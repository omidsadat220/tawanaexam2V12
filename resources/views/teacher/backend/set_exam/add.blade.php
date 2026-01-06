@extends('teacher.teacher_dashboard')
@section('teacher')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- Custom Style --}}
<style>
        #select-all-questions {
            accent-color: #39ff14;
            width: 18px;
            height: 18px;
        }

        .bg-auto-style {
        min-height: 100vh;
        max-height:100vh;
        overflow-y: auto;
        }

        /* ===== Custom Scrollbar ===== */

    /* Chrome, Edge, Safari */
    .custom-scroll {
        scrollbar-width: thin;
        scrollbar-color: #00c61eff #383b3eff; /* green thumb | secondary track */
    }

    .custom-scroll::-webkit-scrollbar {
        width: 10px;
    }

    .custom-scroll::-webkit-scrollbar-track {
        background: #6c757d; /* Bootstrap secondary */
        border-radius: 10px;
    }

    .custom-scroll::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #0b8900ff, #01d80cff);
        border-radius: 10px;
        border: 2px solid #6c757d;
    }

    .custom-scroll::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(180deg, #0b8900ff, #01d80cff);
    }

</style>

<div class="container-fluid pt-4 px-4">
    <div class="row bg-secondary rounded mx-0 p-4 bg-auto-style custom-scroll" >
        <div class="col-12 text-center">
        {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="text-white">Add Exam</h3>
                <a href="{{ route('all.teacher.set.exam') }}" class="text-success d-flex align-items-center">
                    <svg width="24" height="24" fill="none">
                        <path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    Back to Categories
                </a>
            </div>

            <div class="row justify-content-center">

                <!-- RIGHT SIDE -->
                <div class="col-lg-6 col-md-12">
                    <div class="bg-secondary rounded text-start">
                    
                        <!-- Department -->
                        <div class="row mb-3 align-items-center">
                            <label for="department-dropdown" class="col-sm-3 col-form-label text-white">Department</label>
                            <div class="col-sm-9">
                                <select name="department_id" id="department-dropdown" class="form-select">
                                    <option value="">Select</option>
                                    @foreach ($depart as $info)
                                        <option value="{{ $info->id }}">{{ $info->depart_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Subject -->
                        <div class="row mb-3 align-items-center">
                            <label for="subject-dropdown" class="col-sm-3 col-form-label text-white">Subject</label>
                            <div class="col-sm-9">
                                <select name="subject_id" class="form-select" id="subject-dropdown">
                                    <option value="">Select Subject</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Questions list container -->
                        <div id="questions-container" class="bg-dark text-white p-3 rounded mt-4" 
                            style="display:none; width:100%; box-sizing:border-box; max-height:500px; overflow-y:auto; overflow-x:hidden;">
                            <h5 class="mb-3">Questions of this Subject</h5>

                            <!-- Select All Checkbox -->
                            <div class="form-check mb-2">
                                <input class="form-check-input border border-1 border-success" type="checkbox" id="select-all-questions">
                                <label class="form-check-label text-white fw-normal" for="select-all-questions">Select All Questions</label>
                            </div>

                            <div id="questions-list" style="width:100%;"></div>
                        </div>
                    </div>
                </div>
               

                <!-- LEFT SIDE -->
                 <div class="col-lg-6 col-md-12">
                    <form action="{{ route('store.teacher.set.exam') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row align-items-center">
                            <label for="category_id" class="col-sm-3 col-form-label text-white">Select Exam</label>
                            <div class="col-sm-9">
                                <select name="exam_id" id="exam-dropdown" class="form-select" required>
                                    <option value="">Select Exam</option>
                                    @foreach ($exams as $exam)
                                        <option value="{{ $exam->id }}">{{ $exam->exam_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mt-4 bg-dark text-white p-3 rounded d-none text-end" id="selected-questions" >
                            <h5>✅ Selected Questions</h5>
                            <ul id="selected-list" class="text-start ps-3 mb-0"></ul>
                        </div>

                        {{-- Submit --}}
                        <div class="text-start">
                            <button type="submit" class="btn btn-primary d-inline-block">
                                Submit
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        // Load subjects dynamically
        $('#department-dropdown').on('change', function() {
            var depart_id = this.value;
            $('#subject-dropdown').html('<option value="">Loading...</option>');
            if (depart_id) {
                $.ajax({
                    url: "/get-teacher_subjects/" + depart_id,
                    type: "GET",
                    success: function(res) {
                        $('#subject-dropdown').html('<option value="">Select Subject</option>');
                        $.each(res, function(key, value) {
                            $('#subject-dropdown').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#subject-dropdown').html('<option value="">Select Subject</option>');
            }
        });

        // Load questions by subject
        $('#subject-dropdown').on('change', function() {
            var subject_id = $(this).val();
            $('#questions-list').html('<p>Loading...</p>');
            $('#questions-container').show();

            // Reset select all checkbox
            $('#select-all-questions').prop('checked', false);

            if (subject_id) {
                $.ajax({
                    url: '/get-questions/' + subject_id,
                    type: 'GET',
                    success: function(res) {
                        if (res.length === 0) {
                            $('#questions-list').html('<p>No questions found.</p>');
                            $('#select-all-questions').prop('disabled', true); // غیر فعال
                        } else {
                            $('#select-all-questions').prop('disabled', false); // فعال
                            let html = '';
                            res.forEach((q, i) => {
                                html += `
                                    <div class="p-2 mb-3 border rounded bg-secondary text-start" 
                                        style="width:100%; box-sizing:border-box; margin:0; padding:10px; overflow-x:hidden;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 style="margin:0; padding:0;">Q${i + 1}: ${q.question}</h6>
                                            <input type="checkbox" class="select-question border border-1 border-success  form-check-input" data-id="${q.id}" data-question="${q.question}">
                                        </div>
                                        <ul class="mt-2" style="margin:0; padding-left:20px;">
                                            ${q.options.map(o => `<li>${o}</li>`).join('')}
                                        </ul>
                                        <p style="margin:5px 0;"><strong>✅ Correct:</strong> ${q.correct_answer}</p>
                                        ${q.image ? `<img src="${q.image}" width="100" class="rounded mt-2">` : ''}
                                    </div>
                                `;
                            });
                            $('#questions-list').html(html);
                        }
                    },
                    error: function() {
                        $('#questions-list').html('<p>Error loading questions.</p>');
                        $('#select-all-questions').prop('disabled', true);
                    }
                });
            } else {
                $('#questions-container').hide();
                $('#select-all-questions').prop('checked', false).prop('disabled', true);
            }
        });

        // ✅ Handle selected questions
        $(document).on('change', '.select-question', function() {
            let question = $(this).data('question');
            let questionId = $(this).data('id');

            if (this.checked) {
                $('#selected-questions').show();
                $('#selected-list').append(`<li data-id="${questionId}">${question}</li>`);
                $('form').append(`<input type="hidden" name="question_ids[]" value="${questionId}" id="q-${questionId}">`);
            } else {
                $('#selected-list li[data-id="' + questionId + '"]').remove();
                $('#q-' + questionId).remove();
                if ($('#selected-list li').length === 0) {
                    $('#selected-questions').hide();
                }
            }

            // Update select all checkbox
            let total = $('.select-question').length;
            let checked = $('.select-question:checked').length;
            $('#select-all-questions').prop('checked', total === checked && total > 0);
        });

        // ✅ Handle select all
        $(document).on('change', '#select-all-questions', function() {
            let isChecked = $(this).is(':checked');
            $('.select-question').prop('checked', isChecked).trigger('change');
        });

    });
</script>
@endsection
