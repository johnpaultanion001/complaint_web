<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_of_complainant',
        'grade',
        'section',
        'action_taken',
        'date_of_complaint',
        'name_of_complained',
        'complaint',
    ];
}
