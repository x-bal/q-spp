@extends('layouts.master', ['title' => 'Pembayaran Kewajiban'])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Pembayaran Kewajiban</h4>
                <a href="{{ route('kewajiban.index') }}" class="btn btn-xs btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>

            <div class="card-body">
                <form action="{{ route('kewajiban.bayarKewajiban') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama Kewajiban</label>
                                <input type="text" name="nama_kewajiban" id="nama_kewajiban" class="form-control" value="{{ App\Models\Kewajiban::find($kewajiban->kewajiban_id)->nama }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="biaya">Biaya Kewajiban</label>
                                <input type="text" name="biaya_kewajiban" id="biaya_kewajiban" class="form-control" value="{{ App\Models\Kewajiban::find($kewajiban->kewajiban_id)->biaya }}" readonly>
                            </div>
                        </div>
                        <input type="hidden" name="siswa" value="{{ $kewajiban->siswa_id }}">
                        <input type="hidden" name="kewajiban" value="{{ $kewajiban->kewajiban_id }}">
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nominal">Nominal Bayar</label>
                                <input type="text" name="nominal" id="nominal" class="form-control" value="{{ $kewajiban->nominal ?? old('nominal') }}">

                                @error('nominal')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tanggal_bayar">Tanggal Bayar</label>
                                <input type="date" name="tanggal_bayar" id="tanggal_bayar" class="form-control" value="{{ $kewajiban->tanggal_bayar ?? old('tanggal_bayar') }}">

                                @error('tanggal_bayar')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option {{ $kewajiban->status == 'Belum Lunas' ? 'selected' : '' }} value="Belum Lunas">Belum Lunas</option>
                                    <option {{ $kewajiban->status == 'Lunas' ? 'selected' : '' }} value="Lunas">Lunas</option>
                                </select>

                                @error('status')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop