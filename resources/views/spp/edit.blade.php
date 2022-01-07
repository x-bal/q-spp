@extends('layouts.master', ['title' => 'Edit SPP'])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Form Data SPP</h4>
                <a href="{{ route('spp.index') }}" class="btn btn-xs btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>

            <div class="card-body">
                <form action="{{ route('spp.update', $spp->spp_id) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    @include('spp.form')
                </form>
            </div>
        </div>
    </div>
</div>
@stop