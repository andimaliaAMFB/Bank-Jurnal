<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rumah Jurnal - Bank Jurnal</title>
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
        <!-- CSS Only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="../../Style.css">
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
                                    <img src="" alt="">
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
                            <a href="{{ route('article.create') }}"><li>Upload Artikel</li></a>
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
        @if ($errors->any())
            <div class="alert alert-danger alert-block ">
                <strong>Kesalahan Input: </strong>
                <br>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
        <main>
            <div class="main-isi" id="main-isi">
                <div class="judul-hlm"><h2>{{ $title }}</h2></div>
                
                @if($title == 'Upload Artikel')
                <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
                @elseif(str_contains($title,'Upload Revisi Artikel'))
                <form action="{{ route('article.restore') }}" method="POST" enctype="multipart/form-data">
                @endif
                {{ csrf_field() }}
                    <div class="card form">
                        <div class="form_sub row" id="profile">
                            <div class="form_sub_title w-100">Penulis</div>
                            <div class="row w-100 gx-0 py-3 px-3 form-sub">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>Penulis 1</div>
                                    <div>
                                        <button type="button" class="cancel-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="select d-flex flex-wrap align-items-center px-3 my-2">
                                    <div class="col-md-3">Nama Penulis</div>
                                    <div class="col-md-9 search_input d-flex flex-wrap" id="pnl-1">
                                        <div class="searchbar searchFull search-value w-100">
                                            <input class="w-100 text-center" type="text" name="pnl-1" id="pnl-1" placeholder="Nama Penulis">
                                            <button type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                                    <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"></path>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="searchbar search-dd drop-select w-100" style="height: 0;">
                                            <div class="w-100 se-se-bar d-flex flex-column justify-content-between" id="dropdown-pnl">
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
                                <div class="input d-flex flex-wrap align-items-center px-3 my-2" id="text-pnl-1">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-9 search_input d-flex flex-wrap">
                                        <div class="searchbar w-100">
                                            <input class="w-100" type="text" name="pnl-1" id="pnl-1" placeholder="[Nama Penulis]">
                                        </div>
                                    </div>
                                </div>
                                <div class="select d-flex flex-wrap align-items-center px-3 my-2">
                                    <div class="col-md-3">Program Studi</div>
                                    <div class="col-md-9 search_input d-flex flex-wrap" id="prodi-1">
                                        <div class="searchbar searchFull search-value w-100">
                                            <input class="w-100 text-center" type="text" name="prodi-1" id="prodi-1" placeholder="Program Studi">
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
                                <div class="input d-flex flex-wrap align-items-center px-3 my-2" id="text-prodi-1">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-9 search_input d-flex flex-wrap">
                                        <div class="searchbar w-100">
                                            <input class="w-100" type="text" name="prodi-1" id="prodi-1" placeholder="[Program Studi]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row w-100 gx-0 py-3 px-3 w-100 justify-content-center form-sub addBox border-0">
                                <button type="button" class="btn add-btn col-md-9">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill me-3" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"></path>
                                    </svg>
                                    <p>Tambah Penulis</p>
                                </button>
                            </div>
                        </div>
                        <div class="form_sub row" id="artikel">
                            <div class="form_sub_title w-100">Upload Artikel</div>
                            <div class="row w-100 gx-0 py-3 px-3 form-sub border-0">
                                <div class="d-flex flex-wrap align-items-center px-3 my-2" id="text-jdl">
                                    <div class="col-md-3">Judul Artikel</div>
                                    <div class="col-md-9 search_input d-flex flex-wrap">
                                        <div class="col-10 searchbar w-100">
                                            <input type="text" name="jdl" id="jdl" placeholder="[Judul Artikel]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-sub addBox border-0 d-flex justify-content-center">
                                <div class="drop-file searchbar p-3 w-75 flex-column h-auto">
                                    <div class="drop-file__prompt text-center w-100 d-flex flex-column align-items-center justify-content-center">
                                        <p>Drop File</p>
                                        <p>or</p>
                                        <p class="link">Browser</p>
                                    </div>
                                    <input type="file" name="doc" class="drop-file__input" accept="application/pdf, application/vnd.msword">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end px-4 my-3">
                        <button type="submit" class="btn submit-btn col-md-2">Upload Artikel</button>
                    </div>
                </form>
            </div>
        </main>
        <footer>

        </footer>
        <div class="shade fade" id="shade"></div>
        <!-- JS comunicate with database -->
        <script type="text/javascript">
            var penulis = <?php echo json_encode($tablePenulis); ?>;
            var prodi = <?php echo json_encode($tableProdi); ?>;

            let list_judul = [];
            let list_penulis = [];
            penulis.forEach((element,index) => { list_penulis[index] = penulis[index]['NAMA_PENULIS']; });
            let list_prodi = [];
            prodi.forEach((element,index) => { list_prodi[index] = prodi[index]['NAMA_JURUSAN']; });
            let final_list = [];

            var list_up_penulis = [];
            var list_up_penulis_text = [];
            var list_up_prodi = [];
            var list_up_prodi_text = [];

            var countPenulis_old = 3 - 1;

        </script>
        <!-- JS comunicate with database -->
        <script src="../../Script.js"></script>
        <script type="text/javascript">
            if (document.querySelector(`.judul-hlm`).textContent.includes('Upload Revisi Artikel')) {
                console.log('This is Revision Upload Page');
            }
            while (countPenulis_old > 0) {
                form_page.forEach(form => {
                    if (form.id == 'profile') {
                        var form_list = form.querySelectorAll(`.form-sub`);
                        if (form_list) {
                            form_list.forEach(list => {
                                if (list.classList.contains('addBox')) {
                                    form_addPenulis(form, list);
                                    if (form.childElementCount == 6) { 
                                        list.style.display = "none";
                                    }
                                    ThisForm = document.querySelector(`.form_sub.row#profile`);
                                    if (ThisForm) {
                                        // console.log(ThisForm.childElementCount, ThisForm.querySelectorAll(`.form-sub`).length);
                                        ThisForm.querySelectorAll(`.form-sub`).forEach((item,itemIndex) => {
                                            if (!item.classList.contains(`addBox`)) {
                                                // console.log("Lenght: ",ThisForm.querySelectorAll(`.form-sub`).length, " | itemIndex: ",itemIndex,item);
                                                // console.log(item,item.querySelectorAll(`input`));
                                                // console.log("replace_id_list(item.outerHTML,", itemIndex+1,")");
    
                                                item.querySelectorAll(`input`).forEach(input => {
                                                    // console.log("Before: ",input.name," | ",input.id," | ",input.outerHTML);
                                                    input.name = replace_id_list(input.name, itemIndex+1);
                                                    input.id = replace_id_list(input.id, itemIndex+1);
                                                    input.outerHTML = replace_id_list(input.outerHTML, itemIndex+1);
                                                    // console.log("After: ",input.name," | ",input.id," | ",input.outerHTML);
                                                })
                                                item.outerHTML = replace_id_list(item.outerHTML, itemIndex+1);
                                            }
                                        });
                                    }
                                    countPenulis_old -= 1;
                                }
                            });
                        }
                    }
                });
            }
        </script>
    </body>
</html>
