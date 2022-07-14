<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class HashService extends AbstractService
{
    /**
     * @param Model $model
     * @param int   $limit
     * @return string
     */
    public function getUniqueHash(Model $model, int $limit): string
    {
        $hash = $this->getNewHash($limit);
        if ($exists = $model->where([['hash', '=', $hash]])->first()) {
            $hash = $this->getUniqueHash($model, $limit);
        }

        return $hash;
    }

    /**
     * @param int $limit
     * @return string
     */
    public function getNewHash(int $limit): string
    {
        $keys = array_merge(
            range(0, 9),
            range('a', 'z'),
            range('A', 'Z')
        );

        $hash = '';
        for ($i = 1; $i < $limit; $i++) {
            $hash .= $keys[mt_rand(0, count($keys) - 1)];
        }

        return $hash;
    }

}