@extends('layouts.master', ['title' => 'Data Jurusan'])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Data Jurusan</h4>
                <a href="{{ route('jurusan.create') }}" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i> Add Jurusan</a>
            </div>

            <div class="card-body">
                @role('Admin Yayasan|Administrator')
                <form action="" method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <select name="sekolah" id="sekolah" class="form-control">
                                    <option disabled selected>-- Pilih Sekolah --</option>
                                    @foreach($sekolah as $skl)
                                    <option value="{{ $skl->id }}" {{ request('sekolah') == $skl->id ? 'selected' : '' }}>{{ $skl->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
                @endrole

                <div class="table-responsive">
                    <table class="table table-responsive-md" id="example">
                        <thead>
                            <tr>
                                <th class="width80">#</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jurusan as $jur)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $jur->nama }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('jurusan.edit', $jur->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                        <form action="{{ route('jurusan.destroy', $jur->id) }}" method="post" class="form-delete">
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