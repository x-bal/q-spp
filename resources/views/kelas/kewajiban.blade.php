@extends('layouts.master', ['title' => 'Add Kewajiban Kelas'])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Form Data Kewajiban Kelas</h4>
                <a href="{{ route('tahun-ajaran.show', $kela->tahun_ajaran_id) }}" class="btn btn-xs btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>

            <div class="card-body">
                <form action="{{ route('kelas.storeKewajiban', $kela->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="kewajiban">Kewajiban</label>
                        <select class="multi-select" name="kewajiban[]" multiple="multiple">
                            @foreach($kewajiban as $wajib)
                            <option @if(in_array($wajib->id, $kela->kewajiban()->pluck('kewajiban_id')->toArray())) selected @endif value="{{ $wajib->id }}">{{ $wajib->nama }} - {{ $wajib->biaya }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop