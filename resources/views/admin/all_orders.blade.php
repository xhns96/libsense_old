@extends('layouts.admin')
@section('title', "Barcha buyurtmalar")

@section('headerStyles')
    @parent
    <link rel="stylesheet" href="{{asset('css/DataTable/bootstrapTable.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.datetimepicker.min.css')}}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="{{asset("select2/css/select2.min.css")}}">
    <link rel="stylesheet" href="{{asset("select2/css/select2-bootstrap4.min.css")}}">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css"> --}}
    
@endsection

@section('content')
    <div class="col-12 mt-3 profileCard">
        <form id="cbook-form" action="{{route('admin.all_orders.post')}}" method="post">
            @csrf
            <div class="row">
                <input type="hidden" value="orderSave" name="_for_what" id="_for_what" required>
                <div class="col-12 pt-2">
                    <h4><i data-feather="file-plus" class="feather-icon mb-1 mr-2"></i> Buyurtmani qo'shish: </h4>
                </div>
                {{-- <div class="col-2">
                    <img src="https://hemis.andmiedu.uz/static/crop/3/1/320__90_3173561101.jpg" alt="" class="shadow" style="width: 100px">
                </div> --}}

                <div class="col-12">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <select class="form-control " name="book_id[]" id="book_id" style="width: 100%" multiple required>
                                {{-- @foreach ($allBooks as $item)
                                    <option value="{{$item->id}}">{{$item->id}} / {{$item->book_name}} / {{$item->book_author}} / {{$item->book_year}}</option>
                                @endforeach --}}
                            </select>
                        </div>

                        <div class="col-md-6">
                            <select name="user_id" id="user_id" class="form-control" required>
                                {{-- @foreach ($userAll as $value)
                                    <option value="{{$value->id}}">{{$value->name}} /{{$value->student_id_number}}</option>
                                @endforeach --}}
                            </select>
                        </div>
                        <div class="col-12 d-flex justify-content-end mb-3">
                            <button type="submit" class="btn btn-primary" id="btn-save"><i data-feather="save" class="feather-icon mr-2"></i>Saqlash</button>
                        </div>
                    </div>
                </div>
                
            </div>
        </form>
    </div>
    <div class="row mt-5">
        <div class="col-12 ac">
            <h3>Barcha buyurtmalar jadvali (bosma taboq)</h3>
        </div>

        <div id="table-div" class="col">
            <table id="all-orders-table" class="table table-hover table-bordered" style="width:100%">
                <thead>
                <tr class="ac">
                    <th width="10%" class="font-weight-bold ">T/r</th>
                    <th width="40" class="font-weight-bold ">Kitobxon ma'lumotlari</th>
                    <th width="30%" class="font-weight-bold">Adabiyot ma'lumotlari</th>
                    <th width="20%" ></th>
                </tr>
                </thead>
                <tbody>
                @forelse($allOrders as $item=>$currentOrder)
                    <tr>
                        <td class="ac">{{++$item}}</td>
                        <td>
                            <div class="row">
                                <div class="col-4 ac">
                                    <img src="{{asset('storage/user-profile-images')}}/{{$currentOrder->user_profile_image ?? 'placeholder.png'}}" class="rounded-circle mt-3 s125 img-thumbnail"  alt="user-profile-image">
                                </div>
                                <div class="col-8">
                                    <p><b>ID: </b><span class="mr-3">{{$currentOrder->user_id}}</span> | <b class="ml-3">Qarzdorligi:</b> <code>{{$currentOrder->user_borrow_count}}</code></p>
                                    <p><b>F.I.SH: </b><span>{{$currentOrder->name}}</span></p>
                                    <p><b>Passport №: </b><span>{{$currentOrder->user_passport_id}}</span> <b class="ml-3">Bosqich:</b> {{$currentOrder->user_course_number}}-bosqich</p>
                                    <p><b>Tel №: </b><span>{{$currentOrder->user_phone}}</span> <b class="ml-3">Guruh:</b> {{$currentOrder->user_group_id}}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            @forelse($allOrdersWithBooks as $currentOWB)
                                @if($currentOWB->id == $currentOrder->id)
                                    <p><b>ID:</b> {{$currentOWB->book_id}}</p>
                                    <p><b>Nomi:</b> <b class="text-orange">{{$currentOWB->book_name}}</b></p>
                                    <p><b>Bo'lim:</b>
                                        @forelse($allCampuses as $currentCampus)
                                            @if($currentCampus->id == $currentOWB->book_campus_id)
                                                {{$currentCampus->campus_name}}
                                            @endif
                                            @empty
                                        @endforelse
                                    </p>
                                    <p><b>Nusxalar soni:</b> {{$currentOWB->book_copy_count}} | <b>Hozirgi nusxalar soni:</b> <span class="text-cyan">{{$currentOWB->book_copy_count_now}}</span></p>
                                @endif
                                @empty
                            @endforelse
                        </td>
                        <td class="ac">
                            <div class="row">
                                @if($currentOrder->order_status == 'pending')
                                    <div class="col-12">
                                        <input type="text" data-toggle="tooltip" data-placement="top" data-original-title="Buyurtma tayyor emas !" name="cbook-id"  autocomplete="off"  class="form-control font-weight-bold boxShadow borderRadius20 inputPR20" placeholder="Invertar raqami:"  readonly>
                                    </div>
                                    <div class="col-12 my-2">
                                        <input type="text" data-toggle="tooltip" data-placement="top" data-original-title="Buyurtma tayyor emas !" class="form-control font-weight-bold boxShadow borderRadius20 inputPR20" placeholder="Muddati:"  readonly>
                                    </div>
                                @elseif($currentOrder->order_status == "ready")
                                    <div class="col-12">
                                        <input id="inv{{$currentOrder->id}}" type="text" autocomplete="off" data-toggle="tooltip" data-placement="top" class="form-control font-weight-bold boxShadow borderRadius20 inputPR20" placeholder="Invertar raqami:" data-original-title="Adabiyot invertar raqami.">
                                    </div>
                                    <div class="col-12 my-2">
                                        <input id="bt{{$currentOrder->id}}" type="text" class="form-control font-weight-bold boxShadow borderRadius20 inputPR20 borrowTime" placeholder="Muddati:">
                                    </div>
                                @endif
                                <div class="col-12">
                                    <button class="btn btn-danger order-reject px-1" data-id="{{$currentOrder->id}}" data-user-id = "{{$currentOrder->order_user_id}}"><i data-feather="x-circle" class="feather-icon mr-1"></i>Rad qilish</button>
                                    @if($currentOrder->order_status == "pending")
                                        <button class="btn btn-primary order-ready px-1" data-id = "{{$currentOrder->id}}" data-user-id = "{{$currentOrder->order_user_id}}"><i data-feather="check-circle" class="feather-icon mr-1"></i>Buyurtma tayyor</button>
                                    @elseif($currentOrder->order_status == "ready")
                                        <button class="btn btn-success order-take px-1" data-id = "{{$currentOrder->id}}" data-user-id = "{{$currentOrder->order_user_id}}"><i data-feather="shopping-bag" class="feather-icon mr-1"></i>Topshirish</button>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                @endforelse
                </tbody>
                <tfoot>
                <tr class="ac">
                    <th width="10%" class="font-weight-bold ">T/r</th>
                    <th width="40" class="font-weight-bold ">Kitobxon ma'lumotlari</th>
                    <th width="30%" class="font-weight-bold">Adabiyot ma'lumotlari</th>
                    <th width="20%" ></th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@section('footerScripts')
    @parent
    <script>
        var orderPostURL = "{{route("admin.getData")}}";
        var getUsersData = "{{route("admin.getUsersData")}}";
      </script>
    <script src="{{asset('js/admin-page/add_books/jqueryForm.js')}}"></script>
    <script src="{{asset('js/DataTable/jqueryTable.js')}}"></script>
    <script src="{{asset('js/DataTable/bootstrapTable.js')}}"></script>
    <script src="{{asset('js/jquery.datetimepicker.full.min.js')}}"></script>
    <script src="{{asset("select2/js/select2.full.min.js")}}"></script>
    <script src="{{asset('js/admin-page/all_orders/all_orders.js')}}"></script>
    
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script>
        @if(Session::has('order_success'))
        Swal.fire({
        icon: 'success',
        title: 'Muvaffaqiyat!',
        text: 'Buyurtma muvaffaqiyatli shakilantirildi',
        allowOutsideClick: false
        });
        @endif
    </script>
@endsection
