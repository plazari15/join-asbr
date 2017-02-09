<?php

namespace App\Services;

use Carbon\Carbon;
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
    protected function getPointsForRegion()
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

    /**
     * Metódo calcula a idade do usuário e com base nisso da a quantidade de pontos que devem ser removidos.
     * @return string
     */
    protected function calculateUserBirth()
    {
        $birth = Carbon::createFromFormat('d/m/Y', $this->request->data_nascimento)
            ->diff(Carbon::createFromFormat('d/m/Y', '01/11/2016'))
            ->format('%y');

        var_dump($birth);
        if($birth >= 100 && $birth <= 18) {
            return '-5';
        }

        if($birth >= 18 && $birth <= 39) {
            return '0';
        }

        if($birth >= 40 && $birth <= 99) {
            return '-3';
        }
    }

}