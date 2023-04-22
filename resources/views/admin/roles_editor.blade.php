@extends('layouts.app')

@section('title', 'Role Assignments - Admin')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-7 offset-md-1">

        <div class="card">
          <div class="card-header card-title">Role Assignments</div>
          <div class="card-body">

            @foreach($roles as $r)
              <ul class="listBox">
                <li>{{$r->name}}
                  <ul class="listBox">
                    @foreach ($r->users as $u)
                      <li>
                        @if(
                        ($r->name !== 'Admin' && $canEdit) ||
                        ($r->name === 'Admin' && $canDeleteAdmins) ||
                        ($r->name === 'Super-Admin' && $canDeleteSuperAdmins)
                        )
                          <form class="form-inline" role="form" method="POST" action="{{ route('revokeRole') }}">
                            @csrf  @method('delete')
                            <input type="hidden" name="role_id" value="{{ $r->id }}">
                            <input type="hidden" name="member_id" value="{{ $u->id }}">
                            <a href="/members/{{ $u->id }}">{{ $u->name }}</a>
                            <input type="submit" class="text-danger btn btn-sm btn-warning d-print-none" value=" X " title="Revoke" style="font-size: smaller; padding:0 0 0 0;margin-left:10px;">
                          </form>
                        @else
                          <a href="/members/{{ $u->id }}">{{ $u->name }}</a>
                        @endif
                      </li>
                    @endforeach
                      @if($canEdit)
                        <form class="form-horizontal d-print-none" role="form" method="POST" action="{{ route('assignRole') }}">
                          @csrf  @method('post')
                          <input type="hidden" name="role_id" value="{{ $r->id }}">
                          <div class="form-group row">
                            <label class="col-md-5 text-right text-muted col-form-label" for="role-id-{{ $r->id }}">Add:</label>
                            <div class="col-md-4" id="input-r-{{$r->id}}">
                              @include('admin._member_selector', ['fieldname' => 'member_id', 'field_id' => 'role-id-'.$r->id, 'current' => null, 'users' => $users])
                            </div>
                            <div class="col-3">
                              <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-btn fa-save"></i> Add</button>
                            </div>
                          </div>
                        </form>
                      @endif
                  </ul>
                  <hr>

                </li>
              </ul>
            @endforeach
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
