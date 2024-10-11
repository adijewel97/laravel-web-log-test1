<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- my stile login  -->
  <link rel="stylesheet" href="{{ asset('mystyle/css/style.css') }}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <link rel="stylesheet" href="{{asset('adminlte320/plugins/fontawesome-free/css/all.min.css') }}">

  <link rel="stylesheet" href="{{asset('adminlte320/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

  <link rel="stylesheet" href="{{asset('adminlte320/plugins/toastr/toastr.min.css') }}">

  <link rel="stylesheet" href="{{asset('adminlte320/dist/css/adminlte.min.css?v=3.2.0') }}">
  <script nonce="66d26bb8-cd60-4684-bf9e-ebede0305f06">
    try {
      (function(w, d) {
        ! function(b, c, d, e) {
          b[d] = b[d] || {};
          b[d].executed = [];
          b.zaraz = {
            deferred: [],
            listeners: []
          };
          b.zaraz.q = [];
          b.zaraz._f = function(f) {
            return async function() {
              var g = Array.prototype.slice.call(arguments);
              b.zaraz.q.push({
                m: f,
                a: g
              })
            }
          };
          for (const h of ["track", "set", "debug"]) b.zaraz[h] = b.zaraz._f(h);
          b.zaraz.init = () => {
            var i = c.getElementsByTagName(e)[0],
              j = c.createElement(e),
              k = c.getElementsByTagName("title")[0];
            k && (b[d].t = c.getElementsByTagName("title")[0].text);
            b[d].x = Math.random();
            b[d].w = b.screen.width;
            b[d].h = b.screen.height;
            b[d].j = b.innerHeight;
            b[d].e = b.innerWidth;
            b[d].l = b.location.href;
            b[d].r = c.referrer;
            b[d].k = b.screen.colorDepth;
            b[d].n = c.characterSet;
            b[d].o = (new Date).getTimezoneOffset();
            if (b.dataLayer)
              for (const o of Object.entries(Object.entries(dataLayer).reduce(((p, q) => ({
                  ...p[1],
                  ...q[1]
                })), {}))) zaraz.set(o[0], o[1], {
                scope: "page"
              });
            b[d].q = [];
            for (; b.zaraz.q.length;) {
              const r = b.zaraz.q.shift();
              b[d].q.push(r)
            }
            j.defer = !0;
            for (const s of [localStorage, sessionStorage]) Object.keys(s || {}).filter((u => u.startsWith("_zaraz_"))).forEach((t => {
              try {
                b[d]["z_" + t.slice(7)] = JSON.parse(s.getItem(t))
              } catch {
                b[d]["z_" + t.slice(7)] = s.getItem(t)
              }
            }));
            j.referrerPolicy = "origin";
            j.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(b[d])));
            i.parentNode.insertBefore(j, i)
          };
          ["complete", "interactive"].includes(c.readyState) ? zaraz.init() : b.addEventListener("DOMContentLoaded", zaraz.init)
        }(w, d, "zarazData", "script");
      })(window, document)
    } catch (e) {
      throw fetch("/cdn-cgi/zaraz/t"), e;
    };
  </script>
</head>

{{-- alert boostrap from javasecript me --}}
<script type="text/javascript" src="{{ asset('mystyle/js/myalertbs.js') }}"></script>

</head>

<body>

  <section>
    <div class="page-hero d-flex align-items-center justify-content-center ">
      <div class="login-box" style="top: 150px;">
        <form action="/loginuser" method="post" enctype="multipart/form-data">
          @csrf
          @if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
          <script>
            $(function() {
              $('#myModal').modal('show');
            });
          </script>
          @endif
          <h2 class="title-login"><b>LOGIN</b></h2>
          <p class="aplikasi" style="margin-left: 20px;">Monitoring & Laporan MIV P2APST</p>
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
          <button class="btn-me" type="submit">Login</button>
          <div class="register-link">
            <p>Don't have an accunt ? <a href="">Register</a></p>
          </div>
        </form>
      </div>
    </div>

    <div class="modal fade" id="myModal">
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
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>

  </section>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <!-- Bootstrap 4 -->
  <script src="{{ asset('adminlte320/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

  <script src="{{ asset('adminlte320/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('adminlte320/plugins/bootstrap/js/bootstrap.b)undle.min.js') }}"></script>
  <script src="{{ asset('adminlte320/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('adminlte320/plugins/toastr/toastr.min.js') }}"></script>
  <script src="{{ asset('adminlte320/dist/js/adminlte.min.js?v=3.2.0') }}"></script>

</body>

</html>