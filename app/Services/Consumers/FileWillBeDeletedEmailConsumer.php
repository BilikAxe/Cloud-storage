<?php

namespace App\Services\Consumers;

use App\Mail\FileWillBeDeletedMail;
use App\Models\File;
use Illuminate\Mail\Mailable;

class FileWillBeDeletedEmailConsumer extends FileDeletedEmailConsumer
{
    public function getMail(File $file): Mailable
    {
        return new FileWillBeDeletedMail($file);
    }
}
