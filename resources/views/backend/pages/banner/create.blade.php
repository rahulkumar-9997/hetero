@extends('backend.layouts.master')
@section('title','Add new banner')
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
                <h4 class="fw-bold"></h4>
                <h6>
                    Add new Banner
                </h6>
                           
            </div>
        </div>
        
    </div>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <a href="{{ route('manage-banner.index') }}" data-title="Go Back to Previous Page" data-bs-toggle="tooltip" class="btn btn-sm btn-info" data-bs-original-title="Go Back to Previous Page">
                <i class="ti ti-arrow-left me-1"></i>
                Go Back to Previous Page
            </a>   
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')

@endpush