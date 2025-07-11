<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreditLog;
use Illuminate\Support\Facades\Auth;

class HistoricoRecargaController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = CreditLog::with(['user', 'executor'])
            ->orderBy('created_at', 'desc');

        if ($user->type === 'guard') {
            $alunoIds = $user->alunos()->pluck('users.id')->toArray();
            $idsPermitidos = array_merge([$user->id], $alunoIds);

            $query->whereIn('user_id', $idsPermitidos);
        }

        // Filtros adicionais
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
