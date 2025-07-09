<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreditLog;
use Illuminate\Support\Facades\Auth;

class HistoricoRecargaController extends Controller
{
    public function index(Request $request)
    {
        $query = CreditLog::with(['user', 'executor'])
            ->orderBy('created_at', 'desc');

        // Filtros
        if ($request->filled('data_inicio')) {
            $query->where('created_at', '>=', $request->data_inicio);
        }

        if ($request->filled('data_fim')) {
            $query->where('created_at', '<=', $request->data_fim);
        }

        if ($request->filled('users')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->users . '%');
            });
        }

        $logs = $query->paginate(10);

        return view('historicoRecarga', compact('logs'));
    }
}
