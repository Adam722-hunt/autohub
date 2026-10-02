<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageResource;
use App\Http\Requests\StoreMessageRequest;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Vehicle;
use App\Models\AdminSetting;
use Illuminate\Http\Request;
use App\Notifications\NewMessageNotification;

class MessageController extends Controller
{
    public function store(Vehicle $vehicle, StoreMessageRequest $request)
    {
        if (AdminSetting::where('key', 'enable_messaging')->value('value') != 'true') {
            return response()->json([
                'message' => 'Messaging is currently disabled'
            ], 403);
        }

        if ($request->user()->id === $vehicle->user_id) {
            return response()->json([
                'message' => 'You cannot message yourself'
            ], 403);
        }

        if ($conversation = $request->user()->buyerConversations()->where('vehicle_id', $vehicle->id)->first()) {

            return response()->json([
                'message' => 'You have already message this seller',
                'conversation' => $conversation
            ], 200);
        }

        $validated = $request->validated();

        $converation = $request->user()->buyerConversations()->create([
            'seller_id' => $vehicle->user_id,
            'vehicle_id' => $vehicle->id
        ]);


        $message = $converation->messages()->create([
            'sender_id' => $request->user()->id,
            'message' => $validated['message']
        ]);


        return response()->json([
            'message' => 'Conversation and message were created successfully',
            'conversation' => $converation,
            'data' => $message
        ], 201);
    }

    public function send(Conversation $conversation, StoreMessageRequest $request)
    {
        if (AdminSetting::where('key', 'enable_messaging')->value('value') != 'true') {
            return response()->json([
                'message' => 'Messaging is currently disabled'
            ], 403);
        }
        if (
            $conversation->buyer_id !== $request->user()->id &&
            $conversation->seller_id !== $request->user()->id
        ) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }


        $validated = $request->validated();

        $conversation->update([
            'buyer_deleted_at' => null,
            'seller_deleted_at' => null
        ]);

        $message = $conversation->messages()->create([
            'sender_id' => $request->user()->id,
            'message' => $validated['message']
        ]);
        $recipient = $conversation->buyer_id === $request->user()->id
            ? $conversation->seller
            : $conversation->buyer;
        if ($recipient->notificationSettings->messages) {
            $recipient->notify(new NewMessageNotification($message));
        }

        return response()->json([
            'message' => 'sent',
            'data' => new MessageResource($message)
        ], 201);
    }

    public function update(Conversation $conversation, Message $message, StoreMessageRequest $request)
    {
        if (AdminSetting::where('key', 'enable_messaging')->value('value') != 'true') {
            return response()->json([
                'message' => 'Messaging is currently disabled'
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
        if (
            $conversation->buyer_id !== $request->user()->id &&
            $conversation->seller_id !== $request->user()->id
        ) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        if ($message->conversation_id !== $conversation->id) {
            return response()->json([
                'message' => 'Message does not belong to this conversation'
            ], 404);
        }

        if ($message->sender_id !== $request->user()->id) {
            return response()->json([
                'message' => 'You can only edit your own messages'
            ], 403);
        }
        if ($message->deleted_at !== null) {
            return response()->json([
                'message' => 'You cannot edit a deleted message'
            ], 403);
        }

        $validated = $request->validated();

        $message->update([
            'message' => $validated['message'],
        ]);

        return response()->json([
            'message' => 'Message updated',
            'updated_message' => new MessageResource($message)
        ]);
    }

    public function destroy(Conversation $conversation, Message $message, Request $request)
    {
        if (AdminSetting::where('key', 'enable_messaging')->value('value') != 'true') {
            return response()->json([
                'message' => 'Messaging is currently disabled'
            ], 403);
        }
        if (
            $conversation->buyer_id !== $request->user()->id &&
            $conversation->seller_id !== $request->user()->id
        ) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        if ($message->conversation_id !== $conversation->id) {
            return response()->json([
                'message' => 'Message does not belong to this conversation'
            ], 404);
        }

        if ($message->sender_id !== $request->user()->id) {
            return response()->json([
                'message' => 'You can only delete your own messages'
            ], 403);
        }

        $message->update([
            'deleted_at' => now(),
        ]);

        return response()->json([
            'message' => 'Message was successfully deleted'
        ], 200);
    }
}
