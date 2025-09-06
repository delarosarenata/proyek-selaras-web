<?php

namespace App\Http\Controllers;

use App\Models\Respondent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SkdController extends Controller
{
    public function runBot(Request $request, Respondent $respondent) // Terima $respondent
    {
        // Panggil Artisan command dengan ID
        Artisan::call('skd:entri', ['respondentId' => $respondent->id]);
        $output = Artisan::output();
        return back()->with('success', "Proses bot selesai. Hasil: <pre>{$output}</pre>");
    }
}