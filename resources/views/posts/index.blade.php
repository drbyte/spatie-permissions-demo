@foreach($posts as $p)
  <p>{{ $p->id }}. <a href="{{route('post.show', ['post' => $p->id])}}"> {{ $p->title }}</a></p>
@endforeach
