@extends('layouts.master', ['title' => 'Add Permission'])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Form Data Permission</h4>
                <a href="{{ route('permission.index') }}" class="btn btn-xs btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>

            <div class="card-body">
                <form action="{{ route('permission.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('permission.form')
                </form>
            </div>
        </div>
    </div>
</div>
@stop