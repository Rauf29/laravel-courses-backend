<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    public function index($slug)
    {
        $platform = Platform::where('slug', $slug)->first();
        $courses = $platform->courses()->paginate(12);
        return view('topic.single', [
            'platform' => $platform,
            'courses' => $courses
        ]);
    }
}
