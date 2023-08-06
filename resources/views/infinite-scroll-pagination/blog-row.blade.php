@foreach ($blogs as $item)
    <div class="pb-5">
        <h2 class="fs-4">#{{ $item->id }}: {{ $item->title }}</h2>
        <p>{{ $item->description }}</p>
    </div>
@endforeach
