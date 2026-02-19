@extends('backend.layouts.master')
@section('title','Edit Role')
@push('styles')
<link rel="stylesheet" href="{{asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
<link rel="stylesheet" href="{{asset('backend/assets/plugins/tabler-icons/tabler-icons.css')}}">
<link rel="stylesheet" href="{{asset('backend/assets/css/dataTables.bootstrap5.min.css')}}">
@endpush
@section('main-content')
<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Edit Role: {{ ucfirst($role->name) }}</h4>
            </div>
        </div>
        <div class="page-btn">
            <a href="{{ route('roles.index') }}" class="btn btn-success btn-sm">
                <i class="fa fa-arrow-left"></i> Back to Roles
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body p-3">
            <form action="{{ route('roles.update', $role->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="row">
                    <div class="col-sm-12 col-12">
                        <div class="mb-3">
                            <label>Role Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $role->name) }}" placeholder="e.g., editor, manager"  {{ in_array($role->name, ['admin', 'super-admin']) ? 'readonly' : '' }}>
                            <small class="text-muted">Use only letters, numbers, and hyphens</small>
                            @if(in_array($role->name, ['admin', 'super-admin']))
                                <p class="text-warning mt-1"><i class="fa fa-info-circle"></i> System role name cannot be changed</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Permissions <span class="text-danger">*</span></label>
                        <div class="row">
                            @foreach($permissions->chunk(4) as $chunk)
                            <div class="col-md-3">
                                @foreach($chunk as $permission)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            {{ in_array($permission->id, old('permissions', $rolePermissions)) ? 'checked' : '' }}>
                                        {{ $permission->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                    </div>                    
                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-info" onclick="selectAll()">
                            <i class="fa fa-check-square"></i> Select All
                        </button>
                        <button type="button" class="btn btn-sm btn-secondary" onclick="deselectAll()">
                            <i class="fa fa-square"></i> Deselect All
                        </button>
                    </div>                 
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center justify-content-end mb-4">                           
                            <a href="{{ route('roles.index') }}" class="btn btn-secondary me-2">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Update Role
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
function selectAll() {
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.checked = true;
    });
}

function deselectAll() {
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.checked = false;
    });
}
</script>
@endpush