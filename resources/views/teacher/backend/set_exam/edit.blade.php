@extends('teacher.teacher_dashboard')
@section('teacher')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="container-fluid pt-4 px-4">
    <div class="row bg-secondary pt-5 position-relative">
        <div class="col-12 text-center">
            <h2>Edit Exam</h2>
        </div>

        <!-- LEFT SIDE -->
        <div class="col-6">
            <form action="{{ route('update.teacher.set.exam', $exam->id) }}" method="POST">
                @csrf
                <div class="row mb-3 pt-5 align-items-center">
                    <label for="exam-dropdown" class="col-2 col-form-label text-white">Select Exam</label>
                    <div class="col-10">
                        <select name="exam_id" id="exam-dropdown" class="form-select" required>
                            <option value="">Select Exam</option>
                            @foreach ($exams as $e)
                                <option value="{{ $e->id }}" {{ $exam->id == $e->id ? 'selected' : '' }}>
                                    {{ $e->exam_title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-4 bg-dark text-white p-3 rounded" id="selected-questions" style="display:{{ count($selectedQuestions) > 0 ? 'block' : 'none' }}; max-height:500px; overflow-y:auto; overflow-x:hidden;">
                    <h5>✅ Selected Questions</h5>
                    <ul id="selected-list" class="text-start" style="padding-left:20px; margin:0;">
                        @foreach ($selectedQuestions as $qId)
                            @php
                                $q = \App\Models\NewQuestion::find($qId);
                            @endphp
                            @if($q)
                                <li data-id="{{ $q->id }}">{{ $q->question }}</li>
                                <input type="hidden" name="question_ids[]" value="{{ $q->id }}" id="q-{{ $q->id }}">
                            @endif
                        @endforeach
                    </ul>
                </div>

                <div class="btn-group mt-3">
                    <button type="submit" class="btn btn-primary">Update Exam</button>
                </div>
            </form>
        </div>

        <!-- RIGHT SIDE -->
        <div class="col-6 text-center">
            <div class="form-container container-form" style="display: block;">
                <div class="d-flex flex-row justify-content-between mb-3">
                    <h3 class="text-white"></h3>
                    <a href="{{ route('all.set.exam') }}" class="back-link text-white">
                        Back to All Exams
                    </a>
                </div>

                <div class="container text-start p-4 bg-secondary rounded" style="overflow-x:hidden;">
                    <!-- Department -->
                    <div class="row mb-3 pt-3 align-items-center">
                        <label for="department-dropdown" class="col-sm-2 col-form-label text-white">Department</label>
                        <div class="col-sm-10">
                            <select name="department_id" id="department-dropdown" class="form-select">
                                <option value="">Select</option>
                                @foreach ($depart as $info)
                                    <option value="{{ $info->id }}">{{ $info->depart_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Subject -->
                    <div class="row mb-3 pt-3 align-items-center">
                        <label for="subject-dropdown" class="col-sm-2 col-form-label text-white">Subject</label>
                        <div class="col-sm-10">
                            <select name="subject_id" class="form-select" id="subject-dropdown">
                                <option value="">Select Subject</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Questions list container -->
                    <div id="questions-container" class="bg-dark text-white p-3 rounded mt-4" style="display:none; max-height:500px; overflow-y:auto;">
                        <h5 class="mb-3">Questions of this Subject</h5>

                        <!-- Select All Checkbox -->
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="select-all-questions">
                            <label class="form-check-label text-white fw-normal" for="select-all-questions">Select All Questions</label>
                        </div>

                        <div id="questions-list"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    let selectedQuestionIds = @json($selectedQuestions);

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

        // Reset select all
        $('#select-all-questions').prop('checked', false).prop('disabled', false);

        if (subject_id) {
            $.ajax({
                url: '/get-questions/' + subject_id,
                type: 'GET',
                success: function(res) {
                    if (res.length === 0) {
                        $('#questions-list').html('<p>No questions found.</p>');
                        $('#select-all-questions').prop('checked', false).prop('disabled', true);
                    } else {
                        $('#select-all-questions').prop('disabled', false);
                        let html = '';
                        res.forEach((q, i) => {
                            let checked = selectedQuestionIds.includes(q.id) ? 'checked' : '';
                            html += `
                                <div class="p-2 mb-3 border rounded bg-secondary text-start">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6>Q${i+1}: ${q.question}</h6>
                                        <input type="checkbox" class="select-question form-check-input" data-id="${q.id}" data-question="${q.question}" ${checked}>
                                    </div>
                                    <ul>
                                        ${q.options.map(o => `<li>${o}</li>`).join('')}
                                    </ul>
                                    <p><strong>✅ Correct:</strong> ${q.correct_answer}</p>
                                    ${q.image ? `<img src="${q.image}" width="100">` : ''}
                                </div>
                            `;
                            if (checked && $('#q-' + q.id).length === 0) {
                                $('form').append(`<input type="hidden" name="question_ids[]" value="${q.id}" id="q-${q.id}">`);
                            }
                        });
                        $('#questions-list').html(html);
                    }
                },
                error: function() {
                    $('#questions-list').html('<p>Error loading questions.</p>');
                    $('#select-all-questions').prop('checked', false).prop('disabled', true);
                }
            });
        } else {
            $('#questions-container').hide();
            $('#select-all-questions').prop('checked', false).prop('disabled', true);
        }
    });

    // Handle selected questions dynamically
    $(document).on('change', '.select-question', function() {
        let question = $(this).data('question');
        let questionId = $(this).data('id');

        if (this.checked) {
            $('#selected-questions').show();
            if($('#selected-list li[data-id="' + questionId + '"]').length === 0){
                $('#selected-list').append(`<li data-id="${questionId}">${question}</li>`);
                $('form').append(`<input type="hidden" name="question_ids[]" value="${questionId}" id="q-${questionId}">`);
            }
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

    // Handle select all
    $(document).on('change', '#select-all-questions', function() {
        let isChecked = $(this).is(':checked');
        $('.select-question').prop('checked', isChecked).trigger('change');
    });
});
</script>
@endsection
