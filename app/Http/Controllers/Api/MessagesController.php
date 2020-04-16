<?php

namespace App\Http\Controllers\Api;

use App\Events\NewMessageEvent;
use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessagesController extends Controller
{
    public function index() {
        return Message::with('user')->get();
    }

    public function store(Request $request) {
        DB::beginTransaction();
        $item = Message::firstOrCreate([
           'message' => $request->message,
           'user_id' => auth()->id()
        ]);
         $item = Message::with('user')->findOrFail($item->id);
        broadcast(new NewMessageEvent($item));
        DB::commit();

        return $item;

    }
}
