<?php

namespace App\Http\Controllers;

use App\Http\Requests\CutterRequest;
use App\Services\CutterService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

/**
 *
 */
class CutterController extends Controller
{
    /**
     * @var CutterService $service
     */
    protected $service;

    /**
     * @param CutterService $service
     */
    public function __construct(CutterService $service)
    {
        $this->service = $service;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $links = $this->service->getAll();

        return view('welcome', [
            'links' => $links,
        ]);
    }

    /**
     * @param CutterRequest $request
     * @return RedirectResponse
     */
    public function store(CutterRequest $request)
    {
        if ($this->service->create($request->all())) {
            return redirect()->route('home');
        }
    }

    /**
     * @param Model $model
     * @return RedirectResponse|never
     */
    public function redirect(Model $model)
    {
        return $this->service->redirectByHash($model);
    }
}