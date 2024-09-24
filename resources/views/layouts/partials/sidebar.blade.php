<aside>
    <div class="sidebar d-flex flex-column" id="sidebar">

        <button type="button"
            class="btn d-block d-lg-none btn-light bg-white close-sidebar fs-5 shadow p-0 d-flex align-items-center justify-content-center"
            title="Fechar" onclick="toggleMenuMobile()">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                stroke="#133D3C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>


        <ul class="list-unstyled">
            <li class="">
                <a href="{{ route('home') }}"
                    class="sidebar-link d-flex align-items-center  gap-4 @if (Route::is('home')) active @endif  sidebar-link-inicio">
                    <i data-feather="home"></i>
                    <div>
                        Início
                    </div>
                </a>
            </li>
            @can('admin')
              <li class="">
                    <a href="{{ route('lojas.index') }}"
                        class="sidebar-link d-flex align-items-center @if (Route::is('usuarios.*')) active @endif  gap-4 ">
                        <i data-feather="list"></i>
                        <div>
                           Lojas
                        </div>
                    </a>
                </li>
                <li class="">
                    <a href="{{ route('usuarios.index') }}"
                        class="sidebar-link d-flex align-items-center @if (Route::is('usuarios.*')) active @endif  gap-4 ">
                        <i data-feather="user"></i>
                        <div>
                           Usuarios
                        </div>
                    </a>
                </li>
                <li class="">
                    <a href="{{route('pacotes.index')}}"
                        class="sidebar-link d-flex align-items-center @if (Route::is('pacotes.*')) active @endif  gap-4 ">
                        <i data-feather="package"></i>
                        <div>
                           Pacotes
                        </div>
                    </a>
                </li>
            @endcan
            @can('admin')

                {{-- <li class="">
                    <a href="{{ route('painel.admin.compras.index') }}"
                        class="sidebar-link d-flex align-items-center @if (Route::is('painel.admin.compras.*')) active @endif  gap-4 ">
                        <i data-feather="list"></i>
                        <div>
                            Pedidos de compras
                        </div>
                    </a>
                </li> --}}
            @endcan
            @canany(['loja','vendedor'])
                {{-- <li class="">
                    <a href="#"
                        class="sidebar-link d-flex align-items-center @if (Route::is('painel.farmacia.clientes.*')) active @endif  gap-4 ">
                        <i data-feather="users"></i>
                        <div>
                            Clientes
                        </div>
                    </a>
                </li> --}}


            @endcanany

            @can('loja')

            {{-- <li class="">
                <a href="{{ route('painel.admin.compras.index') }}"
                    class="sidebar-link d-flex align-items-center @if (Route::is('painel.admin.compras.*')) active @endif  gap-4 ">
                    <i data-feather="list"></i>
                    <div>
                        Pedidos de compras
                    </div>
                </a>
            </li> --}}

            @endcan

            @can('admin')
            <li class="">
                <a href="{{route('cartoes.index')}}"
                    class="sidebar-link d-flex align-items-center @if (Route::is('cartoes.*')) active @endif gap-4 ">
                    <i data-feather="credit-card"></i>
                    <div>
                        Cartões Pré
                    </div>
                </a>
            </li>
                <li class="">
                    <a href="{{route('servicos.index')}}"
                        class="sidebar-link d-flex align-items-center @if (Route::is('servicos.*')) active @endif gap-4 ">
                        <i data-feather="image"></i>
                        <div>
                            Serviços
                        </div>
                    </a>
                </li>
            @endcan


            @can('admin')
                {{-- <li class="">
                    <a href="#"
                        class="sidebar-link d-flex align-items-center @if (Route::is('painel.admin.graficos.*')) active @endif  gap-4 ">
                        <i data-feather="bar-chart-2"></i>
                        <div>
                            Gráficos
                        </div>
                    </a>
                </li> --}}
            @endcan
            @can('loja')
            <li class="">
                <a href="{{route('cartoes.index')}}"
                    class="sidebar-link d-flex align-items-center @if (Route::is('cartoes.*')) active @endif gap-4 ">
                    <i data-feather="credit-card"></i>
                    <div>
                        Cartões Pré
                    </div>
                </a>
            </li>
            <li class="">
                    <a href="{{route('pdv.index')}}"
                        class="sidebar-link d-flex align-items-center @if (Route::is('pdv.*')) active @endif  gap-4 ">
                        <i data-feather="shopping-cart"></i>
                        <div>
                            PDV
                        </div>
                    </a>
                </li>
            @endcan


        </ul>

        <ul class="list-unstyled mt-auto mb-0">
            @canany(['admin','adminFarmacia'])
            {{-- <li class="">
                <a href="#"
                    class="sidebar-link d-flex align-items-center @if (Route::is('painel.config.*')) active @endif  gap-4 ">
                    <i data-feather="settings"></i>
                    <div>
                        Ajustes
                    </div>
                </a>
            </li> --}}
        @endcanany
            <li class="">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();"
                    class="sidebar-link d-flex align-items-center  gap-4 sidebar-link-sair ">
                    <i data-feather="log-out"></i>
                    <div>
                        Sair
                    </div>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>

        </ul>
    </div>
</aside>
