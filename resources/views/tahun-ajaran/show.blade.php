@extends('layouts.master', ['title' => 'Tahun Ajaran ' . $tahunAjaran->tahun_ajaran])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Tahun Ajaran {{ $tahunAjaran->tahun_ajaran }}</h4>
                <a href="{{ route('tahun-ajaran.index') }}" class="btn btn-xs btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
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
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Jumlah</th>
                                <th>Kewajiban</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tahunAjaran->kelas as $kelas)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kelas->nama }}</td>
                                <td>{{ $kelas->jurusan->nama }}</td>
                                <td>{{ $kelas->siswa()->count() > 0 ? $kelas->siswa()->count() . ' Siswa' : 'Harap import data siswa' }}</td>
                                <td>
                                    <ul>
                                        @foreach($kelas->kewajiban as $kewajiban)
                                        <li>{{ $kewajiban->nama }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button type="button" id="{{ $kelas->id }}" class="btn btn-success shadow btn-import btn-xs mr-1" data-toggle="modal" data-target="#modalImport"><i class="fa fa-upload"></i> Import</button>
                                        <a href="#" class="btn btn-info shadow btn-xs  mr-1"><i class="fa fa-download"></i> Eksport</a>
                                        <a href="{{ route('kelas.kewajiban', $kelas->id) }}" class="btn btn-primary shadow btn-xs  mr-1"><i class="fa fa-plus"></i> Kewajiban</a>
                                        <!-- <form action="{{ route('tahun-ajaran.destroy', $kelas->id) }}" method="post" class="form-delete">
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

<div class="modal fade" id="modalImport">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Import</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="{{ route('siswa.import') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="kelas" id="kelas">
                    <div class="form-group">
                        <label for="file">File Upload</label>
                        <input type="file" name="file" id="file" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@push('script')
<!-- <script src="{{ asset('assets') }}/js/plugins-init/datatables.init.js"></script> -->
<script>
    $('#example').DataTable();

    $(".btn-import").on('click', function() {
        let id = $(this).attr('id')
        $("#kelas").val(id)
    })
</script>
@endpush