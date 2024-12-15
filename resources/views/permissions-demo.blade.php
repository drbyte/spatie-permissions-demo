@hasrole('writer')
  <p>You have been assigned the [writer] role.</p>
@else
  <p>You do NOT have the writer role.</p>
@endhasrole

@can('edit articles')
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
