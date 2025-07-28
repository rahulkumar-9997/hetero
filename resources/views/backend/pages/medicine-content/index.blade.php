@extends('backend.layouts.master')
@section('title','Medicine List')
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
                <h6>Medicine List</h6>
            </div>
        </div>
        <div class="page-btn">            
            <a href="{{ route('manage-medicine.create') }}"
            class="btn btn-primary">
                <i class="ti ti-circle-plus me-1"></i>
                Create New Medicine
            </a>
        </div>
    </div>
    <div class="card">
        <!-- <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="search-set">
                <div class="search-input">
                    <span class="btn-searchset">
                        <i class="ti ti-search fs-14 feather-search"></i>
                    </span>
                </div>
            </div>
        </div> -->
        <div class="card-body p-0">
            <div class="table-responsive">                
                <div class="display-medicine-category">
                    @if(isset($medicineContents) && $medicineContents->count() > 0)
                        @include('backend.pages.medicine-content.partials.medicine-content-list', ['medicineContents' => $medicineContents])
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    $(document).on('click', '.medicine_show_confirm', function (event) {
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
</script>
@endpush