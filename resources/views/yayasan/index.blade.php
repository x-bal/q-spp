@extends('layouts.master', ['title' => 'Data Yayasan'])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Data Yayasan</h4>
                <a href="{{ route('yayasan.create') }}" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i> Add Yayasan</a>
            </div>

            <div class="card-body">
                @role('Admin Yayasan')
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
                                <!-- <th>Logo</th> -->
                                <th>Nama</th>
                                <th>Telp</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($yayasan as $ysn)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ysn->nama }}</td>
                                <td>{{ $ysn->telp }}</td>
                                <td>{{ $ysn->alamat }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('yayasan.use', $ysn->id) }}?use={{ $ysn->is_use == 0 ? 1 : 0 }}" class="btn btn-{{ $ysn->is_use == 1 ? 'danger' : 'info' }} shadow btn-xs sharp mr-1"><i class="fa fa-{{ $ysn->is_use == 1 ? 'times' : 'check' }}"></i></a>
                                        <a href="{{ route('yayasan.edit', $ysn->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                        <form action="{{ route('yayasan.destroy', $ysn->id) }}" method="post" class="form-delete">
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