   <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
          <nav class="navbar bg-secondary navbar-dark">
            <a href="index.html" class="navbar-brand mx-4 mb-3">
              <h3 class="text-primary">
                <img src="{{asset('backend/assets/img/logo.png')}}" alt="logo" class="img-fluid logo" />
                <span id="typing"></span>
              </h3>
            </a>

            <div class="d-flex align-items-center ms-4 mb-4">
              <div class="position-relative">
                <img
                  class="rounded-circle"
                  src="{{asset('backend/assets/img/admin2.jpg')}}"
                  alt=""
                  style="width: 40px; height: 40px"
                />
                <div
                  class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"
                ></div>
              </div>


              @php
                $id = Auth::user()->id;
                $profileData = App\Models\User::find($id);
              @endphp


              <div class="ms-3">
                <h6 class="mb-0">{{$profileData->name}}</h6>
                
                <span>{{$profileData->name}}</span>
              </div>
            </div>
            <div class="navbar-nav w-100">
             <a href="{{route('teacher.dashboard')}}" class="nav-item nav-link"
                ><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a
              >
              {{-- <div class="nav-item dropdown">
                <a href="teachers.html" class="nav-item nav-link"
                  ><i class="fa fa-laptop me-2"></i>Teachers</a
                >
                <a href="students.html" class="nav-item nav-link"
                  ><i class="fa fa-laptop me-2"></i>Students</a
                >
                <a href="Catagory.html" class="nav-item nav-link"
                  ><i class="fa fa-laptop me-2"></i>Catagory</a
                >
                <a href="subCatagory.html" class="nav-item nav-link"
                  ><i class="fa fa-laptop me-2"></i>SubCatagory</a
                >
                <a href="questionanswer.html" class="nav-item nav-link"
                  ><i class="fa fa-laptop me-2"></i>Q/A</a
                >
                <a href="exam.html" class="nav-item nav-link"
                  ><i class="fa fa-laptop me-2"></i>Exam</a
                >
              </div> --}}

              
              <div class="nav-item dropdown">
                <a
                  href="#"
                  class="nav-link dropdown-toggle"
                  data-bs-toggle="dropdown"
                  ><i class="far fa-file-alt me-2"></i>student</a
                >
                <div class="dropdown-menu bg-transparent border-0">
                  <!-- <a href="teachers.html" class="dropdown-item">Teachers</a>
                            <a href="students.html" class="dropdown-item">Students</a> -->
                  <a href="{{route('manage.student')}}" class="dropdown-item">all student</a>
                </div>
              </div>

                <div class="nav-item dropdown">
                <a
                  href="#"
                  class="nav-link dropdown-toggle"
                  data-bs-toggle="dropdown"
                  ><i class="far fa-file-alt me-2"></i>Exam</a
                >
                <div class="dropdown-menu bg-transparent border-0">
                  <!-- <a href="teachers.html" class="dropdown-item">Teachers</a>
                            <a href="students.html" class="dropdown-item">Students</a> -->
                  <a href="{{route('all.teacher.exam')}}" class="dropdown-item">all Exam</a>
                </div>
              </div>

              <div class="nav-item dropdown">
                <a
                  href="#"
                  class="nav-link dropdown-toggle"
                  data-bs-toggle="dropdown"
                  ><i class="far fa-file-alt me-2"></i>Question</a
                >
                <div class="dropdown-menu bg-transparent border-0">
                  <!-- <a href="teachers.html" class="dropdown-item">Teachers</a>
                            <a href="students.html" class="dropdown-item">Students</a> -->
                  <a href="{{route('all.teacher.qestion')}}" class="dropdown-item">all Qestion</a>
                </div>
              </div>

                

              {{-- <div class="nav-item dropdown">
                <a
                  href="#"
                  class="nav-link dropdown-toggle"
                  data-bs-toggle="dropdown"
                  ><i class="far fa-file-alt me-2"></i>add exam</a
                >
                <div class="dropdown-menu bg-transparent border-0">
                  <!-- <a href="teachers.html" class="dropdown-item">Teachers</a>
                            <a href="students.html" class="dropdown-item">Students</a> -->
                  <a href="{{route('all.add.exam')}}" class="dropdown-item">Add Exam</a>
                </div>
              </div> --}}

            </div>
          </nav>
        </div>
        <!-- Sidebar End -->