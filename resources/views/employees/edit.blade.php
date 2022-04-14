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
                        <h4 class="page-title">Employee Register</h4>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="card">
                            <form class="form-horizontal" id="form1" method="post"
                                  action="{{route('employee.update')}}">
                                <input type="hidden" name="id" value="{{$employee->id}}">
                                <div class="card-body">
                                    <h4 class="card-title">Employee Info</h4>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">First
                                            Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="fname"
                                                   value="{{$employee->first_name}}" name="fname"
                                                   placeholder="First Name Here">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Last
                                            Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="lname"
                                                   value="{{$employee->last_name}}" name="lname"
                                                   placeholder="Last Name Here">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 text-right control-label col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" name="email"
                                                   value="{{$employee->email}}" id="email" placeholder="Email Here">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email1" class="col-sm-3 text-right control-label col-form-label">Company</label>
                                        <div class="col-sm-9">
                                            <select class="select2 form-control custom-select" name="company_id"
                                                    style="width: 100%; height:36px;">
                                                <option value="">Select</option>
                                                @foreach($companies as $company)
                                                    <option value="{{$company->id}}"
                                                            @if($company->id == $employee->company_id)selected @endif >{{$company->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Contact
                                            No</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="phone"
                                                   value="{{$employee->phone}}" id="cono1"
                                                   placeholder="Contact No Here">
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary btn-submit offset-2">Update
                                            <img src="{{asset('assets/images/loading.gif')}}" alt="loading" style="width: 25px;" class="loading" />
                                        </button>                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $(document).on('submit', '#form1', function (e) {
                e.preventDefault();
                e.stopPropagation();
                $('.loading').css('display','inline');
                $('.btn-submit').prop('disabled', true);
                $.ajax({
                    /* the route pointing to the post function */
                    url: '{{route('employee.update')}}',
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $('#form1').serialize(),
                    dataType: "json",
                    success: function (data) {
                        $('.loading').css('display','none');
                        $('.btn-submit').prop('disabled', false);
                        if (data.status) {
                            Swal.fire({
                                type: 'success',
                                title: 'Saved',
                                text: 'Record Update Successfully'
                            }).then(function () {
                                window.location.href = '/employees'
                            });
                        } else {
                            for (const [variable, index] of Object.entries(data)) {
                                toastr.options =
                                    {
                                        "closeButton": true,
                                        "progressBar": true
                                    }
                                toastr.error(index[0]);
                            }

                        }
                    },

                });

            });
        });
    </script>


@endsection
