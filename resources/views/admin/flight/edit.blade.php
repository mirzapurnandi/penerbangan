@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Jadwal Penerbangan</div>

                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin-flight.update', $result->id) }}"
                            method="POST">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <label for="kota_berangkat" class="col-sm-3 col-form-label">Keberangkatan</label>
                                    <div class="col-sm-9">
                                        {!! $kota_berangkat !!}
                                        @error('kota_berangkat')
                                            <code>{{ $message }}</code>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="kota_tujuan" class="col-sm-3 col-form-label">Tujuan</label>
                                    <div class="col-sm-9">
                                        {!! $kota_tujuan !!}
                                        @error('kota_tujuan')
                                            <code>{{ $message }}</code>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="berangkat" class="col-sm-3 col-form-label">Waktu Berangkat</label>
                                    <div class="col-sm-9">
                                        <input type="datetime-local" name="berangkat"
                                            value="{{ date('Y-m-d\TH:i', strtotime($result->berangkat)) }}"
                                            class="form-control @error('berangkat') is-invalid @enderror">
                                        @error('berangkat')
                                            <code>{{ $message }}</code>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="tiba" class="col-sm-3 col-form-label">Waktu Tiba</label>
                                    <div class="col-sm-9">
                                        <input type="datetime-local" name="tiba"
                                            value="{{ date('Y-m-d\TH:i', strtotime($result->tiba)) }}"
                                            class="form-control @error('tiba') is-invalid @enderror">
                                        @error('tiba')
                                            <code>{{ $message }}</code>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="harga" class="col-sm-3 col-form-label">Harga Tiket</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="harga" value="{{ old('harga') ?: $result->harga }}"
                                            class="form-control @error('harga') is-invalid @enderror"
                                            placeholder="Masukan Harga Tiket">
                                        @error('harga')
                                            <code>{{ $message }}</code>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="nama" class="col-sm-3 col-form-label"> </label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary"> Edit </button>
                                        <a href="{{ route('admin-flight.index') }}" class="btn btn-default float-right">
                                            Cancel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
