<?php 

namespace App\Providers; 

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Interfaces\CategoryRepositoryInterface',
            'App\Repositories\CategoryRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\CommentRepositoryInterface',
            'App\Repositories\CommentRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\EditrequestRepositoryInterface',
            'App\Repositories\EditrequestRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\FavcategoryRepositoryInterface',
            'App\Repositories\FavCategoryRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\MemeRepositoryInterface',
            'App\Repositories\MemeRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\NotificationRepositoryInterface',
            'App\Repositories\NotificationRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\ReportmemeRepositoryInterface',
            'App\Repositories\ReportmemeRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\UserRepositoryInterface',
            'App\Repositories\UserRepository'
        );
    }
}