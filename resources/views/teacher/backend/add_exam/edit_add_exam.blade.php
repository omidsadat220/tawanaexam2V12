@extends('teacher.teacher_dashboard')
@section('teacher')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

                        <form action="{{ route('update.teacher.add.exam') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $addexam->id }}">

                             <div class="row mb-3 align-items-center">
                                    <label class="col-2  col-form-label">Department</label>
                                    <select name="department_id" class="col-10  form-select" id="department-dropdown">
                                        <option value="">Select Department</option>
                                        @foreach ($depart as $dept)
                                            <option value="{{ $dept->id }}"
                                                {{ $addexam->department_id == $dept->id ? 'selected' : '' }}>
                                                {{ $dept->depart_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>

                            <div class="row mb-3 align-items-center">
                                    <label class="col-2 col-form-label">Subject</label>
                                    <select name="subject_id" class="col-10 form-select" id="subject-dropdown">
                                        <option value="">Select Subject</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}"
                                                {{ $addexam->subject_id == $subject->id ? 'selected' : '' }}>
                                                {{ $subject->subject_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('subject_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                            

                            <div class="row mb-3 align-items-center">
                                    <label class="col-2 col-form-label">Exam Title</label>
                                    <select name="user_id" class="col-10 form-select" id="subject-dropdown">
                                        <option value="">Select Subject</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ $addexam->user_id == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                            </div>

                             <div class="row mb-3 align-items-center">
                                    <label class="col-2 col-form-label">Start Time</label>
                                    <input type="time" name="exam_time" class="col-10 form-control"
                                        value="{{ $addexam->exam_time }}">
                                    @error('exam_time')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>

                             <div class="col-12 d-flex align-items-end w-100 justify-content-end">
                                <a href="#" class="mb-3" id="addNewBtn">
                                    <button style="--clr: #39ff14" type="submit" class="button-styleee">
                                        <span>Updath Add Exam</span><i></i>
                                    </button>
                                </a>
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
            $('#department-dropdown').select2();
            $('#subject-dropdown').select2();

            // Dynamic Subjects on Department Change
            $('#department-dropdown').change(function() {
                var deptID = $(this).val();
                if (deptID) {
                    $.ajax({
                        url: '/get-teacher_subjects/' + deptID,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#subject-dropdown').empty();
                            $('#subject-dropdown').append(
                                '<option value="">Select Subject</option>');
                            $.each(data, function(key, value) {
                                $('#subject-dropdown').append('<option value="' + value
                                    .id + '">' + value.subject_name + '</option>');
                            });
                            $('#subject-dropdown').trigger('change'); // Refresh Select2
                        }
                    });
                } else {
                    $('#subject-dropdown').empty();
                    $('#subject-dropdown').append('<option value="">Select Subject</option>');
                    $('#subject-dropdown').trigger('change'); // Refresh Select2
                }
            });
        });
    </script>
@endsection
