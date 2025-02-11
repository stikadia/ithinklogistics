<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\ProductRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class ProductRepoTest extends TestCase
{
    use RefreshDatabase;

    protected $repository, $catrepo;

    protected $dummyData = [
        "name" => "Product Test",
        "description" => "Test description",
        "price" => "12.5",
        "sku" => "TEST123",
    ];

    protected $dummyCat = ["name" => "Test Category"];

    public function setUp(): void
    {
        parent::setUp();
        Cache::flush();
        $this->repository = new ProductRepository(new Product());
        $this->catrepo = new CategoryRepository(new Category());
    }

    public function test_can_create_product()
    {
        $cat = $this->catrepo->create($this->dummyCat);
        $this->dummyData["category_id"] = $cat->id;
        $product = $this->repository->create($this->dummyData);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals("Product Test", $product->name);
        $this->assertDatabaseHas("products", ["sku" => "TEST123", "price" => "12.5"]);
    }

    public function test_can_update_product()
    {
        $cat = $this->catrepo->create($this->dummyCat);
        $this->dummyData["category_id"] = $cat->id;
        $product = $this->repository->create($this->dummyData);

        $updatedData = ["name" => "Product Test 2", "sku" => "TEST234"];
        $updated = $this->repository->update($product->id, $updatedData);

        $this->assertTrue($updated);
        $this->assertDatabaseHas("products", ["name" => "Product Test 2", "sku" => "TEST234"]);
    }

    public function test_can_delete_product()
    {
        $cat = $this->catrepo->create($this->dummyCat);
        $this->dummyData["category_id"] = $cat->id;
        $product = $this->repository->create($this->dummyData);

        $deleted = $this->repository->delete($product->id);

        $this->assertTrue($deleted);
        $this->assertDatabaseMissing("products", ["name" => "Product Test"]);
    }

    public function test_can_fetch_product_by_id()
    {
        $cat = $this->catrepo->create($this->dummyCat);
        $this->dummyData["category_id"] = $cat->id;
        $product = $this->repository->create($this->dummyData);

        $newProduct = $this->repository->find($product->id);

        $this->assertInstanceOf(Product::class, $newProduct);
        $this->assertEquals("Product Test", $newProduct->name);
        $this->assertDatabaseHas("products", ["sku" => "TEST123", "price" => "12.5"]);
    }
}
