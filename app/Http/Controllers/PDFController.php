<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use App\Models\User;

class PDFController extends Controller
{
    public function generatePDF($id){
        $user = User::where('id', $id)->first();
        $data = [
            'nome' => $user->name,
            'email' => $user->email,
            'location' => $user->location,
            'qualification' => $user->aboutMe,
        ];

        $pdf = PDF::loadView('myPDF', $data);
        return $pdf->download('myPDF.pdf');
    }
}
