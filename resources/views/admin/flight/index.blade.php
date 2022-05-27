@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Jadwal Penerbangan
                            <a href="{{ route('admin-flight.create') }}" class="btn btn-success">
                                <i class="nav-icon fas fa-plus"></i> Tambah
                            </a>
                        </h5>
                    </div>


                    <div class="card-body">
                        @if (Session::has('message'))
                            {!! Session::get('message') !!}
                        @endif

                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kota Berangkat</th>
                                    <th>Nama Kota Tujuan</th>
                                    <th>Waktu Berangkat</th>
                                    <th>Waktu Tinggal</th>
                                    <th>Harga Tiket</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $key => $val)
                                    <tr>
                                        <td>{{ $page + ($key + 1) }}</td>
                                        <td>{{ $val->nama_kota_berangkat->nama }}</td>
                                        <td>{{ $val->nama_kota_tujuan->nama }}</td>
                                        <td>{{ $val->berangkat }}</td>
                                        <td>{{ $val->tiba }}</td>
                                        <td>{{ $val->harga }}</td>
                                        <td class="text-right py-0 align-middle">
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin-flight.edit', $val->id) }}"
                                                    class="btn btn-success m-1">
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin-flight.destroy', $val->id) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger m-1"
                                                        onclick="return confirm('Yakin Hapus Jadwal Penerbangan ini... ?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer clearfix">
                        <div class="row">
                            <div class="col-lg-4">
                                Total: <b>{{ $result->total() }} Data</b>
                            </div>
                            <div class="col-lg-8">
                                {{ $result->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
