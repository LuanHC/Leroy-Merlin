<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductsTest extends TestCase
{
    /**
     * Test to list products.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/products');

        $response->assertStatus(200);
    }
    /**
     * Test to import products.
     *
     * @return void
     */
    public function testStore()
    {
    	Storage::fake('products');
    	$response = $this->json('POST', '/products', [
            'products' => UploadedFile::fake()->create('test.xls','7')
        ]);

        // Assert the file was stored...
        Storage::disk('products')->assertExists('test.xls');

        // Assert a file does not exist...
        Storage::disk('products')->assertMissing('missing.xls');
    }
    /**
     * Test to show list.
     *
     * @return void
     */
    public function testShow()
    {
        $response = $this->get('/products/1');

        $response->assertStatus(200);
    }
    /**
     * Test to update product.
     *
     * @return void
     */
    public function testUpdate()
    {
        $response = $this->json('PUT', '/products/1', [
        	'category_id' => '1',
        	'lm' => '1111',
        	'name' => 'Product Test',
        	'free_shipping' => '1',
        	'description' => 'Description Test',
        	'price' => '111'
        ]);

        $response->assertStatus(200);
    }
    /**
     * Test to delete product.
     *
     * @return void
     */
    public function testDestroy()
    {
        $response = $this->delete('/products/11');

        $response->assertStatus(200);
    }
    /**
     * Test to show list.
     *
     * @return void
     */
    public function testVerify()
    {
        $response = $this->get('/verify');

        $response->assertStatus(200);
    }
}
