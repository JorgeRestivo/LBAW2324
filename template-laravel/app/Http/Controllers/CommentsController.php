<?php

// app/Http/Controllers/CommentsController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsController extends Controller
{
    // ... (outros métodos existentes) ...

    public function store(Request $request, $eventId)
    {
        // Valide os dados do formulário
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        // Crie o comentário
        $comment = new Comment([
            'content' => $request->input('content'),
            'owner_id' => auth()->id(),
            'event_id' => $eventId,
            'dateTime' => now(), // ou utilize Carbon para uma data/hora mais precisa
        ]);

        // Salve o comentário no banco de dados
        $comment->save();

        // Redirecione de volta para a página do evento
        return redirect()->route('event.show', ['id' => $eventId])->with('success', 'Comment added successfully.');
    }
}
