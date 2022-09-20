@extends('layouts.app')

{{-- @section('title')
NOMADS
@endsection --}}

@push('addon-style')
    <link rel="stylesheet" href="{{ asset('dist/assets/css/shared/iconly.css')}}">
@endpush


@section('content')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <div class="page-heading">
            <h3>Dashboard Sesarengan</h3>
        </div>
        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-12">
                    <div class="row">
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon purple" style="background-color: #006266">
                                                <i class="iconly-boldDanger"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Jumlah Aduan</h6>
                                            <h6 class="font-extrabold mb-0">{{ $complaint_all }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon blue" style="background-color: #009432">
                                                <i class="iconly-boldProfile"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Jumlah User Aktif</h6>
                                            <h6 class="font-extrabold mb-0">{{ $user_all }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon green" style="background-color: #A3CB38">
                                                <i class="iconly-boldActivity"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Aduan Dikerjakan</h6>
                                            <h6 class="font-extrabold mb-0">{{ $complaint_dikerjakan }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon red" style="background-color: #C4E538">
                                                <i class="iconly-boldTick-Square"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Aduan Selesai</h6>
                                            <h6 class="font-extrabold mb-0">{{ $complaint_selesai }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Aduan Terkini</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-lg">
                                            <thead>
                                                <tr>
                                                    <th>Aduan</th>
                                                    <th>Deskripsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($complaint_terkini as $complaint)
                                                <tr>
                                                    <td class="col-3">
                                                        <div class="d-flex align-items-center">
                                                            <p class="font-bold ms-3 mb-0">{{ $complaint->caption->caption }}</p>
                                                        </div>
                                                    </td>
                                                    <td class="col-auto">
                                                        <p class=" mb-0">{{ $complaint->description }}</p>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Statistik Aduan</h4>
                                </div>
                                <div class="card-body">
                                    <div id="chart-visitors-profile">
                                        {!! $chart->container() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2022 &copy; Sesarengan</p>
                </div>
                <div class="float-end">
                    <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                            href="#">Sesarengan Team</a></p>
                </div>
            </div>
        </footer>
    </div>
@endsection

@push('addon-script')
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
@endpush