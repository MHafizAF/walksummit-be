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
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit pendaki</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Edit pendaki</h6>
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
                <form action="{{ route('pendaki.update', $pendaki->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="nik" class="form-control-label">NIK</label>
                        <input class="form-control @error('nik') is-invalid @enderror" type="text"
                            value="{{ $pendaki->nik }}" name="nik" id="nik">
                        @error('nik')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama" class="form-control-label">Nama</label>
                        <input class="form-control @error('nama') is-invalid @enderror" type="text"
                            value="{{ $pendaki->nama }}" name="nama" id="nama">
                        @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                            <option value="P" {{ $pendaki->jenis_kelamin == "P" ? 'selected' : '' }}>P</option>
                            <option value="L" {{ $pendaki->jenis_kelamin == "L" ? 'selected' : '' }}>L</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="form-control-label">Alamat</label>
                        <input class="form-control @error('alamat') is-invalid @enderror" type="text"
                            value="{{ $pendaki->alamat }}" name="alamat" id="alamat">
                        @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_telp" class="form-control-label">Nomor Telepon</label>
                        <input class="form-control @error('no_telp') is-invalid @enderror" type="text"
                            value="{{ $pendaki->no_telp }}" name="no_telp" id="no_telp">
                        @error('no_telp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_telp_orgtua" class="form-control-label">Nomor Telepon Orang Tua</label>
                        <input class="form-control @error('no_telp_orgtua') is-invalid @enderror" type="text"
                            value="{{ $pendaki->no_telp_orgtua }}" name="no_telp_orgtua" id="no_telp_orgtua">
                        @error('no_telp_orgtua')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <input type="hidden" name="grup_id" value="{{ $pendaki->grup_id }}">
                    <button type="submit" class="btn bg-gradient-info btn-sm">Update</button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection