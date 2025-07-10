<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showHome()
    {
        $buttons = $this->checkUserType();
        return view('home', ['buttons' => $buttons]);
    }

    public function checkUserType()
    {
        if (auth()->user()->type == 'admin') {
            return [
                ['route' => 'financeiro', 'icon' => 'cash-coin', 'label' => 'Financeiro'],
                ['route' => 'estoque', 'icon' => 'box', 'label' => 'Estoque'],
                ['route' => 'profile', 'icon' => 'person', 'label' => 'Perfil'],
                ['route' => 'painelUsuarios', 'icon' => 'people', 'label' => 'Usuários'],
                ['route' => 'historico', 'icon' => 'basket3', 'label' => 'Histórico de Compras'],
                ['route' => 'historicoRecarga', 'icon' => 'receipt-cutoff', 'label' => 'Histórico de Recargas'],
                ['route' => 'pdv', 'icon' => 'shop', 'label' => 'PDV'],
                ['route' => 'recarga', 'icon' => 'wallet', 'label' => 'Recarga'],
                ['route' => 'responsaveis', 'icon' => 'journal-plus', 'label' => 'Pedidos de Responsáveis'],
                //['route' => 'sobre', 'icon' => 'info-circle', 'label' => 'Sobre Nós'],
            ];
        } elseif (auth()->user()->type == 'func') {
            return [
                ['route' => 'estoque', 'icon' => 'box', 'label' => 'Estoque'],
                ['route' => 'profile', 'icon' => 'person', 'label' => 'Perfil'],
                ['route' => 'historico', 'icon' => 'basket3', 'label' => 'Histórico de Compras'],
                ['route' => 'pdv', 'icon' => 'shop', 'label' => 'PDV'],
                //['route' => 'sobre', 'icon' => 'info-circle', 'label' => 'Sobre Nós'],
            ];
        } elseif (auth()->user()->type == 'guard') {
            return [
                ['route' => 'profile', 'icon' => 'person', 'label' => 'Perfil'],
                ['route' => 'painelStudents', 'icon' => 'people', 'label' => 'Alunos'],
                ['route' => 'agendamento', 'icon' => 'calendar-event', 'label' => 'Agendamento'],
                ['route' => 'historico', 'icon' => 'basket3', 'label' => 'Histórico de Compras'],
                //['route' => 'sobre', 'icon' => 'info-circle', 'label' => 'Sobre Nós'],
            ];
        } elseif (auth()->user()->type == 'student') {
            return [
                ['route' => 'profile', 'icon' => 'person', 'label' => 'Perfil'],
                ['route' => 'agendamento', 'icon' => 'calendar-event', 'label' => 'Agendamento'],
                ['route' => 'historico', 'icon' => 'basket3', 'label' => 'Histórico de Compras'],
                //['route' => 'sobre', 'icon' => 'info-circle', 'label' => 'Sobre Nós'],
            ];
        }
        return [];
    }

}
