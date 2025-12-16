@extends('admin.admin_dashboard')
@section('admin')
<div class="container-fluid pt-4 px-4">
        <div class="row bg-secondary ">
            <div class="col-12 text-center">


                <div class="container-form" id="categories-page">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center justify-content-between mb-4">
                            <h3 class="m-0">View Student Info</h3>

                            <div class="d-flex align-items-center gap-2">
                                <form class="d-none d-md-flex">
                                    <input class="form-control bg-dark border-0 " type="search" placeholder="Search" />
                                </form>

                            </div>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="paginated table table-bordered" id="datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">name</th>
                                    <th scope="col">email</th>
                                    <th scope="col">Genrate Voucher</th>
                                    <th scope="col">Show Voucher</th>

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        {{-- <td scope="row">{{ $user->id }}</td> --}}
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>

                                     <td>
                                            <form action="{{ route('generate.voucher') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">

                                                <select name="category_id" class="form-control mb-2" required>
                                                    <option value="">Select Category</option>
                                                    @foreach ($category as $cat)
                                                        <option value="{{ $cat->id }}">{{ $cat->uni_name }}</option>
                                                    @endforeach
                                                </select>

                                                <button class="btn btn-sm btn-primary">Generate Voucher</button>
                                            </form>
                                        </td>
                                        <td><a href="{{ route('show.voucher', $user->id) }}">Show Voucher</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div id="pagination" class="mt-3 d-flex gap-2"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection