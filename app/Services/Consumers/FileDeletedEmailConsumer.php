<?php

namespace App\Services\Consumers;

use App\Mail\FileDeletedMail;
use App\Models\File;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use PhpAmqpLib\Message\AMQPMessage;

class FileDeletedEmailConsumer implements ConsumerInterface
{
    public function handle(AMQPMessage $msg): void
    {
        $file = File::find($msg->body);
        $user = User::find($file->user_id);
        Mail::to($user->email)->send(new FileDeletedMail($file));
        echo ' [x] Received ', $user->email, "\n";
    }
}
