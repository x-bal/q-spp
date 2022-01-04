@extends('layouts.master', ['title' => 'Add Ruangan'])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Form Data Ruangan</h4>
                <a href="{{ route('ruang.index') }}" class="btn btn-xs btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>

            <div class="card-body">
                <form action="{{ route('ruang.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('ruang.form')
                </form>
            </div>
        </div>
    </div>
</div>
@stop