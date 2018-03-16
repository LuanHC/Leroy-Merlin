<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategory;
use App\Http\Requests\UpdateCategory;
use App\Services\CategoryService;
use App\Jobs\ProcessFile;
use Carbon\Carbon;

class CategoryController extends Controller
{
    /**
     * @var CategoryService
     */
    protected $service;

    /**
     * CategoryController constructor.
     * @param CategoryService $service
     */
    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $include = $request->include;
        return $this->service->all($include);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCategory  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory $request)
    {
        $data = $request->only([
            'name'
        ]);
        
        return $this->service->store($data);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $include = $request->include;
        return $this->service->show($include, $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCategory  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategory $request, $id)
    {
        $data = $request->only([
            'id',
            'name',
        ]);

        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }

    public function verify()
    {
        $queue = \DB::table('jobs')->where('payload', 'like', '%ProcessFile%')->first();

        if (!empty($queue)) {
            return 'The report in process';
        } else {
            return 'Processed';
        }
    }
}
