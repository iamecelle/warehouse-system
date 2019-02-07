<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Student, App\Course;
use Illuminate\Http\Request;

class StudentsController extends Controller
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
            $students = Student::where('id_number', 'LIKE', "%$keyword%")
                ->orWhere('first_name', 'LIKE', "%$keyword%")
                ->orWhere('last_name', 'LIKE', "%$keyword%")
                ->orWhere('gender', 'LIKE', "%$keyword%")
                ->orWhere('course_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $students = Student::latest()->paginate($perPage);
        }

        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $courses = Course::get()->pluck('course_code', 'id');

        return view('admin.students.create', compact('courses'));
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
            'id_number' => 'required',
            'first_name' => 'required',
            'last_name' => 'required'
        ]);
        $requestData = $request->all();
        
        Student::create($requestData);

        return redirect('admin/students')->with('flash_message', 'Student added!');
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
        $student = Student::findOrFail($id);

        return view('admin.students.show', compact('student'));
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
        $student = Student::findOrFail($id);
        $courses = Course::get()->pluck('course_code', 'id');

        return view('admin.students.edit', compact('student'))->with('courses', $courses);
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
            'id_number' => 'required',
            'first_name' => 'required',
            'last_name' => 'required'
        ]);
        $requestData = $request->all();
        
        $student = Student::findOrFail($id);
        $student->update($requestData);

        return redirect('admin/students')->with('flash_message', 'Student updated!');
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
        Student::destroy($id);

        return redirect('admin/students')->with('flash_message', 'Student deleted!');
    }

    public function list()
    {
        $students = Student::get();

        $return_array = [];

        foreach($students as $student) {
            $return_array[] = [
                'id' => $student->id,
                'id_number' => $student->id_number,
                'full_name' => $student->full_name,
                'gender' => ucfirst($student->gender),
            ];
        }

        return response()->json(['data' => $return_array]);
    }
}
