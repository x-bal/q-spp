<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="tahun">Tahun Ajaran</label>
            <input type="text" name="tahun" id="tahun" class="form-control" placeholder="2022/2023" value="{{ $tahunAjaran->tahun_ajaran ?? old('tahun_ajaran') }}">

            @error('tahun')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="mulai">Mulai</label>
            <select name="mulai" id="mulai" class="form-control">
                <option disabled selected>-- Pilih Bulan --</option>
                <option {{ $tahunAjaran->mulai == '01' ? 'selected' : '' }} value="01">Januari</option>
                <option {{ $tahunAjaran->mulai == '02' ? 'selected' : '' }} value="02">Febuari</option>
                <option {{ $tahunAjaran->mulai == '03' ? 'selected' : '' }} value="03">Maret</option>
                <option {{ $tahunAjaran->mulai == '04' ? 'selected' : '' }} value="04">April</option>
                <option {{ $tahunAjaran->mulai == '05' ? 'selected' : '' }} value="05">Mei</option>
                <option {{ $tahunAjaran->mulai == '06' ? 'selected' : '' }} value="06">Juni</option>
                <option {{ $tahunAjaran->mulai == '07' ? 'selected' : '' }} value="07">Juli</option>
                <option {{ $tahunAjaran->mulai == '08' ? 'selected' : '' }} value="08">Agustus</option>
                <option {{ $tahunAjaran->mulai == '09' ? 'selected' : '' }} value="09">September</option>
                <option {{ $tahunAjaran->mulai == '10' ? 'selected' : '' }} value="10">Oktober</option>
                <option {{ $tahunAjaran->mulai == '11' ? 'selected' : '' }} value="11">November</option>
                <option {{ $tahunAjaran->mulai == '12' ? 'selected' : '' }} value="12">Desember</option>
            </select>

            @error('mulai')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="sampai">Sampai</label>
            <select name="sampai" id="sampai" class="form-control">
                <option disabled selected>-- Pilih Bulan --</option>
                <option {{ $tahunAjaran->sampai == '01' ? 'selected' : '' }} value="01">Januari</option>
                <option {{ $tahunAjaran->sampai == '02' ? 'selected' : '' }} value="02">Febuari</option>
                <option {{ $tahunAjaran->sampai == '03' ? 'selected' : '' }} value="03">Maret</option>
                <option {{ $tahunAjaran->sampai == '04' ? 'selected' : '' }} value="04">April</option>
                <option {{ $tahunAjaran->sampai == '05' ? 'selected' : '' }} value="05">Mei</option>
                <option {{ $tahunAjaran->sampai == '06' ? 'selected' : '' }} value="06">Juni</option>
                <option {{ $tahunAjaran->sampai == '07' ? 'selected' : '' }} value="07">Juli</option>
                <option {{ $tahunAjaran->sampai == '08' ? 'selected' : '' }} value="08">Agustus</option>
                <option {{ $tahunAjaran->sampai == '09' ? 'selected' : '' }} value="09">September</option>
                <option {{ $tahunAjaran->sampai == '10' ? 'selected' : '' }} value="10">Oktober</option>
                <option {{ $tahunAjaran->sampai == '11' ? 'selected' : '' }} value="11">November</option>
                <option {{ $tahunAjaran->sampai == '12' ? 'selected' : '' }} value="12">Desember</option>
            </select>

            @error('sampai')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <!-- @role('Admin Yayasan')
    <div class="col-md-6">
        <div class="form-group">
            <label for="sekolah">Sekolah</label>
            <select name="sekolah" id="sekolah" class="form-control">
                <option disabled selected>-- Pilih Sekolah --</option>
                @foreach($sekolah as $skl)
                <option value="{{ $skl->id }}" {{ $skl->id == $tahunAjaran->sekolah_id ? 'selected' : '' }}>{{ $skl->nama }}</option>
                @endforeach
            </select>

            @error('sekolah')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    @endrole -->
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
        </div>
    </div>
</div>