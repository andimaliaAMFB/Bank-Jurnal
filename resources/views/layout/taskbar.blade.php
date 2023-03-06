@if(Auth::check())
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
                <a href="{{ route('dashboard') }}" class="ms-2">
                    <div class="navbar head-logo">
                        <img class="navbar-toggler-icon me-3" src="../../asset/logo_rumah jurnal 1.png">
                        <p id="nama-aplikasi" style="font-weight: bold;">Rumah Jurnal</p>
                    </div>
                </a>
            </div>
            <div class="task-content">
                <ul>
                    <a href="{{ route('dashboard') }}"><li>Dashboard</li></a>
                    <a href="{{ route('article.create') }}"><li>Upload Artikel</li></a>
                    @if(isset(Auth::user()->status) && Auth::user()->status == 'Admin')
                    <a href="{{ route('akun') }}"><li>Akun Pengguna</li></a>
                    <a href="{{ route('prodi') }}"><li>Program Studi</li></a>
                    <a href="{{ route('status.index', ['level_status' => 'draft']) }}"><li>Draft<p>{{ $taskbarValue['Draft'] }}</p></li></a>
                    <a href="{{ route('status.index', ['level_status' => 'revisi-mayor']) }}"><li>Revisi Mayor<p>{{ $taskbarValue['Revisi Mayor'] }}</p></li></a>
                    <a href="{{ route('status.index', ['level_status' => 'revisi-minor']) }}"><li>Revisi Minor<p>{{ $taskbarValue['Revisi Minor'] }}</p></li></a>
                    @elseif(isset(Auth::user()->status) && Auth::user()->status == 'Penulis')
                    <a href="{{ route('myarticle') }}"><li>My Article<p>{{ $taskbarValue['My Article'] }}</p></li></a>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endif