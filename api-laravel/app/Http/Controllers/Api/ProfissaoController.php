<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfissoesRequest;
use App\Models\Profissoes;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Js;

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

    public function store(ProfissoesRequest $request)
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
                'message' => "Profissão não cadastradada!"
            ], 400);
        }
    }

    public function update(ProfissoesRequest $request, Profissoes $profissao): JsonResponse
    {

        DB::beginTransaction();

        try{

            $profissao->update([
                'nome' => $request->nome,
                'descricao' => $request->descricao,
                'salario' => $request->salario,
                'empresa' => $request->empresa,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'profissao' => $profissao,
                'message' => "Profissão editada!",
            ], 200);

        } catch (Exception $e){

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => "Profissão não editada!"
            ], 400);
        }

        return response()->json([
            'status' => true,
            'profissao' => $profissao,
            'message' => "Profissão editada com sucesso!",
        ], 200);
    }

    public function destroy(Profissoes $profissao) :JsonResponse
    {
        try{

            $profissao->delete();

            return response()->json([
                'status' => true,
                'profissao' => $profissao,
                'message' => "Profissão apagada com sucesso!",
            ], 200);

        } catch(Exception $e){

            return response()->json([
                'status' => false,
                'message' => "Profissão não apagado!"
            ], 400);
        }
    }
}