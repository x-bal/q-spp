<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ $staff->user->name ?? old('nama') }}">

            @error('nama')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="nip">NIP</label>
            <input type="number" name="username" id="nip" class="form-control" value="{{ $staff->user->username ?? old('username') }}">

            @error('username')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $staff->user->email ?? old('email') }}">

            @error('email')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="jabatan">Jabatan</label>
            <input type="text" name="jabatan" id="jabatan" class="form-control" value="{{ $staff->jabatan ?? old('jabatan') }}">

            @error('jabatan')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ $staff->tanggal_lahir ?? old('tanggal_lahir') }}">

            @error('tanggal_lahir')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <!-- <div class="col-md-6">
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" value="{{ $staff->password ?? old('password') }}">

            @error('password')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div> -->
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
        </div>
    </div>
</div>