@extends('backend.layouts.master')
@section('title','Edit banner')
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
                    Редактировать баннер
                </h6>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <a href="{{ route('manage-banner.index') }}" data-title="Вернуться на предыдущую страницу" data-bs-toggle="tooltip" class="btn btn-sm btn-info" data-bs-original-title="Вернуться на предыдущую страницу">
                <i class="ti ti-arrow-left me-1"></i>
               Вернуться на предыдущую страницу
            </a>
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('manage-banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="banner_heading_name">Название заголовка баннера</label>
                            <input class="form-control" id="banner_heading_name" name="banner_heading_name" value="{{ old('banner_heading_name', $banner->banner_heading_name) }}">
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="banner_content">Содержимое баннера</label>
                            <textarea class="form-control" name="banner_content" id="banner_content">{{ old('banner_content', $banner->banner_content) }}</textarea>
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="banner_link">Ссылка баннера</label>
                            <input type="text" class="form-control" name="banner_link" id="banner_link"
                                value="{{ old('banner_link', $banner->banner_link) }}">
                        </div>
                    </div>
                    <div class="col-sm-3 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="banner_desktop_img">Изображение баннера на рабочем столе</label>
                            <input type="file" class="form-control" name="banner_desktop_img" id="banner_desktop_img">

                            @if($banner->banner_desktop_img)
                            <div class="mt-2">
                                <img src="{{ asset('upload/banner/' . $banner->banner_desktop_img) }}" alt="Desktop Banner"
                                    class="img-thumbnail" style="max-height: 100px;">
                                <p class="small text-muted mt-1">Текущее изображение</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="banner_mobile_img">Изображение баннера для мобильного устройства</label>
                            <input type="file" class="form-control" name="banner_mobile_img" id="banner_mobile_img">

                            @if($banner->banner_mobile_img)
                            <div class="mt-2">
                                <img src="{{ asset('upload/banner/' . $banner->banner_mobile_img) }}" alt="Mobile Banner"
                                    class="img-thumbnail" style="max-height: 100px;">
                                <p class="small text-muted mt-1">Текущее изображение</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row sticky" id="banner_medicine_row">
                    <div class="col-md-12 table-responsive">
                        <div class="bg-indigo pt-1 pb-1 rounded-2">
                            <h4 class="text-center text-light" style="margin-bottom: 0px;">Лекарство в баннере</h4>
                        </div>

                        <table class="table align-middle mb-3">
                            <tbody id="banner_medicine_container">
                                @forelse($banner->medicines as $medicine)
                                <tr class="medicine_row">
                                    <td style="width: 50%">
                                        <label class="form-label">Название лекарства</label>
                                        <input type="text" name="medicine_title[]" class="form-control"
                                            value="{{ old('medicine_title.' . $loop->index, $medicine->title) }}"
                                            placeholder="Введите название лекарства">
                                    </td>
                                    <td style="width: 50%">
                                        <label class="form-label">Ссылка на лекарство</label>
                                        <input type="text" name="medicine_link[]" class="form-control"
                                            value="{{ old('medicine_link.' . $loop->index, $medicine->link) }}"
                                            placeholder="Введите ссылку на лекарство">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm remove_medicine_row mt-4">Удалить</button>
                                    </td>
                                </tr>
                                @empty
                                <tr class="medicine_row">
                                    <td style="width: 50%">
                                        <label class="form-label">Название лекарства</label>
                                        <input type="text" name="medicine_title[]" class="form-control" placeholder="Введите название лекарства">
                                    </td>
                                    <td style="width: 50%">
                                        <label class="form-label">Ссылка на лекарство</label>
                                        <input type="text" name="medicine_link[]" class="form-control" placeholder="Введите ссылку на лекарство">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm remove_medicine_row mt-4" style="display: none;">Удалить</button>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end">
                                        <button class="btn btn-primary add_more_additional btn-sm" type="button">Добавить еще одно название лекарства</button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Submit -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center justify-content-end mb-4">
                            <a href="{{ route('manage-banner.index') }}" class="btn btn-secondary me-2">Отмена</a>
                            <button type="submit" class="btn btn-primary">Обновить</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let container = document.getElementById('banner_medicine_container');
        let addButton = document.querySelector('.add_more_additional');
        addButton.addEventListener('click', function() {
            let rows = container.querySelectorAll('.medicine_row').length;
            if (rows < 3) {
                let row = document.createElement('tr');
                row.classList.add('medicine_row');
                row.innerHTML = `
                <td style="width: 50%">
                    <label class="form-label">Medicine Title</label>
                    <input type="text" name="medicine_title[]" class="form-control" placeholder="Enter medicine title">
                </td>
                <td style="width: 50%">
                    <label class="form-label">Medicine Link</label>
                    <input type="text" name="medicine_link[]" class="form-control" placeholder="Enter medicine link">
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove_medicine_row mt-4">Remove</button>
                </td>
            `;
                container.appendChild(row);
            } else {
                alert("You can add maximum 3 medicines only.");
            }
        });

        container.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove_medicine_row')) {
                e.target.closest('tr').remove();
            }
        });
    });
</script>
@endpush