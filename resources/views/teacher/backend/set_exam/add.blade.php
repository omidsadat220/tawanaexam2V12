@extends('teacher.teacher_dashboard')
@section('teacher')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
    #select-all-questions {
    accent-color: #39ff14; /* رنگ دلخواه تیک */
    width: 18px; /* اندازه چک‌باکس */
    height: 18px;
}

</style>

<div class="container-fluid pt-4 px-4">
    <div class="row bg-secondary pt-5 position-relative">
        <div class="col-12 text-center">
            <h2>Add Exam</h2>
        </div>

        <!-- LEFT SIDE -->
        <div class="col-6">
            <form action="{{ route('store.teacher.set.exam') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3 pt-5 align-items-center">
                    <label for="category_id" class="col-2 col-form-label text-white">Select Exam</label>
                    <div class="col-10">
                        <select name="exam_id" id="exam-dropdown" class="form-select" required>
                            <option value="">Select Exam</option>
                            @foreach ($exams as $exam)
                                <option value="{{ $exam->id }}">{{ $exam->exam_title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-4 bg-dark text-white p-3 rounded" id="selected-questions" style="display:none; max-height:500px; overflow-y:auto; overflow-x:hidden;">
                    <h5>✅ Selected Questions</h5>
                    <ul id="selected-list" class="text-start" style="padding-left:20px; margin:0;"></ul>
                </div>

                <div class="btn-group mt-3" style="width: 100px;height: 40px;">
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
            </form>
        </div>

        <!-- RIGHT SIDE -->
        <div class="col-6 text-center">
            <div class="form-container container-form" id="add-category-page" style="display: block; margin-top: -18px;">
                

                <div class="container text-start p-4 bg-secondary rounded" style="overflow-x:hidden;">
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
                    <div class="row mb-3 pt-3 align-items-center">
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
                            <input class="form-check-input" type="checkbox" id="select-all-questions">
                            <label class="form-check-label text-white fw-normal" for="select-all-questions">Select All Questions</label>
                        </div>

                        <div id="questions-list" style="width:100%;"></div>
                    </div>
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
                                        <input type="checkbox" class="select-question form-check-input" data-id="${q.id}" data-question="${q.question}">
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
