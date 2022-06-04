<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class InventoryController extends Controller
{
    public function list()
    {
        $user = Auth::user();

        if ($user->hasRole('Admin') == true) {
            $inventory = Inventory::query()->orderBy('created_at')->get();

            return view('inventory.list', compact('inventory'));
        }

        $inventory = Inventory::query()->where('user_id', '=', $user->id)->orderBy('created_at')->get();

        return view('inventory.list', compact('inventory'));
    }

    public function add()
    {
        return view('inventory.add');
    }

    public function edit($id)
    {
        $inventory = Inventory::query()->where('id', $id)->first();

        return view('inventory.edit', compact('inventory'));
    }

    public function delete($id)
    {
        Inventory::query()->where('id', $id)->delete();

        return redirect()->route('inventory.list')->with('success', 'Delete Inventory.');

    }

    public function store(Request $request)
    {
        // Validations
        $request->validate([
            'name_inventory' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'condition' => 'required',
        ]);


        try {

           Inventory::create([
                'name' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
                'user_id' => Auth::user()->id,
                'description' => $request->description,
                'name_inventory' => $request->name_inventory,
                'stock' => $request->stock,
                'condition' => $request->condition,
            ]);

            return redirect()->route('inventory.list')->with('success', 'User Created Successfully.');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function change($id,Request $request)
    {
        // Validations
        $request->validate([
            'name_inventory' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'condition' => 'required',
        ]);


        try {

            Inventory::where('id',$id)->update([
                'description' => $request->description,
                'name_inventory' => $request->name_inventory,
                'stock' => $request->stock,
                'condition' => $request->condition,
            ]);

            return redirect()->route('inventory.list')->with('success', 'Inventory Update Successfully.');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
}
