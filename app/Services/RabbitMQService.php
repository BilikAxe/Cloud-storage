<?php

namespace App\Services;

use App\Exceptions\ConsumerNotFoundException;
use App\Services\Consumers\ConsumerInterface;
use App\Services\Consumers\FileDeletedEmailConsumer;
use App\Services\Consumers\FileWillBeDeletedEmailConsumer;
use App\Services\Consumers\SendVerificationEmailConsumer;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQService
{
    private array $consumers = [
        'email' => SendVerificationEmailConsumer::class,
        'willBeDelete' => FileWillBeDeletedEmailConsumer::class,
        'deleted' => FileDeletedEmailConsumer::class,
    ];


    /**
     * @throws \Exception
     */
    public function publish(string $message, string $queue): void
    {
        $connection = new AMQPStreamConnection(env('MQ_HOST'), env('MQ_PORT'), env('MQ_USER'), env('MQ_PASS'), env('MQ_VHOST'));
        $channel = $connection->channel();
        $channel->exchange_declare('test_exchange', 'direct', false, false, false);
        $channel->queue_declare($queue, false, false, false, false);
        $channel->queue_bind($queue, 'test_exchange', 'test_key');
        $msg = new AMQPMessage($message);
        $channel->basic_publish($msg, 'test_exchange', 'test_key');
        echo " [x] Sent $message to test_exchange / test_queue.\n";
        $channel->close();
        $connection->close();
    }


    /**
     * @throws \Exception
     */
    public function consume(string $queue): void
    {
        $connection = new AMQPStreamConnection(env('MQ_HOST'), env('MQ_PORT'), env('MQ_USER'), env('MQ_PASS'), env('MQ_VHOST'));
        $channel = $connection->channel();
        $callback = function ($msg) use ($queue) {

            if (! isset($this->consumers[$queue])) {
                throw new ConsumerNotFoundException("Message: Not found queue " . $queue);
            }

            $consumer = $this->consumers[$queue];
            $obj = new $consumer();

            if ($obj instanceof ConsumerInterface){
                $obj->handle($msg);
            }

        };
        $channel->queue_declare($queue, false, false, false, false);
        $channel->basic_consume($queue, '', false, true, false, false, $callback);
        echo "Waiting for new message on $queue", " \n";
        while ($channel->is_consuming()) {
            $channel->wait();
        }
        $channel->close();
        $connection->close();
    }
}
