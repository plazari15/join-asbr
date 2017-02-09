<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $this->createLead();
    }

    public function createLead()
    {
        $data = [
            'nome' => $this->request->nome,
            'data_nascimento' => Carbon::createFromFormat('d/m/Y', $this->request->data_nascimento)->format('Y-m-d'),
            'email' => $this->request->email,
            'telefone' => $this->request->telefone,
            'regiao' => $this->getRegiao(),
            'unidade' => $this->getUnidade(),
            'token' => $this->getToken(),
            'score' => $this->getTotalPoints(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        if(DB::table('leads')->insert($data)){
            return true;
        }

    }

    /**
     * O token esta sendo enviado por email, eu tentei de algumas formas obter ele por meio da api, mas o máximo de
     * dados que consegui receber foi o código e uma mensagem.
     * @return bool|\Psr\Http\Message\StreamInterface
     */
    protected function getToken(){
        //return 'códio_no_email';
        $client = new \GuzzleHttp\Client();
        $data =  $client->request('GET', "http://api.actualsales.com.br/join-asbr/ti/token?email={$this->request->email}");

        if($data->getStatusCode()){
            //return $data->getBody();
            return 'códio_no_email';
        }

        return false;
    }

    /**
     * Metodo se responsabiliza por executar o cálculo e retornar toda a pontuação que o usuário possuí
     * @return int
     */
    protected function getTotalPoints(){
        $pontos = ( 10 - $this->getPointsForRegion() - $this->calculateUserBirth() );
        return $pontos;
    }

    /**
     * Este método vai informar ao sistema quantos pontos deve remover do lead por ser de uma determinada região
     */
    protected function getPointsForRegion()
    {
        switch ($this->request->regiao){
            case '1':
                return '2';
                break;

            case '2':
                if($this->request->unidade == 3){
                    return '0';
                }
                return '1';
                break;

            case '3':
                return '3';
                break;

            case '4':
                return '4';
                break;

            case '5':
                return '5';
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

        if($birth >= 100 && $birth <= 18) {
            return '5';
        }

        if($birth >= 18 && $birth <= 39) {
            return '0';
        }

        if($birth >= 40 && $birth <= 99) {
            return '3';
        }
    }

    /**
     * retorno a região do meu lead
     * @return string
     */
    protected function getRegiao()
    {
        switch ($this->request->regiao){
            case '1':
                return 'Sul';
                break;

            case '2':
                return 'Sudeste';
                break;

            case '3':
                return 'Centro-Oeste';
                break;

            case '4':
                return 'Nordeste';
                break;

            case '5':
                return 'Norte';
                break;
        }
    }
    /**
     * Através do meu banco de dados, eu retorno a unidade selecionada pelo usuário
     * @return mixed
     */
    protected function getUnidade()
    {
        if($this->request->regiao == '5'){
            return 'INDISPONÍVEL';
        }

        $value = DB::table('unity')
            ->where('region_id', $this->request->regiao)
            ->where('id', $this->request->unidade)
            ->select('title')
            ->first();

        return $value->title;
    }

}