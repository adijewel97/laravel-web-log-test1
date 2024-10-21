<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="" class="brand-link bg-orange">
        {{-- class="brand-image img-circle elevation-4" --}}
        <img src="{{ asset('images/PLN-PETIR.png') }}" alt="Logo" class="brand-image img-circle elevation-4"
            style="opacity: .8">
        <span class="brand-text font-weight-light"> <b> MIV PLN </b></span>
    </a>

    <div class="sidebar">

        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">Alexander Pierce</a>
                </div>
            </div>

           {{--  <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div> --}}



        <nav class="mt-4">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                data-accordion="false">

                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../../index.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v1</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">MULTI LEVEL EXAMPLE</li>
                <li class="nav-item  menu-is-opening menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            Level 1
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item  menu-is-opening menu-open">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Level 2
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Level 3</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Level 3</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link active">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Level 3</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li> --}}

                @if (Session::exists('UserListMenu'))
                @foreach (Session::get('UserListMenu') as $item)
                @if ($item['LEVELMENU'] == '1')
                <?php
                $reset = substr($item['IDMENU'], 0, 1);
                // in_array($string, $array)
                $urlsub = [];
                foreach (Session::get('UserListMenu') as $submenu) {
                    if ($item['IDMENU'] == $submenu['IDMAINMENU']) {
                        array_push($urlsub, $submenu['URL']);
                    }
                }

                if ($item['AKTIF'] == 1 || in_array('/' . Request::segment(1), $urlsub)) {
                    $opensubmenu = 'enu-is-opening menu-open';
                } else {
                    $opensubmenu = '';
                }

                ?>
                <li class="nav-item {{ $opensubmenu }}" style="font-size: 12px">
                    {{-- <li class="nav-item enu-is-opening menu-open"> --}}
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas {{ $item['ICON'] }}"></i>
                        {{-- <i class="nav-icon fas fa-tachometer-alt"></i> --}}
                        <p>
                            {{ $item['NAMAMENU'] }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    @elseif ($item['LEVELMENU'] == '2')
                    <ul class="nav nav-treeview" style="font-size: 10px">
                        <li class="nav-item">
                            <a href="{{ $item['URL'] }}" {{-- class="nav-link" --}}
                                class="nav-link {{ '/' . Request::segment(1) === $item['URL'] ? 'active' : null }}"
                                id="{{ $item['IDMENU'] }}">
                                {{-- <i class="far fa-circle nav-icon"></i> --}}
                                {{-- <p><u>{{ $item['NAMAMENU'] }}</u></p> --}}
                                <p>{{ $item['NAMAMENU'] }}
                                </p>
                            </a>
                        </li>
                    </ul>
                    @endif

                    @if ($reset != substr($item['IDMENU'], 0, 1))
                </li>
                @endif
                @endforeach
                </br></br></br>
                @else
                {{-- dd('hello') --}}
                <script>
                    window.location = "/login";
                </script>
                @endif

    </div>

    <script type="text/javascript">
        // const links = document.querySelectorAll('.nav-link');

        // if (links.length) {
        //     links.forEach((link) => {
        //         link.addEventListener('click', (e) => {
        //             links.forEach((link) => {
        //                 link.classList.remove('active');
        //             });
        //             e.preventDefault();
        //             link.classList.add('active');
        //         });
        //     });
        // }

        /** add active class and stay opened when selected */
        var url = window.location;

        // for sidebar menu entirely but not cover treeview
        $('ul.sidebar-menu a').filter(function() {
            return this.href == url;
        }).parent().addClass('active');

        // for treeview
        $('ul.treeview-menu a').filter(function() {
            return this.href == url;
        }).closest('.treeview').addClass('active');
    </script>


</aside>