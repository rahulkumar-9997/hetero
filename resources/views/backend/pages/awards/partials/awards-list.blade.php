<table class="table">
    <thead class="thead-light">
        <tr>
            <th width="10%">№</th>
            <th width="15%">Категория</th>
            <th width="15%">Год</th>
            <th width="30%">Год</th>
            <th width="10%">Изображение</th>
            <th width="10%">Статус</th>
            <th width="10%">Действия</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($awards) && $awards->count() > 0)
            @foreach($awards as $award)
            <tr>
                <td>{{ $loop->iteration }}</td>                
                <td>{{ $award->awardCategory->title ?? 'N/A' }}</td>
                <td>{{ $award->year->title ?? 'N/A' }}</td>
                <td>{{ $award->content ?? 'N/A' }}</td>
                <td>
                    @if($award->awardImages->count() > 0)
                        <div class="d-flex" style="gap: 5px;">
                            @foreach($award->awardImages->take(3) as $image)
                                <a href="{{ asset('upload/awards/'.$image->file) }}" data-lightbox="award-{{ $award->id }}">
                                    <img src="{{ asset('upload/awards/'.$image->file) }}" 
                                    class="img-thumbnail" 
                                    style="width: 80px; height: 80px; object-fit: cover;">
                                </a>
                            @endforeach
                            @if($award->awardImages->count() > 3)
                                <span class="badge bg-purple align-self-center">
                                    +{{ $award->awardImages->count() - 3 }}
                                </span>
                            @endif
                        </div>
                    @else
                        <span class="badge bg-purple">No images</span>
                    @endif
                </td>
                <td>
                    @if($award->status == 1)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                </td>
                <td class="action-table-data">
                    <div class="edit-delete-action">
                        <a class="btn btn-sm btn-primary me-2 p-2"
                           href="{{ route('manage-awards.edit', $award->id) }}" 
                           title="Edit">
                            <i data-feather="edit" class="feather-edit"></i>
                        </a>
                        <form action="{{ route('manage-awards.destroy', $award->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger show_confirm" 
                                    data-name="Award" title="Delete">
                                <i data-feather="trash-2" class="feather-trash-2"></i>
                            </button>
                        </form>
                       
                    </div>
                </td>
            </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6" class="text-center">No awards found.</td>
            </tr>
        @endif
    </tbody>
</table>