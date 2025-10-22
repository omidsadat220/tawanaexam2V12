@extends('admin.admin_dashboard')
@section('admin')
    <div class="container-fluid pt-4 px-4">
        <div class="row bg-secondary">
            <div class="col-12 text-center">

                 <div class="form-container container-form" id="add-category-page" style="display: block;">
                    <!-- Back Button -->
                    <div class="d-flex flex-row justify-content-around">
                        <h3 class="text-white mb-0">Edit Question</h3>
                        <a href="{{ route('all.answer') }}" class="back-link text-decoration-none text-light" id="backBtn">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" style="cursor:pointer">
                                <path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            Back to Questions
                        </a>
                    </div>

                    <div class="col-12 col-lg-8 mx-auto">
                        <div class="bg-secondary rounded p-4">
                            <form id="categoryForm" action="{{ route('update.answer', $answer->id) }}" method="POST">
                                @csrf

                                <input type="hidden" name="ans_id" value="{{ $answer->id }}">

                                {{-- Category --}}
                                <div class="row mb-3 align-items-center">
                                    <label for="category_id" class="col-sm-2 col-form-label text-white">Category
                                        Name</label>
                                    <div class="col-sm-10">
                                        <select name="category_id" id="category_id" class="form-select">
                                            <option value="">Select Category</option>
                                            @foreach ($category as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $answer->category_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->uni_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- Question --}}
                                <div class="row mb-3 align-items-center">
                                    <label for="question" class="col-sm-2 col-form-label text-white">Question</label>
                                    <div class="col-sm-10">
                                        <input class="form-control catinput" type="text" id="question" name="question"
                                            value="{{ old('question', $answer->question) }}"
                                            placeholder="Enter question...">
                                    </div>
                                </div>

                                {{-- Answer One --}}
                                <div class="row mb-3 align-items-center">
                                    <label for="question_one" class="col-sm-2 col-form-label text-white">Answer One</label>
                                    <div class="col-sm-10">
                                        <input class="form-control catinput" type="text" id="question_one"
                                            name="question_one" value="{{ old('question_one', $answer->question_one) }}"
                                            placeholder="Enter answer one...">
                                    </div>
                                </div>

                                {{-- Answer Two --}}
                                <div class="row mb-3 align-items-center">
                                    <label for="question_two" class="col-sm-2 col-form-label text-white">Answer Two</label>
                                    <div class="col-sm-10">
                                        <input class="form-control catinput" type="text" id="question_two"
                                            name="question_two" value="{{ old('question_two', $answer->question_two) }}"
                                            placeholder="Enter answer two...">
                                    </div>
                                </div>

                                {{-- Answer Three --}}
                                <div class="row mb-3 align-items-center">
                                    <label for="question_three" class="col-sm-2 col-form-label text-white">Answer
                                        Three</label>
                                    <div class="col-sm-10">
                                        <input class="form-control catinput" type="text" id="question_three"
                                            name="question_three"
                                            value="{{ old('question_three', $answer->question_three) }}"
                                            placeholder="Enter answer three...">
                                    </div>
                                </div>

                                {{-- Answer Four --}}
                                <div class="row mb-3 align-items-center">
                                    <label for="question_four" class="col-sm-2 col-form-label text-white">Answer
                                        Four</label>
                                    <div class="col-sm-10">
                                        <input class="form-control catinput" type="text" id="question_four"
                                            name="question_four" value="{{ old('question_four', $answer->question_four) }}"
                                            placeholder="Enter answer four...">
                                    </div>
                                </div>

                                {{-- Correct Answer --}}
                                <div class="row mb-4 align-items-center">
                                    <label for="correct_answer" class="col-sm-2 col-form-label text-white">Correct
                                        Answer</label>
                                    <div class="col-sm-10">
                                        <input class="form-control catinput" type="text" id="correct_answer"
                                            name="correct_answer"
                                            value="{{ old('correct_answer', $answer->correct_answer) }}"
                                            placeholder="Enter correct answer...">
                                    </div>
                                </div>

                                {{-- Submit --}}
                                <div class="row">
                                    <div class="col-12 text-end">
                                        <button type="submit" class="button-styleee" style="--clr:#39ff14">
                                            <span>Update Question</span>
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div> {{-- bg --}}
                </div> {{-- form-container --}}
            </div> {{-- col --}}
        </div> {{-- row --}}
    </div> {{-- container-fluid --}}
@endsection
