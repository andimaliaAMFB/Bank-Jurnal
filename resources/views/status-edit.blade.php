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
        <main>
            <div class="main-isi" id="main-isi">
                <div class="judul-hlm"><h2>{{$title}}</h2></div>
                
                <div class="list-artikel" id="list_wrapper" style="margin-block: 2rem;">
                    <div class="artikel-tabel-edit card px-3">
                        <div class="article-order row flex-wrap card-head">
                            <div class="col-md-7 search_input me-3" id="jdl-search">
                                <form action="" class="d-flex flex-wrap">
                                    <div class="col-10 searchbar search-label search-value justify-content-center flex-grow-1">
                                        <input class="w-100" type="text" name="s-jdl" id="search-jdl" placeholder="Judul Artikel">
                                    </div>
                                    <div class="col-auto searchbar search-button justify-content-center">
                                        <button type="submit" name="s-jdl-btn" id="search-jdl-btn" class="dot search-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="col-10 searchbar search-dd drop-select flex-grow-1" style="height: 0;">
                                        <div class="w-100 se-se-bar d-flex flex-column justify-content-between" id="dropdown-jdl">
                                            <ul class="select-droped">
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-auto searchbar search-break justify-content-center col-3" style="height: 0;">
                                        <button type="button" class="dot search-btn" style="height: 0;">
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-3 search_input" id="final-select">
                                <form action="" class="d-flex flex-wrap">
                                    <div class="col-8 searchbar search-label justify-content-center">
                                        Catatan Revisi:
                                    </div>
                                    <div class="col-4 searchbar search-value justify-content-center"id="select-final">
                                        No
                                    </div>
                                    <div class="col-8 searchbar search-break" style="height: 0;">
                                    </div>
                                    <div class="col-4 searchbar search-dd drop-select" style="height: 0;">
                                        <div class="w-100 se-se-bar d-flex flex-column justify-content-between" id="dropdown-final">
                                            <ul class="select-droped">
                                                <li>Yes</li>
                                                <li class="active">No</li>
                                                <li>All</li>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-5 search_input me-3" id="pnl-select">
                                <form action="" class="d-flex flex-wrap">
                                    <div class="col-4 searchbar search-label justify-content-center">
                                        Penulis:
                                    </div>
                                    <div class="col-8 searchbar search-value justify-content-center" id="select-pnl">
                                        &gt;--Pilih Penulis--&lt;
                                    </div>
                                    <div class="col-4 searchbar search-break" style="height: 0;">
                                    </div>
                                    <div class="col-8 searchbar search-dd drop-select" style="height: 0;">
                                        <div class="w-100 se-se-bar d-flex flex-column justify-content-between" id="dropdown-pnl">
                                            <div class="select-search searchbar">
                                                <input type="text" name="s-se-pnl" id="s-se-pnl" placeholder="Penulis">
                                            </div>
                                            <ul class="select-droped">
                                                <li>poin</li>
                                                <li>poin</li>
                                                <li>poin</li>
                                                <li>poin</li>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-5 search_input" id="prodi-select">
                                <form action="" class="d-flex flex-wrap">
                                    <div class="col-4 searchbar search-label justify-content-center">
                                        Prodi:
                                    </div>
                                    <div class="col-8 searchbar search-value justify-content-center" id="select-prodi">
                                        &gt;--Pilih Program Studi--&lt;
                                    </div>
                                    <div class="col-4 searchbar search-break" style="height: 0;">
                                    </div>
                                    <div class="col-8 searchbar search-dd drop-select" style="height: 0;">
                                        <div class="w-100 se-se-bar d-flex flex-column justify-content-between" id="dropdown-prodi">
                                            <div class="select-search searchbar">
                                                <input type="text" name="s-se-prodi" id="s-se-prodi" placeholder="Prodi">
                                            </div>
                                            <ul class="select-droped"><li>poin</li>
                                                <li>poin</li>
                                                <li>poin</li>
                                                <li>poin</li>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <table class="tabel-card" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th class="col-md-3">Penulis</th>
                                    <th class="col-md-3">Program Studi</th>
                                    <th class="col-md-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td colspan="4"><i>Loading...</i></td></tr>
                            </tbody>
                        </table>
                        <div class="page row justify-content-between" id="article_pagination">
                            <div class="table-data-count col-md-auto justify-content-center text-center" id="article_pagination_count">10 of 100 Articles</div>
                            <div class="page-button d-flex col-md-auto justify-content-center mx-0 align-items-center">
                                <button class="np-btn btn col-auto" id="first_btn_artikel">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"></path>
                                        <path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"></path>
                                    </svg>
                                </button>
                                <button class="np-btn btn col-auto" id="prev_btn_artikel"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"></path>
                                </svg>
                                </button>
                                <p class="no-loc col-auto" id="no_loc_artikel">1</p>
                                <button class="np-btn btn col-auto" id="next_btn_artikel">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                                    </svg>
                                </button>
                                <button class="np-btn btn col-auto" id="last_btn_artikel">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"></path>
                                        <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-modal" style="display: none;">
                    <div class="fliter-form px-3" id="form">
                        <div class="form-card card col-md-8">
                            <div class="card-head row justify-content-between">
                                <h3 class="col-auto">Ubah Status</h3>
                                <button class="btn col-auto">X</button>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('status.update', ['level_status' => $level_status,'id_artikel' => 1])}}" id="form-status" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="profile_form form_sub">
                                        <div class="form_sub row" id="judul">
                                            <div class="w-25 form_sub_title">Judul Artikel</div>
                                            <div class="w-75">[Judul Artikel]</div>
                                        </div>
                                        <div class="form_sub row" id="penulis">
                                            <div class="w-25 form_sub_title">Penulis</div>
                                            <div class="w-75">[Nama Penulis]</div>
                                        </div>
                                        <div class="form_sub row" id="status_title">
                                            <div class="form_sub_title">Status Perubahan</div>
                                            <div class="history_form">
                                                <div class="history_list row parent">
                                                    <div class="date_up">MMMM/DD/YYYY</div>
                                                    <span></span>
                                                    <div class="pointer">V</div>
                                                </div>
                                                <div class="history_detail child">
                                                    <div class="history_detail row" id="lama">
                                                        <div class="form_sub_title">Status Lama</div>
                                                        <div>[Status Lama Judul Artikel ke 1-1]</div>
                                                    </div>
                                                    <div class="history_detail row" id="baru">
                                                        <div class="form_sub_title">Status Baru</div>
                                                        <div>[Status Baru Judul Artikel ke 1-1]</div>
                                                    </div>
                                                    <div class="history_detail row" id="catatan">
                                                        <div class="form_sub_title">Catatan</div>
                                                        <div>[Catatan Revisi Judul Artikel ke 1-1]</div>
                                                    </div>
                                                    <div class="history_detail row" id="artikel">
                                                        <div class="link" id="see_article">Lihat Artikel</div>
                                                    </div>
                                                </div>
                                                <div class="history_list row">
                                                    <div class="date_up">MMMM/DD/YYYY</div>
                                                    <span></span>
                                                    <div class="pointer">V</div>
                                                </div>
                                                <div class="history_detail child">
                                                    <div class="history_detail row" id="lama">
                                                        <div class="form_sub_title">Status Lama</div>
                                                        <div>[Status Lama Judul Artikel ke 1-1]</div>
                                                    </div>
                                                    <div class="history_detail row" id="baru">
                                                        <div class="form_sub_title">Status Baru</div>
                                                        <div>
                                                            <select name="" id="tabel_status_change">
                                                                <option disabled="" selected="" value="">[Status Baru]</option>
                                                                <option value="">Draft</option>
                                                                <option value="">Revisi Minor</option>
                                                                <option value="">Revisi Mayor</option>
                                                                <option value="">Layak Publish</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="history_detail row" id="catatan">
                                                        <div class="form_sub_title">Catatan</div>
                                                        <div>
                                                            <textarea name="" id="" rows="10" class="searchbar search-jdl" placeholder="[Catatan Revisi Yang diberikan Oleh Admin]"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="history_detail row" id="artikel">
                                                        <div class="link" id="see_article">Lihat Artikel</div>
                                                    </div>
                                                </div>
                                                <div class="history_list row">
                                                    <div class="date_up">MMMM/DD/YYYY</div>
                                                    <span></span>
                                                    <div class="pointer">V</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                            <button type="submit" class="btn submit-btn col-auto">Update Status</button>
                                            <button type="button" class="btn submit-btn-border col-auto">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
        <footer>

        </footer>
        <div class="shade fade" id="shade"></div>
        
        <!-- JS comunicate with database -->
        <script type="text/javascript">
            var judul = <?php echo json_encode($judul); ?>;
            var penulis = <?php echo json_encode($penulis); ?>;
            var prodi = <?php echo json_encode($tableProdi); ?>;
            var final = <?php echo json_encode($final); ?>;
            var finalSearch = <?php echo json_encode($finalSearch); ?>;

            let list_judul = [];
            judul.forEach((element,index) => { list_judul[index] = judul[index]; });
            let list_penulis = [];
            penulis.forEach((element,index) => { list_penulis[index] = penulis[index]; });
            let list_prodi = [];
            prodi.forEach((element,index) => { list_prodi[index] = prodi[index]['nama_jurusan']; });
            let final_list = final;
            let final_search = finalSearch;

            var historyArray = <?php echo json_encode($history); ?>;

        </script>
        <!-- JS comunicate with database -->

        <script src="../Script.js"></script>
    </body>
</html>
