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
        @include('layout.header')
        @include('layout.taskbar')

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block d-flex justify-content-between align-items-center">
                <strong>{{ $message }}</strong>
            </div>
        @endif

        @if ($errorList = Session::get('error'))
            <div class="alert alert-danger alert-block d-flex justify-content-between align-items-center">
                <ul style="list-style-type:none; margin:0;">
                @foreach($errorList as $value)
                    <li><strong>{{ $value }}</strong></li>
                @endforeach
                </ul>
            </div>
        @endif
        <main>
            <div class="main-isi" id="main-isi">
                <form action="{{ route('profile.update', ['id' => Auth::user()->id]) }}" method="POST" enctype="multipart/form-data" name="profileAkun">
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
                                        @if(isset(Auth::user()->foto_profil))
                                        <img src="{{ 'storage/profile-image/'.Auth::user()->foto_profil }}" id="uploadedIMG" class="profile_img">
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
                                    <div><h4>{{ Auth::user()->username }}</h4></div>
                                    <div><h5>{{ Auth::user()->status }}</h5></div>
                                </div>
                            </div>
                            <div class="mt-3 form_sub row box gx-0">
                                <div class="row col-md-9 gx-0 p-1 form-sub border-0">
                                    <div class="d-flex flex-wrap align-items-center px-3 my-2" id="name">
                                        <div class="form_sub_title w-100">Nama Pengguna</div>
                                        <div class="col-md-12 search_input d-flex flex-wrap w-100">
                                            <div class="searchbar w-100">
                                                <input type="text" name="name" placeholder="[Nama Pengguna]" value="{{ Auth::user()->nama_lengkap }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-md-3 gx-0 p-1 form-sub border-0">
                                    <div class="d-flex flex-wrap align-items-center px-3 my-2" id="username">
                                        <div class="form_sub_title w-100">Username</div>
                                        <div class="col-md-12 search_input d-flex flex-wrap w-100">
                                            <div class="searchbar w-100">
                                                <input class="w-100" type="text" name="username" placeholder="[Username]" value="{{ Auth::user()->username }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if (Auth::user()->status == "Penulis")
                                <div class="row col-md-12 gx-0 p-1 form-sub border-0">
                                    <div class="col-md-6 d-flex flex-wrap align-items-center px-3 my-2" id="prodi">
                                        <div class="form_sub_title w-100">Program Studi</div>
                                        <div class="col-md-6 search_input d-flex flex-wrap w-100">
                                            <div class="searchbar searchFull search-value w-100">
                                                <input type="text" name="prodi" id="prodi" placeholder="[Program Studi]" value="{{ $arrayAkun[0]['nama_jurusan'] }}">
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
                                                <input type="date" name="tgl" style="width:100%;" placeholder="DD-MM-YYYY" value="{{ Auth::user()->tanggal_lahir }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-md-6 gx-0 p-1 form-sub border-0">
                                    <div class="d-flex flex-wrap align-items-center px-3 my-2" id="tlp">
                                        <div class="form_sub_title w-100">Nomor Telp</div>
                                        <div class="col-md-12 search_input d-flex flex-wrap w-100">
                                            <div class="searchbar w-100">
                                                <input type="text" name="tlp" placeholder="[xxxx-xxxx-xxxx]" value="{{ Auth::user()->no_telepon }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-md-6 gx-0 p-1 form-sub border-0">
                                    <div class="d-flex flex-wrap align-items-center px-3 my-2" id="email">
                                        <div class="form_sub_title w-100">Email</div>
                                        <div class="col-md-12 search_input d-flex flex-wrap w-100">
                                            <div class="searchbar w-100">
                                                <input type="text" name="email" placeholder="[xxxxx@xxxmail.com]" value="{{ Auth::user()->email }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-md-6 gx-0 p-1 form-sub border-0">
                                    <div class="w-100 d-flex flex-wrap align-items-center px-3 my-2" id="kota">
                                        <div class="form_sub_title w-100">Kota</div>
                                        <div class="col-md-12 search_input d-flex flex-wrap w-100" id="kota">
                                            <div class="searchbar searchFull search-value w-100">
                                                <input type="text" name="kota" id="kota" placeholder="[Kota]" value="{{ $arrayAkun[0]['nama_kota'] }}">
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
                                                <input type="text" name="prov" id="prov" placeholder="[Provinsi]" value="{{ $arrayAkun[0]['nama_provinsi'] }}">
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
                                                <input type="text" name="alamat" placeholder="[Alamat]" value="{{ Auth::user()->alamat }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-md-3 gx-0 p-1 form-sub border-0">
                                    <div class="d-flex flex-wrap align-items-center px-3 my-2" id="pos">
                                        <div class="form_sub_title w-100">Kode Pos</div>
                                        <div class="col-md-12 search_input d-flex flex-wrap w-100">
                                            <div class="searchbar w-100">
                                                <input type="text" name="pos" placeholder="[Kode Pos]" value="{{ Auth::user()->kode_pos }}">
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
            var finalSearch = <?php echo json_encode($finalSearch); ?>;

            let list_judul = [];
            let list_penulis = [];
            let list_prodi = [];
            prodi.forEach((element,index) => { list_prodi[index] = prodi[index]['NAMA_JURUSAN']; });
            let list_kota = [];
            kota.forEach((element,index) => { list_kota[index] = kota[index]['NAMA_KOTA']; });
            let list_prov = [];
            prov.forEach((element,index) => { list_prov[index] = prov[index]['NAMA_PROVINSI']; });
            let final_list = [];
            let final_search = finalSearch;
        </script>
        <!-- JS comunicate with database -->
        <script src="../Script.js"></script>

        <script type="text/javascript">
            function priviewImage(){
                var file = document.getElementById('img-input').files;
                if (file.length > 0) {
                    var fileReader = new FileReader();

                    fileReader.onload = function (event){
                        document.getElementById('uploadedIMG').setAttribute("src",event.target.result);
                    };

                    fileReader.readAsDataURL(file[0]);
                }
                parent = document.getElementById('uploadedIMG').parentNode;
                parent.querySelector('svg#blank-pp').remove();
            }
        </script>
    </body>
</html>
