<?php

namespace App\Http\Controllers;

use App\Models\Event; 
use Illuminate\Http\Request;

class CatalogueController extends Controller
{

    public function index()
    {
        return view('catalogue.index');
    }

    public function showEvent() //Data Dummy Aja
    {
        // Data dummy
        $event = [
            'title' => 'Juicy Luicy',
            'date' => '2024-12-06',
            'location' => 'Yogyakarta',
            'description' => 'AGAGAGAGA.',
        ];

        // Mengirim data dummy ke view
        return view('catalogue.event', compact('event'));
    }


}

