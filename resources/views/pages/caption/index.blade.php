@extends('layouts.app')

{{-- @section('title')
SESARENGAN
@endsection --}}

@push('addon-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/assets/css/pages/datatablescustom.css')}}">
@endpush

@section('content')
    {{-- main-start --}}
    <div id="main" data-aos="fade-up">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Data Master Caption</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Data Caption</li>
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
                            <i data-feather="plus"></i>Tambah Caption
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="tabel1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Caption</th>
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
                        <h5 class="modal-title" id="myModalLabel1">Tambah Caption</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="caption" class="form-label">Caption</label>
                            <input type="text" class="form-control" id="caption" placeholder="Masukkan Caption">
                            <input type="hidden" id="id" name="id">
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
                    url : "{{route('caption.data')}}"
                },
                columns:[
                    {
                        "data" :null, "sortable": false,
                        render : function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1
                        }
                    },
                    {data: 'caption', name: 'caption'},
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
            $('#myModalLabel1').text('Tambah Caption')
        });

        $(document).on('click','.edit', function () {
            let id = $(this).attr('id')
            $('#tambah').click()
            $('#simpanspan').text('Update')
            $('#myModalLabel1').text('Edit Caption')
            $.ajax({
                url : "{{route('caption.edit')}}",
                type : 'post',
                data : {
                    id : id,
                    _token : "{{csrf_token()}}"
                },
                success: function (res) {
                    $('#id').val(res.data.id)
                    console.log(res.data);
                    $('#caption').val(res.data.caption)

                }
            })
        })

        function tambah() {
            $.ajax({
                url : "{{route('caption.store')}}",
                type : "post",
                data : {
                    caption : $('#caption').val(),
                    "_token" : "{{csrf_token()}}"
                },
                success : function (res) {
                    console.log(res);
                    alert(res.text)
                    $('#tutup').click()
                    $('#tabel1').DataTable().ajax.reload()
                    $('#caption').val(null)
                },
                error : function (xhr) {
                    alert(xhr.responJson.text)
                }
            })
        }

        function edit(){
            $.ajax({
                url : "{{route('caption.update')}}",
                type : "post",
                data : {
                    id : $('#id').val(),
                    caption : $('#caption').val(),
                    "_token" : "{{csrf_token()}}"
                },
                success : function (res) {
                    console.log(res);
                    alert(res.text)
                    $('#tutup').click()
                    $('#tabel1').DataTable().ajax.reload()
                    $('#caption').val(null)
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
                url : "{{route('caption.delete')}}",
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