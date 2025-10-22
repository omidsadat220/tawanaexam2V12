@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <div class="container-fluid pt-4 px-4">
        <div class="row bg-secondary">
            <div class="col-12 text-center">
                <div class="form-container container-form" id="add-category-page" style="display: block;">
                    <div class="d-flex flex-row justify-content-around">
                        <h3 class="text-white">Add New Exam</h3>
                        <a href="{{ route('all.exam') }}" class="back-link d-block text-start" id="backBtn">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" style="cursor: pointer">
                                <path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                            Back to Categories
                        </a>
                    </div>

                    <form action="{{ route('store.exam') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="container text-start p-4 bg-secondary rounded ">

                            <div class="row mb-3 pt-3 align-items-center">
                                <label for="department-dropdown"
                                    class="col-sm-2 col-form-label text-white">Department</label>
                                <div class="col-sm-10">
                                    <select name="department_id" id="department-dropdown" class="form-select">
                                        <option value="">Select</option>
                                        @foreach ($depart as $info)
                                            <option value="{{ $info->id }}">{{ $info->depart_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="row mb-3 pt-3 align-items-center">
                                <label for="subject-dropdown" class="col-sm-2 col-form-label text-white">Subject</label>
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

                            <div class="row mb-3 align-items-center">
                                <label for="exam_title" class="col-sm-2 col-form-label text-white">exam_title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="exam_title" name="exam_title" type="text"
                                        placeholder="Enter Exam Title">
                                </div>
                            </div>


                            <div class="row mb-3 align-items-center">
                                <label for="time" class="col-sm-2 col-form-label text-white">time</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="start_time" type="time" id="time"
                                        placeholder="Exam duration">
                                </div>
                            </div>
                     
                     
                            <div class="row">
                                <div class="col-12 text-end">
                                    <button style="--clr: #39ff14" type="submit" class="button-styleee">
                                        <span>Add exam</span><i></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
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
                        url: "/get-subjects/" + depart_id,
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
