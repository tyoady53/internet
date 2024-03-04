<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('home') }}">
            <img src="{{ asset('img/logo-bk.png') }}" class="navbar-brand-img h-150">
            <span class="ms-1 font-weight-bold">TIRTA KOTA<br>ALAM CAGAK LESTARI</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mt-3 d-flex align-items-center">
                <div class="ps-4">
                </div>
                <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Menu</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'customer') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'customer/index']) }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                            <path d="M256 288c79.5 0 144-64.5 144-144S335.5 0 256 0 112 64.5 112 144s64.5 144 144 144zm128 32h-55.1c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16H128C57.3 320 0 377.3 0 448v16c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48v-16c0-70.7-57.3-128-128-128z"/>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Pelanggan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'billing') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'billing/index']) }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="256" height="256" viewBox="0 0 256 256" xml:space="preserve">

                            <defs>
                            </defs>
                            <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
                                <path d="M 67.245 21.439 c -1.104 0 -2 -0.896 -2 -2 V 2.136 c 0 -1.104 0.896 -2 2 -2 s 2 0.896 2 2 v 17.303 C 69.245 20.543 68.35 21.439 67.245 21.439 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                <path d="M 2 71.518 c -1.104 0 -2 -0.896 -2 -2 V 2.136 c 0 -1.104 0.896 -2 2 -2 s 2 0.896 2 2 v 67.382 C 4 70.622 3.104 71.518 2 71.518 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                <path d="M 77.622 89.864 c -1.104 0 -2 -0.896 -2 -2 s 0.896 -2 2 -2 c 3.931 0 7.237 -2.721 8.137 -6.377 H 67.245 c -1.104 0 -2 -0.896 -2 -2 s 0.896 -2 2 -2 H 88 c 1.104 0 2 0.896 2 2 C 90 84.312 84.447 89.864 77.622 89.864 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                <path d="M 67.245 79.487 c -1.104 0 -2 -0.896 -2 -2 V 53.169 c 0 -1.104 0.896 -2 2 -2 s 2 0.896 2 2 v 24.318 C 69.245 78.592 68.35 79.487 67.245 79.487 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                <path d="M 12.377 89.864 C 5.553 89.864 0 84.312 0 77.487 v -7.97 c 0 -1.104 0.896 -2 2 -2 s 2 0.896 2 2 v 7.97 c 0 4.619 3.758 8.377 8.377 8.377 c 1.104 0 2 0.896 2 2 S 13.482 89.864 12.377 89.864 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                <path d="M 77.622 89.864 H 12.377 c -1.104 0 -2 -0.896 -2 -2 s 0.896 -2 2 -2 h 65.245 c 1.104 0 2 0.896 2 2 S 78.727 89.864 77.622 89.864 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                <path d="M 12.377 89.864 c -1.104 0 -2 -0.896 -2 -2 s 0.896 -2 2 -2 c 4.619 0 8.377 -3.758 8.377 -8.377 c 0 -1.104 0.896 -2 2 -2 h 44.49 c 1.104 0 2 0.896 2 2 s -0.896 2 -2 2 H 24.593 C 23.635 85.364 18.521 89.864 12.377 89.864 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                <path d="M 41.739 52.07 H 15.876 c -1.104 0 -2 -0.896 -2 -2 s 0.896 -2 2 -2 h 25.863 c 1.104 0 2 0.896 2 2 S 42.844 52.07 41.739 52.07 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                <path d="M 71.038 40.392 c -1.073 0 -1.949 -0.845 -1.998 -1.906 c -1.061 -0.049 -1.906 -0.925 -1.906 -1.998 c 0 -1.104 0.896 -2 2 -2 c 2.153 0 3.904 1.751 3.904 3.904 C 73.038 39.496 72.143 40.392 71.038 40.392 z M 69.134 38.487 h 0.01 H 69.134 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                <path d="M 67.245 31.748 c -1.104 0 -2 -0.896 -2 -2 V 27.39 c 0 -1.104 0.896 -2 2 -2 s 2 0.896 2 2 v 2.358 C 69.245 30.852 68.35 31.748 67.245 31.748 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                <path d="M 69.134 38.487 h -3.778 c -2.153 0 -3.904 -1.751 -3.904 -3.904 v -2.931 c 0 -2.153 1.751 -3.904 3.904 -3.904 h 3.778 c 2.153 0 3.904 1.751 3.904 3.904 c 0 1.104 -0.896 2 -2 2 c -1.072 0 -1.948 -0.844 -1.998 -1.904 h -3.589 v 2.74 h 3.683 c 1.104 0 2 0.896 2 2 S 70.238 38.487 69.134 38.487 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                <path d="M 67.245 47.586 c -1.104 0 -2 -0.896 -2 -2 v -2.358 c 0 -1.104 0.896 -2 2 -2 s 2 0.896 2 2 v 2.358 C 69.245 46.69 68.35 47.586 67.245 47.586 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                <path d="M 69.134 45.228 h -3.778 c -2.153 0 -3.904 -1.751 -3.904 -3.904 c 0 -1.104 0.896 -2 2 -2 c 1.072 0 1.948 0.844 1.998 1.904 h 3.589 v -2.836 c 0 -1.104 0.896 -2 2 -2 s 2 0.896 2 2 v 2.932 C 73.038 43.476 71.287 45.228 69.134 45.228 z M 65.451 41.323 h 0.01 H 65.451 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                <path d="M 54.271 64.202 H 15.876 c -1.104 0 -2 -0.896 -2 -2 s 0.896 -2 2 -2 h 38.395 c 1.104 0 2 0.896 2 2 S 55.375 64.202 54.271 64.202 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                <path d="M 59.09 11.045 c -0.46 0 -0.92 -0.158 -1.293 -0.474 l -6.863 -5.814 l -6.862 5.814 c -0.746 0.632 -1.84 0.632 -2.586 0 l -6.863 -5.814 l -6.863 5.814 c -0.746 0.632 -1.84 0.632 -2.586 0 l -6.863 -5.814 l -6.862 5.814 c -0.746 0.632 -1.84 0.632 -2.586 0 L 0.707 3.662 C -0.136 2.948 -0.24 1.686 0.474 0.843 C 1.188 -0.001 2.45 -0.104 3.293 0.61 l 6.863 5.814 l 6.862 -5.814 c 0.746 -0.632 1.84 -0.632 2.586 0 l 6.863 5.814 L 33.33 0.61 c 0.746 -0.632 1.84 -0.632 2.586 0 l 6.863 5.814 l 6.862 -5.814 c 0.746 -0.632 1.84 -0.632 2.586 0 l 6.863 5.814 l 6.862 -5.814 c 0.843 -0.713 2.104 -0.61 2.819 0.233 c 0.714 0.843 0.609 2.105 -0.233 2.819 l -8.155 6.909 C 60.01 10.887 59.55 11.045 59.09 11.045 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                <path d="M 67.245 55.169 c -10.402 0 -18.865 -8.463 -18.865 -18.865 s 8.463 -18.865 18.865 -18.865 c 10.401 0 18.864 8.463 18.864 18.865 S 77.646 55.169 67.245 55.169 z M 67.245 21.439 c -8.196 0 -14.865 6.668 -14.865 14.865 s 6.669 14.865 14.865 14.865 S 82.109 44.5 82.109 36.304 C 82.109 28.107 75.441 21.439 67.245 21.439 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                <path d="M 34.69 39.939 H 15.876 c -1.104 0 -2 -0.896 -2 -2 s 0.896 -2 2 -2 H 34.69 c 1.104 0 2 0.896 2 2 S 35.794 39.939 34.69 39.939 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                <path d="M 41.739 27.808 H 15.876 c -1.104 0 -2 -0.896 -2 -2 s 0.896 -2 2 -2 h 25.863 c 1.104 0 2 0.896 2 2 S 42.844 27.808 41.739 27.808 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            </g>
                            </svg>
                    </div>
                    <span class="nav-link-text ms-1">Billing</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'payment') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'payment/index']) }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path d="M621.2 54.5C582.4 38.2 543.6 32 504.8 32c-123.2 0-246.3 62.3-369.5 62.3-30.9 0-61.8-3.9-92.7-13.7-3.5-1.1-7-1.6-10.4-1.6C15 79 0 92.3 0 110.8v317.3c0 12.6 7.2 24.6 18.8 29.5C57.6 473.8 96.5 480 135.3 480c123.2 0 246.3-62.4 369.5-62.4 30.9 0 61.8 3.9 92.7 13.7 3.5 1.1 7 1.6 10.4 1.6 17.2 0 32.3-13.3 32.3-31.8V83.9c0-12.6-7.2-24.6-18.9-29.5zM320 352c-44.2 0-80-43-80-96 0-53 35.8-96 80-96s80 43 80 96c0 53-35.8 96-80 96z"/>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Pembayaran</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'report') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'report/index']) }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <svg class="svg-icon" style="width: 1em; height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                            <path d="M948.735317 609.719602c-3.562129 3.63376-6.732331 6.949272-9.549493 10.144034-2.837628 3.189645-5.335519 5.857405-7.451716 7.998161-2.842745 2.886747-5.310959 4.984524-7.4159 6.383384l-90.278119-89.465614c4.238534-3.586688 9.003048-7.831362 14.314007-12.772908 5.310959-5.02341 9.729595-8.915044 13.294794-11.753695 8.481162-7.828292 17.683754-11.149944 27.608801-10.145058 9.886161 1.091868 18.035772 3.409656 24.420179 6.950296 7.081279 3.585665 14.688537 9.79304 22.843264 18.632359 8.128121 8.919137 14.344706 18.277272 18.563798 28.29544 2.13564 5.640464 3.560082 12.768815 4.281513 21.293979C960.057177 593.762165 956.500165 601.979314 948.735317 609.719602L948.735317 609.719602 948.735317 609.719602 948.735317 609.719602zM785.153682 772.752746l-73.275887 73.487711c-9.925047 9.925047-18.23327 18.494213-24.965601 25.575492-6.730285 7.0383-10.446933 10.969842-11.169387 11.670807-3.520173 2.843768-7.407714 5.858428-11.6749 9.096169-4.219091 3.140527-8.503675 5.858428-12.744255 7.954159-4.241604 2.14178-10.778484 4.765537-19.62599 8.042163-8.858762 3.189645-17.884322 6.164397-27.087938 9.008164-9.202593 2.843768-18.059308 5.336542-26.560936 7.433296-8.481162 2.185782-14.872732 3.584642-19.10308 4.282536-8.53028 1.449002-14.192234 0.357134-17.011442-3.184529-2.838651-3.550873-3.541663-9.583263-2.119267-18.10331 0.719384-4.282536 2.119267-10.671037 4.241604-19.152199 2.140757-8.56405 4.614088-17.270339 7.456832-26.098401 2.816139-8.92016 5.462408-17.269315 7.973602-25.096585 2.452865-7.780197 4.41659-13.114692 5.79396-15.914458 4.28663-9.267061 9.945513-17.397229 17.011442-24.52251l13.836123-13.860682 26.5374-26.625404c10.627035-10.671037 22.297842-22.556739 35.042097-35.675524 12.743232-13.114692 25.484418-26.097378 38.2123-38.865169 30.472012-30.5549 64.817238-64.660672 103.054097-102.258988l89.185228 89.451288L785.153682 772.752746 785.153682 772.752746 785.153682 772.752746zM696.507736 219.197304c0-14.559601-11.799744-26.361391-26.338878-26.361391l-52.702316 0 0-52.682873 105.409748 0c14.539134 0 26.340925 11.758812 26.340925 26.360368l0 358.368994-52.709479 57.993832L696.507736 219.197304 696.507736 219.197304 696.507736 219.197304 696.507736 219.197304zM564.753993 245.557672l-26.361391 0c-14.538111 0-26.340925-11.80179-26.340925-26.360368L512.051677 113.787556c0-14.557554 11.802814-26.360368 26.340925-26.360368l26.361391 0c14.539134 0 26.346041 11.802814 26.346041 26.360368l0 105.409748C591.100034 233.754858 579.293127 245.557672 564.753993 245.557672L564.753993 245.557672 564.753993 245.557672zM327.577199 140.15304l158.113087 0 0 52.682873L327.577199 192.835913 327.577199 140.15304 327.577199 140.15304zM274.869766 245.557672l-26.340925 0c-14.557554 0-26.365484-11.80179-26.365484-26.360368L222.163357 113.787556c0-14.557554 11.80793-26.360368 26.365484-26.360368l26.340925 0c14.539134 0 26.367531 11.802814 26.367531 26.360368l0 105.409748C301.236274 233.754858 289.408901 245.557672 274.869766 245.557672L274.869766 245.557672 274.869766 245.557672zM116.753609 219.197304l0 579.784826c0 14.558577 11.80793 26.361391 26.365484 26.361391l332.979744 0-47.920406 52.68185L90.389148 878.025371c-14.535041 0-26.341948-11.757788-26.341948-26.317389L64.0472 166.513408c0-14.602579 11.80793-26.360368 26.341948-26.360368l105.433284 0 0 52.682873-52.702316 0C128.556423 192.835913 116.753609 204.637704 116.753609 219.197304L116.753609 219.197304 116.753609 219.197304 116.753609 219.197304zM617.465518 654.048203c0 7.262404-5.9055 13.162788-13.183254 13.162788L208.98522 667.210991c-7.281847 0-13.163811-5.901407-13.163811-13.162788l0-26.356274c0-7.306406 5.881964-13.162788 13.163811-13.162788l395.297045 0c7.27673 0 13.183254 5.857405 13.183254 13.162788L617.465518 654.048203 617.465518 654.048203zM604.283288 456.376145 208.98522 456.376145c-7.281847 0-13.163811-5.9055-13.163811-13.163811l0-26.360368c0-7.300266 5.881964-13.158694 13.163811-13.158694l395.297045 0c7.27673 0 13.183254 5.858428 13.183254 13.158694l0 26.360368C617.465518 450.470645 611.560018 456.376145 604.283288 456.376145L604.283288 456.376145 604.283288 456.376145 604.283288 456.376145zM604.283288 456.376145"  />
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Report</span>
                </a>
            </li>
            @if(str_contains(auth()->user()->getRoleNames()[0],'admin'))
            <li class="nav-item mt-3 d-flex align-items-center">
                <div class="ps-4">
                </div>
                <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">User Management</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'user') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'user/index']) }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                            <path d="M256 288c79.5 0 144-64.5 144-144S335.5 0 256 0 112 64.5 112 144s64.5 144 144 144zm128 32h-55.1c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16H128C57.3 320 0 377.3 0 448v16c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48v-16c0-70.7-57.3-128-128-128z"/>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'master-bill') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'master-bill/index']) }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM80 64h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16s7.2-16 16-16zm16 96H288c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V256c0-17.7 14.3-32 32-32zm0 32v64H288V256H96zM240 416h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H240c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Master Billings</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'role') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'role/index']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Role</span>
                </a>
            </li>
            {{-- <li class="nav-item mt-3 d-flex align-items-center">
                <div class="ps-4">
                </div>
                <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Setup</h6>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'setup') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'setup']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-cog text-danger text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Setup</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
</aside>
