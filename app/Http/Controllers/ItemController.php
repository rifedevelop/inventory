<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index()
    {
        return view('items');
    }

    public function data()
    {
        $items = Item::query();
        return datatables()->of($items)
            ->order(function ($query) {
                $query->orderBy('updated_at', 'desc');
            })
            ->addIndexColumn()
            ->addColumn('created_at', function ($item) {
                return $item->created_at;
            })
            ->addColumn('updated_at', function ($item) {
                return $item->updated_at; //->format('d-m-Y H:i:s');
            })
            ->addColumn('action', function ($item) {
                return '<button type="button" command="show-modal" commandfor="dialog" data-item-action="edit" data-item-id="' . $item->id . '" class="text-red-50 py-2 px-4 rounded mb-3">Edit</button>
                        <button command="show-modal" commandfor="dialog-delete" class="text-red-50 py-2 px-4 rounded mb-3" data-item-id="' . $item->id . '">Delete</button>';
            })
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'item_name' => 'required',
            'stock' => 'required',
        ]);

        // Item::create($request->all());
        // $item = Item::create($request->all());
        $item = Item::create([
            'code' => 'ITM' . date('dmY') . str_pad($this->getNextItemNumber(), 4, '0', STR_PAD_LEFT),
            'category' => $request->category,
            'item_name' => $request->item_name,
            'stock' => $request->stock,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $item->save();

        return redirect()->route('items')->with('success', 'Item created successfully');
    }

    public function edit(Request $request)
    {
        $item = Item::find($request->id);
        return response()->json($item);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'category' => 'required',
            'item_name' => 'required',
            'stock' => 'required',
        ]);
        $item = Item::find($request->id);
        $item->update($request->all());
        return redirect()->route('items')->with('success', 'Item updated successfully');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $item = Item::find($request->id);
        $item->delete();

        return redirect()->route('items')->with('success', 'Item deleted successfully');
    }

    /**
     * Get the next item number for generating the item code
     * This method ensures sequential numbering even if items are deleted
     */
    private function getNextItemNumber()
    {
        // Get the current date format for the code prefix
        $currentDatePrefix = 'ITM' . date('dmY');

        // Find the highest number used in existing codes with the same date prefix
        $lastItem = Item::where('code', 'like', $currentDatePrefix . '%')
            ->orderBy('code', 'desc')
            ->first();

        if ($lastItem) {
            // Extract the numeric part from the code
            $lastNumber = (int) substr($lastItem->code, strlen($currentDatePrefix));
            return $lastNumber + 1;
        }

        // If no items exist with today's date prefix, start with 1
        return 1;
    }
}
