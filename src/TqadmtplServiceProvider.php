<?php

namespace Taq\Tqadmtpl;
use Livewire\Livewire;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Taq\Tqadmtpl\Commands\TqadmtplCommand;

use Taq\Tqadmtpl\View\Components\Layout;
use Taq\Tqadmtpl\View\Components\Sidebaritem;
use Taq\Tqadmtpl\View\Components\Sidebargroup;

use Taq\Tqadmtpl\Livewire\TqadmSide;

class TqadmtplServiceProvider extends PackageServiceProvider
{

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
            //->hasRoute('web')
            ->hasMigration('create_tqadmtpl_table')
            //->hasCommand(TqadmtplCommand::class);
            ;
    }
    public function packageRegistered(){
        Livewire::component('tqadm-side', TqadmSide::class);
    }
}
