@extends('backend.layouts.master')
@section('title','Role List')
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
                <h4 class="fw-bold">Role List</h4>
            </div>
        </div>
        <div class="page-btn">
            <a href="{{ route('roles.create') }}" class="btn btn-success btn-sm">
                <i class="fa fa-plus"></i> Add New Role
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
                                <th>Role Name</th>
                                <th>Guard</th>
                                <th>Permissions</th>
                                <th>Users Count</th>
                                <th>Created</th>
                                <th width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $key => $role)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <strong>{{ ucfirst($role->name) }}</strong>
                                    @if(in_array($role->name, ['admin', 'super-admin']))
                                        <span class="badge bg-danger">System</span>
                                    @endif
                                </td>
                                <td><span class="badge bg-info">{{ $role->guard_name }}</span></td>
                                <td>
                                    @foreach($role->permissions->take(5) as $permission)
                                        <span class="badge bg-primary">{{ $permission->name }}</span>
                                    @endforeach
                                    @if($role->permissions->count() > 5)
                                        <span class="badge bg-secondary">+{{ $role->permissions->count() - 5 }} more</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-{{ $role->users_count > 0 ? 'warning' : 'secondary' }}">
                                        {{ $role->users_count ?? 0 }} Users
                                    </span>
                                </td>
                                <td>{{ $role->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info btn-sm" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    
                                    @if(!in_array($role->name, ['admin', 'super-admin']))
                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" 
                                          style="display: inline;" 
                                          onsubmit="return confirm('Are you sure you want to delete this role?')">
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
                                <td colspan="7" class="text-center">No roles found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')

@endpush