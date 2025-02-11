<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Repositories\Eloquent\CategoryRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class CategoryRepoTest extends TestCase
{
    use RefreshDatabase;

    protected $repository;

    protected $dummyData = ["name" => "Test Category", "parent_category_id" => null];

    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
        $this->repository = new CategoryRepository(new Category());
    }

    public function test_can_create_category()
    {
        $cat = $this->repository->create($this->dummyData);

        $this->assertInstanceOf(Category::class, $cat);
        $this->assertEquals("Test Category", $cat->name);
        $this->assertDatabaseHas('categories', ['name' => 'Test Category']);
    }

    public function test_can_udpate_category()
    {
        $cat = $this->repository->create($this->dummyData);

        $updateData = ['name' => 'Test Category Updated'];
        $updated = $this->repository->update($cat->id, $updateData);

        $this->assertTrue($updated);
        $this->assertDatabaseHas('categories', ['name' => 'Test Category Updated']);
    }

    public function test_can_delete_cateogory()
    {
        $cat = $this->repository->create($this->dummyData);

        $deleted = $this->repository->delete($cat->id);

        $this->assertTrue($deleted);
        $this->assertDatabaseMissing("categories", ["id" => $cat->id]);
    }

    public function test_can_fetch_category_by_id()
    {
        $cat = $this->repository->create($this->dummyData);

        $newCat = $this->repository->find($cat->id);

        $this->assertInstanceOf(Category::class, $newCat);
        $this->assertEquals($cat->id, $newCat->id);
    }
}
