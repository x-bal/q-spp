@extends('layouts.master', ['title' => 'Add Staff'])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Form Data Staff</h4>
                <a href="{{ route('staff.index') }}" class="btn btn-xs btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>

            <div class="card-body">
                <form action="{{ route('staff.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('staff.form')
                </form>
            </div>
        </div>
    </div>
</div>
@stop