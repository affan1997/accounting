<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Account;
class AccountController extends Controller
{
    public function index(){
        return view('accounts.index');
    }
    // public function index(){
    //     $accounts = Account::orderBy('id','DESC')->paginate(10);
    //     return view('accounts.index',['accounts' => $accounts]);
    // }
    // public function create(){
    //     return view('accounts.create');
    // }
    // public function store(Request $request){
    //     $account = new Account;
    //     $account->name=str_replace(['And','To','Of','For'],['and', 'to', 'of', 'for'],ucwords(strtolower($request->name)));
    //     $account->head = $request->head;
    //     $account->normal_balance = $request->normal_balance;
    //     $account->save();
    //     return redirect()->route('accounts.index');
    // }
    // public function edit($id){
    //     $account = Account::find($id);
    //     return view('accounts.edit',['account'=>$account]);
    // }
    // public function update(Request $request, $id){
    //     $account = Account::find($id);
    //     $account->name=str_replace(['And','To','Of','For'],['and', 'to', 'of', 'for'],ucwords(strtolower($request->name)));
    //     $account->head = $request->head;
    //     $account->normal_balance = $request->normal_balance;
    //     $account->save();
    //     return redirect()->route('accounts.index');
    // }
    // public function destroy($id){
    //     $account = Account::find($id);
    //     $account->delete();
    //     return redirect()->route('accounts.index');
    // }
    // public function search(Request $request){
    //     $accounts = Account::where('name','LIKE',"%$request->search%")
    //     ->orWhere('head','LIKE',"%$request->search%")
    //     ->orWhere('normal_balance', 'LIKE', "%$request->search%")->paginate(10);
    //     return view('accounts.index',['accounts' => $accounts]);
    // }
}
