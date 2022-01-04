@extends('layouts.master', ['title' => 'Add Role'])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Form Data Role</h4>
                <a href="{{ route('role.index') }}" class="btn btn-xs btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>

            <div class="card-body">
                <form action="{{ route('role.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('role.form')
                </form>
            </div>
        </div>
    </div>
</div>
@stop