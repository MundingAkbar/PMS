<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehicles extends Model
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
        'registration_date',
        'remarks',
        'units',
        'unit_value',
        'total_value',
        'description'
    ];
}
