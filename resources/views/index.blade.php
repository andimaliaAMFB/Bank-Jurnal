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

        <div class="mb-3 w-100 slide-container position-relative">
            <img src="../asset/Group 28.png" alt="" class="position-absolute top-0 end-0 h-100">
            <div class="text-center position-absolute top-50 start-50 translate-middle">
                <h1>RUMAH JURNAL</h1>
                <h3>Universitas Islam Negeri Sunan Gunung Djati Bandung</h3>
                <h5>Publikasi, Diseminasi Riset, Akreditasi Pengelolaan Jurnal</h5>
            </div>
            <div class="row justify-content-between align-items-center py-3 px-4 position-absolute bottom-0 h-auto w-100 menu">
                <button class="btn col-auto mx-3">
                    <a href="#">
                        <h4 class="m-0"><strong>Rumah Jurnal</strong></h4>
                    </a>
                </button>
                <div class="row justify-content-center col-auto p-0">
                    <a href="#" class="col-auto"><img src="../asset/logo uin - logo Only.png" alt="" style="width:2rem"></a>
                    <a href="#" class="col-auto"><img src="../asset/logo_rumah jurnal 1.png" alt="" style="width:2rem"></a>
                    <a href="#" class="col-auto"><img src="../asset/logo_BLU.png" alt="" style="width:2rem"></a>
                </div>
            </div>
            <div class="position-absolute top-0 w-100 h-100">
            </div>
        </div>
        <main>
            <div class="main-isi" id="main-isi">
                <div class="statistic-data row justify-content-between gx-0 w-100">
                    <div class="static card col-md-6">
                        <div class="card-head">Statistik Artikel Yang Dipublish Rumah Jurnal</div>
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <canvas id="statistik"></canvas>
                        </div>
                    </div>
                    <div class="donut card col-md-4">
                        <div class="card-head">Artikel Per Jurusan</div>
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <canvas id="doughnut"></canvas>
                        </div>
                    </div>
                </div>
                <div class="filter-prodi">
                    <div class="head-sub row justify-content-between">
                        <h4>List Program Studi</h4>
                        <button class="filter-btn btn row">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                                <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                            Filter
                        </button>
                    </div>
                    <div class="body-sub filter-body"></div>
                </div>
                <div class="list-artikel" id="list_wrapper" style="margin-block: 2rem;">
                    <div class="artikel-tabel-edit card px-3">
                        <table class="tabel-card">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th class="col-3">Penulis</th>
                                    <th class="col-4">Program Studi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td colspan="4"><i>Loading...</i></td></tr>
                            </tbody>
                        </table>
                        <div class="page row" id="article_pagination">
                            <div class="table-data-count col-auto" id="article_pagination_count">
                            </div>
                            <div class="page-button row col-auto">
                                <button class="np-btn btn col-auto" id="first_btn_artikel">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                        <path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                    </svg>
                                </button>
                                <button class="np-btn btn col-auto" id="prev_btn_artikel"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                </svg>
                                </button>
                                <p class="no-loc col-auto" id="no_loc_artikel">1</p>
                                <button class="np-btn btn col-auto" id="next_btn_artikel">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </button>
                                <button class="np-btn btn col-auto" id="last_btn_artikel">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                                        <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slide-penulis">
                    <div class="penulis-isi card">
                        <div class="card-head">
                            Penulis
                        </div>
                        
                        <div class="card-body">
                            <div class="container-slide px-3 row flex-wrap justify-content-between">
                                <div class="profile-box col-auto">
                                    <img src="" alt="profile-image">
                                    <p id="profile-name">Nama Pengguna</p>
                                </div>
                                <div class="profile-box col-auto">
                                    <img src="" alt="profile-image">
                                    <p id="profile-name">Nama Pengguna</p>
                                </div>
                                <div class="profile-box col-auto">
                                    <img src="" alt="profile-image">
                                    <p id="profile-name">Nama Pengguna</p>
                                </div>
                                <div class="profile-box col-auto">
                                    <img src="" alt="profile-image">
                                    <p id="profile-name">Nama Pengguna</p>
                                </div>
                                <div class="profile-box col-auto">
                                    <img src="" alt="profile-image">
                                    <p id="profile-name">Nama Pengguna</p>
                                </div>
                                <div class="profile-box col-auto">
                                    <img src="" alt="profile-image">
                                    <p id="profile-name">Nama Pengguna</p>
                                </div>
                                <div class="profile-box col-auto">
                                    <img src="" alt="profile-image">
                                    <p id="profile-name">Nama Pengguna</p>
                                </div>
                                <div class="profile-box col-auto">
                                    <img src="" alt="profile-image">
                                    <p id="profile-name">Nama Pengguna</p>
                                </div>
                                <div class="profile-box col-auto">
                                    <img src="" alt="profile-image">
                                    <p id="profile-name">Nama Pengguna</p>
                                </div>
                                <div class="profile-box col-auto">
                                    <img src="" alt="profile-image">
                                    <p id="profile-name">Nama Pengguna</p>
                                </div>
                            </div>
                            <div class="page row" id="penulis_pagination">
                                <div class="table-data-count col-auto" id="penulis_pagination_count">
                                    10 of 100 article
                                </div>
                                <div class="page-button row col-auto">
                                    <button class="np-btn btn col-auto" id="first_btn_penulis">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-left" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                            <path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                        </svg>
                                    </button>
                                    <button class="np-btn btn col-auto" id="prev_btn_penulis">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                        </svg>
                                    </button>
                                    <p class="no-loc col-auto" id="no-loc-penulis">1</p>
                                    <button class="np-btn btn col-auto" id="next_btn_penulis">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    </button>
                                    <button class="np-btn btn col-auto" id="last_btn_penulis">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                                            <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-modal" style="display: none;">
                    <div class="fliter-form" id="form">
                        <div class="form-card card col-8">
                            <div class="card-head row justify-content-between">
                                <h3 class="col-auto">Program Studi</h3>
                                <button class="btn col-auto">X</button>
                            </div>
                            <div class="card-body">
                                <form action="" id="form-status">
                                    <div class="row border-bottom">
                                        <article class="row col-auto">
                                            <label for="all" class="col-auto">Pilih Semua:</label> 
                                            <input type="checkbox" id="all" class="col-auto">
                                        </article>
                                        <article class="row col-auto">
                                            <label for="allClear" class="col-auto">Batalkan pilihan:</label> 
                                            <input type="checkbox" id="allClear" class="col-auto">
                                        </article>
                                    </div>
                                    <div class="prodi-pilih">
                                        <article>
                                            <input type="checkbox">
                                            <div><span>Prodi 1</span></div>
                                        </article>
                                        <article>
                                            <input type="checkbox">
                                            <div><span>Manajemen Dakwah</span></div>
                                        </article>
                                        <article>
                                            <input type="checkbox">
                                            <div><span>Teknik Informatika</span></div>
                                        </article>
                                        <article>
                                            <input type="checkbox">
                                            <div><span>Manajemen Pendidikian Islam</span></div>
                                        </article>
                                        <article>
                                            <input type="checkbox">
                                            <div><span>Manajemen Dakwah</span></div>
                                        </article>
                                    </div>
                                    
                                    <div class="row justify-content-end">
                                        <button type="submit" class="btn submit-btn col-auto">Cari Prodi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        
        @include('layout.footer')
        <div class="shade fade" id="shade"></div>
        
        <!-- JS comunicate with database -->
        <script type="text/javascript">
            var judul = <?php echo json_encode($judul); ?>;
            var penulis = <?php echo json_encode($penulis); ?>;
            var prodi = <?php echo json_encode($tableProdi); ?>;
            var final = <?php echo json_encode($final); ?>;
            var finalSearch = <?php echo json_encode($finalSearch); ?>;
            var All_penulis = <?php echo json_encode($tablePenulis); ?>;
            var notifOpen = false;

            let list_judul = judul;
            let list_penulis = penulis;
            let list_prodi = [];
            prodi.forEach((element,index) => { list_prodi[index] = prodi[index]['nama_jurusan']; });
            let final_list = final;
            let final_search = finalSearch;
        </script>
        <!-- JS comunicate with database -->

        
        <script src="Script.js"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            var prodiExist = {};
            var tanggalRilis = {};
            var prodiExist_Array = [];
            var month_Array = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            //count unique
                final_list.map(value => value[3]).forEach((element, index) => {
                    element.split(", ").forEach(pnl => { prodiExist[pnl] = 1 + (prodiExist[pnl] || 0); });
                });
                final_list.map(value => new Date(value[5])).forEach(date => {
                    var month = month_Array[date.getMonth()];
                    var year = date.getFullYear();
                    tanggalRilis[month + " " + year] = 1 + (tanggalRilis[month + " " + year] || 0);
                });
                var currentMonth = new Date();
                var tanggalRilis_label = [];
                var tanggalRilis_data = [];
                for (let i = 0; i < 12; i++) {
                    var month = month_Array[currentMonth.getMonth()];
                    var year = currentMonth.getFullYear();

                    var data_jumlah = tanggalRilis[month + " " + year];
                    if (!data_jumlah) { data_jumlah = 0; }
                    tanggalRilis_data.push(data_jumlah);

                    tanggalRilis_label.push(month + " " + year);
                    currentMonth.setMonth(currentMonth.getMonth() - 1);
                }
                var tanggalRilis_label = tanggalRilis_label.reverse();
                var tanggalRilis_data = tanggalRilis_data.reverse();

                prodi_color.forEach(value => {
                    var nama_prodi = value['nama_prodi'];
                    if (value['nama_prodi'] == '[ N/a ]') { nama_prodi = 'Unknown Program Studi'; }
                    if (prodiExist[value['nama_prodi']]) {
                        prodiExist_Array.push({
                            'prodi': nama_prodi,
                            'jumlah': prodiExist[value['nama_prodi']],
                            'warna': '#' + value['warna']
                        });
                    }
                });
                var prodiExist_label = prodiExist_Array.map(value => value['prodi']);
                var prodiExist_data = prodiExist_Array.map(value => value['jumlah']);
                var prodiExist_warna = prodiExist_Array.map(value => value['warna']);
            //
            
            //statistik line
                var statistikBar = document.querySelector('#statistik');
                new Chart(statistikBar, {
                    type: 'line',
                    data: {
                        labels: tanggalRilis_label,
                        datasets: [{
                            label: "Jumlah Artikel dirilis",
                            data: tanggalRilis_data,
                            borderWidth: 2,
                            pointBorderWidth: 5
                        }]
                    },
                    options: {
                                responsive: true,
                                interaction: {
                                    intersect: false,
                                },
                                plugins: {
                                    legend: {
                                        display: false,
                                    }
                                },
                                scales: {
                                    x: {
                                        ticks: {
                                            display: false,
                                        }
                                    },
                                    y: {
                                        beginAtZero: true,
                                    }
                                }
                            }
                });
            //Frekuensi Prodi doughnut
                var doughnut = document.querySelector('#doughnut');
                new Chart(doughnut, {
                    type: 'doughnut',
                    data: {
                        labels: prodiExist_label,
                        datasets: [{
                            label: "Jumlah Artikel ",
                            data: prodiExist_data,
                            backgroundColor: prodiExist_warna,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        interaction: {
                            intersect: false,
                        },
                        plugins: {
                            legend: {
                                display: false,
                            }
                        },
                        scales: {
                            x: {
                                ticks: {
                                    display: false,
                                },
                                grid: {
                                    display: false,
                                }
                            },
                            y: {
                                beginAtZero: true,
                                display: false,
                                grid: {
                                    display: false,
                                }
                            }
                        },
                        cutout: "60%",
                    }
                });
        </script>
    </body>
</html>
