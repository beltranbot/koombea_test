<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\ContactFile;
use App\Models\ContactFileError;
use App\Models\User;
use App\Repositories\ContactFileErrorRepository;
use App\Repositories\ContactFileRepository;
use App\Repositories\ContactRepository;
use App\Repositories\ContactRepositoryInterface;
use App\Repositories\UserRepository;
use App\Services\ContactFileErrorService;
use App\Services\ContactFileErrorServiceInterface;
use App\Services\ContactService;
use App\Services\ContactServiceInterface;
use App\Services\S3StorageService;
use App\Services\UserService;
use App\Services\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserServiceInterface::class, function ($app) {
            return new UserService(new UserRepository(new User()));
        });
        $this->app->bind(ContactServiceInterface::class, function ($app) {
            return new ContactService(
                new S3StorageService("s3", "contact_files/"),
                new ContactFileRepository(new ContactFile()),
                new ContactRepository(new Contact())
            );
        });
        $this->app->bind(ContactRepositoryInterface::class, function ($app) {
            return new ContactRepository(new Contact());
        });
        $this->app->bind(ContactFileErrorServiceInterface::class, function ($app) {
            return new ContactFileErrorService(new ContactFileErrorRepository(new ContactFileError()));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
