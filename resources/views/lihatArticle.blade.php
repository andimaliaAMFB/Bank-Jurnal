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
        <link rel="stylesheet" href="../../Style.css">

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
                <strong>{{ $errorList }}</strong>
            </div>
        @endif

        <main>
            <div class="main-isi" id="main-isi">
                <div class="detail-artikel">
                    <div class="card">
                        <div class="card-head p-3 m-0 mx-3">
                            <h3>{{ $final[0][0] }}</h3>
                            <div class="d-flex justify-content-center">
                                @foreach($penulis as $key => $value)
                                <a href="{{ '../@'.$value }}"><p>{{ $value }}
                                    @if($key < count($penulis)-1)
                                    ,&nbsp;
                                    @endif
                                </p></a>
                                @endforeach
                            </div>
                            @if($final[0][6] != "Layak Publish")
                            <p>Status Artikel: {{ $final[0][6] }}</p>
                            @endif
                            <p style="font-size:medium;">Tanggal Upload: {{ $final[0][4] }}</p>
                            <p style="font-size:medium;">Tanggal Rilis: {{ $final[0][5] }}</p>
                        </div>
                        <div class="card-body article d-flex flex-column px-4" id="docViewer">
                            <iframe src="../{{ 'storage/article/'.$pathArtikel }}#toolbar=0" frameborder="0" style="width:100%;height:100%;"></iframe>
                        </div>
                    </div>
                </div>
                
                @if(Auth::user()->status == "Admin")
                    <div class="live_modal card col-md-6 position-fixed bottom-0 end-0 m-3" style="box-shadow: 0px 0px 16px rgb(0 0 0 / 25%);">
                        <div class="card-head row justify-content-between m-0 mb-3 p-1">
                            <h3 class="col-auto m-0">Ubah Status</h3>
                            <button class="btn col-auto hide">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-bar-up" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M3.646 11.854a.5.5 0 0 0 .708 0L8 8.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708zM2.4 5.2c0 .22.18.4.4.4h10.4a.4.4 0 0 0 0-.8H2.8a.4.4 0 0 0-.4.4z"/>
                                </svg>
                            </button>
                        </div>
                        <div class="card-body px-3 py-0 m-0" style="display:none;">
                            <form action="{{ route('status.update', ['level_status' => end($history[0][4]),'id_artikel' => 1])}}" id="form-status" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="PUT">
                                <div class="profile_form form_sub">
                                    <div class="form_sub row m-0" id="status_title">
                                        <div class="history_form m-0 w-100">
                                            <div class="history_detail">
                                                <div class="history_detail row" id="lama">
                                                    <div class="form_sub_title">Status Lama</div>
                                                    <div>{{end($history[0][4])}}</div>
                                                </div>
                                                <div class="history_detail row" id="baru">
                                                    <div class="form_sub_title">Status Baru</div>
                                                    <div>
                                                        <select name="status_baru" id="tabel_status_change">
                                                            <option disabled="" selected="" value="" required>[Status Baru]</option>
                                                            <option value="Draft">Draft</option>
                                                            <option value="Revisi Mayor">Revisi Mayor</option>
                                                            <option value="Revisi Minor">Revisi Minor</option>
                                                            <option value="Layak Publish">Layak Publish</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="history_detail row" id="catatan">
                                                    <div class="form_sub_title">Catatan</div>
                                                    <div>
                                                        <textarea name="catatan_revisi" id="" rows="10" class="searchbar search-jdl" placeholder="[Catatan Revisi Yang diberikan Oleh Admin]" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-end px-3 py-1">
                                        <button type="submit" class="btn submit-btn col-auto">Update Status</button>
                                        <button type="button" class="btn submit-btn-border col-auto hide">Hide</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </main>
        @include('layout.footer')
        <div class="shade fade" id="shade"></div>
        
        <!-- JS comunicate with database -->
        <script>
            var judul = <?php echo json_encode($judul); ?>;
            var penulis = <?php echo json_encode($penulis); ?>;
            var final = <?php echo json_encode($final); ?>;
            var finalSearch = <?php echo json_encode($finalSearch); ?>;
            var notifOpen = false;

            let list_judul = [];
            judul.forEach((element,index) => { list_judul[index] = judul[index]; });
            let list_penulis = [];
            penulis.forEach((element,index) => { list_penulis[index] = penulis[index]; });
            let list_prodi = [];
            let final_list = final;
            let final_search = finalSearch;
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
        <script>
            if (document.querySelector('.live_modal')) {
                var form = document.querySelector('.live_modal');
                window.addEventListener('mouseup', function(event) {
                    if (window.innerWidth > 768) { form.classList.remove("form-modal"); }
                    else { form.classList.add("form-modal"); }
                    if (form.querySelector('select')) {
                        e = form.querySelector('select');
                        eValue = e.value;
                        eText = e.options[e.selectedIndex].text;
                        change_Selected_Value(e,eValue,eText);
                    }
                });
                form.querySelectorAll('button.hide').forEach(element => {
                    element.onclick = function click(params) {
                        var head_button = form.querySelector('.card-head button.hide');
                        var body = form.querySelector('.card-body');
                        form_function(form);
                        form.style.display = "";
                        if (!form.classList.contains("show")) {
                            head_button.innerHTML = 
                            `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-bar-up" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M3.646 11.854a.5.5 0 0 0 .708 0L8 8.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708zM2.4 5.2c0 .22.18.4.4.4h10.4a.4.4 0 0 0 0-.8H2.8a.4.4 0 0 0-.4.4z"/>
                            </svg>`;
                            body.style.display = "none";
                        }
                        else {
                            head_button.innerHTML = 
                            `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-bar-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M3.646 4.146a.5.5 0 0 1 .708 0L8 7.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zM1 11.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5z"/>
                            </svg>`;
                            body.style.display = "";
                        }
                        if (window.innerWidth > 768) {
                            shade_show("remove");
                            overflow_body("auto");
                            form.classList.remove("form-modal");
                        }
                    }
                });

                var formRoute = form.querySelector('form');
                var level_status = "{{ end($history[0][4]) }}";
                level_status = (level_status.replace(" ","-")).toLocaleLowerCase();
                formRoute.action = window.location.origin+'/status/'+level_status+'/'+"{{ $final[0][0] }}";
            }
        </script>
    </body>
</html>