@extends('layouts.master')
@section('pageTitle')
    Companies
@endsection
@section('content')
    <div id="main-wrapper">
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Companies</h4>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title m-b-0">Companies Table</h5>
                            </div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Website</th>
                                    <th scope="col">Logo</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($companies as $company)
                                    <tr>
                                        <td>{{$company->name}}</td>
                                        <td>{{$company->email}}</td>
                                        <td>{{$company->website}}</td>
                                        <td>
                                            @if(!empty($company->logo))
                                                <img src="{{asset('storage/company_logo/'.$company->logo)}}"
                                                     style="width: 200px; height: 200px">
                                            @else
                                                <img src="{{asset('storage/company_logo/default.jpg')}}"
                                                     style="width: 200px; height: 200px">
                                            @endif

                                        </td>

                                        <td>

                                            <a href="{{route('company.edit',$company->id)}}" class="edit_employee"
                                               data-id="{{$company->id}}" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a> |

                                            <a class="delete_company"
                                               data-id="{{$company->id}}" title="Delete">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $companies->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {

            $(document).on('click', '.delete_company', function (e) {
                var id = $(this).attr('data-id');
                if (!confirm("Are you sure you want to delete this?")) {
                    return false;
                }
                $.ajax({
                    url: '{{route('company.delete')}}',
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
