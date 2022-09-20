@extends('layouts.app')

{{-- @section('title')
SESARENGAN
@endsection --}}

@push('addon-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/assets/css/pages/datatablescustom.css')}}">
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJ6WK6_iZ6ANbmW-gieuvb3tcJc53TfyM"></script>
@endpush

@section('content')
    {{-- main-start --}}
    <div id="main" data-aos="fade-left">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Data Aduan</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Aduan</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    {{-- <div class="card-header" style="padding-bottom: 20px;"> 
                    </div> --}}
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="tabel2">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Aksi</th>
                                        <th>Caption</th>
                                        <th>Foto</th>
                                        <th>Lokasi</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                            </table>
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
                {{-- <div id="mapus"></div> --}}
            </div>
        </footer>
    </div>
    {{-- main-end --}}
    {{-- modal-start --}}
    <div class="col-12">
        <div class="modal fade text-left" id="default" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Detail Aduan</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="card-title" id="caption">Caption</h4>
                            </div>
                        </div>        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="carousel-item active">
                                    <img id="det_photo" src="https://upload.wikimedia.org/wikipedia/id/d/d4/Spongebob_Characters.jpg" class="rounded d-block w-100" alt="...">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form form-horizontal">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <h6>User</h6>
                                            </div>
                                            <div class="col-lg-10">
                                                <p id="det_user"></p>
                                            </div>
                                            <div class="col-lg-2">
                                                <h6>Deskripsi</h6>
                                            </div>
                                            <div class="col-lg-10">
                                                <p id="det_deskripsi"></p>
                                            </div>
                                            <div class="col-lg-2">
                                                <h6>Latitude</h6>
                                            </div>
                                            <div class="col-lg-4">
                                                <p id="det_latitude"></p>
                                            </div>
                                            <div class="col-lg-2">
                                                <h6>Longitude</h6>
                                            </div>
                                            <div class="col-lg-4">
                                                <p id="det_longitude"></p>
                                            </div>
                                            
                                            <div class="col-lg-2">
                                                <h6>Alamat</h6>
                                            </div>
                                            <div class="col-lg-10">
                                                <p id="det_alamat"></p>
                                            </div>
                                            <div class="col-lg-3">
                                                <h6>Public/Private</h6>
                                            </div>
                                            <div class="col-lg-9">
                                                <p id="det_is_public">...</p>
                                            </div>
                                            <div class="col-lg-2">
                                                <h6>Status</h6>
                                            </div>
                                            <div id="det_status" class="col-md-6">
                                            </div>
                                            {{-- <div class="col-md-4">
                                                <button type="button" class="btn btn-primary" id="bt-edit-status">
                                                    <span class="d-none d-sm-block">Ubah Status</span>
                                                </button>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-12">
                                <div id="map" style="height: 400px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="margin-top: 20px">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal" id="tutup">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Tutup</span>
                        </button>
                        {{-- <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal" id="simpan">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block" id="simpanspan">Simpan</span>
                        </button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal-end --}}
@endsection

@push('addon-script')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
            isi();
        })
        function isi() {
            $('#tabel2').DataTable({
                serverside : true,
                responseive : true,
                ajax : {
                    url : "{{route('complaint.data')}}"
                },
                columns:[
                    {
                        "data" :null, "sortable": false,
                        render : function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1
                        }
                    },
                    {data: 'aksi', name: 'aksi'},
                    {data: 'caption', name: 'caption'},
                    {data: 'picture_path', name: 'picture_path',
                        searchable: false,
                        orderable:false,
                        render: function( data, type, full, meta ) {
                            return "<img src=\"http://netizens.afdlolnur.id/storage/" + data + "\" height=\"50\"/>";
                        }
                    },
                    {data: 'district', name: 'district'},
                    {data: 'status', name: 'status',
                        searchable: false,
                        render: function( data, type, full, meta ) {
                            if (data === 'PENDING') {
                                return '<span class="badge bg-danger">'+ data +'</span>';
                            } else if (data === 'DITERIMA'){
                                return '<span class="badge bg-warning">'+ data +'</span>';
                            } else if(data === 'DIKERJAKAN'){
                                return '<span class="badge bg-primary">'+ data +'</span>';
                            } else {
                                return '<span class="badge bg-success">'+ data +'</span>';
                            } // return "<img src=\"http://netizens.afdlolnur.id/storage/" + data + "\" height=\"50\"/>";
                        }
                    }
                ]
            })
        }
    </script>
    <script>
        $(document).on('click','.edit', function () {
            let id = $(this).attr('id')
        
            $.ajax({
                url : "{{route('complaint.edit')}}",
                type : 'post',
                data : {
                    id : id,
                    _token : "{{csrf_token()}}"
                },
                success: function (res) {
                    $("#det_status").empty();
                    $('#det_id').val(res.data.id)
                    console.log(res.data);
                    $('#caption').text(res.data.caption.caption)
                    if(res.data.is_anon == 0){
                        $('#det_user').text(res.data.user.name)
                    } else{
                        $('#det_user').text('Anonymous')
                    }
                    $('#det_deskripsi').text(res.data.description)
                    $('#det_latitude').text(res.data.latitude)
                    $('#det_longitude').text(res.data.longitude)
                    $('#det_alamat').text(res.data.district)
                    if(res.data.status == 'PENDING'){
                        $('#det_status').append( "<span id='span_a' class='badge bg-danger'>PENDING</span>" )
                    }else if (res.data.status == 'DITERIMA'){
                        $('#det_status').append( "<span id='span_a' class='badge bg-warning'>DITERIMA</span>" )
                    }else if(res.data.status == 'DIKERJAKAN'){
                        $('#det_status').append( "<span id='span_a' class='badge bg-primary'>DIKERJAKAN</span>" )
                    }else(
                        $('#det_status').append( "<span id='span_a' class='badge bg-success'>SELESAI</span>" )
                    )
                    $("#det_photo").attr("src",res.data.picture_path);
                    //map render
                    const uluru = { lat: parseFloat( res.data.latitude ), lng: parseFloat( res.data.longitude ) };
                    const map = new google.maps.Map(document.getElementById("map"), {
                        zoom: 18,
                        center: uluru,
                        mapTypeId:google.maps.MapTypeId.HYBRID
                    });
                    const marker = new google.maps.Marker({
                        position: uluru,
                        map: map,
                    });
                }
            })
        })
    </script>
    <script>

    </script>
@endpush