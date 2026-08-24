<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JournalEntryController extends Controller
{
    public function index(){
        return view('journal_entries.index');
    }
}
