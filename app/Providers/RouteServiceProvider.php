<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
        $this->mapUserRoutes();
        $this->mapTrainingRoutes();
        $this->mapTrainingModeRoutes();
        $this->mapTrainingSystemRoutes();
        $this->mapTrainingBrandRoutes();
        $this->mapTrainingTypeRoutes();
        $this->mapTrainingAudienceRoutes();
        $this->mapTrainingTargetRoutes();
        $this->mapTrainingUserRoutes();
        $this->mapTrainingHistoryRoutes();
        $this->mapReportsRoutes();
        $this->mapTopPerformanceRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
    protected function mapUserRoutes()
    {
        Route::prefix('users')
             ->middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/users.php'));
    }
    protected function mapTrainingRoutes()
    {
        Route::prefix('trainings')
             ->middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/trainings.php'));
    }
    protected function mapTrainingModeRoutes()
    {
        Route::prefix('training-modes')
             ->middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/training-modes.php'));
    }

    protected function mapTrainingSystemRoutes()
    {
        Route::prefix('training-system')
             ->middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/training-system.php'));
    }

    protected function mapTrainingBrandRoutes()
    {
        Route::prefix('training-brand')
             ->middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/training-brand.php'));
    }
    protected function mapTrainingTypeRoutes()
    {
        Route::prefix('training-types')
             ->middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/training-types.php'));
    }
    protected function mapTrainingAudienceRoutes()
    {
        Route::prefix('training-audiences')
             ->middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/training-audience.php'));
    }
    protected function mapTrainingTargetRoutes()
    {
        Route::prefix('training-targets')
             ->middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/training-targets.php'));
    }
    protected function mapTrainingUserRoutes()
    {
        Route::prefix('training-users')
             ->middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/training-users.php'));
    }

    protected function mapReportsRoutes()
    {
        Route::prefix('reports')
             ->middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/reports.php'));
    }

    protected function mapTrainingHistoryRoutes()
    {
        Route::prefix('training-histories')
             ->middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/training-histories.php'));
    }

    protected function mapTopPerformanceRoutes()
    {
        Route::prefix('top-performance')
             ->middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/top-performance.php'));
    }
}
