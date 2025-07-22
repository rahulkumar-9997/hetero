<table class="table">
    <thead class="thead-light">
        <tr>
            <th>Sr. No.</th>
            <th>Title</th>
            <th>Sub-title</th>
            <th>Content</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($featuredStories) && $featuredStories->count() > 0)
            @foreach($featuredStories as $featuredStory)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <div class="content-text" style="max-width: 300px; overflow-x: auto; height: 100px;">
                        {{ $featuredStory->title }}
                    </div>
                </td>
                <td>{{ $featuredStory->sub_title }}</td>
                <td>
                    <div class="overflow-auto" style="max-width: 250px; max-height: 100px; overflow: auto; white-space: nowrap;">
                        {!! $featuredStory->content !!}
                    </div>                    
                </td>
                <td>
                    @if($featuredStory->status == '1')
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                </td>
                <td class="action-table-data">
                    <div class="edit-delete-action">
                        <a class="btn btn-sm btn-primary me-2 p-2"
                        href="javascript:;" 
                        data-title="Edit News & Media Category" 
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
                <td colspan="4" class="text-center">No feature story found.</td>
            </tr>
        @endif
    </tbody>
</table>