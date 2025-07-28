<table class="table datatable1">
    <thead class="thead-light">
        <tr>
            <th>Title</th>
            <th>Image</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @if((isset($medicineCategory)) && $medicineCategory->count() > 0)
        @foreach($medicineCategory as $medicine_category)
        <tr>
            <td>{{ $medicine_category->title }}</td>
            <td>
                @if($medicine_category->image)
                <img src="{{ asset('upload/medicine-category/' . $medicine_category->image) }}" width="100">
                @else
                -
                @endif
            </td>
            <td>
                @if ($medicine_category->status ==1)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-info">In-Active</span>
                @endif
            </td>
            
            <td class="action-table-data">
                <div class="edit-delete-action">
                    <a class="btn btn-sm btn-primary me-2 p-2"
                    href="javascript:;" 
                    data-title="Edit awards category" 
                    data-size="lg"
                    data-medcatid="{{ $medicine_category->id }}"
                    data-medicine-category-edit="true" 
                    data-url="{{ route('medicine-category.edit', $medicine_category->id) }}"
                    title="Edit">
                        <i data-feather="edit" class="feather-edit"></i>
                    </a>
                    <form action="{{ route('medicine-category.destroy', $medicine_category->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger show_confirm" data-name="{{ $medicine_category->title }}" title="Delete">
                            <i data-feather="trash-2" class="feather-trash-2"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="6" class="text-center">No banners found.</td>
        </tr>
        @endif
    </tbody>
</table>