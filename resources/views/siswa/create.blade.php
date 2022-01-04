@extends('layouts.master', ['title' => 'Add Siswa'])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Form Data Siswa</h4>
                <a href="{{ route('siswa.index') }}" class="btn btn-xs btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>

            <div class="card-body">
                <form action="{{ route('siswa.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('siswa.form')
                </form>
            </div>
        </div>
    </div>
</div>
@stop