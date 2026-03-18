<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function store(Request $request)
    {
        $conversation = Conversation::create([
            'user_id' => $request->user()->id,
            'title' => null,
            'last_message_at' => now(),
        ]);

        $previousPath = (string) (parse_url(url()->previous(), PHP_URL_PATH) ?? '');
        $isAdmin = (bool) ($request->user()?->is_admin);
        $showRoute = $isAdmin ? 'admin.legal.ai.show' : 'chat.show';
        $indexRoute = $isAdmin ? 'admin.dashboard' : 'chat.index';

        if ($request->wantsJson()) {
            return response()->json([
                'id' => $conversation->id,
                'url' => route($showRoute, $conversation),
                'messages_url' => route('messages.store', $conversation),
            ]);
        }

        if ($isAdmin && str_contains($previousPath, '/admin/legal-ai')) {
            return redirect()->route($showRoute, $conversation);
        }

        return redirect()->route($indexRoute);
    }

    public function update(Request $request, Conversation $conversation)
    {
        abort_unless($conversation->user_id === $request->user()->id, 404);

        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:80'],
        ]);

        $conversation->update([
            'title' => $validated['title'] ?: null,
        ]);

        return back();
    }

    public function toggleSave(Request $request, Conversation $conversation)
    {
        abort_unless($conversation->user_id === $request->user()->id, 404);

        $isSaved = ! $conversation->is_saved;

        $conversation->update([
            'is_saved' => $isSaved,
            'saved_at' => $isSaved ? now() : null,
        ]);

        return back();
    }

    public function destroy(Request $request, Conversation $conversation)
    {
        abort_unless($conversation->user_id === $request->user()->id, 404);

        $conversation->delete();

        $previousPath = (string) (parse_url(url()->previous(), PHP_URL_PATH) ?? '');
        $isAdmin = (bool) ($request->user()?->is_admin);

        if ($isAdmin && str_contains($previousPath, '/admin/legal-ai')) {
            return redirect()->route('admin.legal.ai');
        }

        if ($isAdmin) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('chat.index');
    }
}
