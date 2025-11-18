@extends('teacher.teacher_dashboard')
@section('teacher')

<div class="container-fluid pt-4 px-4">
        <div class="row bg-secondary ">
            <div class="col-12 text-center">

                <!-- Categories List Page -->
                <div class="container-form" id="categories-page">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center justify-content-between mb-4">
                            {{-- <h3 class="m-0">New Questions</h3> --}}

                            <div class="d-flex align-items-center gap-2">
                                <form class="d-none d-md-flex">
                                    <input class="form-control bg-dark border-0 " type="search" placeholder="Search" />
                                </form>

                                {{-- <a href="{{ route('add.new.qestion') }}">
                                    <button style="--clr: #39ff14" class="button-styleee">
                                        <span>Create Exam</span><i></i>
                                    </button>
                                </a> --}}
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                        <table class="paginated table table-bordered" id="datatable">
                          <thead>
                        <tr>
                            <th>#</th>
                            <th>Students</th>
                            <th>Department</th>
                            <th>Subject</th>
                            <th>Correct Answers</th>
                            <th>Wrong Answers</th>
                            <th>Score</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $i = 1; @endphp

                        @foreach ($results as $item)
                            <tr>
                                <td style="text-align: center;">{{ $i++ }}</td>

                                {{-- Student --}}
                                <td style="text-align: center;">{{ $item['user']->name ?? 'N/A' }}</td>

                                {{-- Department --}}
                                <td style="text-align: center;">{{ $item['department']->depart_name ?? 'N/A' }}</td>

                                {{-- Subject --}}
                                <td style="text-align: center;">{{ $item['subject']->subject_name ?? 'N/A' }}</td>

                                {{-- Correct --}}
                                <td style="text-align: center;">{{ $item['correct'] }}</td>

                                {{-- Wrong --}}
                                <td style="text-align: center;">{{ $item['wrong'] }}</td>

                                {{-- Score --}}
                                <td style="text-align: center;">{{ $item['score'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                        </table>
                        <div id="pagination" class="mt-3 d-flex gap-2"></div>
                    </div>
                </div>
            </div>
    </div>

@endsection
