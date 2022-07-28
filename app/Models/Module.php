<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'price'
    ];

    protected $table = 'modules';

    public function getCommaPriceAttribute()
    {
        echo (number_format($this->price, 2, ',',''));
    }
}
