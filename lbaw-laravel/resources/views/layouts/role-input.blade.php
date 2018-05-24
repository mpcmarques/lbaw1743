<select name="role">
  @if ($role == 'Owner')
  <option value="Owner" selected>Owner</option>
  @elseif ($user == 'Owner')
  <option value="Owner">Owner</option>
  @endif
  @if ($role == 'Manager')
  <option value="Manager" selected>Manager</option>
  @else
  <option value="Manager">Manager</option>
  @endif
  @if ($role == 'Member')
  <option value="Member" selected>Member</option>
  @else
  <option value="Member">Member</option>
  @endif
</select>
