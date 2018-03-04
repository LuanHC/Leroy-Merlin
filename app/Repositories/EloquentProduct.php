<?php

namespace App\Repositories;

use App\Entities\Product;

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
    public function store(array $attributes)
    {
        $item = $this->entity->create($attributes);
        return $item;
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
