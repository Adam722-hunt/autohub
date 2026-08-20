<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Vehicle;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Report;
use App\Models\Country;
use App\Models\City;
use App\Models\SavedSearch;
use App\Models\Review;

use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'phone',
        'country_id',
        'city_id',
        'avatar',
        'bio',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function sellerConversations()
    {
        return $this->hasMany(Conversation::class, 'seller_id');
    }
    public function buyerConversations()
    {
        return $this->hasMany(Conversation::class, 'buyer_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function favoriteVehicles()
    {
        return $this->belongsToMany(Vehicle::class, 'favorites');
    }

    public function savedSearches()
    {
        return $this->hasMany(SavedSearch::class);
    }

    public function reviewerReviews()
    {
        return $this->hasMany(Review::class, 'reviewer_id');
    }

    public function receivedReviews()
    {
        return $this->hasMany(Review::class, 'reviewed_user_id');
    }
}
