<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProduct;
use App\Http\Requests\UpdateProduct;
use App\Services\ProductService;
use App\Jobs\ProcessFile;
use Carbon\Carbon;

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
    public function store(StoreProduct $request)
    {
        $data = $request->file('file');
        \Excel::load($data, function($reader) {

            // Getting all results
            $collect = $reader->noHeading()->limitColumns(5)->first()->toArray();
            $category = $collect[0][1];
            $items = $reader->skipRows(3)->toArray();
            $data = [];
            $category_id = \DB::table('categories')->where('name',$category)->first();

            for($i=0; $i<count($items[0]); $i++)
            {
                array_push($data,[
                    'category_id'=>$category_id->id,
                    'lm'=>$items[0][$i][0],
                    'name'=>$items[0][$i][1],
                    'free_shipping'=>$items[0][$i][2],
                    'description'=>$items[0][$i][3],
                    'price'=>$items[0][$i][4],
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now()
                ]);
            }

            $collection = collect($data);   //turn data into collection

            foreach ($collection as $collect) {            
              ProcessFile::dispatch(\DB::table('products')->insert($collect))->onQueue('products'); //insert chunked data
            }
        });

        return "Success";
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
    public function update(Request $request, $id)
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

    public function verify(){
        $queue = \DB::table('jobs')->where('payload','like','%ProcessFile%')->first();
        if($queue){
            return 'The report in process';
        }else{
            return 'Processed';
        }
    }
}
