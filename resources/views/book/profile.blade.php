@extends('layouts.book')
@section('title','Profil')
@section('headerStyles')
    @parent
    <link rel="stylesheet" href="{{asset('css/DataTable/bootstrapTable.css')}}">
@endsection

@section('content')


    <div class="row" style="font-family: 'Open Sans', sans-serif;margin-left: 200px; margin-right: 200px; ;border-radius: 30px;background-color: white; padding: 30px 150px 20px 150px">
        <div class="col-4 ac showRightBorder">
{{--            <img src="{{$currentUser->user_profile_image}}" class="rounded-circle mt-3 s125 img-thumbnail" alt="">--}}
{{--            <img src="{{asset('storage/user-profile-images')}}/{{$currentUser->user_profile_image ?? 'placeholder.png'}}" class="rounded-circle mt-3 s125 img-thumbnail" alt=""> --}}
            @if($currentUser->user_profile_image != "")
                <img src="{{$currentUser->user_profile_image}}" class="rounded-circle mt-3 s125 img-thumbnail" alt="">
            @else
                <img src="{{asset('storage/user-profile-images')}}/{{$currentUser->user_profile_image ?? 'placeholder.png'}}" class="rounded-circle mt-3 s125 img-thumbnail" alt="">
            @endif
            <br>
            <h1 class="font-weight-bold " style="font-family: 'Source Serif Pro', serif; font-size: 30px;">{{$currentUser->name}}</h1>
{{--            <p class="mt-1 lemonJelly">{{$currentUser->name}}</p>--}}
            <p class="mt-3 mb-0" style="font-size: 1.2em; font-weight: bold; color: grey">Buyurtmalar soni: <code>@if($currentUser->user_borrow_count){{$currentUser->user_borrow_count}}@else{{'0'}}@endif</code></p>
            <p style="font-size: 1.2em;font-weight: bold; color: grey">Yuklangan adabiyotlar soni: <code>{{$currentUser->user_down_count ?? '0'}}</code></p>
        </div>
        <div class="col-8">
            <div class="row">
                <div class="col" style="font-size: 1.2em">
                    @if($currentUser->user_profile_status == 'inactive')
                        <div class="alert alert-danger">
                            <b>Akkauntingiz faol emas!</b> Faol holatga o'tish uchun barcha ma'lumotlaringizni kiriting.
                        </div>
                        @if($rejectMsg)
                            <div class="alert alert-danger">
                                <b>Izoh:</b> {{$rejectMsg[0]->message}}.
                            </div>
                        @endif
                    @elseif($currentUser->user_profile_status == 'pending')
                        <div class="alert alert-warning">
                            <b>Akkauntingiz faol emas!</b> ARM hodimlari tomonidan kiritgan ma'lumotlaringiz ko'rib chiqilmoqda, agar barcha ma'lumotlaringizni to'g'ri kiritgan bo'lsangiz, ARM hodimlariga passportingiz nusxasini topshiring, shundan so'ng akkauntingiz faol holatga o'tadi.
                        </div>
                    @endif
                </div>
            </div>
            <div class="row mt-1 mx-auto ac" style="font-size: 1.2rem">
                <div class="col-12">
                    <table class="table table-striped text-left">
                        <tr>
                            <th>Talaba:</th>
                            <td>{{$currentUser->name}}</td>
                        </tr>
                        <tr>
                            <th>Telefon raqam:</th>
                            <td>
                                @if($currentUser->user_phone)
                                    {{$currentUser->user_phone}}
                                @else
                                    <code>kiritilmagan</code>
                                @endif
                            </td>
                        </tr>
{{--                        <tr>--}}
{{--                            <th>OTM:</th>--}}
{{--                            <td>--}}
{{--                                {{$currentUser->user_university_name}}--}}
{{--                            </td>--}}
{{--                        </tr>--}}
                        <tr>
                            <th>Fakultet:</th>
                            <td>
                                {{$currentUser->user_faculty_name}}
                            </td>
                        </tr>
                        <tr>
                            <th>Yo‘nalsh:</th>
                            <td>
                                {{$currentUser->user_specialty_name}}
                            </td>
                        </tr>
                        <tr>
                            <th>Bosqich:</th>
                            <td>
                                {{$currentUser->user_course_name}}
                            </td>
                        </tr>
                        <tr>
                            <th>Guruh:</th>
                            <td>
                                {{$currentUser->user_group_name}}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col ac">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#staticEditModal"><i class="bi bi-pencil-square"></i> Tahrirlash</button>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#hemis_sinc"><i class="bi bi-arrow-clockwise" id="btn_hemis_sinc"></i> Sinxronizatsiya</button>
                </div>
            </div>
        </div>
        <div class="col-12 mt-5">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Buyurtma qilingan adabiyotlar jadvali</a>
                    <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Qarzdorlik jadvali</a>
                    <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Topshirilgan adabiyotlar jadvali</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row">
                        <div class="col mt-3">
                            <table id="all-Orders-Table" class="table table-hover table-bordered" style="width:100%">
                                <thead>
                                <tr class="ac">
                                    <th width="10%">T/r</th>
                                    <th width="40%">Adabiyot nomi</th>
                                    <th width="20%">Buyurtma holati</th>
                                    <th width="30%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($userOrders as $item=>$currentOrder)
                                    <tr>
                                        <td class="ac">{{++$item}}</td>
                                        <td>{{$currentOrder->book_name}}</td>
                                        <td class="ac">
                                            @switch($currentOrder->order_status)
                                                @case('pending')
                                                <span class="badge badge-warning">KUTILMOQDA</span>
                                                @break
                                                @case('accepted')
                                                <span class="badge badge-primary">QABUL QILINDI</span>
                                                @break
                                                @case('rejected')
                                                <span class="badge badge-danger">BEKOR QILINDI</span>
                                                @break
                                                @case('ready')
                                                <span class="badge badge-success">TAYYOR</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td class="ac">
                                            <button class="btn btn-danger mr-1 order-reject" data-id = "{{$currentOrder->id}}">Bekor qilish</button>
                                            @if($currentOrder->order_status == 'take_it')
                                                <button class="btn btn-primary mr-1  order-accept" data-id = "{{$currentOrder->id}}">Tasdiqlash</button>
                                            @else
                                                <button class="btn btn-secondary mr-1">Tasdiqlash</button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr class="ac">
                                    <th width="10%">T/r</th>
                                    <th width="40%">Adabiyot nomi</th>
                                    <th width="20%">Buyurtma holati</th>
                                    <th width="30%"></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="row">
                        <div class="col mt-3">
                            <table id="all-Borrows-table" class="table table-hover table-bordered" style="width:100%">
                                <thead>
                                <tr class="ac">
                                    <th width="10%">T/r</th>
                                    <th width="40%">Adabiyot nomi</th>
                                    <th width="20%">Buyurtma holati</th>
                                    <th width="30%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($userOrders as $item=>$currentOrder)
                                    <tr>
                                        <td class="ac">{{++$item}}</td>
                                        <td>{{$currentOrder->book_name}}</td>
                                        <td class="ac">
                                            @switch($currentOrder->order_status)
                                                @case('pending')
                                                <span class="badge badge-warning">KUTILMOQDA</span>
                                                @break
                                                @case('accepted')
                                                <span class="badge badge-primary">QABUL QILINDI</span>
                                                @break
                                                @case('rejected')
                                                <span class="badge badge-danger">BEKOR QILINDI</span>
                                                @break
                                                @case('ready')
                                                <span class="badge badge-success">TAYYOR</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td class="ac">
                                            <button class="btn btn-danger mr-1 order-reject" data-id = "{{$currentOrder->id}}">Bekor qilish</button>
                                            <button class="btn btn-primary mr-1  order-accept" data-id = "{{$currentOrder->id}}">Tasdiqlash</button>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr class="ac">
                                    <th width="10%">T/r</th>
                                    <th width="40%">Adabiyot nomi</th>
                                    <th width="20%">Buyurtma holati</th>
                                    <th width="30%"></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="row">
                        <div class="col mt-3">
                            <table id="all-History-Table" class="table table-hover table-bordered" style="width:100%">
                                <thead>
                                <tr class="ac">
                                    <th width="10%">T/r</th>
                                    <th width="40%">Adabiyot nomi</th>
                                    <th width="20%">Buyurtma holati</th>
                                    <th width="30%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($userOrders as $item=>$currentOrder)
                                    <tr>
                                        <td class="ac">{{++$item}}</td>
                                        <td>{{$currentOrder->book_name}}</td>
                                        <td class="ac">
                                            @switch($currentOrder->order_status)
                                                @case('pending')
                                                <span class="badge badge-warning">KUTILMOQDA</span>
                                                @break
                                                @case('accepted')
                                                <span class="badge badge-primary">QABUL QILINDI</span>
                                                @break
                                                @case('rejected')
                                                <span class="badge badge-danger">BEKOR QILINDI</span>
                                                @break
                                                @case('ready')
                                                <span class="badge badge-success">TAYYOR</span>
                                                @break
                                                @case('take_it')
                                                <span class="badge badge-success">TAYYOR</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td class="ac">
                                            <button class="btn btn-danger mr-1 order-reject" data-id = "{{$currentOrder->id}}">Bekor qilish</button>

                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr class="ac">
                                    <th width="10%">T/r</th>
                                    <th width="40%">Adabiyot nomi</th>
                                    <th width="20%">Buyurtma holati</th>
                                    <th width="30%"></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticEditModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            @if($currentUser->user_profile_status == 'inactive' || $currentUser->user_profile_status == 'pending')
            <form method="post" action="{{route('book=>profile')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Ma'lumotlarni tahrirlash</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="font-family: 'Open Sans', sans-serif; font-weight: bold">
                    <div class="row">
                        <div class="col ac">
                            <span class="text-muted">F.I.O: </span><input name="user-name" id="user-name" class="form-control" type="text" value="{{$currentUser->name}}" readonly>
                        </div>
                        <div class="col ac">
                            <span class="text-muted">Pasport №: </span><input name="user-passport-id" id="user-passport-id" class="form-control backervaL" type="text" value="{{$currentUser->user_passport_id}}" placeholder="XX 1234567">
                        </div>
                        <div class="col ac">
                            <span class="text-muted">Tel: </span><input name="user-phone" id="user-phone" class="form-control backervaL" type="text" value="{{$currentUser->user_phone}}" placeholder="+998 xx xxx xx xx">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col ac">
                            <span class="text-muted ">OTM: </span>
                            <select class="custom-select" name="user-university-id" id="user-university-id">
                                <option selected disabled>OTM ni tanlang:</option>
                                @foreach($allUniversities as $currentUniversity)
                                    <option value="{{$currentUniversity->id}}">{{$currentUniversity->univer_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col ac">
                            <span class="text-muted">Fakultet: </span>
                            <select class="custom-select" name="user-faculty-id" id="user-faculty-id" disabled>
                                <option selected disabled>Fakultetni tanlang:</option>
                            </select>
                        </div>
                        <div class="col ac">
                            <span class="text-muted">Yo'nalish: </span>
                            <select class="custom-select" name="user-specialty-id" id="user-specialty-id" disabled>
                                <option selected disabled>Yo'nalishni tanlang:</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2"></div>
                        <div class="col-4 ac">
                            <span class="text-muted">Bosqich: </span>
                            <select class="custom-select" name="user-course-number" id="user-course-number" disabled>
                                <option selected disabled>Bosqichni tanlang:</option>
                            </select>
                        </div>
                        <div class="col-4 ac">
                            <span class="text-muted">Guruh: </span>
                            <select class="custom-select" name="user-group-id" id="user-group-id" disabled>
                                <option selected disabled>Guruhni tanlang:</option>
                            </select>
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col Aver ac">
                            <span class="text-muted">E-mail manzil: </span>
                            <input name="user-email" id="user-email" class="form-control" type="text" value="{{$currentUser->email}}" readonly>
                        </div>
                        <div class="col ac">
                            <span class="text-muted">Yangi parol: </span>
                            <input name="user-password" id="user-password" class="form-control" type="password" value="" placeholder="Agar parolni o'zgartirmoqchi bo'lsangiz:">
                        </div>
                    </div>
                    @if($currentUser->user_profile_image == "")
                        <div class="row mt-3 p-3">
                            <div class="col-12 p-1" style="border: 1px dashed #b1adad">
                                <span class="text-muted">Profil rasmi: </span>
                                <input type="file" accept=".jpg,.jpeg,.png" name="user-profile-image" id="user-profile-image" class="form-control-file">
                            </div>
                        </div>
                    @endif

                    <div class="row px-3">
                        <div class="col-12 px-0 mt-3 progress">
                            <div id="edit-data-upload" class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Bekor qilish</button>
                    <button type="submit" class="btn btn-primary">Saqlash</button>
                </div>
                </div>
            </form>
            @endif
            @if($currentUser->user_profile_status == 'active')
            <form method="post" action="{{route('book=>profile')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content Aver">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Ma'lumotlarni tahrirlash</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3 ac">
                            <span class="text-muted">F.I.O: </span><input name="user-name" id="user-name" class="form-control" type="text" value="{{$currentUser->name}}" readonly>
                        </div>
{{--                        <div class="col Aver ac">--}}
{{--                            <span class="text-muted">Pasport №: </span><input name="user-passport-id" id="user-passport-id" class="form-control backervaL" type="text" value="{{$currentUser->user_passport_id}}" placeholder="XX 1234567">--}}
{{--                        </div>--}}
                        <div class="col-12 mb-3 Aver ac">
                            <span class="text-muted">Telefon raqam: </span><input name="user-phone" id="user-phone" class="form-control backervaL" type="text" value="{{$currentUser->user_phone}}" placeholder="+998 xx xxx xx xx">
                        </div>
                    </div>
{{--                    <div class="row mt-3">--}}
{{--                        <div class="col Aver ac">--}}
{{--                            <span class="text-muted ">OTM: </span>--}}
{{--                            <select class="custom-select" name="user-university-id" id="user-university-id">--}}
{{--                                <option selected disabled>OTM ni tanlang:</option>--}}
{{--                                @foreach($allUniversities as $currentUniversity)--}}
{{--                                    <option value="{{$currentUniversity->id}}">{{$currentUniversity->univer_name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="col ac">--}}
{{--                            <span class="text-muted">Fakultet: </span>--}}
{{--                            <select class="custom-select" name="user-faculty-id" id="user-faculty-id" disabled>--}}
{{--                                <option selected disabled>Fakultetni tanlang:</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="col ac">--}}
{{--                            <span class="text-muted">Yo'nalish: </span>--}}
{{--                            <select class="custom-select" name="user-specialty-id" id="user-specialty-id" disabled>--}}
{{--                                <option selected disabled>Yo'nalishni tanlang:</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="row mt-3">--}}
{{--                        <div class="col-2"></div>--}}
{{--                        <div class="col-4 ac">--}}
{{--                            <span class="text-muted">Bosqich: </span>--}}
{{--                            <select class="custom-select" name="user-course-number" id="user-course-number" disabled>--}}
{{--                                <option selected disabled>Bosqichni tanlang:</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="col-4 ac">--}}
{{--                            <span class="text-muted">Guruh: </span>--}}
{{--                            <select class="custom-select" name="user-group-id" id="user-group-id" disabled>--}}
{{--                                <option selected disabled>Guruhni tanlang:</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="col-2"></div>--}}
{{--                    </div>--}}
                    <div class="row mt-3">
{{--                        <div class="col Aver ac">--}}
{{--                            <span class="text-muted">E-mail manzil: </span>--}}
{{--                            <input name="user-email" id="user-email" class="form-control" type="text" value="{{$currentUser->email}}" readonly>--}}
{{--                        </div>--}}
                        <div class="col ac">
                            <span class="text-muted">Yangi parol: </span>
                            <input name="user-password" id="user-password" class="form-control" type="password" value="" placeholder="Agar parolni o'zgartirmoqchi bo'lsangiz:">
                        </div>
                    </div>
                    @if($currentUser->user_profile_image == "")
                        <div class="row mt-3 p-3">
                            <div class="col-12 p-1" style="border: 1px dashed #b1adad">
                                <span class="text-muted">Profil rasmi: </span>
                                <input type="file" accept=".jpg,.jpeg,.png" name="user-profile-image" id="user-profile-image" class="form-control-file">
                            </div>
                        </div>
                    @endif
                    <div class="row px-3">
                        <div class="col-12 px-0 mt-3 progress">
                            <div id="edit-data-upload" class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Bekor qilish</button>
                    <button type="submit" class="btn btn-primary">Saqlash</button>
                </div>
                </div>
            </form>
            @endif

        </div>
    </div>

    <div class="modal fade" id="hemis_sinc" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="post" action="{{route('book=>profile')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Ma'lumotlarni tahrirlash</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="font-family: 'Open Sans', sans-serif; font-weight: bold">
                        <div class="form-group">
                            <label for="passport_number">Pasport raqami</label>
                            <input type="text" class="form-control" id="passport_number" name="passport_number" placeholder="AA1234567" required>
                        </div>
                        <div class="form-group">
                            <label for="passport_pin">JSHSHIR-kod</label>
                            <input type="text" class="form-control" id="passport_pin" name="passport_pin" placeholder="12345678912345" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Bekor qilish</button>
                        <button type="submit" class="btn btn-primary">Saqlash</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection

@section('footerScripts')
    @parent
    <script src="{{asset('js/DataTable/jqueryTable.js')}}"></script>
    <script src="{{asset('js/DataTable/bootstrapTable.js')}}"></script>
    <script src="{{asset('js/admin-page/add_books/jqueryForm.js')}}"></script>
    <script src="{{asset("js/inputmask/jquery.inputmask.min.js")}}"></script>
    <script src="{{asset('js/book-page/profile/profile.js')}}"></script>
@endsection
