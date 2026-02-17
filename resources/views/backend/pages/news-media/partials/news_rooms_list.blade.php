<table class="table">
    <thead class="thead-light">
        <tr>
            <th>№</th>
            <th>Заголовок</th>
            <th>Категория</th>
            <th>Содержание</th>
            <th>Дата</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($newsRooms) && $newsRooms->count() > 0)
            @foreach($newsRooms as $newsRoom)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{!! Str::limit(strip_tags($newsRoom->title, 50)) !!}</td>
                <td>{{ $newsRoom->newsMediaCategory->title ?? '' }}</td>
                <td>{!! Str::limit(strip_tags($newsRoom->content, 50)) !!}</td>
                <td>{{ $newsRoom->post_date ? \Carbon\Carbon::parse($newsRoom->post_date)->format('d-m-Y') : null }}</td>
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
                <td colspan="6" class="text-center">No feature story found.</td>
            </tr>
        @endif
    </tbody>
</table>
