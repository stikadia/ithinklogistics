<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = ["name","parent_category_id"];
    
    /**
     * parent
     *
     * @return void
     */
    public function parent(){
        return $this->belongsTo(Category::class, "parent_category_id");
    }
    
    /**
     * children
     *
     * @return void
     */
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_category_id')->with('children');
    }
}
