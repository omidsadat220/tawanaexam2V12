@extends('teacher.teacher_dashboard')
@section('teacher')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="container-fluid pt-4 px-4">
    <div class="row bg-secondary">
        <div class="col-12 text-center">
            <div class="form-container container-form" id="add-category-page" style="display: block;">
                <div class="d-flex flex-row justify-content-around align-items-center mb-3">
                    <h3 class="text-white">Edit Teacher Question</h3>
                    <a href="{{ route('all.teacher.qestion') }}" class="back-link d-block text-start" id="backBtn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" style="cursor: pointer">
                            <path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                        Back to Questions
                    </a>
                </div>

                <div class="col-12 col-lg-8 mx-auto">
                    <div class="bg-secondary rounded h-100 p-4">

                        <form id="qestionForm" action="{{ route('update.teacher.qestion') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $editData->id }}">

                            <!-- Exam Select -->
                            <div class="row mb-3 pt-3 align-items-center">
                                <label class="col-2 col-form-label">Subject</label>
                                <div class="col-10">
                                    <select name="exam_id" class="form-select" id="subject-dropdown">
                                        <option value="">Select exam</option>
                                        @foreach ($exams as $exam)
                                            <option value="{{ $exam->id }}"
                                                {{ old('exam_id', $editData->exam_id) == $exam->id ? 'selected' : '' }}>
                                                {{ $exam->exam_title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Question -->
                            <div class="row mb-3 pt-3 align-items-center">
                                <label for="question" class="col-2 col-form-label text-start">What is Question?</label>
                                <div class="col-10">
                                    <input class="catinput form-control" type="text" id="question" name="question"
                                        value="{{ $editData->question }}" placeholder="Enter question name...">
                                </div>
                            </div>

                            <!-- Options -->
                            @foreach (['option1', 'option2', 'option3', 'option4'] as $option)
                                <div class="row mb-3 pt-3 align-items-center">
                                    <label for="{{ $option }}" class="col-2 text-start col-form-label">{{ $option }}</label>
                                    <div class="col-10">
                                        <input class="catinput form-control" type="text" id="{{ $option }}" name="{{ $option }}"
                                            value="{{ $editData->$option }}" placeholder="Enter {{ $option }} name...">
                                    </div>
                                </div>
                            @endforeach

                            <!-- Correct Answer -->
                            <div class="row mb-3 pt-3 align-items-center">
                                <label for="correct_answer" class="text-start col-2 col-form-label">Correct Answer</label>
                                <div class="col-10">
                                    <input class="catinput form-control" type="text" id="correct_answer" name="correct_answer"
                                        value="{{ $editData->correct_answer }}" placeholder="Enter correct answer...">
                                </div>
                            </div>

                            <!-- Image Upload -->
                            <div class="row mb-3 pt-3 align-items-center">
                                <label for="validationDefault02" class="form-label col-2 col-form-label">Question Image</label>
                                <div class="col-5">
                                    <input type="file" class="form-control" name="image" id="image">
                                </div>
                                <div class="col-5">
                                    <img id="showImage" style="width:100px;"
                                        src="{{ !empty($editData->image) ? url($editData->image) : url('upload/no_image.jpg') }}"
                                        class="rounded-circle avatar-xl img-thumbnail float-end" alt="image profile">
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12 d-flex align-items-end w-100 justify-content-end">
                                <a href="#" class="mb-3" id="addNewBtn">
                                    <button style="--clr: #39ff14" type="submit" class="button-styleee">
                                        <span>Update Question</span><i></i>
                                    </button>
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#image').change(function(e) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#showImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    })
})
</script>

@endsection
