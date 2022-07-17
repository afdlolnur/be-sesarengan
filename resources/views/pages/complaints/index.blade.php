@extends('layouts.admin')

@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Data Aduan</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
          <div class="breadcrumb-item">Data Aduan</div>
        </div>
      </div>

      <div class="section-body">
        {{-- <h2 class="section-title">DataTables</h2>
        <p class="section-lead">
          We use 'DataTables' made by @SpryMedia. You can check the full documentation <a href="https://datatables.net/">here</a>.
        </p> --}}

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a href="{{ route('complaints.create') }}" class="button btn btn-icon icon-left btn-primary">
                  <i class="far fa-edit"></i>
                  Tambah Data
                </a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="table-1">
                    <thead>
                      <tr> 
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Title</th>
                        {{-- <th class="px-6 py-4">Deskripsi</th> --}}
                        <th class="px-6 py-4">Caption</th>
                        <th class="px-6 py-4">Foto</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Location</th>
                        <th class="px-6 py-4">Public</th>
                        <th class="px-6 py-4">Anonim</th>
                        <th class="px-6 py-4">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse($complaint as $item)
                        <tr>
                            <td class="py-2">{{ $item->id }}</td>
                            <td class="py-2">{{ $item->title }}</td>
                            {{-- <td class="py-2">{{ $item->description }}</td> --}}
                            <td class="py-2">{{ $item->caption }}</td>
                            <td>
                                <img alt="image" src="{{$item->picture_path}}" class="rounded-circle" width="35" data-toggle="tooltip" title="{{ $item->name }}">                              
                            </td>
                            <td class="py-2">-</td>
                            <td class="py-2">{{ $item->location }}</td>
                            <td class="py-2">{{ $item->is_public }}</td>
                            <td class="py-2">{{ $item->is_anon }}</td>

                            <td class="py-2">
                                <div class="btn-group mb-3 btn-group-sm py-text-center">
                                    <a href="{{ route('complaints.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <form action="{{ route('complaints.destroy', $item->id) }}" method="POST">
                                        {!! method_field('delete') . csrf_field() !!}
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-times" style="color: white;"></i>
                                        </button>                                        </form>
                                </div>
                            </td>
                            {{-- <td>Create a mobile app</td>
                            <td>
                            <img alt="image" src="../assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Wildan Ahdian">
                            </td>
                            <td>2018-01-20</td>
                            <td><div class="badge badge-success">Completed</div></td>
                            <td><a href="#" class="btn btn-secondary">Detail</a></td> --}}
                        </tr>
                      @empty
                        <tr>
                            <td colspan="6" class="border text-center p-5">
                                Data Ada Data
                            </td>
                        </tr>
                      @endforelse


                      {{-- <tr>
                        <td>
                          2
                        </td>
                        <td>Redesign homepage</td>
                        <td class="align-middle">
                          <div class="progress" data-height="4" data-toggle="tooltip" title="0%">
                            <div class="progress-bar" data-width="0"></div>
                          </div>
                        </td>
                        <td>
                          <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Nur Alpiana">
                          <img alt="image" src="../assets/img/avatar/avatar-3.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Hariono Yusup">
                          <img alt="image" src="../assets/img/avatar/avatar-4.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Bagus Dwi Cahya">
                        </td>
                        <td>2018-04-10</td>
                        <td><div class="badge badge-info">Todo</div></td>
                        <td><a href="#" class="btn btn-secondary">Detail</a></td>
                      </tr>
                      <tr>
                        <td>
                          3
                        </td>
                        <td>Backup database</td>
                        <td class="align-middle">
                          <div class="progress" data-height="4" data-toggle="tooltip" title="70%">
                            <div class="progress-bar bg-warning" data-width="70%"></div>
                          </div>
                        </td>
                        <td>
                          <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Rizal Fakhri">
                          <img alt="image" src="../assets/img/avatar/avatar-2.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Hasan Basri">
                        </td>
                        <td>2018-01-29</td>
                        <td><div class="badge badge-warning">In Progress</div></td>
                        <td><a href="#" class="btn btn-secondary">Detail</a></td>
                      </tr>
                      <tr>
                        <td>
                          4
                        </td>
                        <td>Input data</td>
                        <td class="align-middle">
                          <div class="progress" data-height="4" data-toggle="tooltip" title="100%">
                            <div class="progress-bar bg-success" data-width="100%"></div>
                          </div>
                        </td>
                        <td>
                          <img alt="image" src="../assets/img/avatar/avatar-2.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Rizal Fakhri">
                          <img alt="image" src="../assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Isnap Kiswandi">
                          <img alt="image" src="../assets/img/avatar/avatar-4.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Yudi Nawawi">
                          <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Khaerul Anwar">
                        </td>
                        <td>2018-01-16</td>
                        <td><div class="badge badge-success">Completed</div></td>
                        <td><a href="#" class="btn btn-secondary">Detail</a></td>
                      </tr> --}}
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </section>
</div>
@endsection