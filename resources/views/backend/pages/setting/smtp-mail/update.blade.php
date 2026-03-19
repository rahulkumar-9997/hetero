@extends('backend.layouts.master')
@section('title','SMTP Settings')

@push('styles')
<link rel="stylesheet" href="{{asset('backend/assets/plugins/tabler-icons/tabler-icons.css')}}">
@endpush
@section('main-content')
<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">SMTP Settings</h4>
                <h6>Manage Mail Configuration</h6>
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
            <form method="POST" action="{{ route('settings.update', $setting->id) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Почтовый драйвер</label>
                    <select name="mail_mailer"
                        class="form-select form-control @error('mail_mailer') is-invalid @enderror">
                        <option value="smtp" {{ old('mail_mailer', $setting->mail_mailer ?? '') == 'smtp' ? 'selected' : '' }}>SMTP</option>
                        <option value="sendmail" {{ old('mail_mailer', $setting->mail_mailer ?? '') == 'sendmail' ? 'selected' : '' }}>Sendmail</option>
                    </select>
                    @error('mail_mailer')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Почтовый сервер</label>
                    <input type="text" name="mail_host"
                        class="form-control @error('mail_host') is-invalid @enderror"
                        value="{{ old('mail_host', $setting->mail_host ?? '') }}">
                    @error('mail_host')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Порт</label>
                    <input type="text" name="mail_port"
                        class="form-control @error('mail_port') is-invalid @enderror"
                        value="{{ old('mail_port', $setting->mail_port ?? '') }}">
                    @error('mail_port')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Имя пользователя</label>
                    <input type="text" name="mail_username"
                        class="form-control @error('mail_username') is-invalid @enderror"
                        value="{{ old('mail_username', $setting->mail_username ?? '') }}">
                    @error('mail_username')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Пароль</label>
                    <input type="password" name="mail_password"
                        class="form-control @error('mail_password') is-invalid @enderror"
                        placeholder="Enter new password"  value="{{ old('mail_password', $setting->mail_password ?? '') }}">
                    @error('mail_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Шифрование</label>
                    <select name="mail_encryption"
                        class="form-select form-control @error('mail_encryption') is-invalid @enderror">
                        <option value="tls" {{ old('mail_encryption', $setting->mail_encryption ?? '') == 'tls' ? 'selected' : '' }}>TLS</option>
                        <option value="ssl" {{ old('mail_encryption', $setting->mail_encryption ?? '') == 'ssl' ? 'selected' : '' }}>SSL</option>
                    </select>
                    @error('mail_encryption')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Адрес отправителя</label>
                    <input type="email" name="mail_from_address"
                        class="form-control @error('mail_from_address') is-invalid @enderror"
                        value="{{ old('mail_from_address', $setting->mail_from_address ?? '') }}">
                    @error('mail_from_address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Имя отправителя</label>
                    <input type="text" name="mail_from_name"
                        class="form-control @error('mail_from_name') is-invalid @enderror"
                        value="{{ old('mail_from_name', $setting->mail_from_name ?? config('app.name')) }}">
                    @error('mail_from_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <hr class="my-4">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">
                    Сохранить настройки SMTP
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush