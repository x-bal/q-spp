@extends('layouts.master', ['title' => 'Edit ruang'])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Form Data ruang</h4>
                <a href="{{ route('ruang.index') }}" class="btn btn-xs btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>

            <div class="card-body">
                <form action="{{ route('ruang.update', $ruang->id) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    @include('ruang.form')
                </form>
            </div>
        </div>
    </div>
</div>
@stop