@extends('admin.admin_dashboard')
@section('admin')
    <div class="container-fluid pt-4 px-4">
        <div class="row bg-secondary">
            <div class="col-12 text-center">

                <div class="form-container container-form" id="add-category-page" style="display: block;">
                    <div class="d-flex flex-row justify-content-around">
                        <h3 class="text-white">Add New Category</h3>
                        <a href="{{ route('all.category') }}" class="back-link d-block text-start" id="backBtn">
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
                            <form id="categoryForm" action="{{ route('store.category') }}" method="POST">
                                @csrf
                                <div class="row mb-3 pt-5">
                                    <label for="uni_name" class="col-sm-2 col-form-label">Category Name</label>
                                    <div class="col-sm-10 col-lg-4">
                                        <input class="form-control catinput" type="text" id="uni_name" name="uni_name"
                                            placeholder="Enter category name...">
                                    </div>

                                    <label for="code" class="col-sm-2 col-form-label">Code</label>
                                    <div class="col-sm-10 col-lg-4">
                                        <input class="form-control catinput" type="text" id="code" name="code"
                                            placeholder="Enter category code...">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Active</legend>
                                    <div class="col-4">
                                        <div class="form-check">
                                            <input class="form-check-input catinput" type="checkbox" id="active"
                                                name="active" value="1">
                                            <label class="form-check-label" for="active">Yes</label>
                                        </div>
                                    </div>

                                    <div class="col-4 text-end">
                                        <button style="--clr: #39ff14" type="submit" class="button-styleee">
                                            <span>Save Category</span><i></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
