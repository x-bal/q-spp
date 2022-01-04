@extends('layouts.master', ['title' => 'Edit Jurusan'])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Form Data Jurusan</h4>
                <a href="{{ route('jurusan.index') }}" class="btn btn-xs btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>

            <div class="card-body">
                <form action="{{ route('jurusan.update', $jurusan->id) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    @include('jurusan.form')
                </form>
            </div>
        </div>
    </div>
</div>
@stop