<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Auth\User as Authenticatable;


class InformationsPersonnelle extends Model
{
    use HasFactory;
    protected $collection = 'informations_personnelles';
    protected $connection = 'mongodb';
    protected $fillable = ['nom', 'prenom', 'email', 'image'];
}
