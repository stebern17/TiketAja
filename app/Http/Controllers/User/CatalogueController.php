<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CatalogueController extends Controller
{
    public function index()
    {
        return view('catalogue.index');
    }
}
