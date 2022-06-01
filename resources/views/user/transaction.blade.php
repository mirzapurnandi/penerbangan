@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0"> Pesanan Anda </h5>
                    </div>

                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                                    aria-selected="true"> Pesanan Anda </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#profile-tab-pane" type="button" role="tab"
                                    aria-controls="profile-tab-pane" aria-selected="false"> History Pesanan</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                aria-labelledby="home-tab" tabindex="0">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Kota Penerbangan</th>
                                            <th>Jadwal Penerbangan</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($result as $key => $val)
                                            <tr>
                                                <td>{{ $page + ($key + 1) }}</td>
                                                <td>{{ $val->flight->nama_kota_berangkat->nama }} to
                                                    {{ $val->flight->nama_kota_tujuan->nama }}</td>
                                                <td>{{ tanggal_indonesia($val->flight->berangkat, true, false) }}</td>
                                                <td>{{ $val->status }}</td>
                                                <td>Rp. {{ format_uang($val->total) }}</td>
                                                <td>
                                                    Bayar
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                                tabindex="0">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Kota Penerbangan</th>
                                            <th>Jadwal Penerbangan</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($history as $keys => $vals)
                                            <tr>
                                                <td>{{ $page + ($keys + 1) }}</td>
                                                <td>{{ $vals->flight->nama_kota_berangkat->nama }} to
                                                    {{ $vals->flight->nama_kota_tujuan->nama }}</td>
                                                <td>{{ tanggal_indonesia($vals->flight->berangkat, true, false) }}</td>
                                                <td>Rp. {{ format_uang($vals->total) }}</td>
                                                <td>{{ $vals->status }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
