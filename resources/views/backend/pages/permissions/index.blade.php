@extends('backend.layouts.master')
@section('title','Permission Management')
@push('styles')
<style>
    .simple-tree {        
        background: #fff;
        border-radius: 8px;
    }
    .tree-node {
        margin: 5px 0;
    }
    .tree-node .group {
        background: #f0f7ff;
        padding: 10px 10px;
        border-radius: 6px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
        border-left: 4px solid #0d6efd;
        margin-bottom: 5px;
    }

    .tree-node .group:hover {
        background: #e1f0ff;
    }

    .tree-node .group i {
        color: #0d6efd;
        font-size: 1.1rem;
    }

    .tree-node .group .count {
        background: #0d6efd;
        color: white;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 0.8rem;
        margin-left: auto;
    }

    .children {
        margin-left: 30px;
    }

    .permission-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 5px 10px;
        margin: 5px 0;
        background: #f8fafc;
        border-radius: 6px;
        border: 1px solid #e2e8f0;
    }

    .permission-item:hover {
        background: #f1f5f9;
        border-color: #0d6efd;
    }

    .permission-item .name {
        flex: 1;
        font-size: 0.95rem;
        color: #334155;
    }

    .permission-item .badge {
        background: #e2e8f0;
        color: #475569;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 0.75rem;
    }

    .action-btns {
        display: flex;
        gap: 5px;
    }

    .action-btns button,
    .action-btns a {
        width: 28px;
        height: 28px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
    }

    .btn-edit {
        background: #cff4fc;
        color: #0dcaf0;
    }

    .btn-edit:hover {
        background: #0dcaf0;
        color: white;
    }

    .btn-delete {
        background: #f8d7da;
        color: #dc3545;
    }

    .btn-delete:hover {
        background: #dc3545;
        color: white;
    }

    .tree-search {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 1rem;
    }

    .tree-search:focus {
        border-color: #0d6efd;
        outline: none;
    }

    .tree-controls {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }

    .tree-controls button {
        padding: 8px 15px;
        border: 1px solid #e2e8f0;
        background: white;
        border-radius: 6px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .tree-controls button:hover {
        background: #f8fafc;
        border-color: #0d6efd;
    }

    .stats {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        gap: 30px;
    }

    .arrow {
        transition: transform 0.2s;
    }

    .arrow.rotate {
        transform: rotate(90deg);
    }
</style>
@endpush
@section('main-content')
<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">
                    Permissions Management
                </h4>
            </div>
        </div>
        <div class="page-btn">
            <a href="{{ route('permissions.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> Add New
            </a>
        </div>
    </div>

    <div class="simple-tree" id="treeContainer">
        @forelse($groupedPermissions as $group => $permissions)
        <div class="tree-node" data-group="{{ Str::slug($group) }}">
            <div class="group" onclick="toggleNode(this)">
                <i class="fas fa-chevron-right arrow"></i>
                <i class="fas fa-folder"></i>
                <span>{{ $group ?: 'Uncategorized' }}</span>
                <span class="count">{{ $permissions->count() }}</span>
            </div>
            <div class="children">
                @foreach($permissions as $permission)
                <div class="permission-item" data-name="{{ strtolower($permission->name) }}">
                    <i class="fas fa-shield-alt text-primary"></i>
                    <span class="name">{{ $permission->name }}</span>
                    <span class="badge">{{ $permission->guard_name }}</span>

                    <div class="action-btns">
                        <a href="{{ route('permissions.edit', $permission->id) }}" class="btn-edit" title="Edit">
                            <i class="fa fa-edit"></i>
                        </a>

                        <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST"
                            style="display: inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-delete show_confirm" data-name="{{ $permission->name }}" title="Delete">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @empty
        <div style="text-align: center; padding: 40px;">
            <i class="fas fa-tree fa-3x text-muted mb-3"></i>
            <p>No permissions found</p>
            <a href="{{ route('permissions.create') }}" class="btn btn-primary">
                Create Permission
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
<script>
    function toggleNode(element) {
        let children = element.nextElementSibling;
        let arrow = element.querySelector('.arrow');
        if (children.style.display === 'none' || children.style.display === '') {
            children.style.display = 'block';
            arrow.classList.add('rotate');
        } else {
            children.style.display = 'none';
            arrow.classList.remove('rotate');
        }
    }
   
    
</script>
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