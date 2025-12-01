<table class="table">
    <thead class="thead-light">
        <tr>
            <th>Sr. No.</th>
            <th>
                MHH 
                <BR><span class="text-muted">(INN: International Non-proprietary Name)</span>
            </th>
            <th>
                ТН 
                <BR><span class="text-muted">(Trade Name / Brand Name)</span>
            </th>
            <th>
                Форма выпуска 
                <BR><span class="text-muted">(Dosage Form / Form of Release)</span>
            </th>
            <th>Category</th>
            <th>Short Content</th>
            <th>Status</th>
            <th>Actions</th>
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
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
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
                <td colspan="6" class="text-center">No medicine content found.</td>
            </tr>
        @endif
    </tbody>
</table>