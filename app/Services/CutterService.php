<?php

namespace App\Services;

use App\Models\Cutter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;

/**
 *
 */
class CutterService extends AbstractService
{
    /**
     * @var HashService $hashService
     */
    protected HashService $hashService;

    /**
     * @var Cutter $model
     */
    protected Model $model;

    /**
     * @param HashService $hashService
     * @param Cutter      $model
     */
    public function __construct(HashService $hashService, Cutter $model)
    {
        $this->hashService = $hashService;
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function create(array $data): bool
    {
        $data['limit'] = $this->checkLimitForCreate($data['limit']);
        $data['hash'] = $this->hashService->getUniqueHash(new Cutter(), Cutter::LIMIT_SYMBOLS);
        $model = $this->model->create($data);

        return (bool) $model->id;
    }

    /**
     * @param Cutter $model
     * @return RedirectResponse|never
     */
    public function redirectByHash(Model $model)
    {
        if (!is_null($model->limit)) {
            if ($model->limit === 0) {
                return abort(404);
            }

            $model->update(['limit' => $model->limit - 1]);
        }
        if (Carbon::parse($model->life_time)->timestamp - now()->timestamp < 1) {
            return abort(404);
        }
        return redirect()->to($model->link);
    }

    /**
     * @param int $limit
     * @return int|null
     */
    protected function checkLimitForCreate(int $limit)
    {
        if ($limit === 0) {
            return null;
        }

        return $limit;
    }
}