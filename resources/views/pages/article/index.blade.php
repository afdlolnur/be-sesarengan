@extends('layouts.app')

{{-- @section('title')
SESARENGAN
@endsection --}}

@push('addon-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/assets/css/pages/datatablescustom.css')}}">
@endpush

@section('content')
    {{-- main-start --}}
    <div id="main" data-aos="fade-down">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Data Master Artikel</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Data Artikel</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header" style="padding-bottom: 16px; align: right;">
                        <button id="btnTambah" type="button" class="btn btn-success icon icon-left" data-bs-toggle="modal"
                            data-bs-target="#default">
                            <i data-feather="plus"></i>Tambah Artikel
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="tabel1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
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
            </div>
        </footer>
    </div>
    {{-- main-end --}}
    {{-- modal-start --}}
    <div class="col-12">
        <div class="modal fade text-left" id="default" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Tambah Artikel</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="artikeljudul" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="artikeljudul" placeholder="Judul Artikel">
                            <input type="hidden" id="id" name="id">
                        </div>
                        <div class="mb-3">
                            <label for="artikeldeskripsi" class="form-label">Deskripsi</label>
                            <textarea type="text" rows="4" class="form-control" id="artikeldeskripsi" placeholder="Isi Artikel"></textarea>
                        </div>
                        <div class="mb-3">
                            {{-- <label for="artikelpublish" class="form-label">Publish/Unpublish</label>
                            <input type="text" class="form-control" id="artikelpublish" placeholder="Nama Wisata">
                            <input type="hidden" id="id" name="id"> --}}

                            <input type="radio" id="publish" name="artikelpublish" value="1">
                            <label for="publish">Publish</label><br>
                            <input type="radio" id="unpublish" name="artikelpublish" value="0">
                            <label for="unpublish">Unpublish</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal" id="tutup">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Batal</span>
                        </button>
                        <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal" id="simpan">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block" id="simpanspan">Simpan</span>
                        </button>
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
            $('#tabel1').DataTable({
                serverside : true,
                responseive : true,
                ajax : {
                    url : "{{route('article.data')}}"
                },
                columns:[
                    {
                        "data" :null, "sortable": false,
                        render : function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1
                        }
                    },
                    {data: 'title', name: 'title'},
                    {data: 'description', name: 'description'},
                    {data: 'is_publish', name: 'is_publish',
                        searchable: false,
                        render: function( data, type, full, meta ) {
                            if (data == 1) {
                                return '<span class="badge bg-success">Publish</span>';
                            } else {
                                return '<span class="badge bg-primary">Unpublish</span>';
                            } // return "<img src=\"http://netizens.afdlolnur.id/storage/" + data + "\" height=\"50\"/>";
                        }
                    },
                    {data: 'aksi', name: 'aksi'}
                ]
            })
        }
    </script>
    <script>
        $('#simpanspan').on('click',function () {
            if ($(this).text() === 'Simpan') {
                tambah();
            } else {
                edit();
            }
        });

        $(document).on('click','#btnTambah', function () {
            $('#simpanspan').text('Simpan')
            $('#myModalLabel1').text('Tambah Artikel')
            $('#artikeljudul').val(null)
            $('#artikeldeskripsi').val(null)
            $('#artikelpublish').val(null)
        });

        $(document).on('click','.edit', function () {
            let id = $(this).attr('id')
            $('#tambah').click()
            $('#simpanspan').text('Update')
            $('#myModalLabel1').text('Edit Artikel')
            $.ajax({
                url : "{{route('article.edit')}}",
                type : 'post',
                data : {
                    id : id,
                    _token : "{{csrf_token()}}"
                },
                success: function (res) {
                    $('#id').val(res.data.id)
                    console.log(res.data);
                    $('#artikeljudul').val(res.data.title)
                    $('#artikeldeskripsi').val(res.data.description)
                    if(res.data.is_publish == 1)
                    {
                        $('#publish').prop("checked", true);
                    } else {
                        $('#unpublish').prop("checked", true);
                    }
                }
            })
        })

        function tambah() {
            $.ajax({
                url : "{{route('article.store')}}",
                type : "post",
                data : {
                    title : $('#artikeljudul').val(),
                    description : $('#artikeldeskripsi').val(),
                    is_publish : $('input[name=artikelpublish]:checked').val(),
                    "_token" : "{{csrf_token()}}"
                },
                success : function (res) {
                    console.log(res);
                    alert(res.text)
                    $('#tutup').click()
                    $('#tabel1').DataTable().ajax.reload()
                    $('#artikeljudul').val(null)
                    $('#artikeldeskripsi').val(null)
                    $('#artikelpublish').val(null)
                },
                error : function (xhr) {
                    alert(xhr.responJson.text)
                }
            })
        }

        function edit(){
            $.ajax({
                url : "{{route('article.update')}}",
                type : "post",
                data : {
                    id : $('#id').val(),
                    title : $('#artikeljudul').val(),
                    description : $('#artikeldeskripsi').val(),
                    is_publish : $('input[name=artikelpublish]:checked').val(),
                    "_token" : "{{csrf_token()}}"
                },
                success : function (res) {
                    console.log(res);
                    alert(res.text)
                    $('#tutup').click()
                    $('#tabel1').DataTable().ajax.reload()
                    $('#artikeljudul').val(null)
                    $('#artikeldeskripsi').val(null)
                    $('#artikelpublish').val(null)
                    $('#simpanspan').text("Simpan")
                },
                error : function (xhr) {
                    alert(xhr.responJson.text)
                }
            }) 
        }

        $(document).on('click','.hapus', function () {
            let id = $(this).attr('id')
            $.ajax({
                url : "{{route('article.delete')}}",
                type : 'post',
                data: {
                    id: id,
                    "_token" : "{{csrf_token()}}"
                },
                success: function (params) {
                    alert(params.text)
                    $('#tabel1').DataTable().ajax.reload()
                }
            })
        })
    </script>
@endpush