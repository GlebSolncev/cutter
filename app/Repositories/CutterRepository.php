<?php

namespace App\Repositories;

use App\Models\Cutter;

/**
 *
 */
class CutterRepository extends AbstractRepository
{

    /**
     * @return string
     */
    protected function classModel()
    {
        return Cutter::class;
    }
}