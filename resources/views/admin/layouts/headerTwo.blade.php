<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
      <div class="navbar">
        <div class="container-xl">
          <div class="row flex-fill align-items-center">
            <div class="col">
              <ul class="navbar-nav">
                <li class="nav-item {{request()->routeIs("admin.home") ? 'active' : ''}}">
                  <a class="nav-link" href="{{route("admin.home")}}" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                    </span>
                    <span class="nav-link-title">
                      الرئيسية
                    </span>
                  </a>
                </li>

                <li class="nav-item {{request()->routeIs("admin.subscrption.*") ? 'active' : ''}}">
                  <a class="nav-link" href="{{route("admin.subscrption.index")}}" >
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database-exclamation" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M4 6c0 1.657 3.582 3 8 3s8 -1.343 8 -3s-3.582 -3 -8 -3s-8 1.343 -8 3" />
                      <path d="M4 6v6c0 1.657 3.582 3 8 3c1.118 0 2.182 -.086 3.148 -.241m4.852 -2.759v-6" />
                      <path d="M4 12v6c0 1.657 3.582 3 8 3c1.064 0 2.079 -.078 3.007 -.22" />
                      <path d="M19 16v3" />
                      <path d="M19 22v.01" />
                    </svg>
                    <span class="nav-link-title">
                       الاشتراكات
                    </span>
                  </a>
                </li>


                <li class="nav-item {{request()->routeIs("admin.almustawayat.*") ? 'active' : ''}}">
                  <a class="nav-link" href="{{route("admin.almustawayat.index")}}" >
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-military-rank" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M17 7v13h-10v-13l5 -3z" />
                      <path d="M10 13l2 -1l2 1" />
                      <path d="M10 17l2 -1l2 1" />
                      <path d="M10 9l2 -1l2 1" />
                    </svg>
                    <span class="nav-link-title">
                      المستويات
                    </span>
                  </a>
                </li>

                <li class="nav-item {{request()->routeIs("admin.slider") || request()->routeIs("admin.slider.*") ? 'active' : ''}}">
                  <a class="nav-link" href="{{route("admin.slider")}}" >
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-photo-filled" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M8.813 11.612c.457 -.38 .918 -.38 1.386 .011l.108 .098l4.986 4.986l.094 .083a1 1 0 0 0 1.403 -1.403l-.083 -.094l-1.292 -1.293l.292 -.293l.106 -.095c.457 -.38 .918 -.38 1.386 .011l.108 .098l4.674 4.675a4 4 0 0 1 -3.775 3.599l-.206 .005h-12a4 4 0 0 1 -3.98 -3.603l6.687 -6.69l.106 -.095zm9.187 -9.612a4 4 0 0 1 3.995 3.8l.005 .2v9.585l-3.293 -3.292l-.15 -.137c-1.256 -1.095 -2.85 -1.097 -4.096 -.017l-.154 .14l-.307 .306l-2.293 -2.292l-.15 -.137c-1.256 -1.095 -2.85 -1.097 -4.096 -.017l-.154 .14l-5.307 5.306v-9.585a4 4 0 0 1 3.8 -3.995l.2 -.005h12zm-2.99 5l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007z" stroke-width="0" fill="currentColor" />
                    </svg>
                    <span class="nav-link-title">
                      السلايدر
                    </span>
                  </a>
                </li>


                <li class="nav-item dropdown {{request()->routeIs("admin.manger.*")  ? 'active' : ''}}">
                  <a class="nav-link dropdown-toggle" href="#navbar-layout" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users-plus" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M5 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                      <path d="M3 21v-2a4 4 0 0 1 4 -4h4c.96 0 1.84 .338 2.53 .901" />
                      <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                      <path d="M16 19h6" />
                      <path d="M19 16v6" />
                    </svg>
                    <span class="nav-link-title">
                      المستخدمون
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
                        <a class="dropdown-item" href="{{route("admin.manger.index")}}">
                          المدراء
                        </a>
                        <a class="dropdown-item" href="{{route("admin.users.index")}}">
                          المحفظون
                        </a>
                        <a class="dropdown-item" href="{{route("admin.talibs.index")}}">
                          الحافظون
                        </a>
                       
                      </div>
                    </div>
                  </div>
                </li>

                

                
                <li class="nav-item dropdown {{request()->routeIs("admin.manger.*")  ? 'active' : ''}}">
                  <a class="nav-link dropdown-toggle" href="#navbar-layout" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bell-heart" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M10 17h-6a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6a2 2 0 1 1 4 0a7 7 0 0 1 4 6" />
                      <path d="M9 17v1c0 1.408 .97 2.59 2.28 2.913" />
                      <path d="M18 22l3.35 -3.284a2.143 2.143 0 0 0 .005 -3.071a2.242 2.242 0 0 0 -3.129 -.006l-.224 .22l-.223 -.22a2.242 2.242 0 0 0 -3.128 -.006a2.143 2.143 0 0 0 -.006 3.071l3.355 3.296z" />
                    </svg>
                    <span class="nav-link-title">
                      الحلقات
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
                      
                        <a class="dropdown-item" href="{{route("admin.alhalaqat.index")}}">
                          استعراض الحلقات
                        </a>
                      </div>
                    </div>
                  </div>
                </li>


                <li class="nav-item {{request()->routeIs("admin.pages.*")? 'active' : ''}}">
                  <a class="nav-link" href="{{route("admin.pages.index")}}" >
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-stars-filled" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M17.657 12.007a1.39 1.39 0 0 0 -1.103 .765l-.855 1.723l-1.907 .277c-.52 .072 -.96 .44 -1.124 .944l-.038 .14c-.1 .465 .046 .954 .393 1.29l1.377 1.337l-.326 1.892a1.393 1.393 0 0 0 2.018 1.465l1.708 -.895l1.708 .896a1.388 1.388 0 0 0 1.462 -.105l.112 -.09a1.39 1.39 0 0 0 .442 -1.272l-.325 -1.891l1.38 -1.339c.38 -.371 .516 -.924 .352 -1.427l-.051 -.134a1.39 1.39 0 0 0 -1.073 -.81l-1.907 -.278l-.853 -1.722a1.393 1.393 0 0 0 -1.247 -.773l-.143 .007z" stroke-width="0" fill="currentColor" />
                      <path d="M6.057 12.007a1.39 1.39 0 0 0 -1.103 .765l-.855 1.723l-1.907 .277c-.52 .072 -.96 .44 -1.124 .944l-.038 .14c-.1 .465 .046 .954 .393 1.29l1.377 1.337l-.326 1.892a1.393 1.393 0 0 0 2.018 1.465l1.708 -.895l1.708 .896a1.388 1.388 0 0 0 1.462 -.105l.112 -.09a1.39 1.39 0 0 0 .442 -1.272l-.324 -1.891l1.38 -1.339c.38 -.371 .516 -.924 .352 -1.427l-.051 -.134a1.39 1.39 0 0 0 -1.073 -.81l-1.908 -.279l-.853 -1.722a1.393 1.393 0 0 0 -1.247 -.772l-.143 .007z" stroke-width="0" fill="currentColor" />
                      <path d="M11.857 2.007a1.39 1.39 0 0 0 -1.103 .765l-.855 1.723l-1.907 .277c-.52 .072 -.96 .44 -1.124 .944l-.038 .14c-.1 .465 .046 .954 .393 1.29l1.377 1.337l-.326 1.892a1.393 1.393 0 0 0 2.018 1.465l1.708 -.894l1.709 .896a1.388 1.388 0 0 0 1.462 -.105l.112 -.09a1.39 1.39 0 0 0 .442 -1.272l-.325 -1.892l1.38 -1.339c.38 -.371 .516 -.924 .352 -1.427l-.051 -.134a1.39 1.39 0 0 0 -1.073 -.81l-1.908 -.279l-.853 -1.722a1.393 1.393 0 0 0 -1.247 -.772l-.143 .007z" stroke-width="0" fill="currentColor" />
                    </svg>
                    <span class="nav-link-title">
                      الصفحات
                    </span>
                  </a>
                </li>

                <li class="nav-item {{request()->routeIs("admin.sessions.*")? 'active' : ''}}">
                  <a class="nav-link" href="{{route("admin.sessions.index")}}" >
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-stars-filled" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M17.657 12.007a1.39 1.39 0 0 0 -1.103 .765l-.855 1.723l-1.907 .277c-.52 .072 -.96 .44 -1.124 .944l-.038 .14c-.1 .465 .046 .954 .393 1.29l1.377 1.337l-.326 1.892a1.393 1.393 0 0 0 2.018 1.465l1.708 -.895l1.708 .896a1.388 1.388 0 0 0 1.462 -.105l.112 -.09a1.39 1.39 0 0 0 .442 -1.272l-.325 -1.891l1.38 -1.339c.38 -.371 .516 -.924 .352 -1.427l-.051 -.134a1.39 1.39 0 0 0 -1.073 -.81l-1.907 -.278l-.853 -1.722a1.393 1.393 0 0 0 -1.247 -.773l-.143 .007z" stroke-width="0" fill="currentColor" />
                      <path d="M6.057 12.007a1.39 1.39 0 0 0 -1.103 .765l-.855 1.723l-1.907 .277c-.52 .072 -.96 .44 -1.124 .944l-.038 .14c-.1 .465 .046 .954 .393 1.29l1.377 1.337l-.326 1.892a1.393 1.393 0 0 0 2.018 1.465l1.708 -.895l1.708 .896a1.388 1.388 0 0 0 1.462 -.105l.112 -.09a1.39 1.39 0 0 0 .442 -1.272l-.324 -1.891l1.38 -1.339c.38 -.371 .516 -.924 .352 -1.427l-.051 -.134a1.39 1.39 0 0 0 -1.073 -.81l-1.908 -.279l-.853 -1.722a1.393 1.393 0 0 0 -1.247 -.772l-.143 .007z" stroke-width="0" fill="currentColor" />
                      <path d="M11.857 2.007a1.39 1.39 0 0 0 -1.103 .765l-.855 1.723l-1.907 .277c-.52 .072 -.96 .44 -1.124 .944l-.038 .14c-.1 .465 .046 .954 .393 1.29l1.377 1.337l-.326 1.892a1.393 1.393 0 0 0 2.018 1.465l1.708 -.894l1.709 .896a1.388 1.388 0 0 0 1.462 -.105l.112 -.09a1.39 1.39 0 0 0 .442 -1.272l-.325 -1.892l1.38 -1.339c.38 -.371 .516 -.924 .352 -1.427l-.051 -.134a1.39 1.39 0 0 0 -1.073 -.81l-1.908 -.279l-.853 -1.722a1.393 1.393 0 0 0 -1.247 -.772l-.143 .007z" stroke-width="0" fill="currentColor" />
                    </svg>
                    <span class="nav-link-title">
                      الفصول | تيرم
                    </span>
                  </a>
                </li>


                
                <li class="nav-item {{request()->routeIs("admin.settings.create.database")? 'active' : ''}}">
                  <a class="nav-link" href="{{route("admin.settings.create.database")}}" >
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database-edit" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M4 6c0 1.657 3.582 3 8 3s8 -1.343 8 -3s-3.582 -3 -8 -3s-8 1.343 -8 3" />
                      <path d="M4 6v6c0 1.657 3.582 3 8 3c.478 0 .947 -.016 1.402 -.046" />
                      <path d="M20 12v-6" />
                      <path d="M4 12v6c0 1.526 3.04 2.786 6.972 2.975" />
                      <path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" />
                    </svg>
                    <span class="nav-link-title">
                       قاعدة البيانات
                    </span>
                  </a>
                </li>
           

           
              </ul>
            </div>
            <div class="col-2 d-none d-xxl-block">
              <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
                <form action="./" method="get" autocomplete="off" novalidate>
                  <div class="input-icon">
                    <span class="input-icon-addon">
                      <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                    </span>
                    <input type="text" value="" class="form-control" placeholder="Search…" aria-label="Search in website">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>