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
                <h4 class="fw-bold">Форма редактирования пользователя</h4>
            </div>
        </div>
        <div class="page-btn">
            <a href="{{ route('users.index') }}" class="btn btn-success btn-sm">
                <i class="fa fa-arrow-left"></i> Назад к списку пользователей
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
                            <label>Имя <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" placeholder="Enter name">
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label>Электронная почта <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" placeholder="Enter email">
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label>Номер телефона </label>
                            <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number) }}" placeholder="Enter phone number">
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label>Пароль </label>
                            <input type="password" name="password" class="form-control" placeholder="Enter password" minlength="8">
                            <small class="text-muted">Minimum 8 characters</small>
                        </div>
                    </div>                        
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label>Подтвердить пароль </label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label>Выберите роль <span class="text-danger">*</span></label>
                            <select name="role" class="form-select form-control">
                                <option value="">Выберите роль</option>
                                @foreach($roles as $role)
                                    @if(!auth()->user()->hasRole('Admin') && $role->name === 'Admin')
                                        @continue
                                    @endif
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
                            <label>Статус <span class="text-danger">*</span></label>
                            <select name="status" class="form-select form-control">
                                <option value="1" {{ $user->status == '1' ? 'selected' : '' }}>Активный</option>
                                <option value="0" {{ $user->status == '0' ? 'selected' : '' }}>Неактивный</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label>Фото профиля</label>
                            <input type="file" name="profile_img" class="form-control" accept="image/*" onchange="previewImage(this)">
                            <small class="text-muted">(Макс. размер: 2 МБ. Разрешены: jpeg, png, jpg)</small>
                        </div>
                        @if($user->profile_img_url)
                            <div class="form-group">
                                <label>Текущее фото:</label><br>
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
                                Отмена
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Обновить пользователя
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