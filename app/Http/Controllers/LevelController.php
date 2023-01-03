<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index($slug)
    {
        $level = Level::where('slug', $slug)->first();
        $courses = $level->courses()->paginate(12);
        return view('topic.single', [
            'level' => $level,
            'courses' => $courses
        ]);
    }
}
