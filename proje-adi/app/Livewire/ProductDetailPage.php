<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ProductDetailPage extends Component
{
    use LivewireAlert;
    public $slug;
    public $quantity=1;
    public function mount($slug)
    {
        $this->slug = $slug;
    }
    public function artanbtn(){
        $this->quantity++;

    }
     public function azalanbtn(){
        if($this->quantity>1){
            $this->quantity--;
        }
     }
     public function addToCart($product_id){
        $total_count =  CartManagement::addItemToCartWithMik($product_id, $this->quantity);

        $this->dispatch('update-cart-count', total_count:$total_count)->to (Navbar::class);
        $this->alert('success', 'ürün eklendi!', [
            'position' => 'bottom-end',
            'timer' => 3000,
            'toast' => true,
           ]);
     }

    public function render()
    {
        $product = product::where('slug', $this->slug)->firstOrFail();

        $description = $product->description;

        return view('livewire.product-detail-page', compact('product', 'description'));
    }
}
