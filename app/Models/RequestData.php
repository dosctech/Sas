<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestData extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural of the model name
    protected $table = 'request_data'; // Change this to your actual table name

    // Specify the fields that are mass assignable
    protected $fillable = [
        'user_type',
        'document_type',
        'dry_seal',
        'name',
        'student_number',
        'email',
        'contact',
        'status',
    ];
}
