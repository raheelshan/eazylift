<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\MessageSent;
use App\Models\Message;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }    
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $message = auth()->user()->messages()->create([
        //     'message' => 'This is a message'
        // ]);

        // broadcast(new MessageSent(auth()->user(), $message))->toOthers();
        return view('home');
    }
}
