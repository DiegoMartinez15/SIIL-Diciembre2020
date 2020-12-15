<?php

namespace App\Http\Controllers;

use App\SegundosIdiomas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SegundoIdiomaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $segundosidiomas = SegundosIdiomas::all();
        return $segundosidiomas;

    }


}
