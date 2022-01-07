@extends('layouts.master', ['title' => 'Add Kelas'])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Form Data Kelas</h4>
                <a href="{{ route('kelas.index') }}" class="btn btn-xs btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>

            <div class="card-body">
                <form action="" method="get">
                    @role('Administrator|Admin Yayasan')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="sekolah" id="sekolah" class="form-control">
                                    <option disabled selected>-- Pilih sekolah --</option>
                                    @foreach($sekolah as $skl)
                                    <option value="{{ $skl->id }}" {{ $skl->id == request('sekolah') ? 'selected' : '' }}>{{ $skl->nama }}</option>
                                    @endforeach
                                </select>

                                @error('sekolah')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                    @endrole
                </form>
                <form action="{{ route('kelas.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('kelas.form')
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@push('script')
<script>
    $(".sekolah").on('change', function() {
        $(this).submit();
    })
</script>
@endpush