<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $role->name ?? old('name') }}">

            @error('name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="permission">Permission</label>
            <select class="multi-select" name="permission[]" multiple="multiple">
                @foreach($permissions as $permission)
                <option @if(in_array($permission->id, $role->permissions()->pluck('permission_id')->toArray())) selected @endif value="{{ $permission->id }}">{{ $permission->name }}</option>
                @endforeach
            </select>

            @error('permission')
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