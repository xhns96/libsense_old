@extends('layouts.admin')
@section('title', 'Profil')

@section('headerStyles')
    @parent
    <link rel="stylesheet" href="{{asset('css/admin-page/profile/profile.css')}}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-user">
                <div class="profile-top-div">
                    <img class="profile-top-image" src="{{asset('images/admin-page/profile/back.jpg')}}" alt="...">
                </div>
                <div class="card-body">
                    <div>
                        <img class="profile-image border-gray" src="{{asset('storage/admin-profile-images/')}}/{{$currentAdmin->admin_profile_image ?? 'def_avatar_image.png'}}" alt="...">
                        <h3 class="title"><b>{{$currentAdmin->name}}</b></h3>
                    </div>
                    <p class="description text-center">
                        @foreach($allCampuses as $currentCampus)
                            @if($currentCampus->id == $currentAdmin->admin_campus_id)
                                {{$currentCampus->campus_name}}
                            @endif
                        @endforeach
                    </p>
                </div>
                <div class="card-footer">
                    <hr>
                    <div class="button-container">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-6 ml-auto mr-auto ac">
                                <h5>{{$currentAdmin->admin_added_book_count}}<br><small>Kiritgan adabiyotlar soni</small></h5>
                            </div>
                            <div class="col-lg-6 col-md-6 col-6 ml-auto mr-auto ac">
                                <h5>0<br><small>Kiritgan hujjatlar soni</small></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        @foreach($allCampuses as $currentCampus)
                            @if($currentCampus->id == $currentAdmin->admin_campus_id)
                                {{$currentCampus->campus_name}} hodimlari
                            @endif
                        @endforeach
                    </h4>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled team-members">
                        @forelse($allAdmins as $choosedAdmin)
                            @if($choosedAdmin->admin_campus_id == $currentAdmin->admin_campus_id)
                                <li>
                                    <div class="row">
                                        <div class="col-md-2 col-2">
                                            <div class="avatar">
                                                <img src="{{asset('storage/admin-profile-images/')}}/{{$choosedAdmin->admin_profile_image ?? 'def_avatar_image.png'}}" alt="Circle Image" class="rounded-circle img-no-padding img-responsive s45">
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-7">
                                            {{$choosedAdmin->name}}
                                            <br />
                                            <span class="text-muted"><small>Offline</small></span>
                                        </div>
                                        <div class="col-md-3 col-3 text-right">
                                            <button class="btn btn-sm btn-outline-success btn-round btn-icon"><i class="fa fa-envelope"></i></button>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @empty
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-user">
                <div class="card-header">
                    <h5 class="card-title">Ma'lumotlarni tahrirlash</h5>
                </div>
                <div class="card-body">
                    <form id="profile-data-form" action="{{route('admin.profile.post')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-5 pr-1">
                                <div class="form-group">
                                    <label>OTM nomi:</label>
                                    <input type="text" class="form-control" placeholder="University name" value="{{$currentUniversity->univer_name}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-3 px-1">
                                <div class="form-group">
                                    <label>Login</label>
                                    <input type="email" class="form-control" placeholder="Email" value="{{$currentAdmin->email}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Parol</label>
                                    <input type="text" name="admin-password" class="form-control" placeholder="Agar parolni o'zgartirmoqchi bo'lsangiz:">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label>F.I.O.</label>
                                    <input type="text" name="admin-name" class="form-control" placeholder="FIO" value="{{$currentAdmin->name}}">
                                </div>
                            </div>
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label>ARM bo'limi</label>
                                    <select class="font-weight-bold custom-select mr-sm-2 inputPR20" name="admin-campus">
                                        <option selected disabled>ARM bo'limini tanlang...</option>
                                        @forelse($allCampuses as $currentCampus)
                                            <option value="{{$currentCampus->id}}">{{$currentCampus->campus_name}}</option>
                                            @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-3 mb-3" style="border: 1px dashed">
                                <b>Profil rasmini tanlang (agar o'zgartirmoqchi bo'lsangiz):</b><br><input type="file" name="profile-image" accept=".jpg,.jpeg,.png" class="form-control-file">
                            </div>
                        </div>
                        <div class="col-12 px-0 mb-3 progress">
                            <div id="profile-data-upload" class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                        </div>
                        <div class="row">
                            <div class="update ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary btn-round"><i data-feather="save" class="feather-icon"></i> Saqlash</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footerScripts')
    @parent
    <script src="{{asset('js/admin-page/add_books/jqueryForm.js')}}"></script>
    <script src="{{asset('js/admin-page/profile/profile.js')}}"></script>
@endsection
