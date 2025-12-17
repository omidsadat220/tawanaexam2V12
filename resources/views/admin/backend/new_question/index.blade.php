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


                    <div class="table-responsive" style="max-height: 700px; overflow-y: auto;">
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
                                @foreach ($new as $key => $data)
                                    <tr>
                                        <td scope="row">{{ $key+1 }}</td>
                                        <td>{{ $data->department->depart_name ?? 'N/A' }}</td>
                                        <td>{{ $data->subject->subject_name ?? 'N/A' }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($data->question, 15) }}...</td>
                                        <td>{{ \Illuminate\Support\Str::limit($data->option1, 10) }}...</td>
                                        <td>{{ \Illuminate\Support\Str::limit($data->option2, 10) }}...</td>
                                        <td>{{ \Illuminate\Support\Str::limit($data->option3, 10) }}...</td>
                                        <td>{{ \Illuminate\Support\Str::limit($data->option4, 10) }}...</td>
                                        <td>{{ \Illuminate\Support\Str::limit($data->correct_answer, 10) }}...</td>                                        
                                        {{-- <td>{{ $data->user_id}}</td> --}}
                                        <td style="text-align: center;">
                                            @if($data->image)
                                                <i class="fas fa-check-circle" style="color: green; font-size: 20px;"></i>
                                            @else
                                                <i class="fas fa-times-circle" style="color: red; font-size: 20px;"></i>
                                            @endif
                                        </td>
                                                                               
                                    
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
