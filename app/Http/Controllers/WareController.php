<?php

namespace App\Http\Controllers;

use App\Models\Ware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WareController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|exists:categories,id',
            'unit' => 'required|exists:units,id',
            'min_stock' => 'required|integer|min:0',
        ]);

        Ware::create([
            'ware_name' => $request->name,
            'category_id' => $request->category,
            'unit_id' => $request->unit,
            'min_stock' => $request->min_stock,
            'stock' => 0,
        ]);

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan!');
    }

    public function update(Request $request,$id){
        $ware = Ware::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'ware_name'  => 'required|string|unique:wares,ware_name,'.$id,
            'category_id' => 'required|integer',
            'unit_id'  => 'required|integer',
            'min_stock' => 'required|min:0',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'edit_' . $id)
                ->withInput();
        }

        $validated = $validator->validated();

        $ware->update($validated);

        return redirect()->back()->with('success', 'Barang berhasil diperbarui!');
    }
    
    public function destroy($id){
        $ware = ware::findOrFail($id);
        $ware->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus barang');
    }
}