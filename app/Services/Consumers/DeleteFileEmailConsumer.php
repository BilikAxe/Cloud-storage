<?php

namespace App\Services\Consumers;

use PhpAmqpLib\Message\AMQPMessage;

class DeleteFileEmailConsumer implements ConsumerInterface
{
    public function handle(AMQPMessage $msg)
    {
        // TODO: Implement handle() method.
    }
}
