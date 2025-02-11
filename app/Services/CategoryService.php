<?php 

namespace App\Services;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\BO\CategoryBO;
use Illuminate\Support\Collection;

class CategoryService
{
    private CategoryRepositoryInterface $categoryRepository;
    
    /**
     * __construct
     *
     * @param  mixed $categoryRepository
     * @return void
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    
    /**
     * getAll
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->categoryRepository->getParentCategories()
            ->map(fn($category) => new CategoryBO($category))
            ->toArray();
    }
    
    /**
     * getById
     *
     * @param  mixed $id
     * @return CategoryBO
     */
    public function getById(int $id): ?CategoryBO
    {
        $category = $this->categoryRepository->find($id);
        return $category ? new CategoryBO($category) : null;
    }
    
    /**
     * create
     *
     * @param  mixed $data
     * @return CategoryBO
     */
    public function create(array $data): CategoryBO
    {
        return new CategoryBO($this->categoryRepository->create($data));
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
        return $this->categoryRepository->update($id, $data);
    }
    
    /**
     * delete
     *
     * @param  mixed $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->categoryRepository->delete($id);
    }
}

