<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

use App\Models\Produto;

class TableStock extends Component
{
    use WithPagination;

    public $filterType = null;
    public $filterName = null;

    public $name;
    public $describe;
    public $price;
    public $type;
    public $amount;

    public $editingProductId = null;

    public function mount()
    {
        $this->resetFilters();
        $this->resetForm();
    }

    public function render()
    {
        $products = $this->getProducts();
        return view('livewire.table-stock', ['products' => $products]);
    }

    #[On('alteredProduct')]
    public function refreshProducts()
    {
        // Apenas um método para disparar refresh da view via evento
    }

    public function getProducts()
    {
        $query = Produto::query();

        if ($this->filterType) {
            $query->where('type', $this->filterType);
        }

        if ($this->filterName) {
            $query->where('name', 'like', "%" . $this->filterName . "%");
        }

        return $query->paginate(10);
    }

    public function updatingFilterType()
    {
        $this->resetPage();
    }

    public function updatingFilterName()
    {
        $this->resetPage();
    }

    public function storeProduct()
    {
        $this->validate([
            'name' => 'required|string|max:100|unique:products,name',
            'describe' => 'required|string|max:255',
            'price' => 'required|numeric|min:0|max:999.99',
            'type' => 'required|in:drink,savory,lunch,snacks,natural',
            'amount' => 'required|integer|min:0|max:999'
        ]);

        Produto::create([
            'name'     => $this->name,
            'describe' => $this->describe,
            'price'    => $this->price,
            'type'     => $this->type,
            'amount'   => $this->amount
        ]);

        $this->resetForm();
        $this->dispatch('alteredProduct');
        $this->dispatch('closeModal');
    }

    public function editProduct($id)
    {
        $product = Produto::findOrFail($id);

        $this->editingProductId = $product->id;
        $this->name     = $product->name;
        $this->describe = $product->describe;
        $this->price    = $product->price;
        $this->type     = $product->type;
        $this->amount   = $product->amount;
    }

    public function updateProduct()
    {
        if (!$this->editingProductId) return;

        $this->validate([
            'name' => 'required|string|max:100|unique:products,name,' . $this->editingProductId,
            'describe' => 'required|string|max:255',
            'price' => 'required|numeric|min:0|max:999.99',
            'type' => 'required|in:drink,savory,lunch,snacks,natural',
            'amount' => 'required|integer|min:0|max:999'
        ]);

        $product = Produto::findOrFail($this->editingProductId);

        $product->name = $this->name;
        $product->describe = $this->describe;
        $product->price = $this->price;
        $product->type = $this->type;
        $product->amount = $this->amount;

        $product->save();

        $this->resetForm();
        $this->dispatch('alteredProduct');
        $this->dispatch('closeModal');
    }

    public function addProduct($id)
    {
        $product = Produto::find($id);
        $product->amount += 1;
        $product->save();
        $this->dispatch('alteredProduct');
    }

    public function reduceProduct($id)
    {
        $product = Produto::find($id);
        if ($product->amount > 0) {
            $product->amount -= 1;
            $product->save();
            $this->dispatch('alteredProduct');
        } else {
            session()->flash('error', 'Quantidade mínima atingida.');
        }
    }

    public function resetFilters()
    {
        $this->filterType = null;
        $this->filterName = null;
        $this->resetPage();
    }

    public function resetForm()
    {
        $this->editingProductId = null;
        $this->name = null;
        $this->describe = null;
        $this->price = null;
        $this->type = null;
        $this->amount = null;
    }
}
