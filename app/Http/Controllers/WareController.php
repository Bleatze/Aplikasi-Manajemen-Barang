<?php

namespace App\Http\Controllers;

use App\Models\Ware;
use App\Models\WareIn;
use App\Models\WareOut;
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

    public function update(Request $request, $id)
    {
        $ware = Ware::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'ware_name'  => 'required|string|unique:wares,ware_name,' . $id,
            'category_id' => 'required|integer',
            'unit_id'  => 'required|integer',
            'min_stock' => 'required|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'edit_' . $id)
                ->withInput()
                ->with('modal_target', 'modal-edit-barang-' . $id);
        }

        $validated = $validator->validated();

        $ware->update($validated);

        return redirect()->back()->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $ware = Ware::findOrFail($id);
        $ware->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus barang');
    }

    public function inAdd(Request $request)
    {
        $request->validate([
            'ware_id' => 'required|integer',
            'amount' => 'required|integer|min:1',
        ]);

        WareIn::create([
            'ware_id' => $request->ware_id,
            'amount' => $request->amount,
        ]);

        return redirect()->back()->with('success', 'Berhasil memasukkan barang');
    }

    public function inUpdate(Request $request, $id)
    {
        $wareIns = WareIn::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'ware_id' => 'required|integer',
            'amount' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'edit_' . $id)
                ->withInput()
                ->with('modal_target', 'modal-edit-masuk-' . $id);
        }

        $validated = $validator->validated();

        $wareIns->update($validated);

        return redirect()->back()->with('success', 'Barang berhasil diperbarui!');
    }

    public function inDestroy($id)
    {
        $wareIns = WareIn::findOrFail($id);
        $wareIns->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus barang');
    }

    public function outAdd(Request $request)
    {
        $request->validate([
            'ware_id' => 'required|exists:wares,id',
            'amount' => 'required|integer|min:1',
        ]);

        $ware = Ware::findOrFail($request->ware_id);

        if ($request->amount > $ware->stock) {
            return redirect()->back()
                ->with('kurang', 'Stok tidak mencukupi untuk barang keluar.')
                ->with('modal_target', 'modal-tambah');
        }

        WareOut::create([
            'ware_id' => $request->ware_id,
            'amount' => $request->amount,
        ]);

        return redirect()->back()->with('success', 'Data barang keluar berhasil ditambahkan.');
    }

    public function outUpdate(Request $request, $id)
    {
        $wareOut = WareOut::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'ware_id' => 'required|exists:wares,id',
            'amount' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'edit_' . $id)
                ->withInput()
                ->with('modal_target', 'modal-edit-keluar-' . $id);
        }

        $validated = $validator->validated();

        $oldWareId = $wareOut->ware_id;
        $oldAmount = $wareOut->amount;

        if ($validated['ware_id'] != $oldWareId) {
            $newWare = Ware::findOrFail($validated['ware_id']);
            if ($validated['amount'] > $newWare->stock) {
                return redirect()->back()
                    ->withErrors(['amount' => 'Stok tidak mencukupi untuk barang baru.'], 'edit_' . $id)
                    ->withInput()
                    ->with('modal_target', 'modal-edit-keluar-' . $id);
            }

            Ware::find($oldWareId)?->increment('stock', $oldAmount);
            $newWare->decrement('stock', $validated['amount']);
        } else {
            $selisih = $validated['amount'] - $oldAmount;
            if ($selisih > 0 && $selisih > $wareOut->ware->stock) {
                return redirect()->back()
                    ->withErrors(['amount' => 'Stok tidak mencukupi untuk jumlah tambahan.'], 'edit_' . $id)
                    ->withInput()
                    ->with('modal_target', 'modal-edit-keluar-' . $id);
            }

            if ($selisih !== 0) {
                $wareOut->ware->decrement('stock', $selisih);
            }
        }

        $wareOut->update($validated);

        return redirect()->back()->with('success', 'Data barang keluar berhasil diubah.');
    }

    public function outDestroy($id)
    {
        $wareOuts = WareOut::findOrFail($id);
        $wareOuts->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus barang');
    }
}
