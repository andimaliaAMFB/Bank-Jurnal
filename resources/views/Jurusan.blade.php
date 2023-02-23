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

        <main>
            <div class="main-isi" id="main-isi">
                <div class="judul-hlm"><h2>{{ $title }}</h2></div>
                <form action="{{ route('prodi.update', ['id' => 'update']) }}" method="POST" enctype="multipart/form-data" name="Jurusan">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <div class="d-flex flex-wrap justify-content-center w-100">
                    @foreach($tableProdi as $key => $value)
                        <div class="d-flex flex-column justify-content-between align-items-center col-md-2 border p-2 m-2 img_add blockDiv position-relative">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill position-absolute top-0 end-0 m-3" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                            </svg>
                            <label for="img-input_{{ $value['id_jurusan'] }}" class="btn w-100 h-100 position-relative d-flex justify-content-center align-items-center">
                                @if(isset($value['lambang_jurusan']))
                                <img src="{{ 'storage/jurusan-image/'.$value['lambang_jurusan'] }}" id="uploadedIMG_{{ $value['id_jurusan'] }}" style="width:50%;">
                                @else
                                <img src="" id="uploadedIMG_{{ $value['id_jurusan'] }}" style="width:50%;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" id="blank-pp" class="bi bi-journal position-absolute w-100 h-100 top-0 start-0 p-2 p-md-4" viewBox="0 0 16 16" style="display: block; opacity: 0.75;">
                                    <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                                    <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                                </svg>
                                @endif
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg position-absolute w-100 h-100 top-0 start-0 p-3 p-md-5" viewBox="0 0 16 16" style="display:none;">
                                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                                </svg>
                            </label>
                            <input class="form-file" id="img-input_{{ $value['id_jurusan'] }}" type="file" name="imageup_{{ $value['id_jurusan'] }}" style="display:none; visibility: none;" onchange="priviewImage(`{{ $value['id_jurusan'] }}`);"/>
                            <div class="p-2 w-100 text-center line-3-h d-flex justify-content-between align-items-center">
                                <input name="{{ $value['id_jurusan'] }}" type="text" class="p-0" value="{{ $value['nama_jurusan'] }}" style="font-weight:bolder;" required>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                </svg>
                            </div>
                        </div>
                    @endforeach
                    <button type="submit" class="position-fixed bottom-0 end-0 m-3 m-md-5 btn submit-btn col-auto" style="box-shadow: 0px 0px 16px rgb(0 0 0 / 25%);">Perbarui Program Studi</button>
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

            let list_judul = [];
            let list_penulis = [];
            let list_prodi = [];
            let final_list = [];;
            let final_search = finalSearch;
        </script>
        <!-- JS comunicate with database -->

        
        <script src="Script.js"></script>
        <script type="text/javascript">
            function priviewImage(id){
                var file = document.getElementById('img-input_'+id).files;
                if (file.length > 0) {
                    var fileReader = new FileReader();

                    fileReader.onload = function (event){
                        document.getElementById('uploadedIMG_'+id).setAttribute("src",event.target.result);
                    };
                    fileReader.readAsDataURL(file[0]);
                }
                parent = document.getElementById('uploadedIMG_'+id).parentNode;
                parent.querySelector('svg#blank-pp').remove();
            }
        </script>
    </body>
</html>
