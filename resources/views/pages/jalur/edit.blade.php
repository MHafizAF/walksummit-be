@extends('layouts.global')

@section('content')
@include('partials.sidebar')

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit jalur</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Edit jalur</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                </div>
                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item d-flex align-items-center">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <input type="submit" value="Log Out"
                                class="dropdown-item text-center text-danger text-bold fw-bold">
                        </form>
                    </li>
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('jalur.update', $jalur->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <input type="hidden" name="admin_id" value="{{ Auth::user()->id }}">
                    <div class="form-group">
                        <label for="nama" class="form-control-label">Nama</label>
                        <input class="form-control @error('nama') is-invalid @enderror" type="text"
                            value="{{ $jalur->nama }}" name="nama" id="nama">
                        @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kuota" class="form-control-label">Kuota</label>
                        <input class="form-control @error('kuota') is-invalid @enderror" type="text"
                            value="{{ $jalur->kuota }}" name="kuota" id="kuota">
                        @error('kuota')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn bg-gradient-info btn-sm">Update</button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection