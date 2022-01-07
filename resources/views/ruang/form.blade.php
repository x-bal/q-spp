<div class="row">
    <div class="col-md-{{ auth()->user()->hasRole('Admin Sekolah') ? 4 : 6 }}">
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ $ruang->nama ?? old('nama') }}">

            @error('nama')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-md-{{ auth()->user()->hasRole('Admin Sekolah') ? 4 : 6 }}">
        <div class="form-group">
            <label for="lantai">Lantai</label>
            <input type="text" name="lantai" id="lantai" class="form-control" value="{{ $ruang->lantai ?? old('lantai') }}">

            @error('lantai')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-{{ auth()->user()->hasRole('Admin Sekolah') ? 4 : 6 }}">
        <div class="form-group">
            <label for="gedung">Gedung</label>
            <input type="text" name="gedung" id="gedung" class="form-control" value="{{ $ruang->gedung ?? old('gedung') }}">

            @error('gedung')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    @role('Administrator|Admin Yayasan')
    <div class="col-md-6">
        <div class="form-group">
            <label for="sekolah">Sekolah</label>
            <select name="sekolah" id="sekolah" class="form-control">
                <option disabled selected>-- Pilih Sekolah --</option>
                @foreach($sekolah as $skl)
                <option {{ $skl->id == $ruang->sekolah_id ? 'selected' : '' }} value="{{ $skl->id }}">{{ $skl->nama }}</option>
                @endforeach
            </select>

            @error('sekolah')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    @endrole
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
        </div>
    </div>
</div>