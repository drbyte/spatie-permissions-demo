@can('edit all posts')
    <p>You have permission to [edit all posts]. Clicking Edit Post below will return a edit page</p>
@else
    <p>You do NOT have permission to [edit all posts]. Clicking edit below will return a 403 Error UNLESS you own the post. For guests they will get a redirect to login page</p>
@endcan

@foreach($posts as $p)
    <p>{{ $p->id }}. <a href="{{route('post.show', ['post' => $p->id])}}"> {{ $p->title }}</a> (<a href="{{route('post.edit', ['post' => $p->id])}}">Edit Post</a>)</p>
@endforeach

<p>
    <a href="{{route('home')}}" class="">Back to Demo Home Page</a>
</p>
