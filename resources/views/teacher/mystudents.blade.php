@extends('teacher.master')

@section('content')

    <div class="container-fluid">
        <div class="mt-3">
            <div class="row">
                <div class="col-6">
                    @if(session('msg'))
                    <div class="text-center p-3 mb-2 bg-success text-white">
                        {{ session('msg') }}
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">Students</h3>
                                </div>
                                {{-- <div class="col text-right">
                                    <button class="btn btn-sm btn-primary" type="button" data-toggle="modal"
                                        data-target="#addCourseModal"> Add Course</button>
                                </div> --}}
                            </div>
                        </div>
                        @if ($students->count())
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Student Name</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Score</th>
                                        <th scope="col">Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                    <tr>
                                        <th scope="row">
                                            {{ $student->name}}
                                        </th>
                                        <th scope="row">
                                            {{ $student->description}}
                                        </th>
                                        <td>
                                            <button class="btn btn-sm btn-secondary" type="button" data-toggle="modal"
                                                data-target="#editTeacherModal">Edit</button>
                                        </td>
                                        <td>
                                            <form action="{{ route() }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <p class="px-5">No Student.</p>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
