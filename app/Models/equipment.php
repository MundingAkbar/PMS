<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipment extends Model
{
    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'article',
        'requisitioner',
        'deployment',
        'property_number',
        'remarks',
        'units',
        'unit_value',
        'total_value',
        'description'
    ];
}
