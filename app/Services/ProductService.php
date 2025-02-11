<?php 

namespace App\Services;

use App\BO\ProductBO;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ProductService
{
    private ProductRepositoryInterface $productRepository;
    
    /**
     * __construct
     *
     * @param  mixed $productRepository
     * @return void
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    
    /**
     * getAll
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->productRepository->all()->map(fn($product) => new ProductBO($product))->toArray();
    }
    
    /**
     * getById
     *
     * @param  mixed $id
     * @return ProductBO
     */
    public function getById(int $id): ?ProductBO
    {
        $product = $this->productRepository->find($id);
        return $product ? new ProductBO($product) : null;
    }
    
    /**
     * create
     *
     * @param  mixed $data
     * @return ProductBO
     */
    public function create(array $data): ProductBO
    {
        return new ProductBO($this->productRepository->create($data));
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
        return $this->productRepository->update($id, $data);
    }
    
    /**
     * delete
     *
     * @param  mixed $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->productRepository->delete($id);
    }
    
    /**
     * search
     *
     * @param  mixed $keyword
     * @return LengthAwarePaginator
     */
    public function search(string $keyword): LengthAwarePaginator
    {
        return $this->productRepository->search($keyword);
    }
}
