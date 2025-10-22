@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <div class="container-fluid pt-4 px-4">
        <div class="row bg-secondary">
            <div class="col-12 text-center">
                <div class="form-container container-form" id="add-category-page" style="display: block;">
                    <div class="d-flex flex-row justify-content-around">
                        <h3 class="text-white">Edit Exam</h3>
                        <a href="{{ route('all.exam') }}" class="back-link d-block text-start" id="backBtn">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" style="cursor: pointer">
                                <path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                            Back to Categories
                        </a>
                    </div>

                    <div class="col-12 col-lg-8 mx-auto">
                        <div class="bg-secondary rounded p-4">
                            <form action="{{ route('exam.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $exam->id }}">

                                <div class="row mb-3 align-items-center">
                                    <label class="col-2 col-form-label text-white">Department</label>
                                    <div class="col-10">
                                        <select name="department_id" id="department-dropdown" class="form-select" required>
                                            <option value="">Select Department</option>
                                            @foreach ($departments as $dept)
                                                <option value="{{ $dept->id }}"
                                                    {{ $exam->department_id == $dept->id ? 'selected' : '' }}>
                                                    {{ $dept->depart_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3 align-items-center">
                                    <label class="col-2 col-form-label text-white">Subject</label>
                                    <div class="col-10">
                                        <select name="subject_id" id="subject-dropdown" class="form-select" required>
                                            <option value="">Select Subject</option>
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}"
                                                    {{ $exam->subject_id == $subject->id ? 'selected' : '' }}>
                                                    {{ $subject->subject_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('subject_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3 align-items-center">
                                    <label class="col-2 col-form-label text-white">Exam Title</label>
                                    <div class="col-10">
                                        <input type="text" name="exam_title" class="form-control"
                                            value="{{ $exam->exam_title }}" placeholder="Enter Exam Title" required>
                                        @error('exam_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3 align-items-center">
                                    <label class="col-2 col-form-label text-white">Start Time</label>
                                    <div class="col-10">
                                        <input type="time" name="start_time" class="form-control"
                                            value="{{ $exam->start_time }}" required>
                                        @error('start_time')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 text-end">
                                        <button type="submit" class="button-styleee" style="--clr: #39ff14;">
                                            <span>Update Exam</span><i></i>
                                        </button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                // Initialize Select2
                $('#department-dropdown').select2({
                    width: '100%'
                });
                $('#subject-dropdown').select2({
                    width: '100%'
                });

                // Dynamic Subjects on Department Change
                $('#department-dropdown').change(function() {
                    var deptID = $(this).val();
                    if (deptID) {
                        $.ajax({
                            url: '/get-subjects/' + deptID,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                $('#subject-dropdown').empty().append(
                                    '<option value="">Select Subject</option>');
                                $.each(data, function(key, value) {
                                    $('#subject-dropdown').append('<option value="' + value
                                        .id + '">' + value.subject_name + '</option>');
                                });
                                $('#subject-dropdown').trigger('change'); // Refresh Select2
                            },
                            error: function() {
                                $('#subject-dropdown').empty().append(
                                    '<option value="">Error loading subjects</option>');
                            }
                        });
                    } else {
                        $('#subject-dropdown').empty().append('<option value="">Select Subject</option>')
                            .trigger('change');
                    }
                });
            });
        </script>
    @endsection
