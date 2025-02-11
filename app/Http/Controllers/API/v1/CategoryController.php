<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryValidator;
use App\Http\Requests\UpdateCategoryValidator;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    private CategoryService $categoryService;
    
    /**
     * __construct
     *
     * @param  mixed $categoryService
     * @return void
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    
    /**
     * index
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->categoryService->getAll(), 200);
    }
    
    /**
     * show
     *
     * @param  mixed $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $category = $this->categoryService->getById($id);
        return $category ? response()->json($category, 200) : response()->json(['message' => 'Category not found'], 404);
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function store(CreateCategoryValidator $request): JsonResponse
    {
        $validatedData = $request->validated();

        $category = $this->categoryService->create($validatedData);
        return response()->json($category, 201);
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return JsonResponse
     */
    public function update(UpdateCategoryValidator $request, int $id): JsonResponse
    {
        $validatedData = $request->validated();

        $updated = $this->categoryService->update($id, $validatedData);
        return $updated ? response()->json(['message' => 'Category updated'], 200) 
                        : response()->json(['message' => 'Category not found'], 404);
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->categoryService->delete($id);
        return $deleted ? response()->json(['message' => 'Category deleted'], 200) 
                        : response()->json(['message' => 'Category not found'], 404);
    }
}
