@extends('admin.admin_dashboard')
@section('admin')
    <div class="container-fluid pt-4 px-4">
        <div class="row bg-secondary">
            <div class="col-12 text-center">
                {{-- <div class="form-container container-form" id="add-category-page" style="display: block;">
                    <div class="d-flex flex-row justify-content-around">
                        <h3 class="text-white">Set Teacher</h3>
                        <a href="{{ route('manage.student') }}" class="back-link d-block text-start" id="backBtn">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" style="cursor: pointer">
                                <path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                            Back to Categories
                        </a>
                    </div>
                    <form action="{{ route('store.set.class') }}" method="POST">
                        @csrf
                        <div class="container text-start p-4 bg-secondary rounded">

                            <div class="row mb-3 pt-3 align-items-center">
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-3 col-form-label">Student</label>
                                        <div class="col-9">
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <input type="text" class="form-control" value="{{ $user->name }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>

                                
                            </div>

                            <div class="col-6">
                                    <div class="row">
                                        <label class="col-3 col-form-label">Select Role</label>
                                        <div class="col-9">
                                            <select class="form-select" name="subject_id" required>
                                                <option value="">Select Subject</option>
                                                <option value="teacher">Teacher</option>
                                                <option value="user">User</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            <div class="row">
                                <div class="col-12 text-end">
                                    <button style="--clr: #39ff14" type="submit" class="button-styleee">
                                        <span>Submit</span><i></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>

                </div> --}}

                <div class="form-container container-form" id="edit-category-page" style="display: block;">
                    <div class="d-flex flex-row justify-content-around">
                        <h3 class="text-white">Set Teacher</h3>
                        <a href="{{ route('all.set.students') }}" class="back-link d-block text-start" id="backBtn">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" style="cursor: pointer">
                                <path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                            Back to Categories
                        </a>
                    </div>

                    <form action="{{ route('update.set.teacher') }}" method="POST">
                        @csrf
                        <div class="container text-start p-4 bg-secondary rounded">
                            <div class="row mb-3 pt-3 align-items-center">
                    
                                {{-- Student ID --}}
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-3 col-form-label">Student</label>
                                        <div class="col-9">
                                            <input type="hidden" name="id" value="{{ $user->id }}"> {{-- باید "id" باشد همانطور که کنترلر انتظار دارد --}}
                                            <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                                        </div>
                                    </div>
                                </div>
                    
                                {{-- Role Select --}}
                                <div class="col-6">
                                    <div class="row">
                                        <label class="col-3 col-form-label">Select Role</label>
                                        <div class="col-9">
                                            <select class="form-select" name="role" required>
                                                <option value="">Select Role</option>
                                                <option value="teacher" @if($user->role=='teacher') selected @endif>Teacher</option>
                                                <option value="user" @if($user->role=='user') selected @endif>User</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                    
                            </div>
                    
                            {{-- Submit --}}
                            <div class="row">
                                <div class="col-12 text-end">
                                    <button type="submit" class="button-styleee">
                                        <span>Submit</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    {{-- <script>
        let addCategoryPage = document.getElementById('add-category-page');
        let editCategoryPage = document.getElementById('edit-category-page');

        // ✅ Logic: show Set form if student has no class, otherwise show Edit form
        @if (empty($student->department_id))
            addCategoryPage.style.display = 'block';
            editCategoryPage.style.display = 'none';
        @else
            addCategoryPage.style.display = 'none';
            editCategoryPage.style.display = 'block';
        @endif
    </script> --}}
@endsection
