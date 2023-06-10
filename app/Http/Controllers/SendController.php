<?php

namespace App\Http\Controllers;

use App\Jobs\SendTextJob;
use Illuminate\Http\Request;
use PhpAmqpLib\Connection\AMQPSSLConnection;
use PhpAmqpLib\Message\AMQPMessage;

class SendController extends Controller
{
    /**
     * @throws \Exception
     */
    public function sendText(): void
    {
//        SendTextJob::dispatch()->onQueue('text');
        $host = 'localhost';
        $vhost = '/';   // The default vhost is /
        $user = 'user'; // The default user is guest
        $pass = 'user'; // The default password is guest
        $port = 15671;

        $data = "info: Hello World!";
        $exchange = 'email';

        $connection = new AMQPSSLConnection($host, $port, $user, $pass, $vhost, ['verify_peer_name' => false], [], 'ssl');
        $channel = $connection->channel();

        $msg = new AMQPMessage($data);
        $channel->batch_basic_publish($msg, $exchange);
        $channel->publish_batch();

        $channel->close();
        $connection->close();
    }



}
