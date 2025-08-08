<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transaction');
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
            // ->addColumn('action', function ($item) {
            //     return '<button type="button" command="show-modal" commandfor="dialog" data-item-action="edit" data-item-id="' . $item->id . '" class="text-red-50 py-2 px-4 rounded mb-3">Edit</button>
            //                 <button command="show-modal" commandfor="dialog-delete" class="text-red-50 py-2 px-4 rounded mb-3" data-item-id="' . $item->id . '">Delete</button>';
            // })
            ->make(true);
    }
}
