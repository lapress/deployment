<?php

namespace LaPress\Deployment;

use Illuminate\Support\ServiceProvider;

/**
 * @author Sebastian Szczepański
 * @copyright Ably
 */
class DeploymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            DeployCommand::class,
        ]);
    }
}
