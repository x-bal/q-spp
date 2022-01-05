<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ $siswa->nama ?? old('nama') }}">

            @error('nama')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="nisn">Nisn</label>
            <input type="number" name="nisn" id="nisn" class="form-control" value="{{ $siswa->nisn ?? old('nisn') }}">

            @error('nisn')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                <option disabled selected>-- Jenis Kelamin --</option>
                <option {{ $siswa->jk == 'L' ? 'selected' : '' }} value="L">L</option>
                <option {{ $siswa->jk == 'P' ? 'selected' : '' }} value="P">P</option>
            </select>

            @error('jenis_kelamin')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="{{ $siswa->tempat_lahir ?? old('tempat_lahir') }}">

            @error('tempat_lahir')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ $siswa->tanggal_lahir ?? old('tanggal_lahir') }}">

            @error('tanggal_lahir')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="kelas">Kelas</label>
            <select name="kelas" id="kelas" class="form-control">
                <option disabled selected>-- Pilih Kelas --</option>
                @foreach($kelas as $kls)
                <option value="{{ $kls->id }}" {{ $kls->id == $siswa->kelas_id ? 'selected' : '' }}>{{ $kls->nama }}</option>
                @endforeach
            </select>

            @error('kelas')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
        </div>
    </div>
</div>