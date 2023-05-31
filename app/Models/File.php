<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $table = 'files';


    protected $fillable = [
        'name',
        'size',
        'user_id',
        'path',
        'directory_id',
    ];
}
