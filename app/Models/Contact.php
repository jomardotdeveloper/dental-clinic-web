<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 
        'last_name', 
        'middle_name', 
        'contact_number', 
        'user_id', 
        'is_dentist', 
        'is_patient', 
        'is_admin', 
        'is_staff'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
