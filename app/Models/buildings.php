<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buildings extends Model
{
    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name_of_building',
        'area_acquired',
        'location',
        'make',
        'location',
        'make',
        'num_of_floors',
        'total_floor_area',
        'condition',
        'current_use',
        'how_acquired',
        'cost'
    ];
}
