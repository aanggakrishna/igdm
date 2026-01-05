<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstagramMessageController extends Controller
{
    public function index()
    {
        $messages = \App\Models\IgRowMessage::latest()->paginate(20);
        return view('instagram.index', compact('messages'));
    }
}
