<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Product extends Model
{
    use HasFactory;
    protected $fillable = ['sku', 'name', 'category_id', 'supplier_id', 'price', 'stock'];
    protected function casts(): array { return ['price' => 'decimal:2', 'stock' => 'integer']; }
    public function category() { return $this->belongsTo(Category::class); }
    public function supplier() { return $this->belongsTo(Supplier::class); }
    public function suppliers() { return $this->belongsToMany(Supplier::class, 'product_suppliers')->withTimestamps(); }
    public function stockMovements() { return $this->hasMany(StockMovement::class); }
}
