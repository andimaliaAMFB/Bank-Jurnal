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
        @include('layout.header')
        @include('layout.taskbar')

        @if($countPnl = Session::get('Count_penulis_jurusan'))
            <input type="hidden" id="countPnl" value="{{$countPnl}}">
        @endif

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block d-flex justify-content-between align-items-center">
                <strong>{{ $message }}</strong>
            </div>
        @elseif ($message = Session::get('error'))
            <div class="alert alert-danger alert-block ">
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
                <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data" name="formUpload">
                @elseif(str_contains($title,'Upload Revisi Artikel'))
                <form action="{{ route('article.restore', ['id_article' => $id_article]) }}" method="POST" enctype="multipart/form-data" name="formUpload">
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
                                    <div class="col-md-3 d-flex">Nama Penulis <strong class="col-red-1 px-1">*</strong> </div>
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
                                    <div class="col-md-3 d-flex">Program Studi <strong class="col-red-1 px-1">*</strong> </div>
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
                            @if(isset($id_article))
                            <div class="form_sub_title w-100">Upload Artikel Baru</div>
                            @else
                            <div class="form_sub_title w-100">Upload Artikel</div>
                            @endif
                            <div class="row w-100 gx-0 py-3 px-3 form-sub border-0">
                                <div class="d-flex flex-wrap align-items-center px-3 my-2" id="text-jdl">
                                    <div class="col-md-3 d-flex">Judul Artikel <strong class="col-red-1 px-1">*</strong> </div>
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
                                        <p>Upload Document (Doc/Docs/PDF)</p>
                                        <p>Max Size 10 MB</p>
                                        <p class="link">Pilih Dokumen</p>
                                    </div>
                                    <input type="file" name="file" class="drop-file__input" accept="application/pdf, application/vnd.msword" required>
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
            var finalSearch = <?php echo json_encode($finalSearch); ?>;
            var notifOpen = false;

            let list_judul = [];
            let list_penulis = [];
            penulis.forEach((element,index) => { list_penulis[index] = penulis[index]['nama_penulis']; });
            let list_prodi = [];
            prodi.forEach((element,index) => { list_prodi[index] = prodi[index]['nama_jurusan']; });
            let final_list = [];
            let final_search = finalSearch;

            var list_up_penulis = [];
            var list_up_penulis_text = [];
            var list_up_prodi = [];
            var list_up_prodi_text = [];

            var countPenulis_old = 0;
            var FieldInput = <?php echo json_encode(Session::get('field')); ?>;
            var judulArtikel = null;

            if (document.querySelector(`#countPnl`)) { countPenulis_old = (document.querySelector(`#countPnl`).value) - 1; }
            if (FieldInput) { FieldInput = <?php echo json_encode(Session::get('field')); ?>; }
            else if(window.location.href.includes('re-upload')){
                FieldInput = <?php echo json_encode($field); ?>;
                countPenulis_old = {{ $countPnl }} -1;
                judulArtikel = '{{ $id_article }}';
            }
            if (FieldInput) {
                var index = 0;
                FieldInput.forEach(element => {
                    // console.log(index, element);
                    var key = Object.keys(element)[0];
                    var value = element[key];
                    if (key.includes('pnl')) {
                        if (list_penulis.includes(value)) { list_up_penulis[index] = value; }
                        else { list_up_penulis_text[index] = value; }
                    }
                    if (key.includes('prodi')) {
                        if (list_prodi.includes(value)) { list_up_prodi[index] = value; }
                        else { list_up_prodi_text[index] = value; }
                        index += 1;
                    }
                });
            }
            console.log(FieldInput,countPenulis_old);
            
            let list_penulis_jurusan = [];
            penulis.forEach(penulis => {
                namaProdi = '';
                prodi.forEach(prodi => {
                    if (penulis['id_jurusan'] == prodi['id_jurusan']) { namaProdi = prodi['nama_jurusan']; }
                });
                list_penulis_jurusan.push([penulis['nama_penulis'],namaProdi]);
            });

        </script>
        <!-- JS comunicate with database -->
        <script src="../../Script.js"></script>
        <script>
            window.addEventListener('mouseup', function(event){
                @if(Auth::user())
                    if (document.querySelector(`.head-notif ul`).style.display === 'block') {
                        notifOpen = true;
                    }
                    else if (document.querySelector(`.head-notif ul`).style.display === 'none' && notifOpen) {
                        
                        @foreach (Auth::user()->unreadNotifications as $notification)
                            @php
                                $notification->markAsRead();
                            @endphp
                        @endforeach
                        window.location = window.location;
                    }
                @endif
            });
        </script>
        <script type="text/javascript">
            
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
    
                                                item.querySelectorAll(`input`).forEach(input => {
                                                    input.name = replace_id_list(input.name, itemIndex+1);
                                                    input.id = replace_id_list(input.id, itemIndex+1);
                                                    input.outerHTML = replace_id_list(input.outerHTML, itemIndex+1);
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
                    else {
                        if(judulArtikel) { form.querySelector('input#jdl').value = judulArtikel; }
                    }
                    form_update(form);
                });
            }
            form_page.forEach(element => {//insert old value
                if (FieldInput) {
                    FieldInput.forEach(value => {
                        if (element.querySelector(`input#`+Object.keys(value)[0])) {
                            element.querySelector(`input#`+Object.keys(value)[0]).value = Object.values(value)[0];
                        }
                    });
                }
            });
        </script>
    </body>
</html>
