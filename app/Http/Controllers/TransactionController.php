<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TransactionController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('transaction', compact('items'));
    }

    public function data()
    {
        $items = Transaction::query();
        return datatables()->of($items)
            ->order(function ($query) {
                $query->orderBy('created_at', 'desc');
            })
            ->addIndexColumn()
            ->addColumn('created_at', function ($item) {
                return $item->created_at;
            })
            ->addColumn('item_name', function ($item) {
                return $item->item->item_name;
            })
            ->addColumn('created_by', function ($item) {
                return $item->user->name;
            })
            ->addColumn('action', function ($item) {
                return '<button type="button" command="show-modal" commandfor="dialog" data-item-action="edit" data-item-id="' . $item->id . '" class="text-red-50 py-2 px-4 rounded mb-3">Edit</button>';
            })
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required',
            'transaction_type' => 'required',
            'qty' => 'required',
        ]);

        $item = item::where('id', $request->item_id)->first();
        if ($item->stock < $request->qty) {
            // return redirect()->route('transactions')->with('error', 'Stock not enough');
            return response()->json(['error' => 'Stock not enough'], 200);
        }

        if ($request->transaction_type == 1) {
            $stock = $item->stock + $request->qty;
        } else {
            $stock = $item->stock - $request->qty;
        }

        try {
            Transaction::create([
                'item_id' => $request->item_id,
                'type' => $request->transaction_type,
                'qty' => $request->qty,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);

            item::where('id', $request->item_id)->update([
                'stock' => $stock,
                'updated_by' => Auth::user()->id,
                'updated_at' => Carbon::now(),
            ]);
        } catch (\Exception $e) {
            // return redirect()->route('transactions')->with('error', 'Transaction failed');
            return response()->json(['error' => 'Transaction failed. ' . $e->getMessage()], 200);
        }
        return response()->json(['success' => 'Transaction created successfully'], 200);
        // return redirect()->route('transactions')->with('success', 'Transaction created successfully');
    }
}
