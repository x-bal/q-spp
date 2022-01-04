@extends('layouts.master', ['title' => 'Data Siswa'])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Data Siswa</h4>
                <a href="{{ route('siswa.create') }}" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i> Add Siswa</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
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
                    <table class="table table-responsive-md" id="example">
                        <thead>
                            <tr>
                                <th class="width80">#</th>
                                <th>Nisn</th>
                                <th>Nama</th>
                                <th>Tempat, Tanggal Lahir</th>
                                <th>Kelas</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswa as $sis)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sis->nisn }}</td>
                                <td>{{ $sis->nama }}</td>
                                <td>{{ $sis->tempat_lahir . ', ' . Carbon\Carbon::parse($sis->tanggal_lahir)->format('d/m/Y') }}</td>
                                <td>{{ $sis->kelas->nama }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('siswa.edit', $sis->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                        <!-- <form action="{{ route('siswa.destroy', $sis->id) }}" method="post" class="form-delete">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger shadow btn-xs sharp btn-delete"><i class="fa fa-trash"></i></button>
                                        </form> -->
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