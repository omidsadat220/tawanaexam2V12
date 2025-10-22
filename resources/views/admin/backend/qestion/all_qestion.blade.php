@extends('admin.admin_dashboard')
@section('admin')


    <div class="container-fluid pt-4 px-4">
        <div class="row vh-auto bg-secondary rounded align-items-center justify-content-center mx-0">
            <div class="col-12 text-center">
                <!-- Categories List Page -->
                 <div class="container-form" id="categories-page">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center justify-content-between mb-4">
                            <h3 class="m-0">All Question</h3>

                            <div class="d-flex align-items-center gap-2">
                                <form class="d-none d-md-flex">
                                    <input class="form-control bg-dark border-0 " type="search" placeholder="Search" />
                                </form>

                                <a href="{{ route('add.qestion') }}">
                                    <button style="--clr: #39ff14" class="button-styleee">
                                        <span>Add Catagory</span><i></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>

                 <div class="table-responsive">
                    <table class="paginated table table-bordered">
                        <thead>
                            <tr>
                                <th  scope="col" >ID</th>
                                <th  scope="col" >Subject name</th>
                                <th  scope="col" >qestion</th>
                                <th  scope="col" >option1</th>
                                <th  scope="col" >option2</th>
                                <th  scope="col" >option3</th>
                                <th  scope="col" >option4</th>
                                <th  scope="col" >correct_answer</th>
                                <th  scope="col" >User_id</th>
                                <th  scope="col" >image</th>
                                <th  scope="col"  class="action">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alldata as $key => $item)
                                <tr>
                                    <td  scope="row">{{ $key + 1 }}</td>
                                    <td>{{ $item->exam->exam_title ?? 'null'}}</td>
                                    <td>{{ $item->question }}</td>
                                    <td>{{ $item->option1 }}</td>
                                    <td>{{ $item->option2 }}</td>
                                    <td>{{ $item->option3 }}</td>
                                    <td>{{ $item->option4 }}</td>
                                    <td>{{ $item->correct_answer }}</td>
                                    <td>{{ $item->user_id}}</td>
                                    <td> <img src="{{ asset($item->image) }}"></td>

                                   
                                    <td>
                                        <a title="Edit" href="{{ route('edit.qestion', $item->id) }}"
                                            class="btn btn-success btn-sm"> <span
                                                class="mdi mdi-book-edit mdi-18px">edit</span>
                                        </a>

                                        <a title="Delete" href="{{ route('delete.qestion', $item->id) }}"
                                            class="btn btn-danger btn-sm" id="delete"><span
                                                class="mdi mdi-delete-circle  mdi-18px">delete</span></a>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                     </table>
                    <div id="pagination" class="mt-3 d-flex gap-2"></div>
                </div>


                <!-- Add New Category Page -->
                <div class="form-container container-form" id="add-category-page" style="display: none">
                    <a href="#" class="back-link d-block text-start" id="backBtn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" style="cursor: pointer">
                            <path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        Back to Categorie
                    </a>

                    <h2 class="text-white">Add New Category</h2>
                    <form id="categoryForm">
                        <div class="row">
                            <div class="col-12 d-flex align-items-center justify-content-between mb-3">
                                <label for="categoryName" class="text-start">Category Name</label>
                                <input class="catinput" type="text" id="categoryName" name="categoryName" required
                                    placeholder="Enter category name..." />
                            </div>

                            <div class="col-12 d-flex align-items-start justify-content-between mb-3">
                                <label for="categoryDesc" class="text-start">Description</label>
                                <textarea type="text" id="categoryDesc" name="categoryDesc" rows="4"
                                    placeholder="Enter category description..."></textarea>
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
