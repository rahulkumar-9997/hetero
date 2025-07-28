<table class="table">
    <thead class="thead-light">
        <tr>
            <th>Sr. No.</th>
            <th>Title</th>
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
                    <div class="content-text" style="max-width: 300px; overflow-x: auto; height: 100px;">
                        {{ $medicineContent->title }}
                    </div>
                </td>
                <td>
                    @if($medicineContent->medicineCategory)
                        {{ $medicineContent->medicineCategory->title }}
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    <div class="overflow-auto" style="max-width: 250px; max-height: 100px; overflow: auto;">
                        {{ $medicineContent->short_content }}
                    </div>                    
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