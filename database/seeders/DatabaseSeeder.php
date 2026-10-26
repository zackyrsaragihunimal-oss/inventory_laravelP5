<?php
namespace Database\Seeders;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(['username' => 'admin'], [
            'name' => 'Administrator', 'password' => Hash::make('Admin12345!'), 'role' => 'admin'
        ]);
        User::updateOrCreate(['username' => 'staff'], [
            'name' => 'Staff Gudang', 'password' => Hash::make('Staff12345!'), 'role' => 'staff'
        ]);
        $categories = collect([
            ['name' => 'Elektronik', 'description' => 'Perangkat elektronik'],
            ['name' => 'Alat Tulis', 'description' => 'Perlengkapan tulis'],
            ['name' => 'Aksesori', 'description' => 'Aksesori perangkat'],
        ])->map(fn ($row) => Category::firstOrCreate(['name' => $row['name']], ['description' => $row['description']]));
        $suppliers = collect([
            ['name' => 'PT Sumber Teknologi', 'phone' => '081234567890', 'email' => 'supplier1@example.com', 'address' => 'Jakarta'],
            ['name' => 'CV Mitra Perlengkapan', 'phone' => '082345678901', 'email' => 'supplier2@example.com', 'address' => 'Bandung'],
        ])->map(fn ($row) => Supplier::firstOrCreate(['name' => $row['name']], $row));
        $items = [
            ['sku' => 'ELK-001', 'name' => 'Mouse USB', 'category_id' => $categories[0]->id, 'supplier_id' => $suppliers[0]->id, 'price' => 75000, 'stock' => 20],
            ['sku' => 'ELK-002', 'name' => 'Keyboard USB', 'category_id' => $categories[0]->id, 'supplier_id' => $suppliers[0]->id, 'price' => 125000, 'stock' => 15],
            ['sku' => 'ATK-001', 'name' => 'Buku Catatan', 'category_id' => $categories[1]->id, 'supplier_id' => $suppliers[1]->id, 'price' => 15000, 'stock' => 50],
            ['sku' => 'AKS-001', 'name' => 'Mouse Pad', 'category_id' => $categories[2]->id, 'supplier_id' => $suppliers[0]->id, 'price' => 25000, 'stock' => 30],
        ];
        foreach ($items as $item) {
            $product = Product::firstOrCreate(['sku' => $item['sku']], $item);
            if ($product->supplier_id) $product->suppliers()->syncWithoutDetaching([$product->supplier_id]);
        }
    }
}
