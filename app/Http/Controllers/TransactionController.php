<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
class TransactionController extends Controller
{
    public function index(){
        return view('transactions.index');
    }
    public function edit($id){
        $transaction = Transaction::find($id);
        return view('transactions.edit',['transaction' => $transaction]);
    }
}
