@if (Auth::user() !== NULL)
    <div class="left-side-bar">
		<div class="brand-logo">
			<a href="{{route('home2')}}">
				<img src="{{asset('admin/vendors/images/siperak-logo.png')}}" alt="" class="dark-logo">
				<img src="{{asset('admin/vendors/images/siperak-logo.png')}}" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
        {{-- @if (Auth::user !== NULL) --}}
            <div class="menu-block customscroll">
                <div class="sidebar-menu">
                    <ul id="accordion-menu">
                        <li>
                            <a href="{{route('recipients.index')}}" class="dropdown-toggle no-arrow">
                                <span class="micon dw dw-user-2"></span><span class="mtext">Penerima</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('pokmases.index')}}" class="dropdown-toggle no-arrow">
                                <span class="micon dw dw-user-11"></span><span class="mtext">Kelompok Masyarakat</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('users.index')}}" class="dropdown-toggle no-arrow">
                                <span class="micon dw dw-user-12"></span><span class="mtext">Pengguna</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('menus.index')}}" class="dropdown-toggle no-arrow">
                                <span class="micon dw dw-food-cart"></span><span class="mtext">Senarai Pangan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('deliveries.index')}}" class="dropdown-toggle no-arrow">
                                <span class="micon dw dw-user-2"></span><span class="mtext">Pengantaran</span>
                            </a>
                        </li>
                        {{-- <li>
                            <a href="sitemap.html" class="dropdown-toggle no-arrow">
                                <span class="micon dw dw-diagram"></span><span class="mtext">Sitemap</span>
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </div>
	</div>
	<div class="mobile-menu-overlay"></div>
@endif
