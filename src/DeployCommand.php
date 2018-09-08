<?php

namespace LaPress\Deployment;

use Illuminate\Console\Command;

/**
 * @author Sebastian Szczepański
 * @copyright Ably
 */
class DeployCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lapress:deploy {--branch=master}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deploy lapress on production server';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Starting deployment process.');
        \Artisan::call('down');

        $this->comment('Updating repository and installing dependencies ...');
        exec('git pull origin '.$this->option('branch'));
        exec('composer install --no-interaction --prefer-dist --optimize-autoloader');

        $this->comment('Updating database structure ...');
        //
        \Artisan::call('migrate', [
            '--force' => true,
        ]);

        // Clear cache
        $this->comment('Clearing cache ...');
        \Artisan::call('cache:clear');
        \Artisan::call('config:cache');
        \Artisan::call('route:cache');

        opcache_reset();
        $this->comment('Opcache cleared.');

        $this->comment('Restarting queues ...');
        \Artisan::call('queue:restart');

        \Artisan::call('up');

        $this->info('Deploy finished.');
    }
}
