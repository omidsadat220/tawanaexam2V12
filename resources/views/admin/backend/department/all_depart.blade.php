@extends('admin.admin_dashboard')
@section('admin')
    <div class="container-fluid pt-4 px-4">
        <div class="row min-vh-100 bg-secondary rounded align-items-center justify-content-center mx-0">
            <div class="col-12 text-center">
                <!-- Departments List Page -->
                <div class="container-form" id="departments-page">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center justify-content-between mb-4">
                            <h3 class="m-0">Departments</h3>

                            <div class="d-flex align-items-center gap-2">
                                <form class="d-none d-md-flex">
                                    <input class="form-control bg-dark border-0" type="search" placeholder="Search" />
                                </form>

                                <a href="{{ route('add.depart') }}">
                                    <button style="--clr: #39ff14" class="button-styleee">
                                        <span>Create Department</span><i></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Departments Table -->
                    <div class="table-responsive">
                        <table class="paginated table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Subjects</th>
                                    <th scope="col" class="action">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departments as $key => $depart)
                                    <tr>
                                        <td scope="row">{{ $key + 1 }}</td>
                                        <td>{{ $depart->depart_name ?? 'نام ندارد' }}</td>
                                        <td>
                                            @foreach ($depart->subjects as $subject)
                                                <span>{{ $subject->subject_name }}</span><br>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a title="Edit" href="{{ route('edit.depart', $depart->id) }}"
                                                class="btn btn-success btn-sm">
                                                <span class="mdi mdi-book-edit mdi-18px">edit</span>
                                            </a>

                                            <a title="Delete" href="{{ route('delete.depart', $depart->id) }}"
                                                class="btn btn-danger btn-sm" id="delete">
                                                <span class="mdi mdi-delete-circle mdi-18px">delete</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div id="pagination" class="mt-3 d-flex gap-2"></div>
                    </div>

                    <!-- Add Department Page (اختیاری - مشابه Category) -->
                    <div class="form-container container-form" id="add-depart-page" style="display: none">
                        <a href="#" class="back-link d-block text-start" id="backBtn">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" style="cursor: pointer">
                                <path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Back to Departments
                        </a>

                        <h3 class="text-white">Add New Department</h3>
                        <form id="departForm">
                            <div class="row">
                                <div class="col-12 d-flex align-items-center justify-content-between mb-3">
                                    <label for="departName" class="text-start">Department Name</label>
                                    <input class="catinput" type="text" id="departName" name="departName" required
                                        placeholder="Enter department name..." />
                                </div>

                                <div class="col-12 d-flex align-items-start justify-content-between mb-3">
                                    <label for="departDesc" class="text-start">Description</label>
                                    <textarea type="text" id="departDesc" name="departDesc" rows="4"
                                        placeholder="Enter department description..."></textarea>
                                </div>

                                <div class="col-12 d-flex align-items-end w-100 justify-content-end">
                                    <a href="#" class="mb-3" id="addNewBtn">
                                        <button style="--clr: #39ff14" type="submit" class="button-styleee">
                                            <span>Save Department</span><i></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>

            </div> <!-- end .col-12 -->
        </div> <!-- end .row -->
    </div> <!-- end .container-fluid -->
@endsection
