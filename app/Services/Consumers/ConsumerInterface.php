<?php

namespace App\Services\Consumers;

use PhpAmqpLib\Message\AMQPMessage;

interface ConsumerInterface
{
    public function handle(AMQPMessage $msg);
}
