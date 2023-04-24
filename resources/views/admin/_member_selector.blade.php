  <select name="{{ $fieldname ?? 'member_id'}}" class="form-control flex-child{{ !empty($class) ? ' ' . $class : '' }}"{{ !empty($autofocus) ? ' autofocus' : '' }} id="{{ $field_id ?? $fieldname }}">
    @foreach ($users as $u)
      <option value="{{ $u->id }}"{{ $u->id == ($current ?? null) ? ' selected' : '' }}>{{ $u->name }}</option>
    @endforeach
  </select>
