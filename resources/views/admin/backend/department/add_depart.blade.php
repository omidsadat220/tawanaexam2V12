@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    <div class="container-fluid pt-4 px-4">
        <div class="row bg-secondary">
            <div class="col-12 text-center">
                <div class="form-container container-form" id="add-category-page" style="display: block;">
                    <div class="d-flex flex-row justify-content-around">
                    <h3 class="text-white">Add Department & Subjects</h3>
                    <a href="{{ route('all.depart') }}" class="back-link d-block text-start">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg" style="cursor: pointer">
                            <path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                        </svg>
                        Back to Departments
                    </a>
                </div>

                <div class="col-12 col-lg-8 mx-auto">
                    <div class="bg-secondary rounded h-100 p-4">
                        <form action="{{ route('store.depart') }}" method="POST">
                            @csrf

                            <!-- Department Name -->
                            <div class="row mb-3">
                                <label for="depart_name" class="col-3 col-form-label">Department Name</label>
                                <div class="col-9">
                                    <input type="text" name="depart_name" class="form-control catinput"
                                           placeholder="Department name" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-3 col-form-label">Department Subjects</label>
                                <div class="col-9">
                                    <div class="d-flex justify-content-end mb-2">
                                        <button type="button" class="btn btn-outline-primary btn-sm" id="add-subject">
                                            + Add Subject
                                        </button>
                                    </div>
                                
                           

                                    <div id="subject-container">
                                        <div class="input-group mb-2">
                                            <div class="col-12">
                                                <input type="text" name="depart_subjects[]" class="form-control catinput"
                                                    placeholder="Department subject" required>
                                                    <button type="button" class="btn btn-danger position-absolute  remove-subject" style="top:-1px; right:0;">Remove</button>
                                        
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Save Button -->
                            <div class="row">
                                <div class="col-12 text-end">
                                    <button style="--clr: #39ff14" type="submit" class="button-styleee">
                                        <span>Save Department</span><i></i>
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

    </div>
</div>

<script>
    $('#add-subject').on('click', function() {
        $('#subject-container').append(`
            <div class="input-group mb-2">
                <input type="text" name="depart_subjects[]" class="form-control catinput" placeholder="Department subject" required>
                <button type="button" class="btn btn-danger remove-subject">Remove</button>
            </div>
        `);
    });

    $(document).on('click', '.remove-subject', function() {
        $(this).closest('.input-group').remove();
    });
</script>
@endsection
