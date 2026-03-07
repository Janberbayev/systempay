<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request, Conversation $conversation)
    {
        $request->validate([
            'body' => 'required|string|max:5000'
        ]);

        // Проверка доступа
        abort_unless(
            $conversation->participants()
                ->where('user_id', auth()->id())
                ->exists(),
            403
        );

        // Создание сообщения
        $conversation->messages()->create([
            'sender_id' => auth()->id(),
            'body' => $request->body
        ]);

        // Обновляем дату последнего сообщения
        $conversation->update([
            'last_message_at' => now()
        ]);

        return back();
    }
}
