@extends('backend.layouts.master')
@section('title','Create Role')
@push('styles')
<style>
    .list-group-item {
        border: none;
        border-bottom: 1px solid #f0f0f0;
        padding: 5px 10px;
        cursor: pointer;
        transition: all 0.2s;
    }
    .group-header {
        background-color: #faf8f8 !important;
        border-left: 3px solid #007bff;
        font-weight: 600;
    }
    .child-item {
        padding-left: 35px !important;
    }
</style>
@endpush

@section('main-content')
<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold"> Создать роль</h4>
            </div>
        </div>
        <div class="page-btn">
            <a href="{{ route('roles.index') }}" class="btn btn-success btn-sm">
                <i class="fa fa-arrow-left"></i> Назад к списку ролей
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('roles.store') }}" method="POST" id="roleForm">
                @csrf

                @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="form-group mb-4">
                    <label class="fw-bold"> Название роли <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name') }}" placeholder="e.g., editor, manager">
                    <small class="text-muted">Используйте только буквы, цифры, дефисы и подчеркивания</small>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="selectAll()">
                        <i class="fa fa-check"></i> Выбрать все
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="deselectAll()">
                        <i class="fa fa-times"></i> Снять выделение
                    </button>
                </div>
                <div class="tree-container">
                    <ul class="list-group" id="permissionTree">
                        @php $nodeId = 0; @endphp
                        @forelse($groupedPermissions as $group => $permissions)
                            @if($group)
                                <li class="list-group-item node-treeview1 group-header" 
                                    data-nodeid="{{ $nodeId }}" 
                                    onclick="toggleNode(this)">
                                    <span class="permission-name">{{ $group }}</span>                                    
                                    <span class="float-end">
                                        <input type="checkbox" 
                                            class="group-checkbox" 
                                            data-group="{{ $group }}"
                                            onclick="event.stopPropagation(); toggleGroup(this)"
                                            id="group_{{ Str::slug($group) }}">
                                    </span>
                                </li>
                                @foreach($permissions as $permission)
                                    @php $nodeId++; @endphp
                                    <li class="list-group-item node-treeview1 child-item child-of-{{ $nodeId-1 }}" 
                                        data-nodeid="{{ $nodeId }}"
                                        data-parentid="{{ $nodeId-1 }}"
                                        style="display: block;">
                                        <label class="permission-label">
                                            <input type="checkbox" 
                                                   name="permissions[]" 
                                                   value="{{ $permission->id }}"
                                                   class="permission-checkbox permission-{{ Str::slug($group) }}"
                                                   data-group="{{ $group }}"
                                                   onchange="updateGroupCheckbox('{{ $group }}')"
                                                   {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}>
                                            {{ $permission->name }}
                                        </label>
                                       
                                    </li>
                                @endforeach
                            @endif
                        @empty
                            <li class="list-group-item text-center text-muted">
                                Права доступа не найдены.
                            </li>
                        @endforelse
                    </ul>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Создать роль
                    </button>
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                        <i class="fa fa-times"></i> Отмена
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>

function toggleGroup(checkbox) {
    let group = checkbox.dataset.group;
    let isChecked = checkbox.checked;
    let groupSlug = group.replace(/\s+/g, '-').toLowerCase();    
    document.querySelectorAll(`.permission-${groupSlug}`).forEach(cb => {
        cb.checked = isChecked;
    });    
    checkbox.indeterminate = false;
}

function selectAll() {
    document.querySelectorAll('.permission-checkbox').forEach(cb => {
        cb.checked = true;
    });
    document.querySelectorAll('.group-checkbox').forEach(cb => {
        cb.checked = true;
        cb.indeterminate = false;
    });
}

function deselectAll() {
    document.querySelectorAll('.permission-checkbox').forEach(cb => {
        cb.checked = false;
    });
    document.querySelectorAll('.group-checkbox').forEach(cb => {
        cb.checked = false;
        cb.indeterminate = false;
    });
}

</script>
@endpush