@hasrole('author')
  <p>You have been assigned the [author] role.</p>
@else
  <p>You do NOT have the author role.</p>
@endhasrole

@can('edit all posts')
  <p>You have permission to [edit articles].</p>
@else
  <p>Sorry, you may NOT edit articles.</p>
@endcan


  <div>
      <ul>
          <li><a href="{{route('showAssignedRoles')}}">Assign Permissions Page</a></li>
          <li> <a href="{{route('show')}}">View My Roles</a></li>
          <li><a href="{{route('post.index')}}">View Posts</a></li>
      </ul>
  </div>
