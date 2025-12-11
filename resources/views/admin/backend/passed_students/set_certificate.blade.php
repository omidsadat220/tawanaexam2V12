@extends('admin.admin_dashboard')
@section('admin')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

    <div class="container-fluid pt-2 px-4">
        <div class="row bg-secondary">
            <div class="col-12">
                <div class="form-container container-form" style="height: auto">
                    <div class="d-flex flex-row justify-content-around">
                        <h3 class="text-white">Add Student Exam</h3>
                        <a href="{{ route('all.passed.students') }}" class="back-link d-block text-start" id="backBtn">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" style="cursor: pointer">
                                <path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                            Back to Passed Students
                        </a>
                    </div>

                    @php
                        $certificate = $result->certificate;
                    @endphp

                    <form action="{{ $certificate ? route('update.certificate', $result->id) : route('store.certificate', $result->id) }}" 
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container text-start p-4 bg-secondary rounded ">
                        
                            <div class="row mb-3 pt-3 align-items-center">
                                <div class="col-md-6">
                                    <div class="row">
                                        <label class="col-3 col-form-label" for="department-dropdown">First Name</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" name="name" value="{{ $certificate->first_name ?? $result->user->name }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row">
                                        <label class="col-3 col-form-label">Last Name</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" name="lastname" value="{{ $certificate->lastname ?? '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mt-4">
                                    <div class="row">
                                        <label class="col-3 col-form-label">Date</label>
                                        <div class="col-9">
                                            <input type="date" name="date" class="form-control" value="{{ $certificate->date ?? '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mt-4">
                                    <div class="row">
                                        <label class="col-3 col-form-label">Upload</label>
                                        <div class="col-9">
                                            <input type="file" class="form-control" id="pdf" name="pdf" accept="application/pdf" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mt-4">
                                    <div class="row">
                                        <label class="col-3 col-form-label">Description</label>
                                        <div class="col-9">
                                            <textarea name="description" class="form-control">{{ $certificate->description ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 text-end">
                                    <button style="--clr: #39ff14" type="submit" class="button-styleee">
                                        <span>Save</span><i></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                </div>
                </form>
            </div>
        </div>
            <div class="row bg-secondary my-2 py-5">
                <div class="col-12 py-5">
                    @if($certificate)
                        <table class="table table-bordered text-white mt-4">
                            <thead>
                                <tr>
                                    <th>First</th>
                                    <th>Last</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>PDF</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $certificate->name }}</td>
                                    <td>{{ $certificate->name }}</td>
                                    <td>{{ $certificate->date }}</td>
                                    <td>{{ $certificate->description }}</td>
                                    <td><a href="{{ asset('uploads/certificates/'.$certificate->pdf) }}" target="_blank">View PDF</a></td>
                                     <td>
                                        <a title="Delete" href="{{ route('delete.certificate', $certificate->id) }}"
                                            class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this certificate?')">
                                            <span class="mdi mdi-delete-circle mdi-18px">Delete</span>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
    </div>

@endsection
