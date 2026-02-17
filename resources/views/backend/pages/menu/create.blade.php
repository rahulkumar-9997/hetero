@extends('backend.layouts.master')
@section('title','Create Menu')
@push('styles')
<!-- <link rel="stylesheet" href="{{asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}"> -->
<link rel="stylesheet" href="{{asset('backend/assets/plugins/summernote/summernote-bs4.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/assets/plugins/tabler-icons/tabler-icons.css')}}">
<link rel="stylesheet" href="{{asset('backend/assets/css/dataTables.bootstrap5.min.css')}}">
@endpush
@section('main-content')
<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Создать страницы</h4>
            </div>
        </div>
    </div>

    <!-- /product list -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <a href="{{ route('menus.index') }}" data-title="Вернуться на предыдущую страницу" data-bs-toggle="tooltip" class="btn btn-sm btn-purple" data-bs-original-title="Вернуться на предыдущую страницу">
                &lt;&lt; Вернуться на предыдущую страницу
            </a>

        </div>
        <div class="accordion-body border-top">
            <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label class="form-label">Название <span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label class="form-label">Местоположение (необязательно)</label>
                            <input type="text" class="form-control" name="location">
                            <small class="text-muted">Пример: Заголовок, Подвал</small>
                        </div>
                    </div>
                    
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center justify-content-end mb-4">
                            <a href="{{ route('menus.index') }}" class="btn btn-secondary me-2">Отмена</a>
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>
    <!-- /product list -->
</div>

@endsection
@push('scripts')

@endpush