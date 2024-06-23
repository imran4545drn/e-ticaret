<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\brand;
use App\Models\cotegary;
use App\Models\product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('ÜRÜNLER - İMRAN')]
class ProductsPage extends Component
{
    use WithPagination;

    use LivewireAlert;


    #[Url]
    public $selected_categories = [];

    #[Url]
    public $selected_brands = [];

    #[Url]
    public $featured;

    #[Url]
    public $on_sale;

    #[Url]
    public $price_range=150000;

    #[Url]
    public $sort= 'latest';

     public function addToCart($product_id){
        $total_count = CartManagement::addItemToCart($product_id);

        $this->dispatch('update-cart-count', total_count:$total_count)->to (Navbar::class);
        $this->alert('success', 'ürün eklendi!', [
            'position' => 'bottom-end',
            'timer' => 3000,
            'toast' => true,
           ]);
     }



    public function render()
    {
        $productQuery = Product::query()->where('is_active', 1);

        if (!empty($this->selected_brands)) {
            $productQuery->whereIn('brand_id', $this->selected_brands);
        }
        if (!empty($this->selected_categories)) {
            $productQuery->whereIn('category_id', $this->selected_categories);
        }

        if ($this->sort =='latest'){
            $productQuery->latest();

        }

        if ($this->sort == 'price'){
            $productQuery->orderBy('price');
        }
if($this->featured){
    $productQuery->where('is_featured',1);
}


if($this->on_sale){
    $productQuery->where('on_sale',1);
}


if($this->price_range){
    $productQuery->whereBetween('price',[0,$this->price_range]);
}


        return view('livewire.products-page', [
            'products' => $productQuery->paginate(9), // Sayfa boyutu 9 olarak ayarlandı
            'brands' => brand::where('is_active', 1)->get(['id', 'name', 'slug']), // 'Brand' modeli
            'categories' => cotegary::where('is_active', 1)->get(['id', 'name', 'slug']), // 'Category' modeli
        ]);
    }
}
