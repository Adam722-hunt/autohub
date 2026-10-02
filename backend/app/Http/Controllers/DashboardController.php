<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $my_active_vehicles = $request->user()->vehicles()->where('status', 'active')->count();

        $my_total_views = $request->user()->vehicleViews()->count();

        $my_unread_messages = Message::where('read_at', null)->whereHas('conversation', function ($query) use ($request) {
            $query->where('seller_id', $request->user()->id)->orWhere('buyer_id', $request->user()->id);
        })->where('sender_id', '!=', $request->user()->id)->count();

        $my_total_favorites = $request->user()->vehicles()->withCount('favoritedByUsers')->get()->sum('favorited_by_users_count');

        $my_recent_listings = $request->user()->vehicles()
            ->select('id', 'title', 'price', 'created_at', 'status')
            ->with('primaryImage')
            ->withCount('vehicleViews')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return response()->json([
            'overview' => [
                'active_listings' => $my_active_vehicles,
                'total_views' => $my_total_views,
                'unread_messages' => $my_unread_messages,
                'total_favorites' => $my_total_favorites,
            ],
            'recent_listings' => $my_recent_listings,
        ]);
    }

    public function myListings(Request $request)
    {
        $my_total_worth = $request->user()->vehicles()->sum('price');

        $my_active_listings = $request->user()->vehicles()->where('status', 'active')->count();

        $my_sold_vehicles = $request->user()->vehicles()->where('status', 'sold')->count();

        $my_pending_listings = $request->user()->vehicles()->where('status', 'pending')->count();

        $my_draft_vehicles = $request->user()->vehicles()->where('status', 'draft')->count();

        $my_total_vehicles = $request->user()->vehicles()->count();
        
        $my_listings = $request->user()->vehicles()->select(
            'id',
            'title',
            'price',
            'year',
            'mileage',
            'transmission_id',
            'status',
            'created_at'
        )->with('transmissionType')->withCount('vehicleViews')->withCount('favoritedByUsers')->withCount('conversations')->with('primaryImage');

        if ($request->filled('filter')) {
            switch ($request->filter) {
                case 'active':

                    $my_listings->where('status', 'active');

                    break;

                case 'pending':

                    $my_listings->where('status', 'pending');

                    break;

                case 'sold':

                    $my_listings->where('status', 'sold');

                    break;

                case 'draft':

                    $my_listings->where('status', 'draft');

                    break;
            }
        }
            
        if(
            $request->filled('title')
        ){
            $my_listings->where('title','ILIKE','%'.$request->title. '%');
        }

        $my_listings = $my_listings->orderBy('updated_at','desc')->get();

        return response()->json([

            'quick_recap'=>[

                'total_worth'=>$my_total_worth,
                'total_sold'=>$my_sold_vehicles,
                'total_active'=>$my_active_listings,
                'total_pending'=>$my_pending_listings,
                'total_draft'=>$my_draft_vehicles,
                'total_vehicles'=>$my_total_vehicles

            ],

            'my_listings' => $my_listings
        ]);
    }
}
