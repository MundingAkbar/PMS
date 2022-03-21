<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class requests extends Model
{
    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'effective_date',
        'date_of_request',
        'office',
        'units',
        'nature_of_request',
        'status',
        'requested_by',
        'assigned_personnel',
        'recommending_for',
        'date_returned_by',
        'accepted_by',
    ];
}
