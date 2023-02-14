<header>
    <nav class="head-isi navbar justify-content-between" id="head-isi">
        <div class="head-left-side navbar d-flex">
            @if(Auth::check())
                <div class="head-taskbar navbar me-2">
                    <button class="head-button" id="taskbar-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"></path>
                        </svg>
                    </button>
                </div>
            @endif
            <a href="{{ route('dashboard') }}" class="ms-2">
                <div class="navbar head-logo">
                    <img class="navbar-toggler-icon me-3" src="../../asset/logo_rumah jurnal 1.png">
                    <p id="nama-aplikasi" style="font-weight: bold;">Rumah Jurnal</p>
                </div>
            </a>
        </div>
        <div class="head-right-side navbar justify-content-end">
            <div class="head-search me-2" id="button-search">
                <button type="button" name="head-search" id="search-btn" class="head-button dot">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                    </svg>
                </button>
            </div>
            @if(Auth::check())
                <div class="head-notif navbar mx-2">
                    <button class="head-button" id="button-notif">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"></path>
                        </svg>
                        @php
                            $notif = 0
                        @endphp
                        @php
                            $notRead = 0
                        @endphp
                            @foreach (Auth::user()->unreadNotifications as $notification)
                                @if (Auth::user()->id == $notification->data['to'])
                                    @php
                                        $notRead += 1
                                    @endphp
                                @endif
                            @endforeach
                            @foreach (Auth::user()->notifications as $notification)
                                @if (Auth::user()->id == $notification->data['to'])
                                    @php
                                        $notif += 1
                                    @endphp
                                @endif
                            @endforeach
                        @if($notRead > 0)
                            <span class="position-absolute translate-middle badge rounded-pill bg-danger">
                                {{ $notRead; }}
                            </span>
                        @endif
                    </button>
                    <ul class="dropdown-menu" style="display: none;" id="dropdown-notif">
                        <li class="label-dropdown">Notifikasi</li>
                        @if($notif > 0)
                            @foreach (Auth::user()->unreadNotifications as $notification)
                                @if(Auth::user()->status == "Penulis" && Auth::user()->id == $notification->data['to'])
                                    <li class="notif-isi d-flex align-items-center">
                                        <span class="mx-2 p-1 bg-2 rounded-circle">
                                        </span>
                                        <div>
                                            <p class="notif-isi-head position-relative">{{$notification->data['message']}}</p>
                                            <div class="notif-isi-waktu">
                                                @php
                                                    $minute = date_diff( date_create(), date_create($notification->created_at) )->format("%I");
                                                @endphp
                                                @php
                                                    $hour = date_diff( date_create(), date_create($notification->created_at) )->format("%H");
                                                @endphp
                                                @php
                                                    $day = date_diff( date_create(), date_create($notification->created_at) )->format("%a");
                                                @endphp
                                                @if($day != 0 && $hour > 24)
                                                    <p>{{$day}} Days 
                                                @elseif ($hour > 0 && $hour < 24)
                                                    <p>{{$hour}} Hours 
                                                @else
                                                    <p>{{$minute}} Minutes 
                                                @endif
                                                Ago</p>
                                                <p class="view-full"><a href="../article/{{$notification->data['judul_artikel']}}" class="view-full">Lihat Artikel</a></p>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                            @foreach (Auth::user()->readnotifications as $notification)
                                @if(Auth::user()->status == "Penulis" && Auth::user()->id == $notification->data['to'])
                                    <li class="notif-isi d-flex align-items-center">
                                        <span class="mx-2 p-1">
                                        </span>
                                        <div>
                                            <p class="notif-isi-head position-relative">{{$notification->data['message']}}</p>
                                            <div class="notif-isi-waktu">
                                                @php
                                                    $minute = date_diff( date_create(), date_create($notification->created_at) )->format("%I");
                                                @endphp
                                                @php
                                                    $hour = date_diff( date_create(), date_create($notification->created_at) )->format("%H");
                                                @endphp
                                                @php
                                                    $day = date_diff( date_create(), date_create($notification->created_at) )->format("%a");
                                                @endphp
                                                @if($day != 0 && $hour > 24)
                                                    <p>{{$day}} Days 
                                                @elseif ($hour > 0 && $hour < 24)
                                                    <p>{{$hour}} Hours 
                                                @else
                                                    <p>{{$minute}} Minutes 
                                                @endif
                                                Ago</p>
                                                <p class="view-full"><a href="../article/{{$notification->data['judul_artikel']}}" class="view-full">Lihat Artikel</a></p>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        @else
                            <li>Tidak ada Notifikasi</li>
                        @endif
                    </ul>
                </div>
                <div class="head-profile navbar ms-2">
                    <button class="head-button dot" id="button-profile">
                        @if(isset(Auth::user()->foto_profil))
                        <img src="{{ 'storage/profile-image/'.Auth::user()->foto_profil }}" id="uploadedIMG" class="profile_img">
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" id="blank-pp" class="bi bi-person-circle" viewBox="0 0 16 16" style="display: block; opacity: 0.75;">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                        </svg>
                        @endif
                    </button>
                    <ul class="dropdown-menu" style="display: none;" id="dropdown-profile">
                        <li class="user-profile label-dropdown">
                            @if(isset(Auth::user()->foto_profil))
                            <img src="{{ 'storage/profile-image/'.Auth::user()->foto_profil }}" id="uploadedIMG" class="profile_img">
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" id="blank-pp" class="bi bi-person-circle" viewBox="0 0 16 16" style="display: block; opacity: 0.75;">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                            </svg>
                            @endif
                            <h3>{{ Auth::user()->username }}</h3>
                            <p>{{ Auth::user()->status }}</p>
                        </li>
                        <a href="{{ route('profile') }}">
                            <li>Profile</li>
                        </a>
                        <a href="{{ route('logout') }}">
                            <li id="logout">Log Out</li>
                        </a>
                    </ul>
                </div>
            @else
                <div class="head-profile navbar ms-2">
                    <a href="{{ route('loginShow') }}" class="head-button btn full-1 py-1 px-2" id="button-profile">LOGIN</a>
                </div>
            @endif
        </div>
    </nav>
    
    <div class="head-modal form-modal" style="display: none;">
        <div class="fliter-form h-auto p-3" id="form_search">
            <div class="form-card card col-md-8">
                <div class="mx-3">
                    <form action="" class="card-head d-flex flex-wrap justify-content-center p-3 pt-0">
                        <div class="w-100 mb-3 row justify-content-between">
                            <h3 class="col-auto">Search</h3>
                            <button class="btn col-auto" type="button" >X</button>
                        </div>
                        <div class="col-auto searchbar search-label justify-content-center full-1" style="box-shadow: none;">
                            <div class="dot border-0" style="background-color: unset;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="col-10 searchbar search-value justify-content-center line-1">
                            <input class="w-100" type="text" name="search" id="search" placeholder="Search">
                        </div>
                    </form>
                    <div class="w-100 se-se-bar drop-select ddShow" id="dropdown-search">
                            <ul class="select-droped h-auto">
                                <a href="">
                                    <li class="d-flex m-3 border-bottom rounded-1 line-1">
                                        <div class="col-4 p-2">
                                            <img src="" alt="Prodi">
                                        </div>
                                        <div class="flex-grow-1 flex-column justify-content-between p-2">
                                            <div class="">Judul Artikel</div>
                                            <div class="">Penulis</div>
                                        </div>
                                    </li>
                                </a>
                                <a href="">
                                    <li class="d-flex m-3 border-bottom rounded-1 line-1">
                                        <div class="col-4 p-2">
                                            <img src="" alt="Prodi">
                                        </div>
                                        <div class="flex-grow-1 flex-column justify-content-between p-2">
                                            <div class="">Judul Artikel</div>
                                            <div class="">Penulis</div>
                                        </div>
                                    </li>
                                </a>
                                <a href="">
                                    <li class="d-flex m-3 border-bottom rounded-1 line-1">
                                        <div class="col-4 p-2">
                                            <img src="" alt="Prodi">
                                        </div>
                                        <div class="flex-grow-1 flex-column justify-content-between p-2">
                                            <div class="">Judul Artikel</div>
                                            <div class="">Penulis</div>
                                        </div>
                                    </li>
                                </a>
                                <a href="">
                                    <li class="d-flex m-3 border-bottom rounded-1 line-1">
                                        <div class="col-4 p-2">
                                            <img src="" alt="Prodi">
                                        </div>
                                        <div class="flex-grow-1 flex-column justify-content-between p-2">
                                            <div class="">Judul Artikel</div>
                                            <div class="">Penulis</div>
                                        </div>
                                    </li>
                                </a>
                                <a href="">
                                    <li class="d-flex m-3 border-bottom rounded-1 line-1">
                                        <div class="col-4 p-2">
                                            <img src="" alt="Prodi">
                                        </div>
                                        <div class="flex-grow-1 flex-column justify-content-between p-2">
                                            <div class="">Judul Artikel</div>
                                            <div class="">Penulis</div>
                                        </div>
                                    </li>
                                </a>
                                <a href="">
                                    <li class="d-flex m-3 border-bottom rounded-1 line-1">
                                        <div class="col-4 p-2">
                                            <img src="" alt="Prodi">
                                        </div>
                                        <div class="flex-grow-1 flex-column justify-content-between p-2">
                                            <div class="">Judul Artikel</div>
                                            <div class="">Penulis</div>
                                        </div>
                                    </li>
                                </a>
                            </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</header>