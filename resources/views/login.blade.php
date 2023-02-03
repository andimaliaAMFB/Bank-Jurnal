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

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block d-flex justify-content-between align-items-center">
            <strong>{{ $message }}</strong>
        </div>
    @endif    
    @if ($errors->any())
        <div class="alert alert-danger alert-block ">
            <strong>Ada Kesalahan Input dalam: </strong>
            <br>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
    <main>
        <div class="main-isi" id="main-isi">
            @if ($form == 'login')
            <form action="{{ route('login.store') }}" method="POST" class="row form-card justify-content-center" name="{{ $form }}">
            @else
            <form action="{{ route('signup.store') }}" method="POST" class="row form-card justify-content-center" name="{{ $form }}">
            @endif
                {{ csrf_field() }}
                @if ($errors->has('username'))
                    <input type="hidden" name="username_error" id="username_error">
                @endif
                @if ($errors->has('pass'))
                    <input type="hidden" name="pass_error" id="pass_error">
                @endif
                @if ($errors->has('email'))
                    <input type="hidden" name="email_error" id="email_error">
                @endif
                @if ($errors->has('email'))
                    <input type="hidden" name="passS_error" id="passS_error">
                @endif
                <div class="card panel panel-change col-3">
                    <div class="d-flex justify-content-evenly align-items-center">
                        <img class="logo navbar-toggler-icon" src="asset/logo_rumah jurnal 1.png">
                        <p id="nama-aplikasi">Rumah Jurnal</p>
                    </div>
                    <div class="flex-grow-1 d-flex justify-content-center flex-column" id="change">
                        <div>
                            <div class="form-title">
                                <p>Selamat Datang!</p>
                            </div>
                            <div class="form-subtitle">
                                <p>Belum memiliki akun Rumah Jurnal?</p>
                            </div>
                        </div>
                        <div>
                            <button type="button" class="btn change-btn w-100">
                                <p>Sign Up</p>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card panel panel-isi col-5 justify-content-center px-5">
                    <div class="form-title">
                        <p>Sign In to Rumah Jurnal</p>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="searchbar">
                            <input type="text" name="username" id="username" placeholder="Username" class="w-100">
                        </div>
                        <div class="searchbar">
                            <input type="text" name="email" id="email" placeholder="Email" class="w-100">
                        </div>
                        <div class="searchbar">
                            <input type="password" name="pass" id="pass" placeholder="Password" class="w-100">
                        </div>
                        <div class="searchbar">
                            <input type="password" name="passS" id="passS" placeholder="Re Enter Password" class="w-100">
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <button type="submit" class="btn log-btn w-100">
                            <p>Sign In</p>
                        </button>
                        <div class="form-subtitle">
                            <p>Atau Sign In Menggunakan</p>
                        </div>
                        <button type="button" class="btn log-btn-border d-flex justify-content-between align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google logo" viewBox="0 0 16 16">
                                <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"></path>
                            </svg>
                            <p class="flex-grow-1">Google</p>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <div class="shade fade" id="shade"></div>
    
    <!-- JS comunicate with database -->
    <script type="text/javascript">

        let list_judul = [];
        let list_penulis = [];
        let list_prodi = [];
        let final_list = [];

    </script>
    <!-- JS comunicate with database -->
    <script src="Script.js"></script>

    <script type="text/javascript">
        var array_error = [];
        array_error[0] = document.querySelector(`#username_error`);
        array_error[1] = document.querySelector(`#pass_error`);
        array_error[2] = document.querySelector(`#email_error`);
        array_error[3] = document.querySelector(`#passS_error`);

        array_error.forEach(error => {
            // console.log(error);
            if (error) {
                string_element = ".searchbar input#" + error.id.split('_')[0];
                element = document.querySelector(string_element);
                element.parentNode.classList.add('line-red-1');
                // element.value = "{{ $errors->first('username') }}";
                // console.log(string_element,element,element.parentNode);
            }
        });
        if (document.querySelector(`#username`)) { document.querySelector(`#username`).value = "{{ old('username') }}"; }
        if (document.querySelector(`#pass`)) { document.querySelector(`#pass`).value = "{{ old('pass') }}"; }
        if (document.querySelector(`#email`)) { document.querySelector(`#email`).value = "{{ old('email') }}"; }
        if (document.querySelector(`#passS`)) { document.querySelector(`#passS`).value = "{{ old('passS') }}"; }
    </script>
</body>
</html>
