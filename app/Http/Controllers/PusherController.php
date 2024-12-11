<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSent; // Ensure this class exists in the App\Events namespace


class PusherController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function broadcast(Request $request)
    {
        broadcast(new MessageSent($request->get('message'), $request->user()))->toOthers();

        return view('broadcast', ['message' => $request->get('message')]);
    }

    public function receive(Request $request)
    {
        return view('receive', ['message' => $request->get('message')]);
    }
}
