<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PlatformController;
use App\Models\Course;
use App\Models\Platform;
use App\Models\Series;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index() {
        $courses = Course::latest()->take(12)->get();
        return response()->json($courses);
    }
    public function allCourses(Request $request) {

        $courses = Course::where(function ($query) use($request) {
            if(!empty($request->search)) {
                $query->where('name','like','%'. $request->search . '%');
            }
            if(!empty($request->duration)) {
                    $query->whereIn('duration', $request->duration);
            }
            if(!empty($request->platforms)) {
              $query->whereIn('platform_id' ,$request->platforms);
            }
//            if(!empty($request->levels)) {
//                $query->whereIn('difficulty_level' ,$request->levels);
//            }



        })->paginate(12);
            $platforms = Platform::select('id','name')->get();
            $series = Series::select('id','name')->get();

            return response()->json([
                'courses' => $courses,
                'platforms'=> $platforms,
                'series'=> $series
            ]);
    }
    public function single($slug) {
    $course = Course::where('slug',$slug)->first();
    return response()->json($course);
    }

}
