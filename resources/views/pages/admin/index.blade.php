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
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Admin</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Admin</h6>
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

    <div class="card m-2">
        <div class="card-body">
            <a href="{{ route('admin.create') }}" class="btn btn-sm btn-success"> Tambah Admin </a>
        </div>
    </div>

    <div class="card mx-2">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                id</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                username</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admin as $item)
                        <tr>
                            <td class="text-center"> {{ $item->id }}</td>
                            <td> {{ $item->username }} </td>
                            <td class="text-center">
                                <a href="{{ route('admin.edit', $item->id) }}"
                                    class="btn bg-gradient-warning btn-sm">Edit</a>
                                <form class="d-inline"
                                    onsubmit="return confirm('Data akan dihapus permanen, apakah anda yakin?')"
                                    action="{{ route('admin.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" class="btn bg-gradient-danger btn-sm" value="Delete">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $admin->links() }}
        </div>
    </div>
</main>
@endsection