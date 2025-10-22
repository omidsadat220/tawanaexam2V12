@extends('admin.admin_dashboard')
@section('admin')
    <div class="container-fluid pt-4 px-4">
        <div class="row vh-auto bg-secondary rounded align-items-center justify-content-center mx-0">
            <div class="col-12 text-center">
                <!-- Categories List Page -->

                <!-- Add New Category Page -->
                <div class="form-container container-form" id="add-category-page" style="display: block;">
                    <a href="{{ route('all.category') }}" class="back-link d-block text-start" id="backBtn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" style="cursor: pointer">
                            <path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                        Back to Categorie
                    </a>

                    <h2 class="text-white">Add New Category</h2>
                    <form id="categoryForm" action="{{ route('update.class.category') }}" method="POST">


                        @csrf

                        <input type="hidden" name="id" value="{{ $classcateogry->id }}">

                        <div class="row">
                            <div class="col-12 d-flex align-items-center justify-content-between mb-3">
                                <label for="categoryName" class="text-start">class_category </label>
                                <input class="catinput" type="text" name="class_category"
                                    value="{{ $classcateogry->class_category }}">
                            </div>




                            <div class="col-12 d-flex align-items-end w-100 justify-content-end">
                                <a href="#" class="mb-3" id="addNewBtn">
                                    <button style="--clr: #39ff14" type="submit" class="button-styleee">
                                        <span>Save Category</span><i></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
