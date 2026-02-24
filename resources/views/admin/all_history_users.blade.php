@extends('layouts.admin')
@section('title', "Barcha buyurtmalar")

@section('headerStyles')
    @parent
    <link rel="stylesheet" href="{{asset('css/DataTable/bootstrapTable.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.datetimepicker.min.css')}}">
@endsection

@section('content')
    <div class="row mt-5">
        <div class="col-12 ac">
            <h3>Fond Jurnali</h3>
        </div>

        <div id="table-div" class="col">
            <table id="all-borrowed-users-table" class="table table-hover table-bordered" style="width:100%">
                <thead>
                    <tr class="ac">
                        <th width="10%" class="font-weight-bold ">ID</th>
                        <th width="35" class="font-weight-bold ">Kitobxon ma'lumotlari</th>
                        <th width="35" class="font-weight-bold ">Adabiyot ma'lumotlari</th>
                        <th width="35" class="font-weight-bold ">Qabul qilib olgan shaxs</th>
                        <th width="20%">Yaratilgan sana</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($allBorrowHistory as $currentBorrow)
                <tr>
                    <td class="ac">{{$currentBorrow->borrow_history_id}}</td>
                    <td>
                        <div class="row">
                            <div class="col-3 ac">
                                @if ($currentBorrow->user_image != "")
                                    <img src="{{$currentBorrow->user_image}}" class="rounded-circle s70 img-thumbnail"  alt="user-profile-image">
                                @else
                                <img src="{{asset('storage/user-profile-images')}}/{{$currentBorrow->user_image ?? 'placeholder.png'}}" class="rounded-circle s70 img-thumbnail"  alt="user-profile-image">
                                @endif
                                
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-12">
                                    <b>Kitobxon ID: </b>{{$currentBorrow->user_id}} <br>
                                    <b>F.I.O: </b>{{$currentBorrow->user_name}}
                                    </div>
                                    {{-- <div class="col-12">
                                        <b>Passport №: </b>{{$currentBorrow->user_passport_id}}
                                    </div> --}}
                                    <div class="col-12">
                                        <b>Tel №: </b>{{$currentBorrow->user_phone}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-12">
                                <b>Adabiyot ID: </b> {{$currentBorrow->book_id}} <b class="ml-3">Inventar raqami: </b> {{$currentBorrow->inv_number}}
                            </div>
                            <div class="col-12">
                                <b>Berilgan vaqti: </b> {{$currentBorrow->borrow_when_take}} <br>
                                <b>Qaytargan vaqti: </b>{{$currentBorrow->borrow_when_must_return}}
                            </div>
                            <div class="col-12">
                                <b>Adabiyot nomi: </b> {{$currentBorrow->book_name}}
                            </div>
                            {{-- <div class="col-12">
                                <b>Adabiyot olingan bo'lim: </b>
                                @forelse($allCampuses as $currentCampus)
                                    @if($currentCampus->id == $currentBorrow->book_campus_id)
                                        {{$currentCampus->campus_name}}
                                    @endif
                                @empty
                                @endforelse
                            </div> --}}
                        </div>
                    </td>
                    <td>
                        <b>ID: </b> {{$currentBorrow->admins_id}} <br>
                        <b>F.I.O: </b> {{$currentBorrow->admin_name}}
                    </td>
                    <td class="ac">
                        {{$currentBorrow->created_at}}
                    </td>
                </tr>
                @empty
                @endforelse
                </tbody>
                <tfoot>
                    <tr class="ac">
                        <th width="10%" class="font-weight-bold ">ID</th>
                        <th width="35" class="font-weight-bold ">Kitobxon ma'lumotlari</th>
                        <th width="35" class="font-weight-bold ">Adabiyot ma'lumotlari</th>
                        <th width="20%" ></th>
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
    <script src="{{asset('js/jquery.datetimepicker.full.min.js')}}"></script>
    <script src="{{asset('js/admin-page/all_borrowed_users/all_borrowed_users.js')}}"></script>
@endsection
