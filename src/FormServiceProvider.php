<?php

namespace Parfumix\FormBuilder;

use Illuminate\Support\ServiceProvider;
use Flysap\Support;

class FormServiceProvider extends Serviceprovider {

    public function boot() {
        $this->loadConfiguration();

        $this->publishes([
            __DIR__.'/../configuration' => config_path('yaml/form-builder'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app->singleton('form', function() {
            return (new Form);
        });
    }

    /**
     * Load configuration .
     *
     * @return $this
     */
    protected function loadConfiguration() {
        Support\set_config_from_yaml(
            __DIR__ . '/../configuration/general.yaml' , 'form-builder'
        );

        Support\merge_yaml_config_from(
            config_path('yaml/form-builder/general.yaml') , 'form-builder'
        );

        return $this;
    }
}

