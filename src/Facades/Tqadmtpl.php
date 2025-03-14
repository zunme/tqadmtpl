<?php

namespace Taq\Tqadmtpl\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Taq\Tqadmtpl\Tqadmtpl
 */
class Tqadmtpl extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Taq\Tqadmtpl\Tqadmtpl::class;
    }
}
