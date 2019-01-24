<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TrainingFile;
use Storage;

class TrainingFileController extends Controller
{
  public function download(Request $request, $id)
    {
        $file = TrainingFile::find($id);
        return response()->download(Storage::path('public/trainings/'.$file->raw_name));
    }
}
