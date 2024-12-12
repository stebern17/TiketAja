@extends('layouts.adminLayout')

@section('title', 'User Management')

@section('content')
<h1>User Management</h1>

<table class="table table-striped">
  <thead>
    <tr>
      <th>No</th> <!-- Tambahkan kolom nomor -->
      <th>Name</th>
      <th>Email</th>
      <th>Role</th> <!-- Menampilkan Role -->
      <th>Created At</th> <!-- Menampilkan Created At -->
      <th>Updated At</th> <!-- Menampilkan Updated At -->
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $index => $user) 
    <tr>
      <td>{{ $index + 1 }}</td> <!-- Menampilkan nomor urut -->
      <td>{{ $user->name_user }}</td>
      <td>{{ $user->email_user }}</td>
      <td>{{ $user->role }}</td> <!-- Menampilkan role -->
      <td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td> <!-- Menampilkan created_at dengan format -->
      <td>{{ $user->updated_at->format('Y-m-d H:i:s') }}</td> <!-- Menampilkan updated_at dengan format -->
      <td>
      <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
      <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
      </form>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection