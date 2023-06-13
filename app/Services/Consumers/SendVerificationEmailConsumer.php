<?php

namespace App\Services\Consumers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use PhpAmqpLib\Message\AMQPMessage;

class SendVerificationEmailConsumer implements ConsumerInterface
{
    public function handle(AMQPMessage $msg): void
    {
        $user = User::find($msg->body);
        event(new Registered($user));
        echo ' [x] Received ', $user->email, "\n";
    }
}
