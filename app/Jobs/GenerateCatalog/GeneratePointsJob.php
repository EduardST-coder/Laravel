<?php

namespace App\Jobs\GenerateCatalog;

class GeneratePointsJob extends AbstractJob
{
    public function handle()
    {
        // Можна симулювати помилку:
        // $f = 1 / 0;

        parent::handle(); // викликає debug('done')
    }
}
