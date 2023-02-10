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
                            <p style="font-size:medium;">Tanggal Upload: {{ $final[0][4] }}</p>
                            <p style="font-size:medium;">Tanggal Rilis: {{ $final[0][5] }}</p>
                        </div>
                        <div class="card-body article d-flex flex-column px-4" id="docViewer">
                            <iframe src="../{{ 'storage/article/'.$pathArtikel }}#toolbar=0" frameborder="0" style="width:100%;height:100%;"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer>

        </footer>
        <div class="shade fade" id="shade"></div>
        
        <!-- JS comunicate with database -->
        <script>
            var judul = <?php echo json_encode($judul); ?>;
            var penulis = <?php echo json_encode($penulis); ?>;
            var final = <?php echo json_encode($final); ?>;
            var finalSearch = <?php echo json_encode($finalSearch); ?>;

            let list_judul = [];
            judul.forEach((element,index) => { list_judul[index] = judul[index]; });
            let list_penulis = [];
            penulis.forEach((element,index) => { list_penulis[index] = penulis[index]; });
            let list_prodi = [];
            let final_list = final;
            let final_search = finalSearch;
            // console.log(final);
        </script>
        <!-- JS comunicate with database -->

        <script src="../../Script.js"></script>
    </body>
</html>