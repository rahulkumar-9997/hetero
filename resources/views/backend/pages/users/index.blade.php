@extends('backend.layouts.master')
@section('title','Users List')
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
                <h4 class="fw-bold">Список пользователей</h4>
            </div>
        </div>
        <div class="page-btn">
            <a href="{{ route('users.create') }}" class="btn btn-success btn-sm">
                <i class="fa fa-plus"></i> Добавить нового пользователя
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body p-3">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>Фото</th>
                            <th>ID пользователя</th>
                            <th>Имя</th>
                            <th>Электронная почта</th>
                            <th>Телефон</th>
                            <th>Роль</th>
                            <th>Статус</th>
                            <th width="150">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                    $i = 1;
                    $authUser = auth()->user();
                    @endphp

                    @forelse($users as $user)

                    {{-- Non-admin users should NOT see Admin users --}}
                    @if(!$authUser->hasRole('Admin') && $user->hasRole('Admin'))
                    @continue
                    @endif

                    <tr>
                        <td>{{ $i++ }}</td>

                        <td>
                            <img src="{{ $user->profile_img_url }}" alt="{{ $user->name }}" class="img-circle"
                                width="40" height="40" style="object-fit: cover;">
                        </td>

                        <td>
                            <span class="badge bg-info">{{ $user->user_id }}</span>
                        </td>

                        <td>{{ $user->name }}</td>

                        <td>{{ $user->email }}</td>

                        <td>{{ $user->phone_number ?? 'N/A' }}</td>

                        <td>
                            @foreach($user->roles as $role)
                            <span class="badge bg-{{ $role->name == 'Admin' ? 'danger' : 'primary' }}">
                                {{ $role->name }}
                            </span>
                            @endforeach
                        </td>

                        <td>
                            @if($user->id != auth()->id())
                            @if($user->status == '1')
                            <span class="badge bg-success">Активный</span>
                            @else
                            <span class="badge bg-secondary">Неактивный</span>
                            @endif
                            @else
                            <span class="badge bg-dark">Свои</span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm" title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>

                            @if($user->id != auth()->id())
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                style="display: inline;" class="show_confirm" data-name="{{ $user->name }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">Пользователи не найдены.</td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-md-12">
                    {{ $users->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            Swal.fire({
                title: `Are you sure you want to delete this ${name}?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel",
                dangerMode: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush