<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Produto;

class TableStock extends Component
{
    use WithPagination;
    public $filterType;
    
    public function mout(){
        $this->filterType = null;
    }

    public function render()
    {
        $query = Produto::query();
        if($this->filterType){
            $query->where('type',$this->filterType);
        }
        $products = $query->paginate(10);
        return view('livewire.table-stock',['products'=>$products]);
    }

}
