@extends('backend.layouts.master')
@section('title','Medicine Category List')
@push('styles')
<link rel="stylesheet" href="{{asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
<link rel="stylesheet" href="{{asset('backend/assets/plugins/tabler-icons/tabler-icons.css')}}">
<link rel="stylesheet" href="{{asset('backend/assets/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/assets/plugins/summernote/summernote-bs4.min.css')}}">
@endpush
@section('main-content')
<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold"></h4>
                <h6>Список категорий лекарств</h6>
            </div>
        </div>
        <div class="page-btn">            
            <a href="javascript:;"
            data-title="Добавить новую категорию лекарств"
            data-medicine-category-add="true"
            data-url="{{ route('medicine-category.create') }}"
            data-size="lg"
            class="btn btn-primary">
                <i class="ti ti-circle-plus me-1"></i>
               Создать новую категорию лекарств
            </a>
        </div>
    </div>
    <div class="card">        
        <div class="card-body p-0">
            <div class="table-responsive">                
                <div class="display-medicine-category">
                    @if(isset($medicineCategory) && $medicineCategory->count() > 0)
                        @include('backend.pages.medicine-category.partials.medicine-category', ['medicineCategory' => $medicineCategory])
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="{{asset('backend/assets/js/pages/medicine-category.js')}}"></script>
<script src="{{ asset('backend/assets/ckeditor-4/ckeditor.js') }}"></script>
<script>
    document.querySelectorAll('.ckeditor4').forEach(function(el) {
        CKEDITOR.replace(el, {
            removePlugins: 'exportpdf'
        });
    });
</script>
@endpush