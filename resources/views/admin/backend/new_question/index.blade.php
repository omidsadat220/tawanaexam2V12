@extends('admin.admin_dashboard')
@section('admin')
   <div class="container-fluid pt-4 px-4">
        <div class="row bg-secondary ">
            <div class="col-12 text-center">

                <!-- Categories List Page -->
                <div class="container-form" id="categories-page">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center justify-content-between mb-4">
                            <h3 class="m-0">New Questions</h3>

                            <div class="d-flex align-items-center gap-2">
                                <form class="d-none d-md-flex">
                                    <input class="form-control bg-dark border-0 " type="search" placeholder="Search" />
                                </form>

                                <a href="{{ route('add.new.qestion') }}">
                                    <button style="--clr: #39ff14" class="button-styleee">
                                        <span>Create Exam</span><i></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table class="paginated table table-bordered" id="datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Question</th>
                                    <th scope="col">Option1</th>
                                    <th scope="col">Option2</th>
                                    <th scope="col">Option3</th>
                                    <th scope="col">Option4</th>
                                    <th scope="col">Correct Answer</th>
                                    <th scope="col">Image</th>

                                    <th scope="col" class="all">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($new as $data)
                                    <tr>
                                        <td scope="row">{{ $data->id }}</td>
                                        <td>{{ $data->department_id }}</td>
                                        <td>{{ $data->subject_id }}</td>
                                        <td>{{ $data->question }}</td>
                                        <td>{{ $data->option1 }}</td>
                                        <td>{{ $data->option2 }}</td>
                                        <td>{{ $data->option3 }}</td>
                                        <td>{{ $data->option4 }}</td>
                                        <td>{{ $data->correct_answer }}</td>
                                        <td>{{ $data->user_id}}</td>
                                        <td> <img src="{{ asset($data->image) }}" style="width: 70px; height: 70px;"></td>

                                    
                                        <td>
                                            <a title="Edit" href="{{ route('edit.new.question', $data->id) }}"
                                                class="btn btn-success btn-sm"> <span
                                                    class="mdi mdi-book-edit mdi-18px">edit</span>
                                            </a>

                                            <a title="Delete" href="{{ route('delete.new.question', $data->id) }}"
                                                class="btn btn-danger btn-sm" id="delete"><span
                                                    class="mdi mdi-delete-circle  mdi-18px">delete</span></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div id="pagination" class="mt-3 d-flex gap-2"></div>
                    </div>
                </div>
            </div>
        </div>
@endsection
