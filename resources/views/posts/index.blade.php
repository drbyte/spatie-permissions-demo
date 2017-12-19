@foreach($posts as $p)
  <p>{{ $p->id }}. {{ $p->title }}</p>
@endforeach
