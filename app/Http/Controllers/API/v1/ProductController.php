<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductValidator;
use App\Http\Requests\UpdateProductValidator;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    private ProductService $productService;
    
    /**
     * __construct
     *
     * @param  mixed $productService
     * @return void
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    
    /**
     * index
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        if ($request->has('search')) {
            return response()->json($this->productService->search($request->search));
        }
        return response()->json($this->productService->getAll(), 200);
    }
    
    /**
     * show
     *
     * @param  mixed $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $product = $this->productService->getById($id);
        return $product ? response()->json($product, 200) : response()->json(['message' => 'Product not found'], 404);
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function store(CreateProductValidator $request): JsonResponse
    {
        $validatedData = $request->validated();

        $product = $this->productService->create($validatedData);
        return response()->json($product, 201);
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return JsonResponse
     */
    public function update(UpdateProductValidator $request, int $id): JsonResponse
    {
        $validatedData = $request->validated();

        $updated = $this->productService->update($id, $validatedData);
        return $updated ? response()->json(['message' => 'Product updated'], 200) 
                        : response()->json(['message' => 'Product not found'], 404);
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->productService->delete($id);
        return $deleted ? response()->json(['message' => 'Product deleted'], 200) 
                        : response()->json(['message' => 'Product not found'], 404);
    }
}