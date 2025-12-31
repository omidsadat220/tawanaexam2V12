@extends('admin.admin_dashboard')

@section('admin')

{{-- Libraries --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
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
                <a href="{{ route('all.set.exam') }}" class="text-success d-flex align-items-center">
                    <svg width="24" height="24" fill="none">
                        <path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    Back to Categories
                </a>
            </div>

            <div class="row justify-content-center">

                {{-- RIGHT SIDE --}}
                <div class="col-lg-6 col-md-12">

                    <div class="bg-secondary rounded text-start">

                        {{-- Department --}}
                        <div class="row mb-3 align-items-center">
                            <label class="col-sm-3 col-form-label text-white">Department</label>
                            <div class="col-sm-9">
                                <select id="department-dropdown" class="form-select">
                                    <option value="">Select</option>
                                    @foreach ($depart as $info)
                                        <option value="{{ $info->id }}">{{ $info->depart_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Subject --}}
                        <div class="row mb-3 align-items-center">
                            <label class="col-sm-3 col-form-label text-white">Subject</label>
                            <div class="col-sm-9">
                                <select id="subject-dropdown" class="form-select">
                                    <option value="">Select Subject</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Questions --}}
                        <div id="questions-container" class="bg-dark text-white p-3 rounded d-none">
                            <h5>Questions of this Subject</h5>

                            <div class="form-check mb-3">
                                <input class="form-check-input border border-1 border-success" type="checkbox" id="select-all-questions">
                                <label class="form-check-label">Select All Questions</label>
                            </div>

                            <div id="questions-list"></div>
                        </div>

                    </div>

                </div>
                
                {{-- LEFT SIDE --}}
                <div class="col-lg-6 col-md-12">

                    <form action="{{ route('store.set.exam') }}" method="POST">
                        @csrf

                        {{-- Exam Select --}}
                        <div class="row mb-3 align-items-center">
                            <label class="col-sm-3 col-form-label text-white">Select Exam</label>
                            <div class="col-sm-9">
                                <select name="exam_id" class="form-select" required>
                                    <option value="">Select Exam</option>
                                    @foreach ($exams as $exam)
                                        <option value="{{ $exam->id }}">{{ $exam->exam_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Selected Questions --}}
                        <div id="selected-questions" class="bg-dark text-white p-3 mt-4 rounded d-none text-end">
                            <h5>✅ Selected Questions</h5>
                            <ul id="selected-list" class="text-start ps-3 mb-0"></ul>
                        </div>

                        {{-- Submit --}}
                        <button type="submit" class="btn btn-primary mt-3 d-block text-start">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script>
$(document).ready(function () {

    // Load subjects
    $('#department-dropdown').change(function () {
        let id = $(this).val();
        $('#subject-dropdown').html('<option>Loading...</option>');

        if (id) {
            $.get(`/get-subjects/${id}`, function (res) {
                let options = '<option value="">Select Subject</option>';
                res.forEach(s => options += `<option value="${s.id}">${s.name}</option>`);
                $('#subject-dropdown').html(options);
            });
        }
    });

    // Load questions
    $('#subject-dropdown').change(function () {
        let id = $(this).val();
        $('#questions-container').removeClass('d-none');
        $('#questions-list').html('Loading...');
        $('#select-all-questions').prop('checked', false);

        if (!id) return;

        $.get(`/get-question/${id}`, function (res) {
            if (!res.length) {
                $('#questions-list').html('No questions found');
                return;
            }

            let html = '';
            res.forEach((q, i) => {
                html += `
                <div class="border rounded p-2 mb-3 bg-secondary">
                    <div class="d-flex justify-content-between">
                        <strong>Q${i+1}: ${q.question}</strong>
                        <input type="checkbox" class="select-question border border-1 border-success form-check-input"
                               data-id="${q.id}" data-question="${q.question}">
                    </div>
                    <ul class="ps-3 mt-2">
                        ${q.options.map(o => `<li>${o}</li>`).join('')}
                    </ul>
                    <p><b>Correct:</b> ${q.correct_answer}</p>
                </div>`;
            });
            $('#questions-list').html(html);
        });
    });

    // Select question
    $(document).on('change', '.select-question', function () {
        let id = $(this).data('id');
        let q = $(this).data('question');

        if (this.checked) {
            $('#selected-questions').removeClass('d-none');
            $('#selected-list').append(`<li data-id="${id}">${q}</li>`);
            $('form').append(`<input type="hidden" name="question_ids[]" id="q-${id}" value="${id}">`);
        } else {
            $(`#q-${id}`).remove();
            $(`#selected-list li[data-id="${id}"]`).remove();
            if (!$('#selected-list li').length) $('#selected-questions').addClass('d-none');
        }
    });

    // Select all
    $('#select-all-questions').change(function () {
        $('.select-question').prop('checked', this.checked).trigger('change');
    });

});
</script>

@endsection
