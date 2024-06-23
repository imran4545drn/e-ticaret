<?php

namespace App\Livewire;

use App\Models\adres;
use App\Models\order;
use App\Models\orderıtem;
use Livewire\Component;

class MyOrderDetailPage extends Component
{
    public $order_id;

    public function mount($order_id){
        $this->order_id = $order_id;
    }
    public function render()
    {
        $order_items= orderıtem::with('product')->where('order_id', $this->order_id)->get();
        $address = adres::where('order_id', $this->order_id)->first();
        $Order = order::where('id', $this->order_id)->first();

        return view('livewire.my-order-detail-page',[
            'order_items'=>$order_items,
            'address'=> $address,
            'Order' => $Order

        ]);
    }
}
