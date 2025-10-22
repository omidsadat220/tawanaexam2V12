@extends('teacher.teacher_dashboard')
@section('teacher')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <div class="container-fluid pt-4 px-4">
        <div class="row bg-secondary">
            <div class="col-12 text-center">
                <div class="form-container container-form" id="add-category-page" style="display: block;">
                    <div class="d-flex flex-row justify-content-around">
                        <h3 class="text-white">Add Teacher Exam</h3>
                        <a href="{{ route('all.exam') }}" class="back-link d-block text-start" id="backBtn">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" style="cursor: pointer">
                                <path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                            Back to Categories
                        </a>
                    </div>



                    <!-- Admission Form -->
                    <form action="{{ route('store.teacher.add.exam') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <!-- Name -->

                            <div class="col-md-6">
                                <label class="col-sm-4 col-form-label">Department</label>
                                <div class="col-sm-10">
                                    <select name="department_id" class="form-select" id="department-dropdown">
                                        <option value="">Select</option>
                                        @foreach ($depart as $info)
                                            <option value="{{ $info->id }}">{{ $info->depart_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="col-sm-4 col-form-label">Subject</label>
                                    <div class="col-sm-10">
                                        <select name="subject_id" class="form-select" id="subject-dropdown">
                                            <option value="">Select Subject</option>
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->subject_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="col-sm-4 col-form-label">Subject</label>
                                    <div class="col-sm-10">
                                        <select name="user_id" class="form-select" id="subject-dropdown">
                                            <option value="">Select Subject</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="col-sm-6 col-form-label">time</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="exam_time" type="time"
                                            placeholder="paid_date">
                                    </div>
                                </div>

                            </div>


                        </div>
                         <div class="col-12 d-flex align-items-end w-100 justify-content-end">
                                <a href="#" class="mb-3" id="addNewBtn">
                                    <button style="--clr: #39ff14" type="submit" class="button-styleee">
                                        <span>Add Exam</span><i></i>
                                    </button>
                                </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Select2 Initialization Script -->
    <script>
        $(document).ready(function() {
            $('#student-select').select2({
                placeholder: "Search or select a student",
                allowClear: true,
                width: '100%'
            });
        });
    </script>



    <!-- jQuery Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function calculateRemaining() {
            let total = parseFloat($('#total_fees').val()) || 0;
            let paid = parseFloat($('#paid').val()) || 0;
            let remaining = total - paid;
            $('#remaining_fees').val(remaining >= 0 ? remaining : 0);
        }


        $(document).ready(function() {
            // Recalculate on input changes
            $('#amount, #paid').on('input', calculateRemaining);

            // Initialize on page load
            calculateRemaining();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#department-dropdown').on('change', function() {
                var depart_id = this.value;
                $('#subject-dropdown').html('<option value="">Loading...</option>');

                if (depart_id) {
                    $.ajax({
                        url: "/get-teacher_subjects/" + depart_id,
                        type: "GET",
                        success: function(res) {
                            $('#subject-dropdown').html(
                                '<option value="">Select Subject</option>');
                            $.each(res, function(key, value) {
                                $('#subject-dropdown').append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                        },
                        error: function() {
                            $('#subject-dropdown').html(
                                '<option value="">Error loading subjects</option>');
                        }
                    });
                } else {
                    $('#subject-dropdown').html('<option value="">Select Subject</option>');
                }
            });
        });
    </script>


@endsection