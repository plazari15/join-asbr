<?php

namespace App\Services;

use Illuminate\Http\Request;

class CreateLead
{
    protected $request;

    /**
     * construct da classe, se responsabiliza por tudo
     * CreateLead constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;


    }

    /**
     * Este método vai informar ao sistema quantos pontos deve remover do lead por ser de uma determinada região
     */
    public function getPointsForRegion()
    {
        switch ($this->request->regiao){
            case '1':
                return '-2';
                break;

            case '2':
                if($this->request->unidade == 3){
                    return '0';
                }
                return '-1';
                break;

            case '3':
                return '-3';
                break;

            case '4':
                return '-4';
                break;

            case '5':
                return '-5';
                break;

        }
    }

}