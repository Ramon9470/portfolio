<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use Illuminate\Support\Facades\Log;

class AutenticacaoController extends Controller
{
    public function login(Request $request)
    {
        try {
            $credenciais = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if (Auth::attempt($credenciais)) {
                $usuario = Auth::user();
                
                $usuario->tokens()->delete();
                
                $token = $usuario->createToken('TokenAdminPortfolio')->plainTextToken;

                return response()->json([
                    'mensagem' => 'Login realizado com sucesso',
                    'token' => $token,
                    'user' => [
                        'nome' => $usuario->nome,
                        'email' => $usuario->email
                    ]
                ], 200);
            }

            return response()->json(['mensagem' => 'Email ou senha incorretos.'], 401);

        } catch (\Exception $e) {
            Log::error("Erro no Login: " . $e->getMessage());
            return response()->json(['mensagem' => 'Erro interno no servidor. Verifique o banco de dados.'], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['mensagem' => 'Deslogado com sucesso']);
    }
}