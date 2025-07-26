<table class="table">
    <thead class="thead-light">
        <tr>
            <th>Sr. No.</th>
            <th>Title</th>
            <th>Category</th>
            <th>Content</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($newsRooms) && $newsRooms->count() > 0)
            @foreach($newsRooms as $newsRoom)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <div class="content-text" style="max-width: 300px; overflow-x: auto; height: 100px;">
                        {{ $newsRoom->title }}
                    </div>
                </td>
                <td>{{ $newsRoom->newsMediaCategory->title }}</td>
                <td>
                    <div class="overflow-auto" style="max-width: 250px; max-height: 100px; overflow: auto; white-space: nowrap;">
                        {!! $newsRoom->content !!}
                    </div>                    
                </td>
                <td>{{ \Carbon\Carbon::parse($newsRoom->post_date)->format('d-m-Y') }}</td>              
                <td class="action-table-data">
                    <div class="edit-delete-action">
                        <a class="btn btn-sm btn-primary me-2 p-2"
                        href="{{ route('manage-news-media.edit', $newsRoom->id) }}?action=newsroom"                         
                        title="Edit">
                            <i data-feather="edit" class="feather-edit"></i>
                        </a>
                        <form action="{{ route('news-room.destroy', $newsRoom->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger newsroom_show_confirm" data-name="{{ $newsRoom->title }}" title="Delete">
                                <i data-feather="trash-2" class="feather-trash-2"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4" class="text-center">No feature story found.</td>
            </tr>
        @endif
    </tbody>
</table>