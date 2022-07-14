<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pump extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'price'
    ];

    protected $table = 'pump';

    public function getCommaPriceAttribute()
    {
        echo (number_format($this->price, 2, ',',''));
    }
}
