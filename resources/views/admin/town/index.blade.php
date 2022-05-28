@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    {{-- <div class="card-header">Kota Penerbangan</div> --}}
                    <div class="card-header">
                        <h5 class="m-0">Kota Penerbangan
                            <a href="{{ route('town.create') }}" class="btn btn-success">
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
                                    <th>Nama</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $key => $val)
                                    <tr>
                                        <td>{{ $page + ($key + 1) }}</td>
                                        <td>{{ $val->nama }}</td>
                                        <td class="text-right py-0 align-middle">
                                            <div class="d-flex">
                                                <a href="{{ route('town.edit', $val->id) }}" class="btn btn-success m-1">
                                                    <i class="bi bi-pen-fill"></i>
                                                </a>
                                                <form action="{{ route('town.destroy', $val->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger m-1"
                                                        onclick="return confirm('Yakin Hapus Kota ini... ?')"> <i
                                                            class="bi bi-trash-fill"></i>
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
