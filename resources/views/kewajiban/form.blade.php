<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ $kewajiban->nama ?? old('nama') }}">

            @error('nama')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="biaya">Biaya</label>
            <input type="text" name="biaya" id="biaya" class="form-control" value="{{ $kewajiban->biaya ?? old('biaya') }}">

            @error('biaya')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="nama">Nama</label>
            <select name="tahun" id="tahun" class="form-control">
                <option disabled selected>-- Tahun Ajaran --</option>
                @foreach($tahun as $thn)
                <option value="{{ $thn->id }}" {{ $thn->id == $kewajiban->tahun_ajaran_id ? 'selected' : '' }}>{{ $thn->tahun_ajaran }}</option>
                @endforeach
            </select>
            @error('nama')
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