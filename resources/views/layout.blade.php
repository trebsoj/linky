<!doctype html>
<html lang="en">
  <head>
    <title>linky</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
    <link href="/css/general.css" rel="stylesheet">

    <link rel="shortcat icon" href="/images/favicon.png">

  </head>

  <body>

  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
      @if(empty($public))
        <a class="navbar-brand col-md-3 col-lg-2 px-3" href="{{route('link.index')}}">
            <img src="/images/logo-nobk-grey.png" height="25">
        </a>
      @else
          <a class="navbar-brand col-md-3 col-lg-2 px-3" href="{{route('public.index')}}">
              <img src="/images/logo-nobk-grey.png" height="25">
          </a>
      @endif
      <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
  </header>

    <div class="container-fluid"">
      <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
          <div class="position-sticky pt-3">

            {{-- Only show, if not public route --}}
            @if(empty($public))
              <ul class="nav flex-column ">
                  <li class="nav-item">
                      <a class="nav-link" target="_blank" href="{{route('public.index')}}">
                          <span data-feather="external-link" style="color: #36cccc"></span>
                          Public route
                      </a>
                  </li>
              </ul>
              <ul class="nav flex-column">
                  <li class="nav-item">
                      <a class="nav-link {{ Request::is('variable') ? 'active' : '' }}" href="{{route('variable.index')}}">
                          <span data-feather="dollar-sign" style="color: #36cccc"></span>
                          Variables
                      </a>
                  </li>
              </ul>
            @endif

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Groups</span>
            </h6>
            <ul class="nav flex-column">
              @foreach ($groups as $item)
                @if(!empty($public) && $item->links_public == 0)
                    @continue
                @endif
                {{-- Print group --}}
                <li class="nav-item">
                  <a class="nav-link {{ Helper::isMenuActive($item, Request::segment(1), Request::segment(2),Request::segment(3)) ? 'active' : '' }}"
                     href="@if(empty($public)){{route('group.show', $item)}}@else{{route('public.group.show', $item)}}@endif"
                  >
                    <img src="/images/favicon.png" height="20px">
                    {{$item->name}}
                  </a>
                </li>
              @endforeach
            </ul>

              {{-- Only show, if not public route --}}
              @if(empty($public))
                <form action="{{route('group.store')}}" method="POST" class="mt-4 g-1 needs-validation" novalidate>
                  @csrf
                  <div class="col-12">
                    <input type="text" name="name" placeholder="Create group" class="form-control" id="vLinkName" required>
                    <div class="valid-feedback"></div>
                  </div>
                  <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-labeled btn-success btn-block">
                      <span class="btn-label"><i class="fa fa-plus"></i></span>
                    </button>
                  </div>
                </form>

                <form action="{{route('logout')}}" method="POST" class="mt-5 mb-4 g-1 needs-validation" id="fmLogout" novalidate>
                  @csrf
                  <div class="gap-2" style="text-align: center;">
                      <button type="submit" class="btn btn-labeled btn-danger btn-block" onclick="return confirm('Are you sure you want to log out?')">
                          <span class="btn-label"><i class="fa fa-sign-out-alt"></i></span>
                          Logout
                      </button>
                  </div>
                </form>
              @endif
          </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

            <div class="container mt-4">
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')
            </div>
        </main>

      </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous">
    </script><script src="/js/dashboard.js"></script>

    <script>
      // Disable form submissions if there are invalid fields
      (function() {
        'use strict';
        window.addEventListener('load', function() {
          // Get the forms we want to add validation styles to
          var forms = document.getElementsByClassName('needs-validation');
          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
      </script>
  </body>

</html>
