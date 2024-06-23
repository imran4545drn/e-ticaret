<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Mail\OrderPlaced;
use App\Models\adres;
use App\Models\order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session as FacadesSession;
use Livewire\Attributes\Title;
use Livewire\Component;
use Stripe\Stripe;
use Stripe\Checkout\Session;





#[Title('KONTROL')]
class CheckoutPage extends Component
{

    public $first_name;
    public $last_name;
    public $phone;
    public $street_adress;
    public $city;
    public $state;
    public $zip_code;
    public $payment_method;

    public function mount(){
        $cart_items= CartManagement::getCartItemsFromCookie();
        if(count($cart_items)==0){
            return redirect('/products');
        }
    }


    public function placeOrder(){

      $this->validate([
        'first_name'=>'required',
        'last_name'=>'required',
        'phone'=>'required',
        'street_adress'=>'required',
        'city'=>'required',
        'state'=>'required',
        'zip_code'=>'required',
        'payment_method'=>'required',


      ]);
      $cart_items = CartManagement::getCartItemsFromCookie();
      $line_items =[];

      foreach ($cart_items as $item){
        $line_items[] = [
            'price_data' => [
                'currency' =>'usd',
                'unit_amount' => $item['unit_amount'] * 100,
                'product_data' => [
                    'name' => $item['name'],
                ]
                ],
                'quantity' => $item['quantity'],
            ];
      }
      $order = new order();
      $order ->user_id = auth()->user()->id;
      $order ->grand_total = CartManagement::calculateGrandTotal($cart_items);
      $order ->payment_method = $this->payment_method;
      $order ->payment_status = 'pending';
      $order ->status = 'new';
      $order ->currency = 'usd';
      $order ->shipping_amount = 0;
      $order ->shipping_method = 'none';
      $order-> notes = 'Order placed by' .auth()->user()->name;

      $address = new adres();
      $address->first_name = $this->first_name;
      $address->last_name = $this->last_name;
      $address->phone = $this->phone;
      $address->street_adress = $this->street_adress;
      $address->city = $this->city;
      $address->state = $this->state;
      $address->zip_code = $this->zip_code;

      $redirect_url='';
      if($this->payment_method == 'stripe'){
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $sessionCheckout = Session::create([
            'payment_method_types' => ['card'],
            'customer_email' => auth()->user()->email,
            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => env('cancel'),
        ]);
        $redirect_url = $sessionCheckout->url;


      }else{
        $redirect_url=route('success');

      }
      $order->save();
      $address->order_id = $order->id;
      $address->save();
      $order->items()->createMany($cart_items);
      CartManagement::clearCartItems();

      return redirect($redirect_url);


    }

    public function render()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        $grand_total = CartManagement::calculateGrandTotal($cart_items);
        return view('livewire.checkout-page', [
            'cart_items'=>$cart_items,
            'grand_total' => $grand_total,
        ]);
    }
}
