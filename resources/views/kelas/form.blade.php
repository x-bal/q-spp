<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ $kela->nama ?? old('nama') }}">

            @error('nama')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="jurusan">Jurusan</label>
            <select name="jurusan" id="jurusan" class="form-control">
                <option disabled selected>-- Pilih Jurusan --</option>
                @foreach($jurusan as $jrs)
                <option value="{{ $jrs->id }}" {{ $jrs->id == $kela->jurusan_id ? 'selected' : '' }}>{{ $jrs->nama }}</option>
                @endforeach
            </select>

            @error('jurusan')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="ruangan">Ruangan</label>
            <select name="ruangan" id="ruangan" class="form-control">
                <option disabled selected>-- Pilih Ruangan --</option>
                @foreach($ruang as $rg)
                <option value="{{ $rg->id }}" {{ $rg->id == $kela->ruang_id ? 'selected' : '' }}>{{ $rg->nama }}</option>
                @endforeach
            </select>

            @error('ruangan')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="tahun">Tahun Ajaran</label>
            <select name="tahun" id="tahun" class="form-control">
                <option disabled selected>-- Pilih Tahun Ajaran --</option>
                @foreach($tahun as $thn)
                <option value="{{ $thn->id }}" {{ $thn->id == $kela->tahun_ajaran_id ? 'selected' : '' }}>{{ $thn->tahun_ajaran }}</option>
                @endforeach
            </select>

            @error('tahun')
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