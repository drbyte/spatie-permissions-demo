<p>Title: <strong>{{ $post->title }}</strong></p>
<p>{{ $post->body }}</p>

@can('edit articles')
    <p><a href="{{route('post.edit', ['post' => $p->id])}}">Edit Post</a></p>
@endcan

<p>
    <a href="{{route('home')}}" class="">Back to Demo Home Page</a>
</p>
