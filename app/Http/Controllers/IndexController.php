<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class IndexController extends BaseController
{
    /**
     * Classe inicial que carrega o template
     * @return \Illuminate\View\View
     */
    public function index(){
        return view('index');
    }
}
