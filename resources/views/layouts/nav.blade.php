<nav class="p-3 bg-dark text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          @if (session()->has('admin'))
            <li><a href="{{URL::to('/equipment')}}" class="nav-link px-2 text-secondary {{ request()->is('equipment') ? 'text-white' : '' }}">Request list</a></li>
            <li><a href="#" class="nav-link px-2 text-secondary {{ request()->is('all_request/detail/*') ? 'text-white' : '' }}">Request detail</a></li>
            <li><a href="{{URL::to('/items')}}" class="nav-link px-2 text-secondary {{ request()->is('items') ? 'text-white' : '' }}">Equipment list</a></li>
            <li><a href="{{URL::to('/equipment/create')}}" class="nav-link px-2 text-secondary {{ request()->is('equipment/create') ? 'text-white' : '' }}">Create equipment</a></li>
            <li><a href="#" class="nav-link px-2 text-secondary {{ request()->is('equipment/edit/*') ? 'text-white' : '' }}">Edit equipment</a></li>
          @endif

          <li><a href="{{URL::to('/from_request')}}" class="nav-link px-2 text-secondary {{ request()->is('from_request') ? 'text-white' : '' }}">From request</a></li>

          @if (session()->has('user'))
            <li><a href="{{URL::to('/my_request/detail/id=' . session('user_id'))}}" class="nav-link px-2 text-secondary {{ request()->is('my_request/detail/*') ? 'text-white' : '' }}">My request</a></li>
          @endif
        </ul>

        {{-- <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
        </form> --}}

        <div class="text-end">
          @if (session()->has('admin'))
              <button type="button" class="btn btn-sm btn-outline-light me-2">{{ session('admin') }}</button>
          @elseif (session()->has('user'))
              <button type="button" class="btn btn-sm btn-outline-light me-2">{{ session('user') }}</button>
          @endif
          <a href="{{ URL::to('/logout') }}" id="logout" class="btn btn-sm btn-warning">Logout</a>
      </div>
      
      </div>
    </div>
  </nav>