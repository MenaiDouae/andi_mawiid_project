    <div class="startbar d-print-none">
        <!--start brand-->
        <div class="brand">
            <a href="index.html" class="logo">
                <span>
                    <img src="assets/images/logo-sm.png" alt="logo-small" class="logo-sm">
                </span>
                <span class="">
                    <img src="assets/images/logo-light.png" alt="logo-large" class="logo-lg logo-light">
                    <img src="assets/images/logo-dark.png" alt="logo-large" class="logo-lg logo-dark">
                </span>
            </a>
        </div>
        <!--end brand-->
        <!--start startbar-menu-->
        <div class="startbar-menu" >
            <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
                <div class="d-flex align-items-start flex-column w-100">
                    <!-- Navigation -->
                    <ul class="navbar-nav mb-auto w-100">
                        <li class="menu-label pt-0 mt-0">
                            {{-- <small class="label-border">
                                <div class="border_left hidden-xs"></div>
                                <div class="border_right"></div>
                            </small> --}}
                            <span>Main Menu</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('welcome')}}" data-bs-toggle="collapse" role="button">
                                <i class="iconoir-home-simple menu-icon"></i>
                                <span>Dashboards</span>
                            </a>
                        </li><!--end nav-item-->
                        <li class="menu-label mt-2">
                            <small class="label-border">
                                <div class="border_left hidden-xs"></div>
                                <div class="border_right"></div>
                            </small>
                            <span>Components</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarAdvancedUI" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarAdvancedUI">
                                <i class="iconoir-peace-hand menu-icon"></i>
                                <span>Advanced UI</span><span class="badge rounded text-success bg-success-subtle ms-1">New</span>
                            </a>
                            <div class="collapse " id="sidebarAdvancedUI">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="advanced-animation.html">Animation</a>
                                    </li><!--end nav-item-->
                                    <li class="nav-item">
                                        <a class="nav-link" href="advanced-clipboard.html">Clip Board</a>
                                    </li><!--end nav-item-->
                                    <li class="nav-item">
                                        <a class="nav-link" href="advanced-dragula.html">Dragula</a>
                                    </li><!--end nav-item-->
                                    <li class="nav-item">
                                        <a class="nav-link" href="advanced-files.html">File Manager</a>
                                    </li><!--end nav-item--> 
                                    <li class="nav-item">
                                        <a class="nav-link" href="advanced-highlight.html">Highlight</a>
                                    </li><!--end nav-item-->
                                    <li class="nav-item">
                                        <a class="nav-link" href="advanced-rangeslider.html">Range Slider</a>
                                    </li><!--end nav-item-->
                                    <li class="nav-item">
                                        <a class="nav-link" href="advanced-ratings.html">Ratings</a>
                                    </li><!--end nav-item-->
                                    <li class="nav-item">
                                        <a class="nav-link" href="advanced-ribbons.html">Ribbons</a>
                                    </li><!--end nav-item-->                                  
                                    <li class="nav-item">
                                        <a class="nav-link" href="advanced-sweetalerts.html">Sweet Alerts</a>
                                    </li><!--end nav-item-->
                                    <li class="nav-item">
                                        <a class="nav-link" href="advanced-toasts.html">Toasts</a>
                                    </li><!--end nav-item-->
                                </ul><!--end nav-->
                            </div><!--end startbarAdvancedUI-->
                        </li><!--end nav-item-->
                    </ul><!--end navbar-nav--->
                </div>
            </div><!--end startbar-collapse-->
        </div><!--end startbar-menu-->    
    </div>
    <!--end startbar-->
    <div class="startbar-overlay d-print-none"></div>