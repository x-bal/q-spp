@extends('layouts.master', ['title' => 'Edit Yayasan'])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Form Data Yayasan</h4>
                <a href="{{ route('yayasan.index') }}" class="btn btn-xs btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>

            <div class="card-body">
                <form action="{{ route('yayasan.update', $yayasan->id) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    @include('yayasan.form')
                </form>
            </div>
        </div>
    </div>
</div>
@stop