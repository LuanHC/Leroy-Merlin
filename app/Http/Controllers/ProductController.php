<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProduct;
use App\Http\Requests\UpdateProduct;
use App\Services\ProductService;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    protected $service;

    /**
     * ProductController constructor.
     * @param ProductService $service
     */
    public function __construct(ProductService $service)
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
     * @param  StoreProduct  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->file('file');
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
     * @param  UpdateProduct  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProduct $request, $id)
    {
        $data = $request->only([
            'id', 
            'category_id',
            'lm',
            'name',
            'free_shipping',
            'description',
            'price',
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
