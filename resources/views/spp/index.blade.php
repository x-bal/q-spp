@extends('layouts.master', ['title' => 'Data SPP'])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Data SPP</h4>
            </div>

            <div class="card-body">
                <form action="" method="get">
                    <div class="row">
                        @role('Admin Yayasan|Administrator')
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
                        @endrole

                        <div class="col-md-4">
                            <div class="form-group">
                                <select name="siswa" id="single-select">
                                    <option disabled selected>-- Pilih Siswa --</option>
                                    @foreach($siswa as $sw)
                                    <option value="{{ $sw->id }}" {{ request('siswa') == $sw->id ? 'selected' : '' }}>{{ $sw->nisn }} - {{ $sw->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-responsive-md" id="example">
                        <thead>
                            <tr>
                                <th class="width80">#</th>
                                <th>Bulan</th>
                                <th>Tahun</th>
                                <th>Nominal</th>
                                <th>Tanggal Bayar</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(request('siswa'))
                            @foreach($spp->spp as $sp)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $sp->bulan }}
                                </td>
                                <td>
                                    {{ $sp->tahun }}
                                </td>
                                <td>
                                    Rp. {{ $sp->pivot->nominal }}
                                </td>
                                <td>
                                    {{ $sp->pivot->status == 'Lunas' ? Carbon\Carbon::parse($sp->pivot->tanggal_bayar)->format('d/m/Y') : '-' }}
                                </td>
                                <td>
                                    <span class="badge badge-{{ $sp->pivot->status == 'Lunas' ? 'success' : 'danger' }}">{{ $sp->pivot->status }}</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('spp.edit', $sp->id) }}?siswa={{ $spp->id }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                        <!-- <form action="{{ route('spp.destroy', $sp->id) }}" method="post" class="form-delete">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger shadow btn-xs sharp btn-delete"><i class="fa fa-trash"></i></button>
                                        </form> -->
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
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