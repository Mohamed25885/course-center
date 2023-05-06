<!DOCTYPE html>
<html>
<head>
  <title>Course Center</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

</head>
<body>

  <!-- Navigation bar -->

  <nav class="navbar navbar-expand-lg navbar-light bg-light mx-3 mb-3">
    <a class="navbar-brand" href="#">Course Center</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="#">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Courses</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Instructors</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Students</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Settings</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">

        @if (Route::has('login'))
            <li class="nav-item">
                @auth
                    <a href="{{ url('/home') }}" class="btn btn-primary">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Log in <i class="fa-solid fa-arrow-right-to-bracket"></i></a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary">Register <i class="fa-regular fa-id-card"></i></a>
                    @endif
                @endauth
            </li>
        @endif
        </li>
      </ul>
    </div>
  </nav>



  <!-- Main content -->

  <!-- Featured courses -->
  <main class="container">
    <div class="container-fluid p-0">
        <div class="row no-gutters">
          <div class="col">
            <img src="{{asset('images/slider-01.jpg')}}" class="img-fluid" style="height: 75vh;">
          </div>
        </div>
    </div>
    <div class="jumbotron">
      <h1 class="display-5 mt-5">Welcome to the Course Center Admin Portal</h1>
      <p class="lead">As an admin or operational user, you have access to a powerful set of tools that allow you to manage and monitor the courses, instructors, and students.</p>
      <hr class="my-4">
      <p>To get started, use the navigation menu above to access the various features and tools available to you.</p>
      <a class="btn btn-primary btn-lg" href="#" role="button">Learn More</a>
    </div>
  </main>



  <!-- Footer -->
  <footer class="footer mt-auto py-3 bg-light">
    <div class="container">
      <span class="text-muted">Copyright &copy; 2021 Course Center</span>
    </div>
  </footer>

  <!-- Bootstrap scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>

</body>
</html>
