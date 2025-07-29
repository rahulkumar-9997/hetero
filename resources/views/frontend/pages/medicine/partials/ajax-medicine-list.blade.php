<div class="row">
    @foreach($medicineContents as $index => $content)
    <div class="col-md-6 wow fadeInUp" data-wow-offset="100" data-wow-duration="1s" data-wow-delay="{{ 0.2 + ($index * 0.1) }}s">
        <div class="expertise-box medicine-list exp-bg{{ ($index % 4) + 1 }}">
            <div class="exp-pic">
                <a href="{{ route('lekarstvennye-preparaty.detail', ['slug' => $content->slug]) }}">
                    @if($content->image && file_exists(public_path('upload/medicine/' . $content->image)))
                    <img src="{{ asset('upload/medicine/' . $content->image) }}" width="100%" alt="{{ $content->title }}">
                    @else
                    <img src="{{ asset('fronted/assets/images/default-medicine.jpg') }}" width="100%" alt="{{ $content->title }}">
                    @endif
                </a>
            </div>
            <div class="exp-desc">
                <h3 class="sub-ttl">{{ $content->title }}</h3>
                <h5 class="exp-info 
                    @if($index % 4 == 0) pruple
                    @elseif($index % 4 == 1) sky-blue
                    @elseif($index % 4 == 2) pruple2
                    @else blue
                    @endif MulishBold">
                    {{ $content->short_content }}
                </h5>
            </div>
            <a href="{{ route('lekarstvennye-preparaty.detail', ['slug' => $content->slug]) }}"
                class="readmore exp-read{{ ($index % 4) + 1 }}">
                Read More
            </a>
        </div>
    </div>
    @endforeach
</div>