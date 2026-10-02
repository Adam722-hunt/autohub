<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavedSearch;
class SavedSearchController extends Controller
{
    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|string|max:100',
            'filters' => 'required|array',
        ]);

        $savedSearch = $request->user()->savedSearches()->create([
            'name' => $data['name'],
            'filters' => $data['filters']
        ]);
        return response()->json([
            'message' => 'Search saved successfully',
            'saved_search' => $savedSearch,
        ], 201);
    }


    public function index(Request $request){

        $user_saved_searches=$request->user()->savedSearches()->count();

        $searches=$request->user()->savedSearches()->orderBy('created_at','desc')->get();

        return response()->json([
            'quantity'=>$user_saved_searches,
            'searches'=>$searches,
        ]);
    }


    public function destroy(Request $request,SavedSearch $savedSearch){

        if($request->user()->id!==$savedSearch->user_id){
            return response()->json([
                'message'=>'Unathorized'
            ],403);
        }

        $savedSearch->delete();

        return response()->json([
           'message'=>'Search deleted successfully'
        ]);

    }

    
}
