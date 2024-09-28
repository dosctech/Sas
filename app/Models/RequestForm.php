<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestForm extends Model
{
    use HasFactory;

    protected $table = 'requests';

    protected $fillable = [
        'user_type',
        'document_type',
        'name',
        'student_number',
        'email',
        'contact',
        'dry_seal',
    ];
}
