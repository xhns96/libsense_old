@extends('layouts.admin')
@section('title', "Barcha kitobxonlar")

@section('headerStyles')
    @parent
    <link rel="stylesheet" href="{{asset('css/DataTable/bootstrapTable.css')}}">
@endsection

@section('content')
    <div class="row mt-5">
        <div class="col-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        HEMIS bilan tekshirish
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <select class="font-weight-bold custom-select bg-white" id="user_type" name="user_type">
                                <option selected="" disabled="">Kitobxon turi</option>
                                <option value="student" selected>Talaba</option>
                                {{-- <option value="teacher">O‘qituvchi</option>
                                <option value="employee">Xodim</option> --}}
        
                            </select>
                        </div>

                        <div class="col-md-4">
                            <select class="font-weight-bold custom-select bg-white" id="level" name="level">
                                <option selected="" disabled="">Kurs</option>
                                <option value="1-kurs">1-kurs</option>
                                <option value="2-kurs">2-kurs</option>
                                <option value="3-kurs">3-kurs</option>
                                <option value="4-kurs">4-kurs</option>
        
                            </select>
                        </div>

                        <div class="col-md-3">
                            <button type="button" class="btn btn-primary" id="btn-sync"><i class="fas fa-sync"></i> Tekshirish</button>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        {{-- <div class="col-6 ac mb-3">
            <h3>Barcha kitobxonlar jadvali</h3>
        </div> --}}

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Barcha kitobxonlar jadvali
                    </h4>
                </div>
                <div class="card-body">
                    <div id="table-div" class="col">
                        <table id="all-users-table" class="table table-hover table-bordered" style="display: none;width:100%">
                            <thead>
                            <tr class="ac">
                                <th width="10%" class="font-weight-bold ">ID</th>
                                <th width="35" class="font-weight-bold ">Kitobxon ma'lumotlari</th>
                                <th width="35" class="font-weight-bold ">O'quv ma'lumotlari</th>
                                <th width="20%"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($allUsers as $currentUser)
                                    <tr>
                                        <td class="ac">{{$currentUser->id}}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-3 ac">
                                                    @if($currentUser->user_profile_image != "")
                                                        <img src="{{$currentUser->user_profile_image}}" class="rounded-circle mt-3 s125 img-thumbnail"  alt="user-profile-image">
                                                    @else
                                                        <img src="{{asset('storage/user-profile-images')}}/{{$currentUser->user_profile_image ?? 'placeholder.png'}}" class="rounded-circle mt-3 s125 img-thumbnail"  alt="user-profile-image">
                                                    @endif
                                                </div>
                                                <div class="col-9">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <b>F.I.O: </b>{{$currentUser->name}}
                                                        </div>
                                                        <div class="col-12"><b>Passport №: </b>
                                                                @if($currentUser->user_passport_id == "")
                                                                    <span>{{$currentUser->passport_number}}</span>
                                                                @else
                                                                    <span>{{$currentUser->user_passport_id}}</span>
                                                                @endif
                                                        </div>
                                                        <div class="col-12">
                                                            <b>Tel №: </b>{{$currentUser->user_phone}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span>
                                                <b>Fakultet: </b>
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
                                            </span>
                                            <br>
            
                                            <span>
                                                <b>Yo'nalish: </b>
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
                                            </span>
                                            <br>
            
                                            <span>
                                                 <b>Bosqich: </b>
                                                <span>
                                                    @if($currentUser->user_course_number == "")
                                                        {{$currentUser->user_course_name}}
                                                    @else
                                                        {{$currentUser->user_course_number}}-bosqich
                                                    @endif
                                                </span>
                                                <br>
                                            </span>
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
                                            <button class="btn btn-danger user-delete" data-id = "{{$currentUser->id}}">O'chirish</button>
                                            <button class="btn btn-primary user-edit" data-id = "{{$currentUser->id}}">Tahrirlash</button>
                                        </td>
                                    </tr>
                                    @empty
                                @endforelse
                            </tbody>
                            <tfoot>
                            <tr class="ac">
                                <th width="10%" class="font-weight-bold ">ID</th>
                                <th width="35" class="font-weight-bold ">Kitobxon ma'lumotlari</th>
                                <th width="35" class="font-weight-bold ">O'quv ma'lumotlari</th>
                                <th width="20%" ></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection

@section('footerScripts')
    @parent
    <script src="{{asset('js/admin-page/add_books/jqueryForm.js')}}"></script>
    <script src="{{asset('js/DataTable/jqueryTable.js')}}"></script>
    <script src="{{asset('js/DataTable/bootstrapTable.js')}}"></script>
    <script src="{{asset('js/admin-page/all_users/all_users.js')}}"></script>
@endsection
