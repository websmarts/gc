<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UpdateManagerController extends Controller
{
    public function edit(User $user)
    {
        return view('admin.edit-manager', compact('user'));
    }


    public function updateName(User $user,Request $request)
    {
            $data = $request->validate([
                'name' => 'required| min:6, max:40'
            ]);
            if($data['name'] == $user->name){
                return redirect()->back()->with('flash','Name submitted was the same as the current name');
            }


            $user->update($data);
            return redirect()->back()->with('flash','Success .. name saved');
    }

    public function updateEmail(User $user,Request $request)
    {
            $data = $request->validate([
                'email' => ['required', Rule::unique('users')->ignore($user->id)],
            ]);
            
            $user->update($data);
            return redirect()->back()->with('flash','Success .. email saved');
    }

    public function updatePassword(User $user,Request $request)
    {
            $data = $request->validate([
                'password' => 'required| min:6'
            ]);
            
            $data['password'] = Hash::make($data['password']);

            $user->update($data);
            return redirect()->back()->with('flash','Success .. password updated');
    }

}
