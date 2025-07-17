<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function add(Request $request){
        $request->validate([
            'name'=>'required|string|max:100',
            'email'=>'required|email|unique:table_users,email',
            'password'=>'required|min:6',
            'role'=>'required|in:admin,user',
        ]);
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>$request->role,
        ]);
        return redirect()->back()->with('success','Berhasil menambahkan user');
    }
    public function update(Request $request, $id){
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:table_users,email,'.$id,
            'role'  => 'required|in:admin,user',
            'password' => 'nullable|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'edit_'.$id) 
                ->withInput();
        }

        $validated = $validator->validated();

        $user->name  = $validated['name'];
        $user->email = $validated['email'];
        $user->role  = $validated['role'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->back()->with('success','Berhasil mengedit user');
    }
    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus user');
    }

}
