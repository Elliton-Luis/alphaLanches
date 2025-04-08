<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showHome(){
        if(auth()->user()->type == 'admin')
            {
                $buttons = [
                    ['route' => 'financeiro', 'icon' => 'cash-coin', 'label' => 'Financeiro'],
                    ['route' => 'estoque', 'icon' => 'box', 'label' => 'Estoque'],
                    ['route' => 'profile', 'icon' => 'person', 'label' => 'Perfil'],
                    ['route' => 'painelUsuarios', 'icon' => 'people', 'label' => 'Usuários'],
                    ['route' => 'painelCompras', 'icon' => 'basket3', 'label' => 'Histórico de Compras'],
                    ['route' => 'painelPDV', 'icon' => 'shop', 'label' => 'PDV'],
                    ['route' => 'sobre', 'icon' => 'info-circle', 'label' => 'Sobre Nós'],
                    ];
            }
            elseif (auth()->user()->type == 'func')
            {
                $buttons = [
                    ['route' => 'estoque', 'icon' => 'box', 'label' => 'Estoque'],
                    ['route' => 'profile', 'icon' => 'person', 'label' => 'Perfil'],
                    ['route' => 'painelCompras', 'icon' => 'basket3', 'label' => 'Histórico de Compras'],
                    ['route' => 'painelPDV', 'icon' => 'shop', 'label' => 'PDV'],
                    ['route' => 'sobre', 'icon' => 'info-circle', 'label' => 'Sobre Nós'],
                    ];
            }

            elseif (auth()->user()->type == 'guard')
            {
                $buttons = [
                    ['route' => 'profile', 'icon' => 'person', 'label' => 'Perfil'],
                    ['route' => 'recarga', 'icon' => 'wallet', 'label' => 'Recarga'],
                    ['route' => 'sobre', 'icon' => 'info-circle', 'label' => 'Sobre Nós'],
                ];
            }

            elseif (auth()->user()->type == 'student')
            {
                $buttons = [
                    ['route' => 'profile', 'icon' => 'person', 'label' => 'Perfil'],
                    ['route' => 'recarga', 'icon' => 'wallet', 'label' => 'Recarga'],
                    ['route' => 'PainelHistorico', 'icon' => 'basket3', 'label' => 'Histórico de Compras'],
                    ['route' => 'sobre', 'icon' => 'info-circle', 'label' => 'Sobre Nós'],
                ];
            }
        return view('home',['buttons' => $buttons]);
    }
    
}
