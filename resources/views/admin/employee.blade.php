@extends('layouts.admin')
@section('title', "Hodimlar")

@section('headerStyles')
    @parent
    <link rel="stylesheet" href="{{asset('css/DataTable/bootstrapTable.css')}}">
@endsection

@section('content')

    <div class="row mt-5">

        <div class="col-12 mb-5 profileCard">
            <form id="new-admin-data-form" action="{{route('admin.employee.post')}}" method="post">
                @csrf
            <div class="row">

                <div class="col-2 pt-2">
                    <h4><i data-feather="user-plus" class="feather-icon mb-1 mr-2"></i> Yangi hodim qo'shish: </h4>
                </div>
                <div class="col-3">
                    <input type="text" autocomplete="off" name="new-admin-name" id="new-admin-name" data-toggle="tooltip" data-placement="top" title="" class="form-control font-weight-bold boxShadow borderRadius20 inputPR20" placeholder="Hodim familiyasi,ismi va sharfi:" data-original-title="F.I.SH">
                </div>
                <div class="col-3">
                    <input type="email" autocomplete="off" name="new-admin-email" id="new-admin-email" data-toggle="tooltip" data-placement="top" title="" class="form-control font-weight-bold boxShadow borderRadius20 inputPR20" placeholder="Hodim elektron po'chta manzili:" data-original-title="Email.">
                </div>
                <div class="col-3">
                    <input type="password" autocomplete="off" name="new-admin-password" id="new-admin-password" data-toggle="tooltip" data-placement="top" title="" class="form-control font-weight-bold boxShadow borderRadius20 inputPR20" placeholder="Parol, eng kamida 8ta belgi:" data-original-title="Parol.">
                </div>
                <div class="col-1 ac">
                    <button type="submit" class="btn btn-primary">Saqlash</button>
                </div>
            </div>
            </form>
        </div>
        <div class="col-12 ac">
            <h3>Barcha hodimlar jadvali</h3>
        </div>
        <div class="col-12">
            <table id="all-employees-table" class="table table-hover table-bordered" style="width:100%">
                <thead>
                <tr class="ac">
                    <th width="10%" class="font-weight-bold">T/r</th>
                    <th width="30%" class="font-weight-bold">F.I.O</th>
                    <th width="30%" class="font-weight-bold">ARM bo'limi</th>
                    <th width="10%" class="font-weight-bold">Profil holati</th>
                    <th width="20%" ></th>
                </tr>
                </thead>
                <tbody>
                    @forelse($allAdmins as $item=>$choosedAdmin)
                        <tr>
                            <td class="ac">{{++$item}}</td>
                            <td>{{$choosedAdmin->name}}</td>
                            <td class="ac">
                                @forelse($allCampuses as $currentCampus)
                                    @if($currentCampus->id == $choosedAdmin->admin_campus_id)
                                        {{$currentCampus->campus_name}}
                                    @endif
                                    @empty
                                        Kiritilmagan
                                @endforelse
                            </td>
                            <td class="ac text-white">
                                @switch($choosedAdmin->admin_profile_status)
                                    @case('active')
                                        <span class="badge bg-success">FAOL</span>
                                    @break
                                    @case('inactive')
                                        <span class="badge bg-danger">NOFAOL</span>
                                    @break
                                @endswitch
                            </td>
                            <td class="ac">
                                @if($choosedAdmin->admin_iss == 'no')
                                    <button class="btn btn-admin btn-primary mr-1" data-for-what="edit-admin" data-id="{{$choosedAdmin->id}}" data-admin-name="{{$choosedAdmin->name}}" data-toggle="modal" data-target="#admin-change-modal"><i class="icon-note"></i> Tahrirlash</button>

                                    <button class="btn btn-admin btn-danger" data-for-what="delete-admin" data-id="{{$choosedAdmin->id}}" data-admin-name="{{$choosedAdmin->name}}"><i class="icon-trash"></i> O'chirish</button></td>
                                @endif
                                @if($choosedAdmin->admin_iss == 'yes')
                                    <button class="btn btn-admin btn-secondary mr-1" data-for-what="edit-admin" disabled><i class="icon-note"></i> Tahrirlash</button><button class="btn btn-admin btn-secondary" data-for-what="delete-admin" disabled><i class="icon-trash"></i> O'chirish</button></td>
                                @endif
                        </tr>
                        @empty
                        <tr></tr>
                    @endforelse
                </tbody>
                <tfoot>
                <tr class="ac">
                    <th width="10%" class="font-weight-bold">T/r</th>
                    <th width="30%" class="font-weight-bold">F.I.O</th>
                    <th width="30%" class="font-weight-bold">ARM bo'limi</th>
                    <th width="10%" class="font-weight-bold">Profil holati</th>
                    <th width="20%" ></th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div id="admin-change-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-hidden="true"
         data-backdrop="static" data-keyboard="false" aria-labelledby="staticBackdropLabel">
        <div class="modal-dialog">
            <form id="admin-change-form" action="{{route('admin.employee.post')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-info">
                        <h4 class="modal-title" id="info-header-modalLabel">ARM bo'limini tahrirlash</h4>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×</button>
                    </div>

                    <div class="modal-body">

                        <div id="admin-change-modal-body" class="row">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                                data-dismiss="modal">Bekor qilish</button>
                        <button type="submit" class="btn btn-info">Saqlash</button>
                    </div>
                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div>

@endsection

@section('footerScripts')
    @parent
    <script src="{{asset('js/admin-page/add_books/jqueryForm.js')}}"></script>
    <script src="{{asset('js/DataTable/jqueryTable.js')}}"></script>
    <script src="{{asset('js/DataTable/bootstrapTable.js')}}"></script>
    <script src="{{asset('js/admin-page/employee/employee.js')}}"></script>
@endsection
