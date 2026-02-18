<table class="table">
    <thead class="thead-light">
        <tr>
            <th>№</th>
            <th>
               МНН (Международное непатентованное наименование)
            </th>
            <th>
                ТН (Торговое наименование / Название бренда)
            </th>
            <th>
                Форма выпуска
            </th>
            <th>Категория</th>
            <th>Краткое описание</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>

    </thead>
    <tbody>
        @if(isset($medicineContents) && $medicineContents->count() > 0)
            @foreach($medicineContents as $medicineContent)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    {!! Str::limit($medicineContent->title, 50) !!}
                </td>
                <td>
                    {!! Str::limit($medicineContent->trade_name, 50) !!}
                </td>
                <td>
                    {!! Str::limit($medicineContent->dosage_form, 50) !!}
                </td>
                <td>
                    @if($medicineContent->medicineCategory)
                        {{ $medicineContent->medicineCategory->title }}
                    @else
                        N/A
                    @endif
                </td>
                <td>
                     {!! Str::limit($medicineContent->short_content, 50) !!}
                </td>
                <td>
                    @if($medicineContent->status)
                        <span class="badge bg-success">Активный</span>
                    @else
                        <span class="badge bg-danger">Неактивный</span>
                    @endif
                </td>
                <td class="action-table-data">
                    <div class="edit-delete-action">
                        <a class="btn btn-sm btn-primary me-2 p-2"
                        href="{{ route('manage-medicine.edit', $medicineContent->id) }}"                         
                        title="Edit">
                            <i data-feather="edit" class="feather-edit"></i>
                        </a>
                        <form action="{{ route('manage-medicine.destroy', $medicineContent->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger medicine_show_confirm" data-name="{{ $medicineContent->title }}" title="Delete">
                                <i data-feather="trash-2" class="feather-trash-2"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6" class="text-center">Контент лекарств не найден.</td>
            </tr>
        @endif
    </tbody>
</table>