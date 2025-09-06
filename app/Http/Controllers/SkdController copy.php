<?php

namespace App\Http\Controllers;

use App\Models\Respondent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

// class SkdController extends Controller
// {
//     public function runBot(Request $request, Respondent $respondent) 
//     {
//         Artisan::call('skd:entri', ['respondentId' => $respondent->id]);
//         $output = Artisan::output();
//         return back()->with('success', "Proses bot selesai. Hasil: <pre>{$output}</pre>");
//     }
// }

class SkdController extends Controller
{
    public function runBot(Respondent $respondent)
    {
        Artisan::call('skd:entri', [
            'respondentId' => $respondent->id
        ]);

        $output = Artisan::output();

        if (str_contains($output, 'GAGAL')) {
            return back()->with('error', "Proses bot GAGAL. Hasil: <pre>{$output}</pre>");
        } else {
            return back()->with('success', "Proses bot selesai. Hasil: <pre>{$output}</pre>");
        }
    }
}