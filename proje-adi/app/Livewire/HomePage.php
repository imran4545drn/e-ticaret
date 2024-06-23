<?php

namespace App\Livewire;

use App\Models\brand;
use App\Models\cotegary;
use Livewire\Attributes\Title;
use Livewire\Component;
#[Title('ANA SAYFA - İMRAN')]
class HomePage extends Component
{
    public function render()
    {
        $brands= brand:: where('is_active', 1)->get();
        $categories= cotegary::where('is_active', 1)->get();
        return view('livewire.home-page',[
          'brands' => $brands,
          'categories' =>$categories
        ]);
    }
}
