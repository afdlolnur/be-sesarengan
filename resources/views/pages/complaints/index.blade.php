<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesarengan</title>

    <link rel="stylesheet" href="{{ asset('dist/assets/css/main/app.css')}}">
    <link rel="stylesheet" href="{{ asset('dist/assets/css/main/app-dark.css')}}">
    <link rel="shortcut icon" href="{{ asset('dist/assets/images/logo/favicon.svg')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('dist/assets/images/logo/favicon.png')}}" type="image/png">

     {{-- 1. DATATABLES --}}
     <link rel="stylesheet" type="text/css" href="{{ asset('dist/assets/css/pages/datatablescustom.css')}}">
        <script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJ6WK6_iZ6ANbmW-gieuvb3tcJc53TfyM">
</script>
</head>
<body>
    <div id="app">
        {{-- sidebar:start --}}
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="index.html"><img src="{{ asset('dist/assets/images/logo/sesarengan.png') }}" alt="Logo" srcset=""></a>
                        </div>
                        <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20"
                                height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                        opacity=".3"></path>
                                    <g transform="translate(-210 -1)">
                                        <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                        <circle cx="220.5" cy="11.5" r="4"></circle>
                                        <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark">
                                <label class="form-check-label"></label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20"
                                preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                                </path>
                            </svg>
                        </div>
                        <div class="sidebar-toggler  x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item">
                            <a href="index.html" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item has-sub active">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Aduan</span>
                            </a>
                            <ul class="submenu active">
                                <li class="submenu-item active">
                                    <a href="#">Data Aduan</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-collection-fill"></i>
                                <span>Data Master</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item ">
                                    <a href="#">Data User</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="#">Data Caption</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="#">Data Wisata</a>
                                </li>
                                <!-- <li class="submenu-item ">
                                    <a href="#">Sweet Alert</a>
                                </li> -->
                            </ul>
                        </li>
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-grid-1x2-fill"></i>
                                <span>Setting</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="#">1</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="#">2</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="#">3</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="table.html" class='sidebar-link'>
                                <i class="bi bi-x-octagon-fill"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- sidebar:end --}}
        <div id="main">
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
    </div>  

    <!--Basic Modal -->
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
                                            <div id="det_status" class="col-md-10">
                                            </div>
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
    <script src="{{asset('dist/assets/js/app.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
        // console.log(id);
        // $('#tambah').click()
        // $('#simpanspan').text('Update')
        // $('#myModalLabel1').text('Detail Aduan')
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

    // function initialize() {
    //      var propertiPeta = {
    //          center: new google.maps.LatLng(-8.5830695, 116.3202515),
    //          zoom: 9,
    //          mapTypeId: google.maps.MapTypeId.ROADMAP
    //      };
    //      var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
    //      // membuat Marker
    //      var marker = new google.maps.Marker({
    //          position: new google.maps.LatLng(-8.5830695, 116.3202515),
    //          map: peta
    //      });
    //  };
</script>

</body>
</html>