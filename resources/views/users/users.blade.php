@extends('partials')
@section('content')
    @if ($errors->any())
        <div class="custom-float-alert fixed-top alert alert-danger" role="alert">
            <ul class="errorstyle">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (Session::has('success'))
        <div class="custom-float-alert fixed-top alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif


    <div class="c-grid-item ">
        <div class="m-5">
            <h4 class="mb-4 text-center"> List of Users</h4>
            <hr>
            <a href="{{ route('adduser') }}"><button class="btn btn-secondary my-3">Add New User</button></a>
            <table class="table table-striped mx-auto" id="listingtable">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>User Name</th>
                        <th>Location</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr data-user-id="{{ $user->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->location }}</td>
                            <td>{{ $user->phone_number }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <a href="{{ route('viewuserlist', $user->id) }}"><i class="fa fa-eye icon"></i></a>
                                <button type="button" class="delete-button" data-user-id="{{ $user->id }}">
                                    <i class="fa fa-trash icon"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>

    @endsection
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#listingtable').DataTable();

                $('.delete-button').on('click', function() {

                    var userId = $(this).data('user-id');
                    var row = $('#listingtable tr[data-user-id="' + userId + '"]');

                    Swal.fire({
                        title: 'Are you sure you want to delete this user?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Send an AJAX request to the server to update the record
                            $.ajax({
                                url: 'user/delete/' + userId,
                                method: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    row.remove();
                                    Swal.fire(
                                        'Deleted!',
                                        'The record has been deleted.',
                                        'success'
                                    )
                                },
                                error: function(xhr) {
                                    Swal.fire(
                                        'Error!',
                                        'Something went wrong!',
                                        'error'
                                    )
                                }
                            });
                        }
                    });
                });

            });
        </script>
    @endpush
