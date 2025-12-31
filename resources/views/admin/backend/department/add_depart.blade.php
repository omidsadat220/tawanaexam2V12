@extends('admin.admin_dashboard')

@section('admin')

{{-- jQuery --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="container-fluid pt-4 px-4 ">
    <div class="row bg-secondary rounded p-4"  style="height:100vh">
        <div class="col-12">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="text-white mb-0">Add Department & Subjects</h3>

                <a href="{{ route('all.depart') }}" class="text-success d-flex align-items-center">
                    <svg width="24" height="24" fill="none">
                        <path d="M15 6L9 12L15 18"
                              stroke="currentColor"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                    Back to Departments
                </a>
            </div>

            {{-- Form Card --}}
            <div class="bg-secondary rounded p-4">
                <form action="{{ route('store.depart') }}" method="POST">
                    @csrf

                    <div class="row">

                        <!-- Department Name -->
                        <div class="col-12 col-lg-6 mb-3">
                            <label class="form-label text-white">Department Name</label>
                            <input
                                type="text"
                                name="depart_name"
                                class="form-control catinput"
                                placeholder="Department name"
                                required
                            >
                        </div>

                        <!-- Department Subjects -->
                        <div class="col-12 col-lg-6 mb-3">
                            <label class="form-label text-white">Department Subjects</label>

                            
                            <div id="subject-container">
                                <div class="input-group mb-2">
                                    <input
                                        type="text"
                                        name="depart_subjects[]"
                                        class="form-control catinput"
                                        placeholder="Department subject"
                                        required
                                    >
                                    <button
                                        type="button"
                                        class="btn btn-danger remove-subject">
                                        Remove
                                    </button>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mb-2">
                                <button
                                    type="button"
                                    class="btn btn-outline-primary btn-sm"
                                    id="add-subject">
                                    + Add Subject
                                </button>
                            </div>

                        </div>

                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

{{-- Scripts --}}
<script>
    $('#add-subject').on('click', function () {
        $('#subject-container').append(`
            <div class="input-group mb-2">
                <input type="text"
                       name="depart_subjects[]"
                       class="form-control catinput"
                       placeholder="Department subject"
                       required>
                <button type="button"
                        class="btn btn-danger remove-subject">
                    Remove
                </button>
            </div>
        `);
    });

    $(document).on('click', '.remove-subject', function () {
        $(this).closest('.input-group').remove();
    });
</script>

@endsection
