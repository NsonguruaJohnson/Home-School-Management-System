<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard


* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com



=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
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
                                    <h3 class="mb-0">Courses</h3>
                                </div>
                                <div class="col text-right">
                                    <button class="btn btn-sm btn-primary" type="button" data-toggle="modal"
                                        data-target="#addCourseModal"> Add Course</button>
                                </div>
                            </div>
                        </div>
                        @if ($courses->count())
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Course Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)
                                    <tr>
                                        <th scope="row">
                                            {{ $course->name}}
                                        </th>
                                        <th scope="row">
                                            {{ $course->description}}
                                        </th>
                                        <td>
                                            <button class="btn btn-sm btn-secondary" type="button" data-toggle="modal"
                                                data-target="#editTeacherModal">Edit</button>
                                        </td>
                                        <td>
                                            <form action="{{ route('delete.course', $course) }}" method="post">
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
                        <p class="px-5">No Course Registered.</p>
                        @endif
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">Activities</h3>
                                </div>
                                <div class="col text-right">
                                    <button class="btn btn-sm btn-primary" type="button" data-toggle="modal"
                                        data-target="#addRoleModal">Create Activity</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Activity Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activities as $activity)
                                    <tr>
                                        <th scope="row">
                                            {{ $activity->name}}
                                        </th>
                                        <td>
                                            {{$activity->description}}
                                        </td>
                                        <td>
                                            <form action="{{ route('delete.activity', $activity) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- Modal For Adding Courses-->
    <div class="modal fade" id="addCourseModal" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Teacher</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('add.course') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input type="text" name="name"
                                    class="form-control @error('name') border border-danger @enderror"
                                    value="{{ old('name') }}" placeholder="Name">
                            </div>
                            <div>
                                @error('name')
                                <div class="text-danger pt-0 mt-0">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input type="text" name="description"
                                    class="form-control @error('username') border border-danger @enderror"
                                    value="{{ old('username') }}" placeholder="Description">
                            </div>
                            <div>
                                @error('description')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-4">Add Course</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal For Editing Courses-->
    @foreach($courses as $course)
    <div class="modal fade" id="editCourseModal" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Teacher</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('update.course', $course) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input type="text" name="name"
                                    class="form-control @error('name') border border-danger @enderror"
                                    value="{{ $course->name }}" placeholder="Name">
                            </div>
                            <div>
                                @error('name')
                                <div class="text-danger pt-0 mt-0">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input type="text" name="description"
                                    class="form-control @error('username') border border-danger @enderror"
                                    value="{{ $course->description }}" placeholder="Username">
                            </div>
                            <div>
                                @error('description')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-4">Update Course</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Modal For Adding Activity -->
    <div class="modal fade" id="addRoleModal" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('add.activity') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative mb-3">
                                <input type="text" name="name"
                                    class="form-control @error('name') border border-danger @enderror"
                                    value="{{ old('name') }}" placeholder="Activity name">
                            </div>
                            <div>
                                @error('name')
                                <div class="text-danger pt-0 mt-0">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative mb-3">
                                <input type="text" name="description"
                                    class="form-control @error('description') border border-danger @enderror"
                                    value="{{ old('description') }}" placeholder="Description">
                            </div>
                            <div>
                                @error('description')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-4">Add Role</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection
