    <div class="startbar d-print-none">
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
       
        <div class="startbar-menu" >
            <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
                <div class="d-flex align-items-start flex-column w-100">
                   
                    <ul class="navbar-nav mb-auto w-100">
                        <li class="menu-label pt-0 mt-0">
                            
                            <span>Main Menu</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('welcome')}}">
                                <i class="iconoir-home-simple menu-icon"></i>
                                <span>Dashboards</span>
                            </a>
                        </li>
                        
                        {{-- Users --}}
                        <li class="menu-label mt-2">
                            <small class="label-border">
                                <div class="border_left hidden-xs"></div>
                                <div class="border_right"></div>
                            </small>
                            <span>Gestions d'Utilisateurs</span>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#userManagement" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="userManagement">
                                <i class="iconoir-community menu-icon"></i>
                                <span>Utilisateurs</span>
                            </a>
                            <div class="collapse " id="userManagement">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Liste Utilisateurs</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Personnels</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Droits d'accés</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="iconoir-group menu-icon"></i>
                                <span>Patients</span>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarAdvancedUI" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarAdvancedUI">
                                <i class="iconoir-hospital menu-icon"></i>
                                <span>Cabinets</span>
                            </a>
                            <div class="collapse " id="sidebarAdvancedUI">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Liste des cabinets</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('services.index')}}">Services</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('specialities.index')}}">Specialités</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('regions.index')}}">Régions</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('villes.index')}}">Villes</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        {{-- Espace Patient --}}
                        <li class="menu-label mt-2">
                            <small class="label-border">
                                <div class="border_left hidden-xs"></div>
                                <div class="border_right"></div>
                            </small>
                            <span>Espace Patients</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="iconoir-calendar menu-icon"></i>
                                <span>Rendez-Vous</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="iconoir-health-shield menu-icon"></i>
                                <span>Traitements</span>
                            </a>
                        </li>

                        {{-- Espace User --}}
                        <li class="menu-label mt-2">
                            <small class="label-border">
                                <div class="border_left hidden-xs"></div>
                                <div class="border_right"></div>
                            </small>
                            <span>Espace Utilisateur</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="iconoir-user-square menu-icon"></i>
                                <span>Mon Profile</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="iconoir-log-out menu-icon"></i>
                                <span>Déconnexion</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>   
    </div>
   
    <div class="startbar-overlay d-print-none"></div>