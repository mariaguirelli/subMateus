<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profissoes;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfissaoController extends Controller
{
    public function index() : JsonResponse
    {   
        $profissoes = Profissoes::orderBy('id', 'DESC')->get();

        return response()-> json([
            'status' => true,
            'profissoes' => $profissoes,
        ],200 );
    }

    public function show(Profissoes $profissao) : JsonResponse
    {
        return response()->json([
            'status' => true,
            'profissao' => $profissao,
        ], 200);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try{

            $profissao = Profissoes::create([
                'nome' => $request->nome,
                'descricao' => $request->descricao,
                'salario' => $request->salario,
                'empresa' => $request->empresa,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'profissao' => $profissao,
                'message' => "Profissão cadastrada!",
            ], 200);

        } catch (Exception $e){

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => "Profissão não cadastrado!"
            ], 400);
        }
    }
}
