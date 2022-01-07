@extends('layouts.master', ['title' => 'Data Staff'])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Data Staff</h4>
                <a href="{{ route('staff.create') }}" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i> Add Staff</a>
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
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Nama</strong></th>
                                <th><strong>Nip</strong></th>
                                <th><strong>Tgl Lahir</strong></th>
                                <th><strong>Sekolah</strong></th>
                                <th><strong>Jabatan</strong></th>
                                <th><strong>Action</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($staffs as $staff)
                            <tr>
                                <td class="{{ $staff->user->is_active == 0 ? 'text-danger' : '' }}">{{ $loop->iteration }}</td>
                                <td class="{{ $staff->user->is_active == 0 ? 'text-danger' : '' }}">{{ $staff->user->name }}</td>
                                <td class="{{ $staff->user->is_active == 0 ? 'text-danger' : '' }}">{{ $staff->user->username }}</td>
                                <td class="{{ $staff->user->is_active == 0 ? 'text-danger' : '' }}">{{ Carbon\Carbon::parse($staff->tgl_lahir)->format('d/m/Y') }}</td>
                                <td class="{{ $staff->user->is_active == 0 ? 'text-danger' : '' }}">{{ $staff->sekolah->nama }}</td>
                                <td class="{{ $staff->user->is_active == 0 ? 'text-danger' : '' }}">{{ $staff->jabatan }}</td>
                                <td>
                                    <div class="d-flex">
                                        @if($staff->user->is_active == 1)
                                        <a href="{{ route('staff.edit', $staff->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                        <form action="{{ route('staff.destroy', $staff->id) }}" method="post" class="form-delete">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger shadow btn-xs sharp btn-delete"><i class="fa fa-trash"></i></button>
                                        </form>
                                        @else
                                        <form action="{{ route('staff.activate', $staff->id) }}" method="post" class="form-activate">
                                            @csrf
                                            <button type="submit" class="btn btn-success shadow btn-xs sharp btn-activate"><i class="fa fa-power-off"></i></button>
                                        </form>
                                        @endif
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