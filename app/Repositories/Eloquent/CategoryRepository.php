<?php 

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CategoryRepository implements CategoryRepositoryInterface
{    
    /**
     * all
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return Cache::remember('categories', 3600, function () {
            return Category::all();    
        });
    }
    
    /**
     * find
     *
     * @param  mixed $id
     * @return Category
     */
    public function find(int $id): ?Category
    {
        return Category::find($id);
    }
    
    /**
     * create
     *
     * @param  mixed $data
     * @return Category
     */
    public function create(array $data): Category
    {
        $this->clearCache();
        return Category::create($data);
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
        $category = Category::find($id);
        return $category ? $category->update($data) : false;
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
        return Category::destroy($id) > 0;
    }

    /**
     * clearCache
     *
     * @param  mixed $key
     * @return void
     */
    public function clearCache()
    {
        return Cache::forget("categories");
    }
    
    /**
     * getParentCategories
     *
     * @return Collection
     */
    public function getParentCategories(): Collection
    {
        return Category::with('children')->whereNull('parent_category_id')->get();
    }
}
