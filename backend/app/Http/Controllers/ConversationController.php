<?php

namespace App\Http\Controllers;
use App\Http\Resources\ConversationResource;
use App\Models\Conversation;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index(Request $request)
    {

        $conversations = Conversation::where('seller_id', $request->user()->id)->whereNull('seller_deleted_at')
            ->orWhere('buyer_id', $request->user()->id)->whereNull('buyer_deleted_at')->with('latestMessage')->withMax('messages', 'created_at')->withCount([
                    'messages as unread_messages_count' => function ($query) use ($request) {
                        $query->whereNull('read_at')->where('sender_id', '!=', $request->user()->id);
                    }
                ])->orderByRaw('messages_max_created_at DESC NULLS last')->get();

        return response()->json([
            'conversations' => ConversationResource::collection($conversations)
        ]);

    }

    public function show(Request $request, Conversation $conversation)
    {

        if ($conversation->buyer_id !== $request->user()->id && $conversation->seller_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }
        if (
            ($conversation->buyer_id === $request->user()->id && $conversation->buyer_deleted_at !== null) ||
            ($conversation->seller_id === $request->user()->id && $conversation->seller_deleted_at !== null)
        ) {
            return response()->json([
                'message' => 'You have deleted this conversation'
            ], 403);
        }
        $conversation->messages()->whereNull('read_at')->where('sender_id', '!=', $request->user()->id)->update(['read_at' => now()]);

        $my_conversation = $conversation->load([
            'messages' => function ($query) {
                $query->orderBy('created_at', 'asc');
            },
            'vehicle',
            'seller',
            'buyer'
        ]);

        return response()->json([
            'conversation' => new ConversationResource($my_conversation),
        ]);
    }

    public function destroy(Conversation $conversation, Request $request)
    {
        if (
            $conversation->buyer_id !== $request->user()->id &&
            $conversation->seller_id !== $request->user()->id
        ) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        if ($request->user()->id === $conversation->seller_id) {
            $conversation->update([
                'seller_deleted_at' => now()
            ]);
        } else {
            $conversation->update([
                'buyer_deleted_at' => now()
            ]);
        }

        return response()->json([
            'message' => 'Conversation deleted successfully'
        ], 200);
    }
}
