<?php

namespace App\Providers;

use App\Repositories\admin\AdminInterface;
use App\Repositories\admin\AdminRepository;
use App\Repositories\guest\GuestInterface;
use App\Repositories\guest\GuestRepository;
use App\Repositories\app_links\AppLinksInterface;
use App\Repositories\app_links\AppLinksRepository;
use App\Repositories\inquiry\InquiryInterface;
use App\Repositories\inquiry\InquiryRepository;
use App\Repositories\language\LanguageInterface;
use App\Repositories\language\LanguageRepository;
use App\Repositories\license\LicenseInterface;
use App\Repositories\license\LicenseRepository;
use App\Repositories\navigation\NavigationInterface;
use App\Repositories\navigation\NavigationRepository;
use App\Repositories\pages\PageInterface;
use App\Repositories\pages\PageRepository;
use App\Repositories\plans\PlanInterface;
use App\Repositories\plans\PlanRepository;
use App\Repositories\products\ProductInterface;
use App\Repositories\products\ProductRepository;
use App\Repositories\questions\QuestionInterface;
use App\Repositories\questions\QuestionRepository;
use App\Repositories\settings\SettingInterface;
use App\Repositories\settings\SettingRepository;
use App\Repositories\slider_links\SliderLinksInterface;
use App\Repositories\slider_links\SliderLinksRepository;
use App\Repositories\sliders\SliderInterface;
use App\Repositories\sliders\SliderRepository;
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
        $this->app->bind(LicenseInterface::class, LicenseRepository::class);
        $this->app->bind(AdminInterface::class, AdminRepository::class);
        $this->app->bind(LanguageInterface::class, LanguageRepository::class);
        $this->app->bind(InquiryInterface::class, InquiryRepository::class);
        $this->app->bind(GuestInterface::class, GuestRepository::class);
        $this->app->bind(AppLinksInterface::class, AppLinksRepository::class);
        $this->app->bind(SliderInterface::class, SliderRepository::class);
        $this->app->bind(SliderLinksInterface::class, SliderLinksRepository::class);
        $this->app->bind(QuestionInterface::class, QuestionRepository::class);
        $this->app->bind(ProductInterface::class,ProductRepository::class);
        $this->app->bind(SettingInterface::class,SettingRepository::class);
        $this->app->bind(PlanInterface::class,PlanRepository::class);
        $this->app->bind(NavigationInterface::class,NavigationRepository::class);
        $this->app->bind(PageInterface::class,PageRepository::class);
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
