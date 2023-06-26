<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;

    protected $table = 'files';


    protected $fillable = [
        'name',
        'size',
        'user_id',
        'path',
        'owner',
        'directory_id',
        'die_at',
    ];


    public function getPublicPath(): string
    {
        return $this->path;
    }


    public function delete(): ?bool
    {
        Storage::disk('public')->delete($this->path);
        return parent::delete();
    }
}
