@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Kota</div>

                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('town.update', $result->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama Kota</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama"
                                            value="{{ old('nama') ? old('nama') : $result->nama }}"
                                            class="form-control @error('nama') is-invalid @enderror"
                                            placeholder="Masukan Nama Kota Penerbangan">
                                        @error('nama')
                                            <code>{{ $message }}</code>
                                        @enderror
                                    </div>
                                </div>

                                <hr>
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-2 col-form-label"> </label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary"> Edit </button>
                                        <a href="{{ route('town.index') }}" class="btn btn-default float-right">
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
