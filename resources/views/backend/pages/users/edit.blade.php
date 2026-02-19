@extends('backend.layouts.master')
@section('title','Edit Form')
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
                <h4 class="fw-bold">Edit User Form</h4>
            </div>
        </div>
        <div class="page-btn">
            <a href="{{ route('users.index') }}" class="btn btn-success btn-sm">
                <i class="fa fa-arrow-left"></i> Back to Users List
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body p-3">
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
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
                            <label>Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" placeholder="Enter name">
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" placeholder="Enter email">
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label>Phone Number </label>
                            <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number) }}" placeholder="Enter phone number">
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label>Password </label>
                            <input type="password" name="password" class="form-control" placeholder="Enter password" minlength="8">
                            <small class="text-muted">Minimum 8 characters</small>
                        </div>
                    </div>                        
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label>Confirm Password </label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label>Select Role <span class="text-danger">*</span></label>
                            <select name="role" class="form-select form-control">
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->name }}" 
                                    {{ ($userRole == $role->name) ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label>Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select form-control">
                                <option value="1" {{ $user->status == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $user->status == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label>Profile Image</label>
                            <input type="file" name="profile_img" class="form-control" accept="image/*" onchange="previewImage(this)">
                            <small class="text-muted">Max size: 2MB. Allowed: jpeg, png, jpg</small>
                        </div>
                        @if($user->profile_img_url)
                            <div class="form-group">
                                <label>Current Image:</label><br>
                                <img src="{{ $user->profile_img_url }}" alt="{{ $user->name }}"  class="img-thumbnail" style="max-height: 100px;">
                            </div>
                        @endif
                        <div class="form-group" id="imagePreview" style="display: none;">
                            <img src="" class="img-thumbnail" style="max-height: 150px;">
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
                                 Update User
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
function previewImage(input) {
    var preview = document.getElementById('imagePreview');
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.style.display = 'block';
            preview.querySelector('img').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none';
    }
}
</script>
@endpush