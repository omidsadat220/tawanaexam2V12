@extends('admin.admin_dashboard')
@section('admin')


    <div class="container-fluid pt-4 px-4">
        <div class="row vh-auto bg-secondary rounded align-items-center justify-content-center mx-0">
            <div class="col-12 text-center">
                <!-- Categories List Page -->

                <!-- Add New Category Page -->
                <div class="form-container container-form" id="add-category-page" style="display: block;">
                    <a href="{{ route('all.answer') }}" class="back-link d-block text-start" id="backBtn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" style="cursor: pointer">
                            <path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                        Back to Categorie
                    </a>

                    <h2 class="text-white">Add New Category</h2>
                    <form id="categoryForm" action="{{ route('update.subject', $editData->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $editData->id }}">

                        <div class="row mb-3">

                            <!-- Category selector -->
                            <div class="col-md-6 d-flex flex-column">
                                <label for="class_category_id" class="form-label">Category Name</label>
                                <select name="class_category_id" id="class_category_id" class="form-control form-select"
                                    required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $editData->class_category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->class_category }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                            <!-- Subjects input -->
                            <div class="col-md-6">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label mb-0">Department Subjects</label>
                                    <button type="button" class="btn btn-outline-primary btn-sm" id="add-subject">
                                        + Add Subject
                                    </button>
                                </div>

                                <div id="subject-container">
                                    @php
                                        $subjects = json_decode($editData->subject_name);
                                    @endphp
                                    @if (!empty($subjects))
                                        @foreach ($subjects as $subject)
                                            <div class="input-group mb-2">
                                                <input class="form-control" name="subject_name[]" type="text"
                                                    value="{{ $subject }}" placeholder="Department subject" required>
                                                <button type="button" class="btn btn-danger remove-subject">Remove</button>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="input-group mb-2">
                                            <input class="form-control" name="subject_name[]" type="text"
                                                placeholder="Department subject" required>
                                            <button type="button" class="btn btn-danger remove-subject">Remove</button>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">Update Category</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- JS for dynamic add/remove -->
    <script>
        $('#add-subject').on('click', function() {
            $('#subject-container').append(`
        <div class="input-group mb-2">
            <input type="text" name="subject_name[]" class="form-control" placeholder="Department subject" required>
            <button type="button" class="btn btn-danger remove-subject">Remove</button>
        </div>
    `);
        });

        $(document).on('click', '.remove-subject', function() {
            $(this).closest('.input-group').remove();
        });
    </script>







@endsection
