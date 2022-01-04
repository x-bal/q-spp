@extends('layouts.master', ['title' => 'Edit Kelas'])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Form Data Kelas</h4>
                <a href="{{ route('kelas.index') }}" class="btn btn-xs btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>

            <div class="card-body">
                <form action="{{ route('kelas.update', $kela->id) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    @include('kelas.form')
                </form>
            </div>
        </div>
    </div>
</div>
@stop