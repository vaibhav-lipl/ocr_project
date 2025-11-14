@extends('layouts.app')

@section('title','Manage Users')

@section('content')

<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 46px;
        height: 24px;
    }

    .switch input {
        display: none;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 34px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked+.slider {
        background-color: #28a745;
    }

    input:checked+.slider:before {
        transform: translateX(22px);
    }
</style>


<div class="card shadow p-3">
    <h4 class="mb-3">Manage Users</h4>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Add New User
        </a>
    </div>

    <div class="mb-3">
        <a href="{{ route('users.export.excel') }}" class="btn btn-success btn-sm">
            <i class="bi bi-file-earmark-excel"></i> Export Excel
        </a>

        <a href="{{ route('users.export.pdf') }}" class="btn btn-danger btn-sm">
            <i class="bi bi-filetype-pdf"></i> Export PDF
        </a>
    </div>

    <table id="usersTable" class="table table-bordered table-striped table-responsive">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(function() {
        $('#usersTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true, // <-- Enable responsiveness
            autoWidth: false,
            ajax: "{{ route('users.list') }}",
            columns: [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'first_name'
                },
                {
                    data: 'last_name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'is_active',
                    render: function(val, type, row) {
                        let checked = val == 1 ? 'checked' : '';

                        return `
                            <label class="switch">
                                <input type="checkbox" class="toggle-status" data-id="${row.id}" ${checked}>
                                <span class="slider round"></span>
                            </label>
                        `;
                    }
                },
                {
                    data: 'created_at'
                },
                {
                    data: 'id',
                    render: function(id) {
                        return `
                            <div class="d-flex gap-2">

                                <a href="{{url('/users/view')}}/${id}" class="text-primary" title="View">
                                    <i class="bi bi-eye-fill fs-5"></i>
                                </a>

                                <a href="{{url('/users/edit')}}/${id}" class="text-warning" title="Edit">
                                    <i class="bi bi-pencil-square fs-5"></i>
                                </a>

                                <a href="javascript:void(0)" class="text-danger delete-user" data-id="${id}" title="Delete">
                                    <i class="bi bi-trash3-fill fs-5"></i>
                                </a>
                                
                            </div>
                        `;
                    }
                }

            ]
        });
    });

    // toggle user active/deactive
    $(document).on('change', '.toggle-status', function() {
        let userId = $(this).data('id');
        let newStatus = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: "{{url('/users/update-status')}}/" + userId,
            type: "POST",
            data: {
                status: newStatus,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                if (newStatus == 1) {
                    showToast("User activated successfully!", "success");
                } else {
                    showToast("User deactivated successfully!", "warning");
                }
            },
            error: function() {
                showToast("Error updating user!", "error");
            }
        });
    });

    // Delete User
    $(document).on('click', '.delete-user', function() {
        let userId = $(this).data('id');

        Swal.fire({
            title: "Are you sure?",
            text: "This action cannot be undone!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete"
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "{{url('/users/delete')}}/" + userId,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function() {
                        $('#usersTable').DataTable().ajax.reload();
                        showToast("User deleted successfully!", "success");
                    }
                });

            }
        });
    });
</script>
@if(session('success'))
<script>
    setTimeout(function() {
        showToast("{{ session('success') }}", "success");
    }, 800);
</script>
@endif
@endsection