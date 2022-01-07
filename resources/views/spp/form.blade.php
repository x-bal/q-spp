<div class="row">
    <input type="hidden" name="siswa" value="{{ $spp->siswa_id }}">
    <div class="col-md-4">
        <div class="form-group">
            <label for="nominal">Nominal</label>
            <input type="text" name="nominal" id="nominal" class="form-control" value="{{ $spp->nominal ?? old('nominal') }}">

            @error('nominal')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="tanggal_bayar">Tanggal Bayar</label>
            <input type="date" name="tanggal_bayar" id="tanggal_bayar" class="form-control" value="{{ $spp->tanggal_bayar ?? old('tanggal_bayar') }}">

            @error('tanggal_bayar')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="nominal">Nominal</label>
            <select name="status" id="status" class="form-control">
                <option {{ $spp->status == 'Belum Lunas' ? 'selected' : '' }} value="Belum Lunas">Belum Lunas</option>
                <option {{ $spp->status == 'Lunas' ? 'selected' : '' }} value="Lunas">Lunas</option>
            </select>

            @error('nominal')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <!-- @role('Administrator|Admin Yayasan')
    <div class="col-md-6">
        <div class="form-group">
            <label for="sekolah">Sekolah</label>
            <select name="sekolah" id="sekolah" class="form-control">
                <option disabled selected>-- Pilih Sekolah --</option>
                @foreach($sekolah as $skl)
                <option {{ $skl->id == $jurusan->sekolah_id ? 'selected' : '' }} value="{{ $skl->id }}">{{ $skl->nama }}</option>
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