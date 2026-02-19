@extends('backend.layouts.master')
@section('title','Edit Permission')
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
                <h4 class="fw-bold">Edit Permission</h4>
            </div>
        </div>
        <div class="page-btn">
            <a href="{{ route('permissions.index') }}" class="btn btn-success btn-sm">
                <i class="fa fa-arrow-left"></i> Back to Permissions List
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body p-3">
            <form action="{{ route('permissions.update', $permission->id) }}" method="POST" enctype="multipart/form-data">
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
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label>Permission Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" 
                                    value="{{ old('name', $permission->name) }}" 
                                    placeholder="e.g., create-post, edit-user" required>
                            <small class="text-muted">
                                Format: action-model (e.g., create-post, edit-user, delete-post)<br>
                                Use only letters, numbers, and hyphens
                            </small>
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label>Guard Name</label>
                            <input type="text" class="form-control" value="{{ $permission->guard_name }}" readonly>
                            <small class="text-muted">Guard name cannot be changed</small>
                        </div>
                    </div>                    
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center justify-content-end mb-4">                           
                            <a href="{{ route('users.index') }}" class="btn btn-secondary me-2">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Update Permission
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

@endpush