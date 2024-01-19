<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetupProgram extends Model
{
    use HasFactory;
    // protected $table = 'setup_programs';
    protected $guarded = [
        'id',
    ];
}
