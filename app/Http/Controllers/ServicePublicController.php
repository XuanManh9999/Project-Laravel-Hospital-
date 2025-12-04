<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServicePublicController extends Controller
{
    public function index()
    {
        $services = Service::where('status', 'active')
            ->orderBy('name')
            ->paginate(9);

        return view('services.index', compact('services'));
    }
}
