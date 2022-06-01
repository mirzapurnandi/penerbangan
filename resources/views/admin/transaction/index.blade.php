@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0"> List Pesanan yang Telah Masuk </h5>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Penumpang</th>
                                    <th>Kota Penerbangan</th>
                                    <th>Jadwal Penerbangan</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $key => $val)
                                    <tr>
                                        <td>{{ $page + ($key + 1) }}</td>
                                        <td>{{ $val->user->name }}</td>
                                        <td>{{ $val->flight->nama_kota_berangkat->nama }} to
                                            {{ $val->flight->nama_kota_tujuan->nama }}</td>
                                        <td>{{ tanggal_indonesia($val->flight->berangkat, true, false) }}</td>
                                        <td>Rp. {{ format_uang($val->total) }}</td>
                                        <td>{{ $val->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
