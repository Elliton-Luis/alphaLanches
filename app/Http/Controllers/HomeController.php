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
                ['route' => 'pdv', 'icon' => 'shop', 'label' => 'PDV'],
                ['route' => 'historico', 'icon' => 'basket3', 'label' => 'Histórico de Compras'],
                ['route' => 'historicoRecarga', 'icon' => 'receipt-cutoff', 'label' => 'Histórico de Recargas'],
                ['route' => 'recarga', 'icon' => 'wallet', 'label' => 'Recarga'],
                ['route' => 'responsaveis', 'icon' => 'journal-plus', 'label' => 'Pedidos de Responsáveis'],
                ['route' => 'painelUsuarios', 'icon' => 'people', 'label' => 'Usuários'],
                ['route' => 'profile', 'icon' => 'person', 'label' => 'Perfil'],
                ['route' => 'pedidosReservados', 'icon' => 'bookmark', 'label' => 'Pedidos Reservados'],
                //['route' => 'sobre', 'icon' => 'info-circle', 'label' => 'Sobre Nós'],
            ];
        } elseif (auth()->user()->type == 'func') {
            return [
                ['route' => 'estoque', 'icon' => 'box', 'label' => 'Estoque'],
                ['route' => 'pdv', 'icon' => 'shop', 'label' => 'PDV'],
                ['route' => 'historico', 'icon' => 'basket3', 'label' => 'Histórico de Compras'],
                ['route' => 'historicoRecarga', 'icon' => 'receipt-cutoff', 'label' => 'Histórico de Recargas'],
                ['route' => 'recarga', 'icon' => 'wallet', 'label' => 'Recarga'],
                ['route' => 'painelUsuarios', 'icon' => 'people', 'label' => 'Usuários'],
                ['route' => 'profile', 'icon' => 'person', 'label' => 'Perfil'],
                ['route' => 'pedidosReservados', 'icon' => 'bookmark', 'label' => 'Pedidos Reservados'],
                //['route' => 'sobre', 'icon' => 'info-circle', 'label' => 'Sobre Nós'],
            ];
        } elseif (auth()->user()->type == 'guard') {
            return [
                ['route' => 'painelUsuarios', 'icon' => 'people', 'label' => 'Alunos'],
                ['route' => 'agendamento', 'icon' => 'calendar-event', 'label' => 'Agendamento'],
                ['route' => 'pedidosReservados', 'icon' => 'bookmark', 'label' => 'Pedidos Reservados'],
                ['route' => 'historico', 'icon' => 'basket3', 'label' => 'Histórico de Compras'],
                ['route' => 'historicoRecarga', 'icon' => 'receipt-cutoff', 'label' => 'Histórico de Recargas'],
                ['route' => 'recarga', 'icon' => 'wallet', 'label' => 'Recarga'],
                ['route' => 'profile', 'icon' => 'person', 'label' => 'Perfil'],
                //['route' => 'sobre', 'icon' => 'info-circle', 'label' => 'Sobre Nós'],
            ];
        } elseif (auth()->user()->type == 'student') {
            return [
                ['route' => 'agendamento', 'icon' => 'calendar-event', 'label' => 'Agendamento'],
                ['route' => 'historico', 'icon' => 'basket3', 'label' => 'Histórico de Compras'],
                ['route' => 'pedidosReservados', 'icon' => 'bookmark', 'label' => 'Pedidos Reservados'],
                ['route' => 'historicoRecarga', 'icon' => 'receipt-cutoff', 'label' => 'Histórico de Recargas'],
                ['route' => 'recarga', 'icon' => 'wallet', 'label' => 'Recarga'],
                ['route' => 'profile', 'icon' => 'person', 'label' => 'Perfil'],
                //['route' => 'sobre', 'icon' => 'info-circle', 'label' => 'Sobre Nós'],
            ];
        }
        return [];
    }

}
