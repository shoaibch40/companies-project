@extends('layouts.master')
@section('pageTitle')
    Employees
@endsection
@section('content')
    <div id="main-wrapper">
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Employees</h4>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title m-b-0">Employees Table</h5>
                            </div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Comapny</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>{{$employee->first_name}}</td>
                                        <td>{{$employee->last_name}}</td>
                                        <td>{{$employee->email}}</td>
                                        <td>{{$employee->company->name}}</td>
                                        <td>{{$employee->phone}}</td>

                                        <td>

                                            <a href="{{route('employee.edit',$employee->id)}}" class="edit_employee"
                                               data-id="{{$employee->id}}" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a> |

                                            <a class="delete_employee"
                                               data-id="{{$employee->id}}" title="Delete">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $employees->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {

            $(document).on('click', '.delete_employee', function (e) {
                var id = $(this).attr('data-id');
                if (!confirm("Are you sure you want to delete this?")) {
                    return false;
                }
                $.ajax({
                    url: '{{route('employee.delete')}}',
                    method: 'post',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {id: id},
                    success: function (data) {
                        if (data.status) {
                            Swal.fire({
                                type: 'danager',
                                title: 'Delete',
                                text: 'Employee Deleted Successfully'
                            }).then(function () {
                                location.reload();
                            });
                        } else {
                            console.log(data);
                        }
                    }
                });
            });

        });
    </script>


@endsection
