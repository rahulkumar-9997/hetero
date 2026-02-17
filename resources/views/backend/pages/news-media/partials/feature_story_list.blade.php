<table class="table">
    <thead class="thead-light">
        <tr>
            <th>№</th>
            <th>Заголовок</th>
            <th>Подзаголовок</th>
            <th>Категория</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($featuredStories) && $featuredStories->count() > 0)
            @foreach($featuredStories as $featuredStory)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    {!! Str::limit($featuredStory->title, 50) !!}
                </td>
                <td>{{ $featuredStory->sub_title }}</td>
                <td>
                    {!! Str::limit($featuredStory->content, 50) !!}
                </td>
                <td>
                    @if($featuredStory->status == '1')
                        <span class="badge bg-success">Активный</span>
                    @else
                        <span class="badge bg-danger">Неактивный</span>
                    @endif
                </td>
                <td class="action-table-data">
                    <div class="edit-delete-action">
                        <a class="btn btn-sm btn-primary me-2 p-2"
                        href="javascript:;" 
                        data-title="Редактировать категорию «Новости и медиа»" 
                        data-size="md"
                        data-id="{{ $featuredStory->id }}"
                        data-url="{{ route('manage-news-media-category.edit', $featuredStory->id) }}"
                        data-newmedia-cat-edit="true"
                        title="Edit">
                            <i data-feather="edit" class="feather-edit"></i>
                        </a>
                        <form action="{{ route('manage-news-media-category.destroy', $featuredStory->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger show_confirm" data-name="{{ $featuredStory->title }}" title="Delete">
                                <i data-feather="trash-2" class="feather-trash-2"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6" class="text-center">Нет записей о главных историях.</td>
            </tr>
        @endif
    </tbody>
</table>