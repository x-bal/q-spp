<div class="row">
    <div class="col-md-12">
        <h4>Data Pemilik Yayasan</h4>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-11">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama_pemilik">Nama Pemilik</label>
                    <input type="text" name="nama_pemilik" id="nama_pemilik" class="form-control" value="{{ $yayasan->admin->name ?? old('nama_pemilik') }}">

                    @error('nama_pemilik')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" value="{{ $yayasan->admin->username ?? old('username') }}">

                    @error('username')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $yayasan->admin->email ?? old('email') }}">

                    @error('email')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" value="{{  old('password') }}">

                    @error('password')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12">
        <h4>Data Yayasan</h4>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-11">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama_yayasan">Nama Yayasan</label>
                    <input type="text" name="nama_yayasan" id="nama_yayasan" class="form-control" value="{{ $yayasan->nama ?? old('nama_yayasan') }}">

                    @error('nama_yayasan')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="telp">Telp Yayasan</label>
                    <input type="number" name="telp" id="telp" class="form-control" value="{{ $yayasan->telp ?? old('telp') }}">

                    @error('telp')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="alamat">Alamat Yayasan</label>
                    <textarea name="alamat" id="alamat" rows="3" class="form-control">{{ $yayasan->alamat ?? old('alamat') }}</textarea>

                    @error('alamat')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="logo">Logo Yayasan</label>
                    <input type="file" name="logo" id="logo" class="form-control" value="{{ $yayasan->logo ?? old('logo') }}">

                    @error('logo')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-11">
        <div class="form-group">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
        </div>
    </div>
</div>