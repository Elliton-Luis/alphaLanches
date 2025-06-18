<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Produto;
use Livewire\WithPagination;

class Pdv extends Component
{
    use WithPagination;
    public $filterName;


    public function mount(){
        $this->filterName = null;
    }

    public function render()
    {
        $query = Produto::query();

        if($this->filterName){
            $query->where('name','like','%'. $this->filterName . '%');
        }

        $products = $query->paginate(6);

        return view('livewire.pdv',['products'=>$products]);
    }
}
