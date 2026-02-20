@extends('layouts.admin')
@section('title', "Yangi kitobxonlar")

@section('headerStyles')
    @parent
    <link rel="stylesheet" href="{{asset('css/DataTable/bootstrapTable.css')}}">

@endsection

@section('content')
    <div class="col-12 mt-3 profileCard">
        <form id="cbook-form" action="{{route('admin.new_users.post')}}" method="post">
            @csrf
            <div class="row">
                <input type="hidden" class="form-control" value="user_save" id="user_save" name="_for_what" required>

                <input type="hidden" class="form-control" value="" id="image" name="image">

                <div class="col-12 pt-2 mb-3">
                    <h4><i data-feather="user-plus" class="feather-icon mb-1 mr-2"></i> Kitobxon qo'shish: </h4>
                </div>

                <div class="col-3 mb-3">
                    <select class="font-weight-bold custom-select bg-white" id="user_type" name="user_type">
                        <option selected="" disabled="">Kitobxon turi</option>
                        <option value="student">Talaba</option>
                        <option value="teacher">O‘qituvchi</option>
                        <option value="employee">Xodim</option>


                    </select>
                </div>

                <div class="col-3 mb-3">
                    <div class="input-group">
                        <input type="number" autocomplete="off" class="form-control" placeholder="Talaba HEMIS ID sini kiriting" aria-label="HEMIS ID ni kiriting" aria-describedby="button-addon2" name="student_id_number" id="student_id_number">

                        <div class="input-group-append">
                            <button class="btn btn-primary d-none" type="button" id="reload-btn" disabled>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <span class="sr-only">Loading...</span>
                              </button>
                          <button class="btn btn-outline-primary" type="button" id="btn_student_id_number"><i class="fa fa-search"></i></button>
                        </div>
                      </div>
                </div>

                <div class="col-6">
                    <input type="text" autocomplete="off" name="name" class="form-control" placeholder="Talabani to‘liq ismi" data-original-title="Talaba" id="name">
                </div>

                <div class="col-4 mb-3">
                    <input type="text" class="form-control" placeholder="Fakultet" name="student_faculty_name" id="student_faculty_name">
                </div>
                <div class="col-4 mb-3">
                    <input type="text" class="form-control" placeholder="Yo‘nalish" name="student_specialty_name" id="student_specialty_name">
                </div>
                <div class="col-4 mb-3">
                    <input type="text" class="form-control" placeholder="Kurs" name="student_course_name" id="student_course_name">
                </div>
                <div class="col-3 mb-3">
                    <input type="text" class="form-control" placeholder="Guruh" name="student_group_name" id="student_group_name">
                </div>
                <div class="col-3 mb-3">
                    <input type="text" class="form-control" placeholder="Semestr" name="student_semestr_name" id="student_semestr_name">
                </div>
                <div class="col-3 mb-3">
                    <input type="text" class="form-control" placeholder="O‘quv yili" name="student_education_year" id="student_education_year">
                </div>
                <div class="col-3 mb-3">
                    <input type="text" class="form-control" placeholder="Talaba holati" name="student_status" id="student_status">
                </div>

                <div class="col-12 mb-3 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" id="btn-save"><i data-feather="save" class="feather-icon mr-2"></i>Saqlash</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row mt-5">
        <div class="col-12 ac">
            <h3>Barcha yangi kitobxonlar ro'yxati</h3>
        </div>

        <div id="table-div" class="col">
            <table id="all-new-users-table" class="table table-hover table-bordered" style="width:100%">
                <thead>
                <tr class="ac">
                    <th width="10%" class="font-weight-bold ">T/r</th>
                    <th width="40" class="font-weight-bold ">Kitobxon ma'lumotlari</th>
                    <th width="20%" class="font-weight-bold"></th>
                    <th width="30%" ></th>
                </tr>
                </thead>
                <tbody>
                    @forelse($allNewUsers as $item=>$currentUser)
                        <tr>
                            <td class="ac">{{++$item}}</td>
                            <td>
                                <div class="row">
                                    <div class="col-4 ac">
                                        @if($currentUser->user_profile_image != "")
                                            <img src="{{$currentUser->user_profile_image}}" class="rounded-circle mt-3 s125 img-thumbnail"  alt="user-profile-image">
                                        @else
                                            <img src="{{asset('storage/user-profile-images')}}/{{$currentUser->user_profile_image ?? 'placeholder.png'}}" class="rounded-circle mt-3 s125 img-thumbnail"  alt="user-profile-image">
                                        @endif
                                    </div>
                                    <div class="col-8">
                                        <p><b>ID: </b><span>{{$currentUser->id}}</span></p>
                                        <p><b>F.I.SH: </b><span>{{$currentUser->name}}</span></p>
                                        <p><b>Passport №: </b>
                                            @if($currentUser->user_passport_id == "")
                                                <span>{{$currentUser->passport_number}}</span>
                                            @else
                                                <span>{{$currentUser->user_passport_id}}</span>
                                            @endif

                                        </p>
                                        <p><b>Tel №: </b><span>{{$currentUser->user_phone}}</span></p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p><b>Fakultet: </b>
                                    <span>
                                        @if($currentUser->user_faculty_id == "")
                                            {{$currentUser->user_faculty_name}}
                                        @else
                                            @forelse($allFaculties as $currentFaculty)
                                                @if($currentFaculty->id == $currentUser->user_faculty_id)
                                                    {{$currentFaculty->faculty_name}}
                                                @endif
                                            @empty
                                                Kiritilmagan
                                            @endforelse
                                        @endif
                                    </span>
                                </p>
                                <p><b>Yo'nalish: </b>
                                    <span>
                                        @if($currentUser->user_specialty_id == "")
                                            {{$currentUser->user_specialty_name}}
                                        @else
                                            @forelse($allSpecialties as $currentSpecialty)
                                                @if($currentSpecialty->id == $currentUser->user_specialty_id)
                                                    {{$currentSpecialty->specialty_name}}
                                                @endif
                                            @empty
                                                Kiritilmagan
                                            @endforelse
                                        @endif
                                    </span>
                                </p>
                                <p><b>Bosqich: </b>
                                    <span>
                                        @if($currentUser->user_course_number == "")
                                            {{$currentUser->user_course_name}}
                                        @else
                                            {{$currentUser->user_course_number}}-bosqich
                                        @endif
                                    </span>
                                </p>
                                <p><b>Guruh: </b>
                                    <span>
                                        @if($currentUser->user_group_id == "")
                                            {{$currentUser->user_group_name}}
                                        @else
                                            @forelse($allGroups as $currentGroup)
                                                @if($currentGroup->id == $currentUser->user_group_id)
                                                    {{$currentGroup->group_name}}
                                                @endif
                                            @empty
                                                Kiritilmagan
                                            @endforelse
                                        @endif
                                    </span>
                                </p>

                                <p><b>Kitobxon turi: </b>
                                    <span>
                                        @switch($currentUser->user_type)
                                            @case('student')
                                                Talaba
                                                @break
                                            @case('teacher')
                                                O‘qituvchi
                                                @break
                                            @case('employee')
                                                Xodim
                                                @break
                                            @default
                                                
                                        @endswitch
                                    </span>
                                </p>
                            </td>
                            <td class="ac">
                                <button class="btn btn-danger user-reject" data-id="{{$currentUser->id}}">Rad qilish</button>
                                <button class="btn btn-primary user-accept" data-id = "{{$currentUser->id}}">Tasdiqlash</button>
                            </td>
                        </tr>
                        @empty
                    @endforelse
                </tbody>
                <tfoot>
                <tr class="ac">
                    <th width="10%" class="font-weight-bold ">T/r</th>
                    <th width="40" class="font-weight-bold ">Kitobxon ma'lumotlari</th>
                    <th width="20%" class="font-weight-bold"></th>
                    <th width="30%" ></th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@section('footerScripts')
    @parent
    <script src="{{asset('js/admin-page/add_books/jqueryForm.js')}}"></script>
    <script src="{{asset('js/DataTable/jqueryTable.js')}}"></script>
    <script src="{{asset('js/DataTable/bootstrapTable.js')}}"></script>
    <script src="{{asset('js/admin-page/new_users/new_users.js')}}"></script>
@endsection
