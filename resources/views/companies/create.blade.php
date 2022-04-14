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
                        <h4 class="page-title">Company Register</h4>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="card">
                            <form class="form-horizontal" id="form1" method="post" action="{{route('company.save')}}"
                                  enctype="multipart/form-data">
                                <div class="card-body">
                                    <h4 class="card-title">Company Info</h4>
                                    <div class="form-group row">
                                        <label for="name"
                                               class="col-sm-3 text-right control-label col-form-label">Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="name" name="name"
                                                   placeholder="Name Here" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 text-right control-label col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" name="email" id="email"
                                                   placeholder="Email Here" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Website</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="website" id="cono1"
                                                   placeholder="Website Here" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">File
                                            Upload</label>
                                        <div class="col-md-9">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="file"
                                                       id="validatedCustomFile" required>
                                                <label class="custom-file-label" for="validatedCustomFile">Choose
                                                    file...</label>
                                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary btn-submit offset-2">Submit
                                            <img src="{{asset('assets/images/loading.gif')}}" alt="loading" style="width: 25px;" class="loading" />
                                        </button>
                                    </div>
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


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#form1').submit(function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                // $('.loading').css('display','inline');
                // $('.btn-submit').prop('disabled', true);
                $.ajax({
                    type: 'POST',
                    url: '{{route('company.save')}}',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        // $('.loading').css('display','none');
                        // $('.btn-submit').prop('disabled', false);

                        if (data.status) {
                            Swal.fire({
                                type: 'success',
                                title: 'Saved',
                                text: 'Record Inserted Successfully'
                            }).then(function () {
                                // location.reload();
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
                    error: function (response) {
                        console.log(response);
                    }
                });
            });
        });
    </script>


@endsection
