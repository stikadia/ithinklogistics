<?php 

namespace App\Repositories\Eloquent;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{    
    /**
     * all
     *
     * @return Collection
     */
    public function all(): Collection
    {
        //product list is cached for 1 hour 
        return Cache::remember('products', 3600, function () {
            return Product::all();    
        });
    }
    
    /**
     * find
     *
     * @param  mixed $id
     * @return Product
     */
    public function find(int $id): ?Product
    {
        return Product::find($id);
    }
    
    /**
     * create
     *
     * @param  mixed $data
     * @return Product
     */
    public function create(array $data): Product
    {
        $this->clearCache();
        return Product::create($data);
    }
    
    /**
     * update
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $this->clearCache();
        $product = Product::find($id);
        return $product ? $product->update($data) : false;
    }
    
    /**
     * delete
     *
     * @param  mixed $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $this->clearCache();
        return Product::destroy($id) > 0;
    }
    
    /**
     * search
     *
     * @param  mixed $keyword
     * @return LengthAwarePaginator
     */
    public function search(string $keyword): LengthAwarePaginator
    {
        return Cache::remember("search_{$keyword}",3600, function() use ($keyword) {
            return Product::where('name', 'like', "%{$keyword}%")
            ->orWhere('description', 'like', "%{$keyword}%")
            ->paginate(10);
        });
    }
    
    /**
     * clearCache
     *
     * @param  mixed $key
     * @return void
     */
    public function clearCache()
    {
        return Cache::forget("products");
    }
}
