<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

use App\Models\Produto;

class ModalEdit extends Component
{
    public $id;
    public $name;
    public $describe;
    public $price;
    public $amount;
    public $type;

    #[On('alteredProduct')]
    public function mount()
    {
        $product = Produto::find($this->id);

        $this->name = $product->name;
        $this->describe = $product->describe;
        $this->price = $product->price;
        $this->amount = $product->amount;
        $this->type = $product->type;
    }

    public function render()
    {
        return view('livewire.modal-edit');
    }


    public function alterProduct()
    {
        $this->validate([
            'name' => 'required|string|max:100|unique:products,name,' . $this->id,
            'describe' => 'required|string|max:255',
            'price' => 'required|numeric|min:0|max:999.99',
            'type' => 'required|in:drink,savory,lunch,snacks,natural',
            'amount' => 'required|integer|min:0|max:999'
        ], [
            'name.required' => 'É Necessário Informar um Nome',
            'name.unique' => 'Produto Já Cadastrado',
            'describe.required' => 'É Necessário Informar uma Descrição',
            'describe.max' => 'Máximo de 255 caracteres',
            'price.required' => 'É Necessário Informar um Preço',
            'type.required' => 'É Necessário Selecionar um Tipo',
            'amount.required' => 'É Necessário Informar a Quantidade',
            'price.min' => 'O valor mínimo permitido é 0.',
            'price.max' => 'O valor máximo permitido é 999.99.',
            'amount.min' => 'O valor mínimo permitido é 0.',
            'amount.max' => 'O valor máximo permitido é 999.',
        ]);

        $product = Produto::find($this->id);

        $product->name = $this->name;
        $product->describe = $this->describe;
        $product->price = $this->price;
        $product->amount = $this->amount;
        $product->type = $this->type;

        $product->save();

        $this->dispatch('alteredProduct');
        session()->flash('success', 'Produto alterado com sucesso');
    }
}
