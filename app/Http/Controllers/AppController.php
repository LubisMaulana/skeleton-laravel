<?php
namespace App\Http\Controllers;

use App\Models\Submission;

class AppController extends Controller
{
    public function home()
    {
        return view('home', [
            'page'         => 'Home',
        ]);
    }
}
