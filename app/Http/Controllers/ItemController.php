<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function index()
    {
        return view('items');
    }
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'item_name' => 'required',
            'stock' => 'required',
        ]);

        // dd($request->all());
        // Item::create($request->all());
        $item = Item::create($request->all());
        $item->save();

        // dd($item);

        return redirect()->route('items')->with('success', 'Item created successfully');
    }

    public function data()
    {
        $items = Item::query();
        return datatables()->of($items)
            ->addIndexColumn()
            ->addColumn('created_at', function ($item) {
                return $item->created_at->format('d-m-Y H:i:s');
            })
            ->addColumn('updated_at', function ($item) {
                return $item->updated_at->format('d-m-Y H:i:s');
            })
            ->addColumn('action', function ($item) {
                return '<a href="javascript:void(0)" class="btn btn-primary btn-sm">Edit</a>
                        <button command="show-modal" commandfor="dialog-delete" class="bg-red-500 hover:bg-red-700 text-red-50 py-2 px-4 rounded mb-3" data-item-id="' . $item->id . '">Delete</button>';
            })
            ->make(true);
    }

    public function destroy(Request $request)
    {
        $item = Item::find($request->id);
        $item->delete();

        return redirect()->route('items')->with('success', 'Item deleted successfully');
    }

    public function edit(Request $request)
    {
        $item = Item::find($request->id);
        return response()->json($item);
    }
}
