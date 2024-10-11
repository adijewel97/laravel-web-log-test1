<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MIV P2APST | Management Instansi Vertikal</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{asset('adminlte320/plugins')}}/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="{{asset('adminlte320/plugins')}}/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="{{asset('adminlte320/plugins')}}/toastr/toastr.min.css">
  <link rel="stylesheet" href="{{asset('adminlte320/dist')}}/css/adminlte.min.css?v=3.2.0">

  <!-- tambhan login style -->
  <link rel="stylesheet" href="{{ asset('mystyle/css/style.css') }}">
  <!-- alert boostrap from javasecript me -->
  <script src="{{ asset('mystyle/js/myalertbs.js') }}"></script>

</head>

<body class="hold-transition sidebar-mini">

  @if (session()->has('err_msg'))
  <label>{{ session()->get('err_msg') }}</label>

  <script>
    ShowMsgSm('Error', esponse.message, 'MB_CLOSE');
  </script>
  @endif

  <section>
    <div class="login-box">
      <form action="/loginuser" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{-- <div class="logo">
                    <img src="{{ asset('images/Logo_PLN.png') }}">
    </div> --}}
    <h2>LOGIN</h2>
    <p class="aplikasi">Monitoring & Laporan MIV P2APST</p>
    <div class="input-box">
      <span class="icon">
        <ion-icon name="mail"></ion-icon>
      </span>
      <input type="text" name="email" value="{{ old('email') }}" autofocus>
      <label>Email / User Name</label>

    </div>
    <div class="input-box">
      <span class="icon">
        <ion-icon name="lock-closed"></ion-icon>
      </span>
      <input type="password" name="password">
      <label>Password</label>

    </div>
    <div class="remember-forgate">
      <label><input type="checkbox"> Remember me </label><a href="">Forgot Password ?</a>
    </div>
    <button class="btn" type="submit">Login</button>
    <!-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#bs-alert">
      Launch Default Modal
    </button> -->
    <div class="register-link">
      <p>Don't have an accunt ? <a href="">Register</a></p>
    </div>
    </form>
    </div>


    <!-- modal message -->
    <!-- <div class="modal fade" tabindex="-1" id="bs-alert">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Default Modal</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>One fine body&hellip;</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div> -->
  </section>

  <script src="{{asset('adminlte320/plugins')}}/jquery/jquery.min.js"></script>
  <script src="{{asset('adminlte320/plugins')}}/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('adminlte320/plugins')}}/sweetalert2/sweetalert2.min.js"></script>
  <script src="{{asset('adminlte320/plugins')}}/toastr/toastr.min.js"></script>
  <script src="{{asset('adminlte320/plugins')}}/js/adminlte.min.js?v=3.2.0"></script>
  <script src="{{asset('adminlte320/plugins')}}/js/demo.js"></script>
</body>

</html>