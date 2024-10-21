<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestForm extends Model
{
    use HasFactory;

    // Specify the fillable fields
    protected $fillable = [
        'user_id', // Include user_id in the fillable array
        'user_type',
        'document_type',
        'first_name',    // Add first_name field
        'last_name',     // Add last_name field
        'middle_name',   // Add middle_name field
        'student_number',
        'email',
        'contact',
        'dry_seal',
        'status',
    ];

    /**
     * Get the user that owns the request form.
     */
    public function user()
    {
        return $this->belongsTo(User::class); // Define the relationship with the User model
    }
}
