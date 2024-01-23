<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MIV - Management Instansi Vertikal</title>

    <link rel="stylesheet" href="{{ asset('mystyle/css/style.css') }}">

    <!-- Bootstrap 4 -->
    {{-- <link rel="stylesheet" href="{{ asset('adminlte320/dist/css/adminlte.css') }}"> --}}
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

    {{-- alert boostrap from javasecript me --}}
    <script src="{{ asset('mystyle/js/myalertbs.js') }}"></script>

</head>

<body>
    {{-- <div>{{ $message }}</div> --}}
    @include('sweetalert::alert')

    @if (session()->has('err_msg'))
    <div class="alert alert-success">
        {{ session()->get('err_msg') }}
    </div>

    <script>
        alert("{{ session()->get('message') }}");
        // ShowMsgSm('Info', "{{ session()->get('err_msg') }}", 'MB_CLOSE');
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
            <input type="text" name="email" value="{{ old('email') }}" required autofocus>
            <label>Email / User Name</label>

        </div>
        <div class="input-box">
            <span class="icon">
                <ion-icon name="lock-closed"></ion-icon>
            </span>
            <input type="password" name="password" required autocomplete="current-password">
            <label>Password</label>

        </div>
        <div class="remember-forgate">
            <label><input type="checkbox"> Remember me </label><a href="">Forgot Password ?</a>
        </div>
        <button class="btn" type="submit">Login</button>
        <div class="register-link">
            <p>Don't have an accunt ? <a href="">Register</a></p>
        </div>
        </form>
        </div>
    </section>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>