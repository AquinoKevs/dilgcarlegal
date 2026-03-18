<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
<<<<<<< HEAD
=======
use App\Services\GeminiChatClient;
use App\Services\OpenAiChatClient;
>>>>>>> 34036aaff8a4409a974abde8df238722cec97ddb
use App\Services\OpinionRetriever;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MessageController extends Controller
{
<<<<<<< HEAD
    public function store(Request $request, Conversation $conversation, OpinionRetriever $retriever)
=======
    public function store(Request $request, Conversation $conversation, OpenAiChatClient $client, OpinionRetriever $retriever)
>>>>>>> 34036aaff8a4409a974abde8df238722cec97ddb
    {
        abort_unless($conversation->user_id === $request->user()->id, 404);

        $validated = $request->validate([
            'prompt' => ['required', 'string', 'max:8000'],
        ]);

        $prompt = trim($validated['prompt']);

        $userMessage = Message::create([
            'conversation_id' => $conversation->id,
            'role' => 'user',
            'content' => $prompt,
        ]);

        if ($conversation->title === null) {
            $titleSeed = preg_replace('/\\s+/', ' ', $prompt);
            $conversation->update([
                'title' => Str::limit(is_string($titleSeed) ? $titleSeed : $prompt, 60, ''),
            ]);
        }

        $conversation->update(['last_message_at' => now()]);

        $opinions = $retriever->retrieve($prompt, 5);

        if (count($opinions) === 0) {
            $assistantContent = 'The requested legal opinion is not currently available in the system database.';
        } else {
            $lines = [];
            foreach ($opinions as $op) {
                $line = $op['title'].' — '.$op['opinion_number'];
                if ($op['date']) {
                    $line .= ' ('.$op['date'].')';
                }
                $line .= "\n".$op['snippet'];
                $lines[] = $line;
            }

            $assistantContent = "Here are the most relevant legal opinions from the system database:\n\n".implode("\n\n", $lines);
        }

<<<<<<< HEAD
=======
        if ($preface !== '') {
            $aiMessages[] = ['role' => 'system', 'content' => $preface];
        }

        foreach ($history as $message) {
            $aiMessages[] = [
                'role' => $message->role,
                'content' => $message->content,
            ];
        }

        $requestLog = AiRequest::create([
            'user_id' => $request->user()->id,
            'conversation_id' => $conversation->id,
            'provider' => 'openai',
            'model' => config('services.openai.model'),
            'status' => 'pending',
        ]);

        $startedAt = hrtime(true);

        try {
            $useGemini = (string) config('services.gemini.api_key') !== '';
            if ($useGemini) {
                $gemini = app(GeminiChatClient::class);
                $result = $gemini->chat($aiMessages);
            } else {
                $result = $client->chat($aiMessages);
            }
        } catch (AiRequestException $e) {
            $durationMs = (int) ((hrtime(true) - $startedAt) / 1_000_000);
            $requestLog->update([
                'status' => 'error',
                'http_status' => $e->httpStatus,
                'error_type' => $e->errorType,
                'error_code' => $e->errorCode,
                'duration_ms' => $durationMs,
            ]);

            return response()->json([
                'message' => $e->getMessage(),
            ], $e->httpStatus && $e->httpStatus >= 400 ? $e->httpStatus : 500);
        }

        $durationMs = (int) ((hrtime(true) - $startedAt) / 1_000_000);
        $usage = is_array($result['usage'] ?? null) ? $result['usage'] : [];

        $assistantContent = trim((string) $result['content']);

>>>>>>> 34036aaff8a4409a974abde8df238722cec97ddb
        $assistantMessage = Message::create([
            'conversation_id' => $conversation->id,
            'role' => 'assistant',
            'content' => $assistantContent,
            'model' => 'library',
            'response_meta' => [
                'provider' => 'library',
            ],
        ]);

        $conversation->update(['last_message_at' => now()]);

        return response()->json([
            'user_message' => [
                'id' => $userMessage->id,
                'role' => $userMessage->role,
                'content' => $userMessage->content,
                'created_at' => $userMessage->created_at?->toIso8601String(),
            ],
            'assistant_message' => [
                'id' => $assistantMessage->id,
                'role' => $assistantMessage->role,
                'content' => $assistantMessage->content,
                'created_at' => $assistantMessage->created_at?->toIso8601String(),
                'model' => $assistantMessage->model,
                'usage' => [
                    'prompt_tokens' => null,
                    'completion_tokens' => null,
                    'total_tokens' => null,
                ],
            ],
        ]);
    }
}
