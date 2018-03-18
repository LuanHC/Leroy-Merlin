<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Entities\Product;

class ProductsTest extends TestCase
{
    use DatabaseTransactions;
    
    protected $response;

    /**
     * Test to list all products.
     *
     * @return void
     */
    public function testListProducts()
    {
        $response = $this->call('GET', '/products')
        ->assertStatus(200);
    }

    /**
     * Test to get specific product.
     *
     * @return void
     */
    public function testGetProducts()
    {
        $response = $this->call('GET', '/products/1')
        ->assertStatus(200);
    }


    public function testUploadProducts()
    {
        $stub = __DIR__.'/file/test.xlsx';
        $name = str_random(8).'.xlsx';
        $path = sys_get_temp_dir().'/'.$name;

        copy($stub, $path);

        $file = new UploadedFile(
            $path,
            $name,
            filesize($path),
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true
        );

        $response = $this->call('POST', '/products', [
            'file' => $file,
        ])->getContent();

        $this->assertContains('"status_code":201', $response);
    }
    
    /**
     * Test to update product.
     *
     * @return void
     */
    public function testUpdateProduct()
    {

        $product = [
            "id" => 1,
            "category_id" => 1,
            "lm" => 1001,
            "name" => "Furadeira X",
            "free_shipping" => 0,
            "description" => "Furadeira eficiente X",
            "price" => 100
        ];

        $response = $this->call('PUT', '/products/1', [
            'id' => '1',
            'category_id' => '1',
            'lm' => '1001',
            'name' => 'Furadeira X',
            'free_shipping' => '0',
            'description' => 'Furadeira eficiente X',
            'price' => 100.00,
        ])->assertStatus(200)->decodeResponseJson();

        $this->assertContains($product, $response);
    }

    /**
     * Test to update product with no Id.
     *
     * @return void
     */
    public function testUpdateProductWithoutId()
    {
        $response = $this->call('PUT', '/products/1', [
            'category_id' => '1',
            'lm' => '1001',
            'name' => 'Furadeira X',
            'free_shipping' => '0',
            'description' => 'Furadeira eficiente X',
            'price' => 100.00,
        ])->assertStatus(422);
    }

    /**
     * Test to update product with no categoryId.
     *
     * @return void
     */
    public function testUpdateProductWithoutCategoryId()
    {
        $response = $this->call('PUT', '/products/1', [
            'id' => '1',
            'lm' => '1001',
            'name' => 'Furadeira X',
            'free_shipping' => '0',
            'description' => 'Furadeira eficiente X',
            'price' => 100.00,
        ])->assertStatus(422);
    }

    /**
     * Test to update product with no lm.
     *
     * @return void
     */
    public function testUpdateProductWithoutCategoryLm()
    {
        $response = $this->call('PUT', '/products/1', [
            'id' => '1',
            'category_id' => '1',
            'name' => 'Furadeira X',
            'free_shipping' => '0',
            'description' => 'Furadeira eficiente X',
            'price' => 100.00,
        ])->assertStatus(422);
    }

    /**
     * Test to update product with no name.
     *
     * @return void
     */
    public function testUpdateProductWithoutCategoryName()
    {
        $response = $this->call('PUT', '/products/1', [
            'id' => '1',
            'category_id' => '1',
            'lm' => '1001',
            'free_shipping' => '0',
            'description' => 'Furadeira eficiente X',
            'price' => 100.00,
        ])->assertStatus(422);
    }

    /**
     * Test to update product with no free_shipping.
     *
     * @return void
     */
    public function testUpdateProductWithoutCategoryFreeShipping()
    {
        $response = $this->call('PUT', '/products/1', [
            'id' => '1',
            'category_id' => '1',
            'lm' => '1001',
            'name' => 'Furadeira X',
            'description' => 'Furadeira eficiente X',
            'price' => 100.00,
        ])->assertStatus(422);
    }

    /**
     * Test to update product with no description.
     *
     * @return void
     */
    public function testUpdateProductWithoutCategoryDescription()
    {
        $response = $this->call('PUT', '/products/1', [
            'id' => '1',
            'category_id' => '1',
            'lm' => '1001',
            'name' => 'Furadeira X',
            'free_shipping' => '0',
            'price' => 100.00,
        ])->assertStatus(422);
    }

    /**
     * Test to update product with no price.
     *
     * @return void
     */
    public function testUpdateProductWithoutCategoryPrice()
    {
        $response = $this->call('PUT', '/products/1', [
            'id' => '1',
            'category_id' => '1',
            'lm' => '1001',
            'name' => 'Furadeira X',
            'free_shipping' => '0',
            'description' => 'Furadeira eficiente X',
        ])->assertStatus(422);
    }

    /**
     * Test to delete product.
     *
     * @return void
     */
    public function testDropProduct()
    {
        $response = $this->call('DELETE', '/products/1')
        ->assertStatus(200);
    }
}
