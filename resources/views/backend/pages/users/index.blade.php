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
                            @forelse($users as $key => $user)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ $user->profile_img_url }}" alt="{{ $user->name }}" 
                                     class="img-circle" width="40" height="40" style="object-fit: cover;">
                                </td>
                                <td><span class="badge bg-info">{{ $user->user_id }}</span></td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone_number ?? 'N/A' }}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        <span class="badge bg-{{ $role->name == 'admin' ? 'danger' : 'primary' }}">
                                            {{ $role->name }}
                                        </span>
                                    @endforeach
                                </td>
                                <td>
                                    @if($user->id != auth()->id())
                                    <div class="custom-control custom-switch">
                                        <label class="custom-control-label" for="status_{{ $user->id }}">
                                           @if($user->status == '1')
                                                <span class="badge bg-success">Активный</span>
                                            @else
                                                <span class="badge bg-secondary">Неактивный</span>
                                            @endif
                                        </label>
                                    </div>
                                    @else
                                        <span class="badge bg-dark">Свои</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    
                                    <button type="button" class="btn btn-warning btn-sm" title="Change Password"
                                            onclick="changePassword({{ $user->id }}, '{{ $user->name }}')">
                                        <i class="fa fa-key"></i>
                                    </button>
                                    
                                    @if($user->id != auth()->id())
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;" class="show_confirm" data-name="{{ $user->name }}">
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
                                <td colspan="9" class="text-center">No users found.</td>
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
<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password - <span id="userName"></span></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="passwordForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6 col-12">
                            <div class="mb-3">
                                <label>New Password</label>
                                <input type="password" name="password" class="form-control" minlength="8">
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="mb-3">                       
                                <label>Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" minlength="8">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
            </form>
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
<script>
    function changePassword(id, name) {
        $('#userName').text(name);
        $('#passwordForm').attr('action', '{{ url("users/change-password") }}/' + id);
        $('#passwordModal').modal('show');
    }
    
    $(document).ready(function() {
        $('.status-toggle').change(function() {
            var id = $(this).data('id');
            var status = $(this).is(':checked') ? 'active' : 'inactive';
            var toggle = $(this);
            
            $.ajax({
                url: '{{ route("users.update-status") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    user_id: id,
                    status: status
                },
                success: function(response) {
                    if(response.success) {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                        toggle.prop('checked', !toggle.is(':checked'));
                    }
                },
                error: function() {
                    toastr.error('Something went wrong');
                    toggle.prop('checked', !toggle.is(':checked'));
                }
            });
        });
    });
</script>
@endpush