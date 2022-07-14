<?php

namespace App\Services;

use App\Models\Cutter;
use App\Repositories\CutterRepository;
use Illuminate\Support\Carbon;

/**
 *
 */
class CutterService extends AbstractService
{
    /**
     * @var CutterRepository $repository
     */
    protected $repository;

    /**
     * @param CutterRepository $repository
     */
    public function __construct(CutterRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->repository->getAll();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function create(array $data)
    {
        $data['limit'] = $this->checkLimitForCreate($data['limit']);
        $data['hash'] = $this->getUniqueHash();

        $model = $this->repository->insertModel($data);

        return (bool) $model->id;
    }

    /**
     * @param string $hash
     * @return \Illuminate\Http\RedirectResponse|never
     */
    public function redirectByHash(string $hash)
    {
        $model = $this->repository->getSingleWithWhere([], [['hash', '=', $hash]]);
        if (!is_null($model->limit)) {
            if ($model->limit === 0) {
                return abort(404);
            }

            $this->repository->updateModel($model, ['limit' => $model->limit - 1]);
        }
        if (Carbon::parse($model->life_time)->timestamp - now()->timestamp < 1) {
            return abort(404);
        }

        return redirect()->to($model->link);
    }

    /**
     * @param $limit
     * @return null
     */
    protected function checkLimitForCreate(int $limit)
    {
        if ($limit === 0) {
            return null;
        }

        return $limit;
    }

    /**
     * @return string
     */
    protected function getUniqueHash()
    {
        $hash = $this->getNewHash();
        if ($exists = $this->repository->getSingleWithWhere([], [['hash', '=', $hash]])) {
            $hash = $this->getUniqueHash();
        }

        return $hash;
    }

    /**
     * @return string
     */
    protected function getNewHash()
    {
        $keys = array_merge(
            range(0, 9),
            range('a', 'z'),
            range('A', 'Z')
        );

        $hash = "";
        for ($i = 1; $i < Cutter::LIMIT_SYMBOLS; $i++) {
            $hash .= $keys[mt_rand(0, count($keys) - 1)];
        }

        return $hash;
    }

}