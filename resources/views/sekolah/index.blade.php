@extends('layouts.master', ['title' => 'Data Sekolah'])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Data Sekolah</h4>
                <a href="{{ route('sekolah.create') }}" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i> Add Sekolah</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive-md" id="example">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Nama</strong></th>
                                <th><strong>Telp</strong></th>
                                <th><strong>Alamat</strong></th>
                                <th><strong>Action</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sekolah as $skl)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $skl->nama }}</td>
                                <td>{{ $skl->telp }}</td>
                                <td>{{ $skl->alamat }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('sekolah.edit', $skl->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                        <form action="{{ route('sekolah.destroy', $skl->id) }}" method="post" class="form-delete">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger shadow btn-xs sharp btn-delete"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('script')
<!-- <script src="{{ asset('assets') }}/js/plugins-init/datatables.init.js"></script> -->
<script>
    $('#example').DataTable();
</script>
@endpush