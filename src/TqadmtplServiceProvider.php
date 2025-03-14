<?php

namespace Taq\Tqadmtpl;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Taq\Tqadmtpl\Commands\TqadmtplCommand;

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
            ->hasViews()
            ->hasMigration('create_tqadmtpl_table')
            ->hasCommand(TqadmtplCommand::class);
    }
}
