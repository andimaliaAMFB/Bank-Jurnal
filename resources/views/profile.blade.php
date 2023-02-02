<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rumah Jurnal - Bank Jurnal</title>
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
        <!-- CSS Only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="../Style.css">
    </head>
    <body>
        <header>
            <nav class="head-isi navbar justify-content-between" id="head-isi">
                <div class="head-left-side navbar d-flex">
                    @if(isset($arrayAkun[0]['ID_AKUN']))
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
                    @if(isset($arrayAkun[0]['ID_AKUN']))
                        <div class="head-notif navbar mx-2">
                            <button class="head-button" id="button-notif">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"></path>
                                </svg>
                            </button>
                            <ul class="dropdown-menu" style="display: none;" id="dropdown-notif">
                                <li class="label-dropdown">Notifikasi</li>
                                <li class="notif-isi">
                                    <p class="notif-isi-head">Artikel Baru Telah Terdaftar</p>
                                    <div class="notif-isi-waktu">
                                        <p>30 days Ago</p>
                                        <p class="view-full">View Full Notification</p>
                                    </div>
                                </li>
                                <li class="notif-isi">
                                    <p class="notif-isi-head">Artikel Baru Telah Terdaftar</p>
                                    <div class="notif-isi-waktu">
                                        <p>30 days Ago</p>
                                        <p class="view-full">View Full Notification</p>
                                    </div>
                                </li>
                                <li class="view-all">See Full Notification</li>
                            </ul>
                        </div>
                        <div class="head-profile navbar ms-2">
                            <button class="head-button dot" id="button-profile">P</button>
                            <ul class="dropdown-menu" style="display: none;" id="dropdown-profile">
                                <li class="user-profile label-dropdown">
                                    <img src="" alt="" class="profile_img">
                                    <h3>{{ $arrayAkun[0]['USERNAME'] }}</h3>
                                    <p>{{ $arrayAkun[0]['STATUS_AKUN'] }}</p>
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
                                <h3 class="w-100 mb-3">Search</h3>
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
        @if(isset($arrayAkun[0]['ID_AKUN']))
            <div class="taskbar-isi" id="taskbar" style="display: none;">
                <div class="taskbar-content">
                    <div class="task-head navbar col-auto d-flex">
                        <div class="head-taskbar navbar me-2">
                            <button class="head-button" id="taskbar-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"></path>
                                </svg>
                            </button>
                        </div>
                        <a href="{{ route('dashboard') }}" class="ms-2">
                            <div class="navbar head-logo">
                                <img class="navbar-toggler-icon me-3" src="../../asset/logo_rumah jurnal 1.png">
                                <p id="nama-aplikasi" style="font-weight: bold;">Rumah Jurnal</p>
                            </div>
                        </a>
                    </div>
                    <div class="task-content">
                        <ul>
                            <a href="{{ route('dashboard') }}"><li>Dashboard</li></a>
                            <a href="{{ route('upload.create') }}"><li>Upload Artikel</li></a>
                            @if(isset($arrayAkun[0]['STATUS_AKUN']) && $arrayAkun[0]['STATUS_AKUN'] == 'Admin')
                            <a href="{{ route('status.index', ['level_status' => 'draft']) }}"><li>Draft<p>{{ $taskbarValue['Draft'] }}</p></li></a>
                            <a href="{{ route('status.index', ['level_status' => 'revisi-mayor']) }}"><li>Revisi Mayor<p>{{ $taskbarValue['Revisi Mayor'] }}</p></li></a>
                            <a href="{{ route('status.index', ['level_status' => 'revisi-minor']) }}"><li>Revisi Minor<p>{{ $taskbarValue['Revisi Minor'] }}</p></li></a>
                            @elseif(isset($arrayAkun[0]['STATUS_AKUN']) && $arrayAkun[0]['STATUS_AKUN'] == 'Penulis')
                            <a href="{{ route('myarticle') }}"><li>My Article</li></a>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block d-flex justify-content-between align-items-center">
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <main>
            <div class="main-isi" id="main-isi">
                <form action="{{ route('profile.update', ['id' => $arrayAkun[0]['ID_AKUN']]) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                    <div class="card form">
                        <div class="card-head justify-content-center">
                            <h3>Profile</h3>
                        </div>
                        <div class="card-body row" id="profile">
                            <div class="d-flex box flex-grow-1">
                                <div class="form_sub_list col-md-3 img_add" id="img-profile">
                                    <label for="img-input" class="btn">
                                        @if(isset($arrayAkun[0]['FOTO_PROFIL']))
                                        <img src="{{ 'storage/profile-image/'.$arrayAkun[0]['FOTO_PROFIL'] }}" id="uploadedIMG" class="profile_img">
                                        @else
                                        <img src="" id="uploadedIMG" class="profile_img">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" id="blank-pp" class="bi bi-person-circle" viewBox="0 0 16 16" style="display: block; opacity: 0.75;">
                                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                        </svg>
                                        @endif
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                        </svg>
                                    </label>
                                    <input class="form-file" id="img-input" type="file" name="imageup" style="display:none; visibility: none;" onchange="priviewImage();"/>
                                    
                                </div>
                                <div class="ms-3 flex-grow-1 profile-text d-flex flex-column justify-content-center form_sub">
                                    <div><h4>{{ $arrayAkun[0]['USERNAME'] }}</h4></div>
                                    <div><h5>{{ $arrayAkun[0]['STATUS_AKUN'] }}</h5></div>
                                </div>
                            </div>
                            <div class="mt-3 form_sub row box gx-0">
                                <div class="row col-md-9 gx-0 p-1 form-sub border-0">
                                    <div class="d-flex flex-wrap align-items-center px-3 my-2" id="name">
                                        <div class="form_sub_title w-100">Nama Pengguna</div>
                                        <div class="col-md-12 search_input d-flex flex-wrap w-100">
                                            <div class="searchbar w-100">
                                                <input type="text" name="name" placeholder="[Nama Pengguna]" value="{{ $arrayAkun[0]['NAMA'] }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-md-3 gx-0 p-1 form-sub border-0">
                                    <div class="d-flex flex-wrap align-items-center px-3 my-2" id="username">
                                        <div class="form_sub_title w-100">Username</div>
                                        <div class="col-md-12 search_input d-flex flex-wrap w-100">
                                            <div class="searchbar w-100">
                                                <input class="w-100" type="text" name="username" placeholder="[Username]" value="{{ $arrayAkun[0]['USERNAME'] }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if (isset($arrayAkun[0]['NAMA_JURUSAN']))
                                <div class="row col-md-12 gx-0 p-1 form-sub border-0">
                                    <div class="col-md-6 d-flex flex-wrap align-items-center px-3 my-2" id="prodi">
                                        <div class="form_sub_title w-100">Program Studi</div>
                                        <div class="col-md-6 search_input d-flex flex-wrap w-100">
                                            <div class="searchbar searchFull search-value w-100">
                                                <input type="text" name="prodi" id="prodi" placeholder="[Program Studi]" value="{{ $arrayAkun[0]['NAMA_JURUSAN'] }}">
                                                <button type="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="searchbar search-dd drop-select w-100" style="height: 0;">
                                                <div class="w-100 se-se-bar d-flex flex-column justify-content-between" id="dropdown-prodi">
                                                    <ul class="select-droped">
                                                        <li>point</li>
                                                        <li>point</li>
                                                        <li>point</li>
                                                        <li>point</li>
                                                        <li>point</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="row col-md-12 gx-0 p-1 form-sub border-0">
                                    <div class="col-md-6 d-flex flex-wrap align-items-center px-3 my-2" id="tgl">
                                        <div class="form_sub_title w-100">Tanggal Lahir</div>
                                        <div class="col-md-12 search_input d-flex flex-wrap">
                                            <div class="searchbar w-100 px-3">
                                                <input type="date" name="tgl" style="width:100%;" placeholder="DD-MM-YYYY" value="{{ $arrayAkun[0]['TANGGAL_LAHIR'] }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-md-6 gx-0 p-1 form-sub border-0">
                                    <div class="d-flex flex-wrap align-items-center px-3 my-2" id="tlp">
                                        <div class="form_sub_title w-100">Nomor Telp</div>
                                        <div class="col-md-12 search_input d-flex flex-wrap w-100">
                                            <div class="searchbar w-100">
                                                <input type="text" name="tlp" placeholder="[xxxx-xxxx-xxxx]" value="{{ $arrayAkun[0]['NO_TELEPON'] }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-md-6 gx-0 p-1 form-sub border-0">
                                    <div class="d-flex flex-wrap align-items-center px-3 my-2" id="email">
                                        <div class="form_sub_title w-100">Email</div>
                                        <div class="col-md-12 search_input d-flex flex-wrap w-100">
                                            <div class="searchbar w-100">
                                                <input type="text" name="email" placeholder="[xxxxx@xxxmail.com]" value="{{ $arrayAkun[0]['EMAIL'] }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-md-6 gx-0 p-1 form-sub border-0">
                                    <div class="w-100 d-flex flex-wrap align-items-center px-3 my-2" id="kota">
                                        <div class="form_sub_title w-100">Kota</div>
                                        <div class="col-md-12 search_input d-flex flex-wrap w-100" id="kota">
                                            <div class="searchbar searchFull search-value w-100">
                                                <input type="text" name="kota" id="kota" placeholder="[Kota]" value="{{ $arrayAkun[0]['NAMA_KOTA'] }}">
                                                <button type="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="searchbar search-dd drop-select w-100" style="height: 0;">
                                                <div class="w-100 se-se-bar d-flex flex-column justify-content-between" id="dropdown-kota">
                                                    <ul class="select-droped">
                                                        <li>point</li>
                                                        <li>point</li>
                                                        <li>point</li>
                                                        <li>point</li>
                                                        <li>point</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-md-6 gx-0 p-1 form-sub border-0">
                                    <div class="w-100 d-flex flex-wrap align-items-center px-3 my-2" id="prov">
                                        <div class="form_sub_title w-100">Provinsi</div>
                                        <div class="col-md-12 search_input d-flex flex-wrap w-100">
                                            <div class="searchbar searchFull search-value w-100">
                                                <input type="text" name="prov" id="prov" placeholder="[Provinsi]" value="{{ $arrayAkun[0]['NAMA_PROVINSI'] }}">
                                                <button type="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="searchbar search-dd drop-select w-100" style="height: 0;">
                                                <div class="w-100 se-se-bar d-flex flex-column justify-content-between" id="dropdown-prov">
                                                    <ul class="select-droped">
                                                        <li>point</li>
                                                        <li>point</li>
                                                        <li>point</li>
                                                        <li>point</li>
                                                        <li>point</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-md-9 gx-0 p-1 form-sub border-0">
                                    <div class="d-flex flex-wrap align-items-center px-3 my-2" id="alamat">
                                        <div class="form_sub_title w-100">Alamat</div>
                                        <div class="col-md-12 search_input d-flex flex-wrap w-100">
                                            <div class="searchbar w-100">
                                                <input type="text" name="alamat" placeholder="[Alamat]" value="{{ $arrayAkun[0]['ALAMAT'] }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-md-3 gx-0 p-1 form-sub border-0">
                                    <div class="d-flex flex-wrap align-items-center px-3 my-2" id="pos">
                                        <div class="form_sub_title w-100">Kode Pos</div>
                                        <div class="col-md-12 search_input d-flex flex-wrap w-100">
                                            <div class="searchbar w-100">
                                                <input type="text" name="pos" placeholder="[Kode Pos]" value="{{ $arrayAkun[0]['KODE_POS'] }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <button type="submit" class="btn submit-btn col-auto">Perbarui Profile</button>
                    </div>
                </form>
            </div>
        </main>
        <footer>

        </footer>
        <div class="shade fade" id="shade"></div>
        
        <!-- JS comunicate with database -->
        <script type="text/javascript">
            var prodi = <?php echo json_encode($tableProdi); ?>;
            var kota = <?php echo json_encode($tableKota); ?>;
            var prov = <?php echo json_encode($tableProv); ?>;

            let list_prodi = [];
            prodi.forEach((element,index) => { list_prodi[index] = prodi[index]['NAMA_JURUSAN']; });
            let list_kota = [];
            kota.forEach((element,index) => { list_kota[index] = kota[index]['NAMA_KOTA']; });
            let list_prov = [];
            prov.forEach((element,index) => { list_prov[index] = prov[index]['NAMA_PROVINSI']; });
            let final_list = [];
        </script>
        <!-- JS comunicate with database -->
        <script src="../Script.js"></script>

        <script type="text/javascript">
            function priviewImage(){
                var file = document.getElementById('img-input').files;
                if (file.length > 0) {
                    var fileReader = new FileReader();

                    fileReader.onload = function (event){
                        document.getElementById('uploadedIMG').setAttribute("src",event.target.result)
                    };

                    fileReader.readAsDataURL(file[0]);
                    document.getElementById('blank-pp').style.display = 'none';
                }
            }
        </script>
    </body>
</html>
