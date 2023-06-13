<?php

namespace App\Services\Consumes;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use PhpAmqpLib\Message\AMQPMessage;

class EmailConsume
{
    public function sendRegistrationMessage(AMQPMessage $msg): void
    {
        $user = User::find($msg->body);
        event(new Registered($user));
        echo ' [x] Received ', $user->email, "\n";
    }


    public function sendADeleteMessage(AMQPMessage $msg)
    {

    }
}
