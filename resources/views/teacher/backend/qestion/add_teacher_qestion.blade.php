@extends('teacher.teacher_dashboard')
@section('teacher')
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
   
<div class="container-fluid pt-4 px-4">
        <div class="row bg-secondary">
            <div class="col-12 text-center">
                <div class="form-container container-form" id="add-category-page" style="display: block;">
                    <div class="d-flex flex-row justify-content-around">
                        <h3 class="text-white">Add Teacher Question</h3>
                        <a href="{{ route('all.teacher.qestion') }}" class="back-link d-block text-start" id="backBtn">
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

                   <form id="categoryForm" action="{{ route('store.teacher.qestion') }}" method="POST" enctype="multipart/form-data">


                        @csrf


                            <div class="row mb-3 pt-3 align-items-center">
                                <label class="col-2 col-form-label">Subject</label>
                                <div class="col-10">
                                    <select name="exam_id" class="form-select" id="subject-dropdown">
                                        <option value="">Select exam</option>
                                        @foreach ($exams as $exam)
                                            <option value="{{ $exam->id }}">{{ $exam->exam_title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                                    
                            <div class="row mb-3 pt-3 align-items-center">
                                <label for="question" class="col-2 col-form-label text-start"> what is Question? </label>
                                <div class="col-10">
                                    <input class="catinput form-control" type="text" id="question" name="question"
                                    placeholder="Enter question name...">
                                </div>
                            </div>

                             <div class="row mb-3 pt-3 align-items-center">
                                <label for="option1" class="col-2 text-start  col-form-label">option1</label>
                                <div class="col-10">
                                    <input class="catinput col-10 form-control" type="text" id="option1" name="option1"
                                    placeholder="Enter option1 name...">
                                </div>    
                            </div>

                             <div class="row mb-3 pt-3 align-items-center">
                                <label for="option2" class="col-2 text-start col-form-label">option2</label>
                                <div class="col-10">
                                    <input class="catinput col-10 form-control" type="text" id="option2" name="option2"
                                    placeholder="Enter option2 name...">
                                </div>    
                            </div>

                             <div class="row mb-3 pt-3 align-items-center">
                                <label for="option3" class="col-2 text-start col-form-label">option3</label>
                                <div class="col-10">
                                    <input class="catinput col-10 form-control" type="text" id="option3" name="option3"
                                    placeholder="Enter option3 name...">
                                </div>    
                            </div>

                              <div class="row mb-3 pt-3 align-items-center">
                                <label for="option4" class="col-2 text-start col-form-label">option4</label>
                                <div class="col-10">
                                    <input class="catinput col-10 form-control" type="text" id="option4" name="option4"
                                    placeholder="Enter option4 name...">
                                </div>    
                            </div>

                            <div class="row mb-3 pt-3 align-items-center">
                                <label for="correct_answer" class="text-start col-2  col-form-label">correct_answer</label>
                                <div class="col-10">
                                    <input class="catinput col-10 form-control" type="text" id="correct_answer" name="correct_answer"
                                    placeholder="Enter correct_answer name...">
                                </div>    
                            </div>

                            <div class="row mb-3 pt-3 align-items-center">
                                <label for="validationDefault02" class="form-label col-2  col-form-label">qestion Image</label>
                                <div class="col-5">
                                    <input type="file" class="form-control" name="image" id="image">
                                </div>
                                <div class="col-5">
                                    <img id="showImage" style="width:100px;" src="{{ url('upload/no_image.jpg') }}"
                                        class="rounded-circle avatar-xl img-thumbnail float-end" alt="image profile">
                                </div>
                            </div>  

                            <div class="col-12 d-flex align-items-end w-100 justify-content-end">
                                <a href="#" class="mb-3" id="addNewBtn">
                                    <button style="--clr: #39ff14" type="submit" class="button-styleee">
                                        <span>Save Qestion</span><i></i>
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