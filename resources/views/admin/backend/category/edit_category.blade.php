@extends('admin.admin_dashboard')
@section('admin')
    <div class="container-fluid pt-4 px-4">
        <div class="row bg-secondary">
            <div class="col-12 text-center">

                <div class="form-container container-form" id="add-category-page" style="display: block;">
                    <!-- Back Button -->
                    <div class="d-flex flex-row justify-content-around">
                        <h4 class="text-white">Edit Category</h4>
                        <a href="{{ route('all.category') }}" class="back-link d-block text-start" id="backBtn">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" style="cursor: pointer">
                                <path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                            Back to Categories
                        </a>
                    </div>

                    <!-- Form Card -->
                    <div class="col-12 col-lg-8 mx-auto">
                        <div class="bg-secondary rounded h-100 p-4">
                            <form id="categoryForm" action="{{ route('update.category', $category->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="cat_id" value="{{ $category->id }}">

                                <div class="row mb-4">
                                    <label for="uni_name" class="col-sm-2 col-form-label fw-semibold">University
                                        Name</label>
                                    <div class="col-sm-10 col-lg-4 mb-3 mb-lg-0">
                                        <input class="form-control catinput " type="text" id="uni_name" name="uni_name"
                                            value="{{ $category->uni_name }}" placeholder="Enter university name..."
                                            required>
                                    </div>

                                    <label for="code" class="col-sm-2 col-form-label fw-semibold">Code</label>
                                    <div class="col-sm-10 col-lg-4">
                                        <input class="form-control catinput" type="text" id="code" name="code"
                                            value="{{ $category->code }}" placeholder="Enter category code..." required>
                                    </div>
                                </div>

                                <div class="row align-items-center mb-4">
                                    <label class="col-sm-2 col-form-label fw-semibold" for="active">Active</label>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input class="form-check-input catinput" type="checkbox" id="active"
                                                name="active" value="1" {{ $category->active ? 'checked' : '' }}>
                                            <label class="form-check-label" for="active">Yes</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button style="--clr: #39ff14" type="submit" class="button-styleee px-4 py-2">
                                        <span>Update Category</span><i></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
