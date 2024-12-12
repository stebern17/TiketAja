@extends('layouts.adminLayout')

@section('title', 'User Management')

@section('content')
<h1>User Management</h1>

<table class="table table-striped">
  <thead>
    <tr>
      <th>No</th>
      <th>Name</th>
      <th>Email</th>
      <th>Role</th>
      <th>Created At</th>
      <th>Updated At</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $index => $user)
    <tr>
      <td>{{ $index + 1 }}</td>
      <td>{{ $user->name_user }}</td>
      <td>{{ $user->email_user }}</td>
      <td>{{ $user->role }}</td>
      <td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
      <td>{{ $user->updated_at->format('Y-m-d H:i:s') }}</td>
      <td>
      <!-- Button to trigger the edit modal -->
      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}">
        Edit
      </button>

      <!-- Button to trigger the delete confirmation modal -->
      <button type="button" class="btn btn-danger" data-bs-toggle="modal"
        data-bs-target="#deleteModal{{ $user->id }}">
        Delete
      </button>

      <!-- Edit Modal -->
      <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1"
        aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Edit User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" value="{{ $user->name_user }}" disabled>
            </div>
            <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" value="{{ $user->email_user }}" disabled>
            </div>
            <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" id="role" name="role">
              <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
              <option value="User" {{ $user->role == 'User' ? 'selected' : '' }}>User</option>
              <option value="Promotor" {{ $user->role == 'Promotor' ? 'selected' : '' }}>Promotor</option>
            </select>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
          </div>
        </div>
        </div>
      </div>

      <!-- Delete Modal -->
      <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1"
        aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel{{ $user->id }}">Delete User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          Are you sure you want to delete this user?
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <!-- Delete Form -->
          <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
          </div>
        </div>
        </div>
      </div>

      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection