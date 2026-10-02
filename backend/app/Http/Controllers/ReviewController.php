<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Notifications\NewReviewNotification;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request, User $user)
    {

        if ($request->user()->id === $user->id) {
            return response()->json([
                'message' => 'You cannot review yourself'
            ], 403);
        }

        if ($request->user()->reviewerReviews()->where('reviewed_user_id', $user->id)->exists()) {
            return response()->json([
                'message' => 'You have already reviewed this seller'
            ], 409);
        }

        $reviewData = $request->validated();

        $review = $request->user()->reviewerReviews()->create([
            'reviewed_user_id' => $user->id,
            'rating' => $reviewData['rating'],
            'comment' => $reviewData['comment'] ?? null,
        ]);
        if ($user->notificationSettings->reviews) {

            $user->notify(new NewReviewNotification($review));
        }

        return response()->json([
            'message' => 'You have successfully reviewed this seller',
            'review' => $review
        ], 201);
    }

    public function reviewerIndex(Request $request)
    {
        $reviews = $request->user()->reviewerReviews()->latest()->get();

        if ($reviews->isEmpty()) {
            return response()->json([
                'message' => 'You have no reviews',
                'reviews' => []
            ], 200);
        }

        return response()->json([
            'reviews' => $reviews,
        ], 200);
    }

    public function reviewedUserIndex(Request $request)
    {
        $reviews = $request->user()->receivedReviews()->latest()->get();

        if ($reviews->isEmpty()) {
            return response()->json([
                'message' => 'No one has reviewed you yet',
                'reviews' => []
            ], 200);
        }

        return response()->json([
            'reviews' => $reviews,
        ], 200);
    }

    public function update(UpdateReviewRequest $request, Review $review)
    {

        if ($request->user()->id !== $review->reviewer_id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $reviewData = $request->validated();

        $review->update($reviewData);

        return response()->json([
            'message' => 'Review updated successfully',
            'review' => $review->refresh(),
        ]);
    }

    public function destroy(Request $request, Review $review)
    {

        if ($request->user()->id !== $review->reviewer_id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $review->delete();

        return response()->json([
            'message' => 'Review deleted successfully'
        ], 200);
    }

    public function getRating(Request $request)
    {
        $user = $request->user();

        $reviewsCount = $user->receivedReviews()->count();

        if ($reviewsCount === 0) {
            return response()->json([
                'message' => 'No reviews yet'
            ], 200);
        }

        $rate = $user->receivedReviews()->avg('rating');

        return response()->json([
            'rate' => $rate,
            'reviewCount' => $reviewsCount
        ]);
    }
}
