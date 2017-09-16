@hasrole('writer')
  <p>You have been assigned the 'writer' role.</p>
@else
  <p>You do NOT have the writer role.</p>
@endhasrole

@can('edit articles')
  <p>You have permission to 'edit articles'.</p>
@else
  <p>Sorry, you may NOT edit articles.</p>
@endcan

@if(optional(auth('admin')->user())->can('edit articles'))
  <p>You are an Admin with 'edit articles' permission.</p>
@endif
