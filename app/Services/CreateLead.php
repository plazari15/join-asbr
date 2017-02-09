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
}