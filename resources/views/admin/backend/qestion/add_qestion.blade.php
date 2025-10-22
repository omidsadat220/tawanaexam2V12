@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <div class="container-fluid pt-4 px-4">
        <div class="row vh-auto bg-secondary rounded align-items-center justify-content-center mx-0">
            <div class="col-12 text-center">


                <div class="form-container container-form" id="add-category-page" style="display: block;">
                    <div class="d-flex flex-row justify-content-around">
                        <h3 class="text-white">Add New Question</h3>
                        <a href="{{ route('all.qestion') }}" class="back-link d-block text-start" id="backBtn">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" style="cursor: pointer">
                                <path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                            Back to Categories
                        </a>
                    </div>

                    <div class="col-12 col-lg-8 mx-auto">
                        <div class="bg-secondary rounded h-100 p-4">
                            <form action="{{ route('store.qestion') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row g-3">

                                    <div class="row mb-3 pt-3 align-items-center">
                                        <label for="category_id" class="col-2 col-form-label text-white">Select
                                            Exam</label>
                                        <div class="col-10">
                                            <select name="exam_id" id="exam-dropdown" class="form-select" required>
                                                <option value="">Select Exam</option>
                                                @foreach ($exams as $exam)
                                                    <option value="{{ $exam->id }}">{{ $exam->exam_title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Question Text -->

                                    <div class="row mb-3 align-items-center">
                                        <label for="question" class="col-2 col-form-label text-white">Question</label>
                                        <div class="col-10">
                                            <input class="form-control catinput" type="text" id="question"
                                                name="question" placeholder="Enter question...">
                                        </div>
                                    </div>

                                    <!-- Options -->
                                    @for ($i = 1; $i <= 4; $i++)
                                        <div class="row mb-3 align-items-center">
                                            <label class="col-2 col-form-label text-white">Option
                                                {{ $i }}</label>
                                            <div class="col-10">
                                                <input type="text" name="option{{ $i }}"
                                                    class="form-control catinput"
                                                    placeholder="Enter option {{ $i }}..." required>
                                            </div>
                                        </div>
                                    @endfor

                                    <!-- Correct Answer -->
                                    <div class="row mb-3 align-items-center">
                                        <label class="col-2 col-form-label text-white">Correct Answer</label>
                                        <div class="col-10">
                                            <input type="text" name="correct_answer" class="form-control"
                                                placeholder="Enter correct answer..." required>
                                        </div>
                                    </div>




                                    <!-- Question Image -->
                                    <div class="row mb-3 align-items-center">
                                        <label class="col-form-label col-2 text-white">Question Image</label>
                                        <div class="col-8">
                                            <input type="file" name="image" id="image" class="form-control">

                                        </div>
                                        <img id="showImage" src="{{ url('upload/no_image.jpg') }}" class="rounded mt-2"
                                            style="width:100px;" alt="Preview">
                                    </div>




                                    <div class="row">
                                        <div class="col-12 text-end">
                                            <button style="--clr: #39ff14" type="submit" class="button-styleee">
                                                <span>Save Question</span><i></i>
                                            </button>
                                        </div>
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
                $('#exam-dropdown').select2({
                    width: '100%'
                });

                // Preview selected image
                $('#image').change(function(e) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#showImage').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                });
            });
        </script>
    @endsection
