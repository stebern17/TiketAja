<?php

namespace App\Http\Controllers\User;

use App\Models\Event; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CatalogueController extends Controller
{

    public function index()
    {
        return view('catalogue.index');
    }
    
    public function showEvent($id)
    {
        // Mencari event berdasarkan ID
        $event = Event::findOrFail($id);

        // Mengirim data event ke view
        return view('catalogue.event', compact('event'));
    }

}

