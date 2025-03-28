<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sauce extends Model
{
    protected $table = 'sauces'; // Nom de la table

    protected $fillable = [
        'userId',
        'name',
        'manufacturer',
        'description',
        'mainPepper',
        'imageUrl',
        'heat',
        'likes',
        'dislikes',
        'usersLiked',
        'usersDisliked',
    ];

    /**
     * Casts pour transformer les champs JSON en tableaux PHP.
     */
    protected $casts = [
        'usersLiked' => 'array',
        'usersDisliked' => 'array',
    ];

    public function User()
    {
        return $this->belongsTo('App\Models\User');
    }
}
