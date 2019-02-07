@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Course {{ $course->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/courses') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/courses/' . $course->id . '/edit') }}" title="Edit Course"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/courses', $course->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Course',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $course->id }}</td>
                                    </tr>
                                    <tr><th> Course Code </th><td> {{ $course->course_code }} </td></tr><tr><th> Course Description </th><td> {{ $course->course_description }} </td></tr><tr><th> Department Id </th><td> {{ $course->department_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>Course Code</th>
                            <th>Student ID</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->course->course_code }}</td>
                            <td>{{ $student->id_number }}</td>
                            <td>{{ $student->last_name.', '.$student->first_name }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
