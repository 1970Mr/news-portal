<?php

namespace Modules\Common\App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class SendTestEmail extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'email:send-test';

    /**
     * The console command description.
     */
    protected $description = 'Send a test email';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Mail::raw('Hello World!', static function ($msg) {
            $msg->to('test@gmail.com')->subject('Test Email');
        });

        $this->info('Test email sent successfully!');
    }

    /**
     * Get the console command arguments.
     */
    protected function getArguments(): array
    {
        return [
            ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     */
    protected function getOptions(): array
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
