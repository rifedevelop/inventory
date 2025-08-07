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
            ->addColumn('action', function ($item) {
                return '<a href="javascript:void(0)" class="btn btn-primary btn-sm">Edit</a>
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm">Delete</a>';
            })
            ->make(true);
    }
}
