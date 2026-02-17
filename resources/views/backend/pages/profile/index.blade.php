@extends('backend.layouts.master')
@section('title','Profile')
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
                <h4 class="fw-bold">Profile</h4>
                <h6>Manage Profile</h6>
            </div>
        </div>
    </div>

    <!-- /product list -->
    <div class="card">        
        <div class="card-body p-0">
            
        </div>
    </div>
    <!-- /product list -->
</div>

@endsection
@push('scripts')

@endpush