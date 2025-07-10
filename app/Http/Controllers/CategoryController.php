<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function add(Request $request){
        $request->validate([
            'category_name'=>'required|string',
        ]);
        Category::create([
            'category_name'=>$request->category_name,
        ]);
        return redirect()->back()->with('success','Berhasil menambahkan kategori');
    }
    public function update(Request $request,$id){
        $kategori = Category::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'category_name'=>'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'edit_'.$id) 
                ->withInput();
        }

        $validated = $validator->validated();

        $kategori->category_name = $validated['category_name'];
        $kategori->save();

        return redirect()->back()->with('success','Berhasil mengedit kategori');
    }
    
    public function destroy($id){
        $kategori = Category::findOrFail($id);
        $kategori->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus kategori');
    }
}
