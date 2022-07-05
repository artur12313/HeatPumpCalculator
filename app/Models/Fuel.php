<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fuel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'caloricValue', 'efficiency', 'unit', 'price'
    ];
    
    protected $table = 'fuels';

    public function getCommaPriceAttribute()
    {
        echo (number_format($this->price, 2, ',',''));
    }
}
