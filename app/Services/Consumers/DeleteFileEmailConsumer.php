<?php

namespace App\Services\Consumers;

use App\Models\User;
use PhpAmqpLib\Message\AMQPMessage;

class DeleteFileEmailConsumer implements ConsumerInterface
{
    public function handle(AMQPMessage $msg): void
    {
        $user = User::find($msg->body);

        echo ' [x] Received ', $user->email, "\n";
    }
}
