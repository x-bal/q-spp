@extends('layouts.master', ['title' => 'Edit Sekolah'])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Form Data Sekolah</h4>
                <a href="{{ route('sekolah.index') }}" class="btn btn-xs btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>

            <div class="card-body">
                <form action="{{ route('sekolah.update', $sekolah->id) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    @include('sekolah.form')
                </form>
            </div>
        </div>
    </div>
</div>
@stop