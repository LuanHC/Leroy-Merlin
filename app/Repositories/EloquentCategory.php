<?php

namespace App\Repositories;

use App\Entities\Category;

class EloquentCategory implements CategoryRepository
{
	/**
     * @var Category
     */
    protected $entity;

    /**
     * EloquentCategory constructor.
     * @param Category $entity
     */
    public function __construct(Category $entity)
    {
        $this->entity = $entity;
    }

    /**
     * Get all categories.
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
     * Get category by id.
     *
     * @param array|null $include
     * @param integer $id
     * @return App\Entities\Category
     */
    public function show($include, $id)
    {
    	return $this->entity
            ->with(($include ? explode(',', $include) : []))
            ->where("{$this->entity->getTable()}.id", $id)
            ->firstOrFail();
    }

    /**
     * Create new category.
     *
     * @param array $attributes
     * @return App\Entities\Category
     */
    public function store(array $attributes)
    {
        $item = $this->entity->create($attributes);
        return $item;
    }

    /**
     * Update category by id.
     *
     * @param array $attributes
     * @param integer $id
     * @return App\Entities\Category
     */
    public function update(array $attributes, $id)
    {
    	$item = $this->show(null, $id);
        $item->update($attributes);

        return $item;
    }

    /**
     * Destroy category by id.
     *
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
