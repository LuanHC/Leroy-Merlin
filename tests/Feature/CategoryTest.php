<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Entities\Category;

class CategoryTest extends TestCase
{
    use DatabaseTransactions;

    protected $response;
    
    /**
     * Test to show categories.
     *
     * @return void
     */
    public function testShowCategories()
    {
        $response = $this->call('GET', '/categories')
        ->assertStatus(200);
    }
    
    /**
     * Test to get category.
     *
     * @return void
     */
    public function testGetCategories()
    {
        $response = $this->call('GET', '/categories/1')
        ->assertStatus(200);
    }

    /**
     * Test to create category.
     *
     * @return void
     */
    public function testCreateCategory()
    {
        $category = [
            'name' => '123123',
        ];

        $response = $this->call('POST', '/categories', [
            'name' => '123123',
        ])->assertStatus(201)->decodeResponseJson();

        $this->assertContains($category, $response);
    }

    /**
     * Test to create category with no name.
     *
     * @return void
     */
    public function testCreateCategoryWithoutName()
    {
        $reponse = $this->call('POST', '/categories', [
            'name' => '',
        ])->assertStatus(422);
    }

    /**
     * Test to update category.
     *
     * @return void
     */
    public function testUpdateCategory()
    {
        $category = [
            'id' => '1',
            'name' => '123123',
        ];

        $response = $this->call('PUT', '/categories/1', [
            'id' => '1',
            'name' => '123123',
        ])->assertStatus(200)->decodeResponseJson();

        $this->assertContains($category, $response);
    }

    /**
     * Test to update category with no name.
     *
     * @return void
     */
    public function testUpdateCategoryWithoutName()
    {
        $response = $this->call('PUT', '/categories/1', [
            'id' => '1',
            'name' => '',
        ])->assertStatus(422);
    }

    /**
     * Test to update category with no Id.
     *
     * @return void
     */
    public function testUpdateCategoryWithoutId()
    {
        $response = $this->call('PUT', '/categories/1', [
            'id' => '',
            'name' => '123123',
        ])->assertStatus(422);
    }

    /**
     * Test to update category with nothing.
     *
     * @return void
     */
    public function testUpdateCategoryWithNothing()
    {
        $response = $this->call('PUT', '/categories/1', [
            'id' => '',
            'name' => '',
        ])->assertStatus(422);
    }

    /**
     * Test to delete category.
     *
     * @return void
     */
    public function testDropCategory()
    {
        $response = $this->call('DELETE', '/categories/1')
        ->assertStatus(200);
    }
}
