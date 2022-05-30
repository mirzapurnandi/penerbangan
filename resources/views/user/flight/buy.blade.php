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
                        <form class="form-horizontal" action="{{ route('flight.buy.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <input type="hidden" name="flight_id" value="{{ $flight_id }}">
                                <div class="mb-3 row">
                                    <label for="berangkat" class="col-sm-3 col-form-label">Kota Berangkat</label>
                                    <div class="col-sm-9">
                                        <input type="text" value="{{ $result->nama_kota_berangkat->nama }}"
                                            class="form-control" disabled="disabled">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="tujuan" class="col-sm-3 col-form-label">Kota Tujuan</label>
                                    <div class="col-sm-9">
                                        <input type="text" value="{{ $result->nama_kota_tujuan->nama }}"
                                            class="form-control" disabled="disabled">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="tujuan" class="col-sm-3 col-form-label">Time</label>
                                    <div class="col-sm-4">
                                        <input type="text" value="{{ $result->berangkat }}" class="form-control"
                                            disabled="disabled">
                                    </div>
                                    <label for="tujuan" class="col-sm-1 col-form-label">Sampai </label>
                                    <div class="col-sm-4">
                                        <input type="text" value="{{ $result->tiba }}" class="form-control"
                                            disabled="disabled">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="tujuan" class="col-sm-3 col-form-label">Harga</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" id="harga" value="{{ $result->harga }}">
                                        <input type="text" value="Rp. {{ format_uang($result->harga) }}"
                                            class="form-control" disabled="disabled">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="qty" class="col-sm-3 col-form-label">Jumlah Tiket</label>
                                    <div class="col-sm-4">
                                        <select name="qty" id="qty" class="form-select qty" aria-label="Qty">
                                            <option value="1"> 1 Tiket</option>
                                            <option value="2"> 2 Tiket</option>
                                            <option value="3"> 3 Tiket</option>
                                            <option value="4"> 4 Tiket</option>
                                            <option value="5"> 5 Tiket</option>
                                            <option value="7"> 7 Tiket</option>
                                            <option value="8"> 8 Tiket</option>
                                            <option value="9"> 9 Tiket</option>
                                            <option value="10"> 10 Tiket</option>
                                        </select>
                                        @error('qty')
                                            <code>{{ $message }}</code>
                                        @enderror
                                    </div>
                                    <label for="tujuan" class="col-sm-1 col-form-label">Total: </label>
                                    <div class="col-sm-4">
                                        <input type="text" id="total" value="Rp. {{ format_uang($result->harga) }}"
                                            class="form-control" readonly="readonly">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="nama" class="col-sm-3 col-form-label"> </label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary"> Beli </button>
                                        <a href="{{ route('flight.index') }}" class="btn btn-default float-right">
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

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            let ina = Intl.NumberFormat('id-ID');
            $(".qty").change(function() {
                var id = $(this).val();
                var harga = $("#harga").val();
                var total = parseInt(harga) * id;

                $("#total").val(`Rp. ${ina.format(total)}`);
            });
        });
    </script>
@endpush
