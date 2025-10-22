@extends('teacher.teacher_dashboard')
@section('teacher')
    <div class="container-fluid pt-4 px-4">
        <div class="row bg-secondary ">
            <div class="col-12 text-center">


                <div class="container-form" id="categories-page">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center justify-content-between mb-4">
                            <h3 class="m-0">View Student Info</h3>

                            <div class="d-flex align-items-center gap-2">
                                <form class="d-none d-md-flex">
                                    <input class="form-control bg-dark border-0 " type="search" placeholder="Search" />
                                </form>

                            </div>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="paginated table table-bordered" id="datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">name</th>
                                    <th scope="col">email</th>
                                    <th scope="col">Set Class</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($students as $user)
                                    <tr>
                                        <td scope="row">{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td><a href="{{ route('set.class', $user->id) }}">Set Class</a></td>





                                        {{-- <td style="text-align:center; font-size: 20px;">
                                <a href="{{ route('edit.teacher.exam', $exam->id) }}">
                                    <i class="fas fa-edit btn btn-primary"></i>
                                </a>
                                <a href="{{ route('delete.teacher.exam', $exam->id) }}" id="delete">
                                    <i class="fas fa-trash-alt btn btn-danger"></i>
                                </a>
                            </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div id="pagination" class="mt-3 d-flex gap-2"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>

 @endsection
