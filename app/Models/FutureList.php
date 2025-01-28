<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FutureList extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'bottle_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec le modèle Bouteille
     */
    public function bottle()
    {
        return $this->belongsTo(Bottle::class);
    }
}
