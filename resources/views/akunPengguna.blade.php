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
                @if($errorList.gettype() == "array" || $errorList.gettype() == "object")
                    @foreach($errorList as $value)
                        <li><strong>{{ $value }}</strong></li>
                    @endforeach
                @else
                    <li><strong>{{ $errorList }}</strong></li>
                @endif
                </ul>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-block ">
                <strong>Kesalahan Input Dalam Menambahkan Akun Baru: </strong>
                <br>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif

        <main>
            <div class="main-isi" id="main-isi">
                <form action="{{ route('akun.store') }}" method="POST" name="Akun">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <div class="card row px-3 mb-4">
                        <div class="card-head text-center"><h4><strong>Tambah Akun</strong></h4></div>
                        <table class="">
                            <tr class="border-0">
                                <td><input type="text" name="username" class="form-control" placeholder="Username"></td>
                                <td class="col-md-4"><input type="text" name="email" class="form-control" placeholder="Email@example"></td>
                                <td class="col-md-2">
                                    <select class="form-select" name="status" id="status">
                                        <option disabled selected>>--Pilih Status Akun--<</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Penulis">Penulis</option>
                                    </select>
                                </td>
                                <td class="col-md-2"><input type="password" name="pass" class="form-control" placeholder="Password"></td>
                            </tr>
                            <tr class="border-0">
                                <td colspan="4">
                                    <button type="button" class="btn add-btn col-12">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill me-3" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"></path>
                                        </svg>
                                        <p>Tambah Akun</p>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="artikel-tabel-edit card row px-3">
                        <div class="card-head text-center"><h4><strong>List Akun</strong></h4></div>
                        <table class="table tabel-card align-middle">
                            <thead>
                                <th>Username</th>
                                <th class="col-md-4">Email</th>
                                <th class="col-md-2">Status</th>
                                <th class="col-md-2">Action</th>
                            </thead>
                            <tbody>
                                <tr><td colspan="4"><i>Loading...</i></td></tr>
                            </tbody>
                        </table>
                        <div class="page row justify-content-between" id="article_pagination">
                            <div class="table-data-count col-md-auto justify-content-center text-center" id="article_pagination_count">10 of 100 Articles</div>
                            <div class="page-button d-flex col-md-auto justify-content-center mx-0 align-items-center">
                                <button class="np-btn btn col-auto" id="first_btn_artikel" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"></path>
                                        <path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"></path>
                                    </svg>
                                </button>
                                <button class="np-btn btn col-auto" id="prev_btn_artikel" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"></path>
                                    </svg>
                                </button>
                                <p class="no-loc col-auto" id="no_loc_artikel">1</p>
                                <button class="np-btn btn col-auto" id="next_btn_artikel" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                                    </svg>
                                </button>
                                <button class="np-btn btn col-auto" id="last_btn_artikel" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"></path>
                                        <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
            </form>
        </main>
        <footer>

        </footer>
        <div class="shade fade" id="shade"></div>
        
        <!-- JS comunicate with database -->
        <script type="text/javascript">
            var finalSearch = <?php echo json_encode($finalSearch); ?>;
            var notifOpen = false;

            let list_judul = [];
            let list_penulis = [];
            let list_prodi = [];
            let final_list = <?php echo json_encode($tableAkun); ?>;
            let final_search = finalSearch;
        </script>
        <!-- JS comunicate with database -->

        
        <script src="Script.js"></script>
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
            function priviewImage(id){
                var file;
                if (id.includes('Create_img')) {
                    file = document.getElementById('Create_img').files;
                }
                else {
                    file = document.getElementById('img-input_'+id).files;
                }
                if (file.length > 0) {
                    var fileReader = new FileReader();

                    fileReader.onload = function (event){
                        if (id.includes('Create_img')) {
                            document.getElementById('Create_img_upload').setAttribute("src",event.target.result);
                        }
                        else {
                            document.getElementById('uploadedIMG_'+id).setAttribute("src",event.target.result);
                        }
                    };
                    fileReader.readAsDataURL(file[0]);
                }
                if (id.includes('Create_img')) {
                    parent = document.getElementById('Create_img_upload').parentNode;
                    parent.querySelector('#Create_img_upload').classList.add('mb-3');
                    parent.querySelector('#Create_img_upload').style.maxWidth= '15vw';
                    parent.querySelector('#Create_img_upload').style.maxHeight= '15vw';
                    parent.querySelector('svg#blank-pp').remove();
                }
                else {
                    parent = document.getElementById('uploadedIMG_'+id).parentNode;
                    parent.querySelector('svg#blank-pp').remove();
                }
            }
        </script>
    </body>
</html>
