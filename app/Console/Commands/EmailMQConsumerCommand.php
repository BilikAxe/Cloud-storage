<?php

namespace App\Console\Commands;

use App\Services\RabbitMQService;
use Illuminate\Console\Command;

class EmailMQConsumerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mq:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consume the mq queue';


    /**
     * @throws \Exception
     */
    public function handle(): void
    {
        $mqService = new RabbitMQService();
        $mqService->consume('email');
    }
}
