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
              
              <a href="{{ route('admin.dashboard') }}" 
              class="nav-item nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
              <i class="fa fa-tachometer-alt me-2"></i>Dashboard</a
              >

               <a href="{{route('all.category')}}" 
              class="nav-item nav-link {{ request()->routeIs('all.category') ? 'active' : '' }}">
              <i class="fa fa-tachometer-alt me-2"></i>ّFinall Catagory</a
              >

               <a href="{{route('all.answer')}}" 
              class="nav-item nav-link {{ request()->routeIs('all.answer') ? 'active' : '' }}">
              <i class="fa fa-tachometer-alt me-2"></i>ّFinall Quastion</a
              >

              <a href="{{route('all.depart')}}" 
              class="nav-item nav-link {{ request()->routeIs('all.depart') ? 'active' : '' }}">
              <i class="fa fa-tachometer-alt me-2"></i>All Department</a
              >

              <a href="{{route('all.exam')}}" 
              class="nav-item nav-link {{ request()->routeIs('all.exam') ? 'active' : '' }}">
              <i class="fa fa-tachometer-alt me-2"></i>All Exam</a
              >

              <a href="{{route('all.set.exam')}}" 
              class="nav-item nav-link {{ request()->routeIs('all.set.exam') ? 'active' : '' }}">
              <i class="fa fa-tachometer-alt me-2"></i>Set Exam</a
              >

              <a href="{{route('all.new.question')}}" 
              class="nav-item nav-link {{ request()->routeIs('all.new.question') ? 'active' : '' }}">
              <i class="fa fa-tachometer-alt me-2"></i>New Quation</a
              >

              <a href="{{route('all.set.students')}}" 
              class="nav-item nav-link {{ request()->routeIs('all.set.students') ? 'active' : '' }}">
              <i class="fa fa-tachometer-alt me-2"></i>Set Teacher</a
              >

                </div>
                
            </div>
          </nav>
        </div>
        <!-- Sidebar End -->