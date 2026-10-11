This would be the edit form for the post:
{{ $post->title }}

<p>If you didn't have the edit articles PERMISSION that the "Writer" ROLE provides you would get a 403 error instead of this page. Try that out by logging in as admin account which won't have this permission and will return a 403 error.</p>
