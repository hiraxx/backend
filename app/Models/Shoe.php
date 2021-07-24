<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'size',
        'price',
        'acquired_on',
    ];

    public function container() {
        return $this->belongsTo('App\Models\Shoe', 'acquired_on', 'id');
    }
}
