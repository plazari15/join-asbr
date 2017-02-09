<?php

namespace App\Http\Controllers;

use App\Services\CreateLead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller as BaseController;

class ApiController extends BaseController
{
    /**
     * Obtem as regiões do banco de dados
     * @return \Illuminate\View\View
     */
    public function getRegion(Request $request){
        $this->validate($request, [
            ['regiao' => 'required|numeric']
        ]);

        $units = DB::table('unity')->select('title', 'id')->where('region_id', $request->regiao)->get();

        if(!empty($units[0]->title)){
            return response()->json(['body' => $units], 200);
        }

        return response()->json(['body' => [['id' => '0', 'title' => 'não encontramos nenhum resultado']] ], 200);
    }

    public function sendForm(Request $request){
        $this->validate($request, [
            'nome' => 'required',
            'email' => 'required|email',
            'telefone' => 'required|numeric',
            'data_nascimento' => 'required|date_format:d/m/Y',
            'regiao' => 'required|numeric',
            'unidade' => 'numeric',
        ]);
        $lead = new CreateLead($request);
        dd($lead->createLead());
    }
}
