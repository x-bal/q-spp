<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="tahun">Tahun Ajaran</label>
            <input type="text" name="tahun" id="tahun" class="form-control" value="{{ $tahunAjaran->tahun_ajaran ?? old('tahun_ajaran') }}">

            @error('tahun')
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