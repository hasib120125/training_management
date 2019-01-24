<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\User;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use App\Observers\UserObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Blade::directive('canany', function ($arguments) {
            list($permissions, $guard) = explode(',', $arguments.',');

            $permissions = explode('|', str_replace('\'', '', $permissions));

            $expression = "<?php if(auth({$guard})->check() && ( false";
            foreach ($permissions as $permission) {
                $expression .= " || auth({$guard})->user()->can('{$permission}')";
            }

            return $expression . ")): ?>";
        });

        Blade::directive('endcanany', function () {
            return '<?php endif; ?>';
        });
        \Validator::extend('not_contains', function ($attribute, $value, $parameters, $validator) {
          foreach($parameters as $param){
            if(strpos($value, $param) !== false){
              return false;
            }
          }
          return true;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Client::class, function ($app) {
            return ClientBuilder::create()
                ->setHosts(config('services.search.hosts'))
                ->build();
        });
    }
}
