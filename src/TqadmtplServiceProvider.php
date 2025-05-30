<?php

namespace Taq\Tqadmtpl;
use Livewire\Livewire;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Taq\Tqadmtpl\Commands\TqadmtplCommand;

use Taq\Tqadmtpl\View\Components\Layout;
use Taq\Tqadmtpl\View\Components\Sidebaritem;
use Taq\Tqadmtpl\View\Components\Sidebargroup;
use Taq\Tqadmtpl\View\Components\Sidebarpersist;

use Taq\Tqadmtpl\Livewire\TqadmSide;
use Taq\Tqadmtpl\Livewire\TqadmSidePersist;

use Taq\Tqadmtpl\Livewire\TqadmUsers;

class TqadmtplServiceProvider extends PackageServiceProvider
{
    public function bootingPackage()
    {
    }
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('tqadmtpl')
            ->hasConfigFile()
            ->hasViews('tqadmtpl')
            ->hasViewComponent('tqadm', Layout::class)
            ->hasViewComponent('tqadm', Sidebaritem::class)
            ->hasViewComponent('tqadm', Sidebargroup::class)
            ->hasViewComponent('tqadm', Sidebarpersist::class)
            ->hasAssets()
            ->hasRoutes(['web','api', 'admin'])
            ->hasMigration('create_tq_memos_table')
            //->hasCommand(TqadmtplCommand::class);
            ;
    }

    public function registeringPackage()
    {
    }
    public function packageRegistered(){
        Livewire::component('tqadm-side', TqadmSide::class);
        Livewire::component('tqadm-side-persist', TqadmSidePersist::class);
        Livewire::component('tqadm-users', TqadmUsers::class);
        
    }
}
