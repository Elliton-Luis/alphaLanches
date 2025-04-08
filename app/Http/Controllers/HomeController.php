<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showHome(){
        $buttons = [
            ['route' => 'financeiro', 'icon' => 'cash-coin', 'label' => 'Financeiro'],
            ['route' => 'estoque', 'icon' => 'box', 'label' => 'Estoque'],
            ['route' => 'profile', 'icon' => 'person', 'label' => 'Perfil'],
            ['route' => 'painelUsuarios', 'icon' => 'people', 'label' => 'Usuários'],
            ['route' => 'painelCompras', 'icon' => 'basket3', 'label' => 'Histórico de Compras'],
            ['route' => 'painelPDV', 'icon' => 'shop', 'label' => 'PDV'],
            ['route' => 'sobre', 'icon' => 'info-circle', 'label' => 'Sobre Nós'],
        ];
        return view('home',['buttons' => $buttons]);
    }
    public function homeAdmin(){
        $buttons = [
            ['route' => 'financeiro', 'icon' => 'cash-coin', 'label' => 'Financeiro'],
            ['route' => 'estoque', 'icon' => 'box', 'label' => 'Estoque'],
            ['route' => 'profile', 'icon' => 'person', 'label' => 'Perfil'],
            ['route' => 'painelUsuarios', 'icon' => 'people', 'label' => 'Usuários'],
            ['route' => 'painelCompras', 'icon' => 'basket3', 'label' => 'Histórico de Compras'],
            ['route' => 'painelPDV', 'icon' => 'shop', 'label' => 'PDV'],
            ['route' => 'sobre', 'icon' => 'info-circle', 'label' => 'Sobre Nós'],
        ];
        return $buttons;
    }

    public function homeFunc(){
        $buttons = [
            ['route' => 'estoque', 'icon' => 'box', 'label' => 'Estoque'],
            ['route' => 'profile', 'icon' => 'person', 'label' => 'Perfil'],
            ['route' => 'painelCompras', 'icon' => 'basket3', 'label' => 'Histórico de Compras'],
            ['route' => 'painelPDV', 'icon' => 'shop', 'label' => 'PDV'],
            ['route' => 'sobre', 'icon' => 'info-circle', 'label' => 'Sobre Nós'],
        ];
        return $buttons;
    }

    public function homeStudent(){
        $buttons = [
            ['route' => 'profile', 'icon' => 'person', 'label' => 'Perfil'],
            ['route' => 'recarga', 'icon' => 'wallet', 'label' => 'Recarga'],
            ['route' => 'PainelHistorico', 'icon' => 'basket3', 'label' => 'Histórico de Compras'],
            ['route' => 'sobre', 'icon' => 'info-circle', 'label' => 'Sobre Nós'],
        ];
        return $buttons;
    }

    public function homeGuard(){
        $buttons = [
            ['route' => 'profile', 'icon' => 'person', 'label' => 'Perfil'],
            ['route' => 'recarga', 'icon' => 'wallet', 'label' => 'Recarga'],
            ['route' => 'sobre', 'icon' => 'info-circle', 'label' => 'Sobre Nós'],
        ];
        return $buttons;
    }
}
