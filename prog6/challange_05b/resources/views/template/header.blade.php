<nav class="navbar navbar-expand-lg static-top">
  <div class="container">
      <div class="col-sm-7">
          <h1>
              <a href="{{route('indexPage')}}" style="text-decoration: none;">Management System</a>
          </h1>
      </div>
      <div class="navbar-collapse col-sm-6">
          <div class="navbar-nav ml-auto">
              <a class="nav-item btn btn-danger" href="{{route('profile')}}" style="margin-right: 7px;">
                  Profile
              </a>
              <a class="nav-item btn btn-danger" href="{{route('logout')}}">
                  Logout
              </a>
          </div>
      </div>
  </div>
</nav>