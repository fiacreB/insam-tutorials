@extends('dashboard.admin.layout.main')
@section('title', 'Admin | UIEs/Insam_tutorias')
@section('content')

    <div class="col">
        <div class="row">
            <div class="col-lg-12">
                <nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
                    <h4 class="title float-left">User Profile</h4>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-12">
                <form action="{{ route('admin.settingUpdate', ['user' => Auth::user()->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="my_course_content_container">
                        <div class="my_setting_content mb30">
                            <div class="my_setting_content_header">
                                <div class="my_sch_title">
                                    <h4 class="m0">Personal Details</h4>
                                </div>
                            </div>
                            <div class="row my_setting_content_details pb0">
                                @if ($user->image)
                                    <div class="d-flx text-center w-100 mb-5" style="border-radius: 50%">
                                        <div class="mb-3">
                                            <img alt="{{ $user->name }}" src="{{ Storage::url($user->image) }}"
                                                class="img-fluid" width="200" height="200"
                                                style="border-radius: 50%" />
                                        </div>
                                        <input type="file" name="image" id="image" accept="image/*" />
                                        <label for="image">
                                            <span class="text-info">Change Image</span>
                                        </label>
                                    </div>
                                @else
                                    <div class="col-ms-4 mr-4">
                                        <div class="wrap-custom-file">
                                            <input type="file" name="image" id="image" accept="image/*" />
                                            <label for="image">
                                                <span>Browse</span>
                                            </label>
                                        </div>
                                    </div>
                                @endif
                                <div class="col">
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="my_profile_setting_input form-group">
                                                <label for="formGroupExampleInput1">Full Name</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ $user->name }}" id="formGroupExampleInput1">
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="my_profile_setting_input form-group">
                                                <label for="formGroupExampleInput3">Email</label>
                                                <input type="email" class="form-control" name="email"
                                                    id="formGroupExampleInput3" placeholder="$89"
                                                    value="{{ $user->email }}">
                                            </div>
                                        </div>

                                        <div class="col-xl-12">
                                            <div class="my_sch_title">
                                                <h4 class="m0">Change password</h4>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="my_profile_setting_input form-group">
                                                <label for="exampleInputPassword1">Old Password</label>
                                                <input type="password" class="form-control" id="exampleInputPassword1"
                                                    value="{{ Auth::user()->password }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="my_profile_setting_input form-group">
                                                <label for="exampleInputPassword2">New Password</label>
                                                <input type="password" name="password" class="form-control"
                                                    id="exampleInputPassword2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row my_setting_content_details">
                                <div class="col-lg-12">
                                    <button type="submit" class="my_setting_savechange_btn btn btn-thm">Save
                                        <span class="flaticon-right-arrow-1 ml15"></span></button>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
