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

                                <a href="{{ route('add.set.exam') }}">
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
                                    <th scope="col">Exam Name</th>

                                    <th scope="col" class="all">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tbody>
                                    @foreach ($examQuestions as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->exam ? $item->exam->exam_title : 'N/A' }}</td>
                                            <td>
                                                <a href="{{ route('edit.set.exam', $item->exam_id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <a href="{{ route('delete.set.exam', $item->exam_id) }}" class="btn btn-danger btn-sm" id="delete">Delete</a>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </tbody>
                        </table>
                        <div id="pagination" class="mt-3 d-flex gap-2"></div>
                    </div>
                </div>
            </div>
        </div>
@endsection
