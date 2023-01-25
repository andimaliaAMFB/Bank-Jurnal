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
        <link rel="stylesheet" href="Style.css">
    </head>
    <body>
        <header>
            <nav class="head-isi navbar justify-content-between" id="head-isi">
                <div class="head-left-side navbar d-flex">
                    <div class="head-taskbar navbar me-2">
                        <button class="head-button" id="taskbar-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"></path>
                            </svg>
                        </button>
                    </div>
                    <a href="<?php echo url('home') ?>" class="ms-2">
                        <div class="navbar head-logo">
                            <img class="navbar-toggler-icon me-3" src="../asset/logo_rumah jurnal 1.png">
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
                                <h3>Username</h3>
                                <p>Peran</p>
                            </li>
                            <a href="<?php echo url('profile', ['id' => $id]) ?>">
                                <li>Profile</li>
                            </a>
                            <li id="logout">Log Out</li>
                        </ul>
                    </div>
                </div>
            </nav>
            
            <div class="head-modal form-modal show" style="display: none;">
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
                    <a href="<?php echo url('home') ?>" class="ms-2">
                        <div class="navbar head-logo">
                            <img class="navbar-toggler-icon me-3" src="../asset/logo_rumah jurnal 1.png">
                            <p id="nama-aplikasi" style="font-weight: bold;">Rumah Jurnal</p>
                        </div>
                    </a>
                </div>
                <div class="task-content">
                    <ul>
                        <a href="<?php echo url('home') ?>"><li>Dashboard</li></a>
                        <a href="<?php echo url('upload', ['id' => $id]) ?>"><li>Upload Artikel</li></a>
                        <a href="<?php echo url('draft') ?>"><li>Draft<p>10</p></li></a>
                        <a href="<?php echo url('revisi-minor') ?>"><li>Revisi Minor<p>100</p></li></a>
                        <a href="<?php echo url('revisi-mayor') ?>"><li>Revisi Mayor<p>0</p></li></a>
                        <a href="<?php echo url('layak-publish') ?>"><li>Layak Publish<p>10</p></li></a>
                    </ul>
                </div>
            </div>
        </div>
        
        <main>
            <div class="main-isi" id="main-isi">
                <div class="detail-artikel">
                    <div class="card">
                        <div class="card-head d-flex flex-wrap align-items-center p-3 m-0 mx-3">
                            <div class="col-3 p-3">
                                <img src="" alt="">
                            </div>
                            <div class="col-9 text-start p-3">
                                <h3>Judul</h3>
                                <p>Tahun</p>
                                <p>Penulis</p>
                                <p>Abstrak</p>
                            </div>
                        </div>
                        <div class="card-body article d-flex flex-column px-4">
                            <embed src="asset/jadwal S1.pdf" width="100%" height="100%">
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer>

        </footer>
        <div class="shade fade" id="shade"></div>
        
        <!-- JS comunicate with database -->
        <!-- <script>
            var tryExport = 3;
        </script> -->
        <!-- JS comunicate with database -->

        <script src="Script.js"></script>
    </body>
</html>