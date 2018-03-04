<?php

namespace App\Transformers;

use App\Entities\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'category',
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $model)
    {
        return [
            'id' => $model->id,
            'category_id' => $model->category_id,
            'lm' => $model->lm,
            'name' => $model->name,
            'free_shipping' => $model->free_shipping,
            'description' => $model->description,
            'price' => $model->price,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }
}
