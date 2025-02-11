<?php
namespace App\BO;

class ProductBO
{
    public int $id;
    public string $name;
    public ?string $description;
    public ?string $sku;
    public float $price;
    public int $category_id;
    public string $created_at;
    public string $updated_at;
    
    /**
     * __construct
     *
     * @param  mixed $product
     * @return void
     */
    public function __construct($product)
    {
        $this->id = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->sku = $product->sku;
        $this->price = $product->price;
        $this->category_id = $product->category_id;
        $this->created_at = $product->created_at->toDateTimeString();
        $this->updated_at = $product->updated_at->toDateTimeString();
    }
}
