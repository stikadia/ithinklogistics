<?php

namespace App\BO;

use Illuminate\Support\Carbon;

class CategoryBO
{
    public ?int $id;
    public string $name;
    public ?int $parent_category_id;
    public string $created_at;
    public string $updated_at;
    public array $children;
    
    /**
     * __construct
     *
     * @param  mixed $category
     * @return void
     */
    public function __construct($category)
    {
        $this->id = $category->id;
        $this->name = $category->name;
        $this->parent_category_id = $category->parent_category_id;
        $this->created_at = $category->created_at ? $category->created_at->toDateTimeString() : Carbon::now()->toDateTimeString();
        $this->updated_at = $category->updated_at ? $category->updated_at->toDateTimeString() : Carbon::now()->toDateTimeString();

        $this->children = $category->children->map(fn($child) => new CategoryBO($child))->toArray();
    }
}
