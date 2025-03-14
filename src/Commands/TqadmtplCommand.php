<?php

namespace Taq\Tqadmtpl\Commands;

use Illuminate\Console\Command;

class TqadmtplCommand extends Command
{
    public $signature = 'tqadmtpl';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
