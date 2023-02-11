<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Simonas - Login</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">

  <!-- ICONS -->
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/img/Favicon.png')}}">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block text-center">
                <h3 style="position: absolute; left: 40px; top: 310px; "class="h3 text-gray-900 mb-4">Sistem Monitoring Susenas</h3>
                <h6 style="position: absolute; left: 40px; top: 345px;" class="h6 text-gray-900 mb-4">BPS Kabupaten Gorontalo</h6>
                <img style="opacity: 0.3; filter: alpha(opacity=30);"class="bg-transparent" src="{{asset('assets/img/kantor1.jpg')}}"></div>
              <div class="col-lg-6">
                <div class="p-5"> <br>
                  <div class="text-center">
                    <!-- <img class="img-profile " src="{{asset('assets/img/apple-icon.png')}}">
                    <h1 class="h3 text-gray-900 mb-4">SIMONAS</h1> -->

                    <a class="sidebar-brand d-flex align-items-center justify-content-center">
                      <div class="sidebar-brand-icon">
                        <img class="img-profile " src="{{asset('assets/img/appleicon.png')}}">
                      </div>
                      <h1 class="h3 text-gray-900 mx-3">SIMONAS</h1>
                    </a>

                  </div> <br><br><br>
                  <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                      <input type="email" aria-describedby="emailHelp" placeholder="Email " id="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> 
                      @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <input type="password" placeholder="Password" id="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                    {{-- <div class="form-group">                      
                        <select name="kegiatan_id" id="kegiatan_id" class="form-control">
                          <option  value="" >-- Pilih Kegiatan --</option>
                          <option value="1" >Susenas Semester II 2021</option>
                          <option value="2" >Susenas Semester II 2021</option>                
                        </select>
                    </div> --}}

                    {{-- <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                            <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="custom-control-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div> --}}

                    
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        {{ __('Login') }}
                    </button>
                    
                    
                  </form>
                  <hr>
                  <!-- <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>                   
                  </div> -->
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('assets/js/sb-admin-2.min.js')}}"></script>

</body>

</html>
