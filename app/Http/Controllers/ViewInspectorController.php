<?php

namespace App\Http\Controllers;


use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class ViewInspectorController extends Controller
{

    protected $files;
    protected $fileContent;
    protected $fileName;




    public $fileUsage = [];
    public $layoutUsage = [];
    public $componentUsage = [];
    public $livewireComponentUsage = [];
    public $usedComponentSourceFiles = [];
    public $usedLivewireComponentSourceFiles = [];
    public $includedFiles = [];



    public function index()
    {
        
        $this->files = Storage::disk('views')->allFiles();

        foreach ($this->files as $this->fileName) {

            $this->fileContent = Storage::disk('views')->get($this->fileName);

            $this->getLayout();
            $this->getComponents();
            $this->getLivewireComponents();
            $this->getIncludes();

            
        }
        $this->pruneOutUnusedFiles();
        

        $data = [
            'included_files' => $this->includedFiles,
            'unused_files' =>$this->files,
            'files' => $this->fileUsage, 
            'layouts'=>$this->layoutUsage, 
            'components' => $this->componentUsage,
            'livewire' => $this->livewireComponentUsage,
            'used_component_source_files' => $this->usedComponentSourceFiles,
            'used_livewire_source_files' => $this->usedLivewireComponentSourceFiles,
        ];


        
        //dd($data);
        return view('view-inspector')->with('data', $data);
    }

    private function pruneOutUnusedFiles()
    {
        
        foreach($this->files as $key => $filename ){
            if(
                array_key_exists($filename, $this->fileUsage) 
                || array_key_exists($filename, $this->usedComponentSourceFiles)
                || array_key_exists($filename, $this->usedLivewireComponentSourceFiles)
                || array_key_exists($filename, $this->includedFiles)
                 ) {
                unset($this->files[$key]);
            }
        }
        
    }

    private function getLayout()
    {
        $pattern = "/\@extends\(\'([^\']+)?\'/is";
        $layout =  $this->matchFirst($pattern, $this->fileContent);

        if ($layout) {
            $this->layoutUsage[$layout][] = $this->fileName;
            $this->fileUsage[$this->fileName]['layout'] = $layout;
        }
    }

    private function getComponents()
    {
        $pattern = "#<x-([\w\-\.]+)?[ \/>]*#";
        $matches = $this->matchAll($pattern, $this->fileContent);

       

        if ($matches && isset($matches[1])) {
            foreach ($matches[1] as $m) {
                $this->componentUsage[$m][] = $this->fileName;
                $this->fileUsage[$this->fileName]['components'][] = $m;

                // get filename of component and record its usage
                $source  = 'components/' . str_replace('.','/',$m) . '.blade.php';
                $this->usedComponentSourceFiles[$source] = $m;
            }
        }
    }

    private function getIncludes()
    {
        /*
        * @include('[path].name')
        */
        $pattern = "#\@include\(\'([^\']+)?\'#";
        $matches = $this->matchAll($pattern, $this->fileContent);
        if ($matches && isset($matches[1])) {
            foreach ($matches[1] as $m) {
               
                $this->fileUsage[$this->fileName]['includes'][] = $m;

                // get filename of include and record its usage
                $source  =  str_replace('.','/',$m) . '.blade.php';
                $this->includedFiles[$source][] = $this->fileName;
            }
        }
    }

    private function getLivewireComponents()
    {
       /*
       * <livewire:[path].name 
       */
       
        $pattern = "#<livewire:([\w\-]+)?[ \/>]*#";
        $matches = $this->matchAll($pattern, $this->fileContent);
        if ($matches && isset($matches[1])) {
            foreach ($matches[1] as $m) {
                $this->livewireComponentUsage[$m][] = $this->fileName;
                $this->fileUsage[$this->fileName]['livewire-components'][] = $m;

                // get filename of component and record its usage
                $source  = 'livewire/' . str_replace('.','/',$m) . '.blade.php';
                $this->usedLivewireComponentSourceFiles[$source] = $m;
            }
        }

        /*
        * @livewire('[path].name')
        */
        $pattern = "#\@livewire\(\'([^\']+)?\'#";
        $matches = $this->matchAll($pattern, $this->fileContent);
        if ($matches && isset($matches[1])) {
            foreach ($matches[1] as $m) {
                $this->livewireComponentUsage[$m][] = $this->fileName;
                $this->fileUsage[$this->fileName]['livewire-components'][] = $m;

                // get filename of component and record its usage
                $source  = 'livewire/' . str_replace('.','/',$m) . '.blade.php';
                $this->usedLivewireComponentSourceFiles[$source] = $m;
            }
        }


    }

    private function matchFirst($pattern, $content)
    {

        $matches = [];
        try {
            preg_match($pattern, $content, $matches);
        } catch (Exception $e) {
        }

        return isset($matches[1]) ? $matches[1] : null;
    }

    private function matchAll($pattern, $content)
    {
        $matches = [];
        try {
            preg_match_all($pattern, $content, $matches);
        } catch (Exception $e) {
        }
        return $matches;
    }
}
