<?php

namespace App\Repositories;

use App\Entities\Product;
use App\Jobs\ProcessFile;
use Carbon\Carbon;

class EloquentProduct implements ProductRepository
{
	/**
     * @var Product
     */
    protected $entity;
    /**
     * EloquentProduct constructor.
     * @param Product $entity
     */
    public function __construct(Product $entity)
    {
        $this->entity = $entity;
    }

    /**
     * Get all.
     *
     * @param array|null $include
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all($include)
    {
    	return $this->entity
            ->with(($include ? explode(',', $include) : []))
            ->get();
    }

    /**
     * Get by id.
     *
     * @param array|null $include
     * @param integer $id
     * @return App\Entities\Product
     */
    public function show($include, $id)
    {
    	return $this->entity
            ->with(($include ? explode(',', $include) : []))
            ->where("{$this->entity->getTable()}.id", $id)
            ->firstOrFail();
    }

    /**
     * Create new.
     *
     * @param array $attributes
     * @return App\Entities\Product
     */
    public function store($attributes)
    {
        $return = array();
        \Excel::load($attributes, function($reader) use (&$return) {
            // Getting all results
            $collect = $reader->noHeading()->limitColumns(5)->first()->toArray();
            $category = $collect[0][1];
            $items = $reader->skipRows(3)->toArray();
            $data = [];
            $category_id = \DB::table('categories')->where('name', $category)->first();

            for ($i=0; $i<count($items[0]); $i++) {
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
                ProcessFile::dispatch(\DB::table('products')
                    ->insert($collect))
                    ->onQueue('products'); //insert chunked data
                    $return[] = $collect;
            }
        });
        return $return;
    }

    /**
     * Update by id.
     *
     * @param integer $enterpriseId
     * @param array $attributes
     * @param integer $id
     * @return App\Entities\Product
     */
    public function update(array $attributes, $id)
    {
    	$item = $this->show(null, $id);
        $item->update($attributes);

        return $item;
    }

    /**
     * Destroy by id.
     *
     * @param integer $enterpriseId
     * @param integer $id
     * @return boolean
     */
    public function destroy($id)
    {
    	$item = $this->show(null, $id);
        $item->delete();

        return $item;
    }

}
