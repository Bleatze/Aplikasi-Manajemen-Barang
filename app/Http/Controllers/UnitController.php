<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    public function add(Request $request){
        $request->validate([
            'unit_name'=>'required|string',
        ]);
        Unit::create([
            'unit_name'=>$request->unit_name,
        ]);
        return redirect()->back()->with('success','Berhasil menambahkan kategori');
    }
    public function update(Request $request,$id){
        $kategori = Unit::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'unit_name'=>'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'edit_'.$id) 
                ->withInput();
        }

        $validated = $validator->validated();

        $kategori->Unit_name = $validated['unit_name'];
        $kategori->save();

        return redirect()->back()->with('success','Berhasil mengedit kategori');
    }
    
    public function destroy($id){
        $kategori = Unit::findOrFail($id);
        $kategori->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus kategori');
    }
}
