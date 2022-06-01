@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0"> List Pembelian Tiket Penerbangan</h5>
                    </div>


                    <div class="card-body">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Penumpang</th>
                                    <th>Total Tiket</th>
                                    <th>Total Harga</th>
                                    <th>Tanggal Pembelian</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $key => $val)
                                    <tr class="align-middle">
                                        <td>{{ $page + ($key + 1) }}</td>
                                        <td>{{ $val->user->name }}</td>
                                        <td>{{ $val->qty }} Tiket</td>
                                        <td>Rp. {{ format_uang($val->total) }}</td>
                                        <td>{!! tanggal_indonesia($val->tanggal) !!}</td>
                                        <td class="text-right py-0 align-middle">
                                            @if ($val->status == 'WAITING')
                                                {{ $val->status }} &nbsp; &nbsp; &nbsp;
                                                <a href="{{ route('admin-flight.save', $val->id) }}"
                                                    onclick="return confirm('Yakin Melunasi Tiket Penerbangan ini... ?')">
                                                    <span class="badge bg-warning">Lunas?</span>
                                                </a>
                                            @else
                                                <span class="badge bg-success">{{ $val->status }}</span>
                                            @endif
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
