<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    protected $fillable = [
        'description', 
        'temp',
        'location',
        'user_id'
        ];
    
        public function user(){
            return $this->belongsTo(User::class, 'user_id');
        }
}
