<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'dentist_id',
        'start_time',
        'end_time'
    ];

    public function dentist()
    {
        return $this->belongsTo(Contact::class, 'dentist_id');
    }
}
