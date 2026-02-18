@extends('backend.layouts.master')
@section('title','Profile')
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
                <h4 class="fw-bold">Профиль</h4>
                <h6>Управление профилем</h6>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body p-4">
            @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4 text-center">
                    @if(Auth::user()->profile_img)
                    <div class="position-relative d-inline-block">
                        <img src="{{ asset('profile-images/'.Auth::user()->profile_img) }}" alt="Profile Image"
                            class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                        <form action="{{ route('profile.delete-image') }}" method="POST"
                            class="d-inline position-absolute top-0 end-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm rounded-circle"
                                onclick="return confirm('Are you sure you want to delete this image?')"
                                style="width: 30px; height: 30px;">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                    </div>
                    @else
                    <img src="{{ asset('backend/assets/img/profiles/avator1.jpg') }}" alt="Default Avatar"
                        class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                    @endif
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Имя</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                        value="{{ old('name', $user->name) }}" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="user_id" class="form-label">Идентификатор пользователя</label>
                    <input type="text" class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" value="{{ old('user_id', $user->user_id) }}" required readonly>
                    @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Электронная почта</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Номер телефона</label>
                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                        id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
                    @error('phone_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="profile_img" class="form-label">Изображение профиля</label>
                    <input type="file" class="form-control @error('profile_img') is-invalid @enderror" id="profile_img"
                        name="profile_img" accept="image/*">
                    <small class="text-muted">Загрузить новое изображение профиля (JPEG, PNG, JPG, GIF, максимум 2 МБ)</small>
                    @error('profile_img')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <hr class="my-4">
                <h5>Изменить пароль</h5>
                <p class="text-muted small">Оставьте пустым, если вы не хотите изменять свой пароль</p>
                <div class="mb-3">
                    <label for="current_password" class="form-label">Текущий пароль</label>
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                        id="current_password" name="current_password">
                    @error('current_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">Новый пароль</label>
                    <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                        id="new_password" name="new_password">
                    @error('new_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">Подтвердить новый пароль</label>
                    <input type="password" class="form-control" id="new_password_confirmation"
                        name="new_password_confirmation">
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        Обновить профиль
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('scripts')

@endpush