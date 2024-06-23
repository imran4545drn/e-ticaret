<?php

namespace App\Livewire;

use App\Models\cotegary;
use Livewire\Component;

class CategoriesPage extends Component
{
    public function render()
    {
        $categories = cotegary::where('is_active',1)->get();
        return view('livewire.categories-page',[
            'categories'=> $categories,
        ]);
    }
}
