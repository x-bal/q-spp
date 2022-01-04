@extends('layouts.master', ['title' => 'Add Kewajiban'])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Form Data Kewajiban</h4>
                <a href="{{ route('kewajiban.index') }}" class="btn btn-xs btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>

            <div class="card-body">
                <form action="{{ route('kewajiban.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('kewajiban.form')
                </form>
            </div>
        </div>
    </div>
</div>
@stop