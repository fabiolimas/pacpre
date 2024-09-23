<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/img/logo.png') }}" alt="" width="90" class="logo">
            </a>


            <!-- mobile -->
            <ul class="list-unstyled d-flex d-lg-none gap-2 my-auto me-auto align-items-center ">

            </ul>
            <!-- mobile -->
            <ul class="list-unstyled d-flex d-lg-none gap-2 my-auto ms-auto align-items-center">
                <!-- user -->
                <li class="nav-item">
                    <a href="#" class="d-flex align-items-center gap-2 nav-link-user">
                        <div class="bg-img-user-mobile"
                            style="background-image: url({{ asset('assets/img/ilustracoes/user-adm.png') }})">
                        </div>
                    </a>
                </li>
            </ul>

            <button class="navbar-toggler d-lg-none p-0 shadow-none ms-2 border-0" type="button"
                aria-expanded="false" aria-label="Toggle navigation" id="toggle-sidebar">
                {{-- <span class="navbar-toggler-icon"></span> --}}
                <i class="" data-feather="menu" style="min-width: 30px; min-height: 30px"></i>
            </button>

            <!-- desktop -->
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav me-auto mt-2 mt-lg-0 align-items-center">

                </ul>

                <div class="d-none d-lg-block">
                    <a href="#" class="d-flex align-items-center gap-2 nav-link-user">
                        @if(Auth::user())
                        {{ auth()->user()->name}}
                        @else

                        @endif
                        <div class="bg-img-user rounded-3 border border-secondary"
                            style="background-image: url({{ asset(auth()->user()->img_perfil ?? 'assets/img/ilustracoes/profile.png') }})">
                        </div>
                    </a>

                </div>
            </div>
        </div>
    </nav>

</header>
