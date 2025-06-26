<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:254|unique:users,email,' . $user->id,
            'telefone' => 'nullable|regex:/^\(\d{2}\) \d{4,5}-\d{4}$/|max:15',
            'cpf' => 'nullable|regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/|max:14|unique:users,cpf,' . $user->id,
            'password' => 'nullable|min:6|max:27|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->telefone = $request->telefone;
        $user->cpf = $request->cpf;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::delete($user->profile_picture);
            }
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->save();

        return redirect()->route('profile.index')->with('success', 'Perfil atualizado com sucesso!');
    }

    public function removePicture()
    {
        $user = Auth::user();
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
            $user->profile_picture = null;
            $user->save();
        }
        return redirect()->route('profile.index')->with('success', 'Foto de perfil removida com sucesso!');
    }

    public function delete()
    {
        $user = Auth::user();
        Auth::logout();
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }
        $user->delete();
        return redirect('/')->with('success', 'Conta excluída com sucesso!');
    }

}