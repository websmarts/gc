<?php
namespace App;

use Illuminate\Support\Arr;

class Settings {

    protected $model;
    protected $allowed;
    
    
    public function __construct($model,$allowed = false)
    {
        $this->model = $model;
        $this->allowed = $allowed;
    }

    /**
     * Merges allowed attributes into model settings (json) attribute 
     */
    public function merge(array $attributes)
    {
      
        $settings = array_merge(
            $this->model->settings ? $this->model->settings :[],
            Arr::only($attributes,$this->allowed)
        );
        return $this->model->update(compact('settings') );
    }

    public function allowedKeys()
    {
        return $this->allowed;
    }

    


}