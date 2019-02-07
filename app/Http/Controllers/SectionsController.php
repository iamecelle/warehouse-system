<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Course, App\Department, App\Student;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $courses = Course::where('course_code', 'LIKE', "%$keyword%")
                ->orWhere('course_description', 'LIKE', "%$keyword%")
                ->orWhere('department_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $courses = Course::latest()->paginate($perPage);
        }

        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $departments = Department::get()->pluck('short_code', 'id');

        return view('admin.courses.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'course_code' => 'required',
			'course_description' => 'required'
		]);
        $requestData = $request->all();
        
        Course::create($requestData);

        return redirect('admin/courses')->with('flash_message', 'Course added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $course = Course::findOrFail($id);

        // $students = Course::join('students', 'courses.id', '=', 'students.course_id')
        //     ->where('courses.id', $id)
        //     ->get();

        $students = Student::with('course')
            ->where('course_id', $id)
            ->get();

        // return $students;

        // return $students;

        return view('admin.courses.show', compact('course'))->with('students', $students);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);

        return view('admin.courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'course_code' => 'required',
			'course_description' => 'required'
		]);
        $requestData = $request->all();
        
        $course = Course::findOrFail($id);
        $course->update($requestData);

        return redirect('admin/courses')->with('flash_message', 'Course updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Course::destroy($id);

        return redirect('admin/courses')->with('flash_message', 'Course deleted!');
    }
}
