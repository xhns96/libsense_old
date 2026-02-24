@extends('layouts.admin')
@section('title', "O'quv muassasasi")

@section('headerStyles')
    @parent
    <link rel="stylesheet" href="{{asset('css/admin-page/settings/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin-page/settings/settings.css')}}">
@endsection

@section('content')
    <div class="row">
        <div class="col-3">
            <div id="univer-logo-div">
                <img class="rounded-circle img-thumbnail" src="{{asset('storage/university-logos')}}/{{$currentUniversity->univer_logo ?? 'placeholder.png'}}" alt="univer-logo">
                <br>
            </div>
        </div>
        <div class="col-9">
            <h3 class="mt-5"><b>Oliy o'quv yurti nomi:</b> <i class="text-muted">{{$currentUniversity->univer_name ?? 'Kiritilmagan'}}</i>
{{--                <i class="ml-3 weight-bold icon-note text-info" data-toggle="modal" data-target="#univer-name-modal"></i>--}}
            </h3>
            <h3 class="my-3"><b>Oliy o'quv yurti qisqa nomi:</b> <i class="text-muted">{{$currentUniversity->univer_short_name ?? 'Kiritilmagan'}}</i>
{{--                <i class="ml-3 weight-bold icon-note text-info" data-toggle="modal" data-target="#univer-short-name-modal"></i>--}}
            </h3>
            <h3><b>Oliy o'quv yurti bosqich soni (2/3/4/6):</b> <i class="text-muted">{{$currentUniversity->univer_course_count ?? 'X'}}ta bosqich</i>
{{--                <i class="ml-3 weight-bold icon-note text-info" data-toggle="modal" data-target="#univer-course-count-modal"></i>--}}
            </h3>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col" style="text-align: center">
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary active">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="campusesRadio" name="customRadio" class="custom-control-input" checked="">
                        <label class="custom-control-label" for="campusesRadio">ARM o'quv zali va abonementlari</label>
                    </div>
                </label>
                <label class="btn btn-primary">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="facultiesRadio" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label" for="facultiesRadio">Fakultetlar</label>
                    </div>
                </label>
                <label class="btn btn-primary">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="specialtiesRadio" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label" for="specialtiesRadio">Yo'nalishlar</label>
                    </div>
                </label>
                <label class="btn btn-primary">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="groupsRadio" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label" for="groupsRadio">Guruhlar</label>
                    </div>
                </label>
            </div>
        </div>
    </div>
    <div class="row mt-3">
{{-- //////////////////////////////   All campuses div  /////////////////////////////////// --}}
        <div id="all-campuses-div" class="col-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-subtitle">
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-3">
                                <div class="form-group">
                                    <input type="text" id="new-campus-name-input" class="form-control" placeholder="ARM bo'limi nomi: " value="">
                                </div>
                            </div>
                            <div class="col-3">
                                <select id = "select-campus-type" class="custom-select mr-sm-2">
                                    <option selected="" disabled>Xona turi :</option>
                                    <option value="abonement">Abonement</option>
                                    <option value="oquvzal">O'quv zali</option>
                                    <option value="boshqa">Boshqa</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <button id="new-campus-name-submit" class="btn btn-rounded btn-success"><i data-feather="plus" class="feather-icon mr-1"></i>Qo'shish</button>
                            </div>
                        </div>
                        <hr>
                    </h6>
                    <div style="text-align: center"><h3>Axborot-resurs markazining barcha bo'limlari jadvali</h3></div>
                    <div class="table-responsive">
                        <table id="all-campuses-table" class="table table-hover table-bordered no-wrap">
                            <thead class="thead-light">
                            <tr class="center-style">
                                <th width="10%">T/r</th>
                                <th width="40%">ARM bo'limi nomi</th>
                                <th width="20%">Xona turi</th>
                                <th width="30%"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($allCampuses as $i=>$currentCampus)
                                    @if($currentCampus->campus_university_id == $currentAdmin->admin_university_id)
                                        <tr>
                                            <td class="ac">{{++$i}}</td>
                                            <td>{{$currentCampus->campus_name}}</td>
                                            <td class="ac">
                                                @switch($currentCampus->campus_type)
                                                    @case('abonement') Abonement @break
                                                    @case('oquvzal') O'quv zal @break
                                                @endswitch
                                            </td>
                                            <td class="ac"><button class="btn btn-campus btn-primary mr-1" data-for-what="edit-campus" data-id="{{$currentCampus->id}}" data-edit-value = "{{$currentCampus->campus_name}}" data-toggle="modal"
                                                                   data-target="#campus-change-modal"><i class="icon-note"></i> Tahrirlash</button><button class="btn btn-campus btn-danger" data-for-what="delete-campus" data-id="{{$currentCampus->id}}" data-edit-value = "{{$currentCampus->campus_name}}"><i class="icon-trash"></i> O'chirish</button></td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                            <tfoot class="thead-light">
                            <tr class="center-style">
                                <th width="10%">T/r</th>
                                <th width="40%">ARM bo'limi nomi</th>
                                <th width="20%">Xona turi</th>
                                <th width="30%"></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
{{-- -------------------------------------------------------------------------------------- --}}

{{-- //////////////////////////////   All facults div  //////////////////////////////////// --}}
        <div id="all-facults-div" class="col-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-subtitle">
                        <div class="row">
                            <div class="col-7"></div>
                            <div class="col-3">
                                <div class="form-group">
                                    <input type="text" id="new-faculty-name-input" class="form-control" placeholder="Yangi fakultet nomi: ">
                                </div>
                            </div>
                            <div class="col-2">
                                <button id="new-faculty-name-submit" class="btn btn-rounded btn-success" ><i data-feather="plus" class="feather-icon mr-1"></i>Qo'shish</button>
                            </div>
                        </div>
                        <hr>
                    </h6>
                    <div style="text-align: center"><h3>Barcha fakultetlar jadvali</h3></div>
                    <div class="table-responsive">
                        <table id="all-facults-table" class="table table-hover table-bordered no-wrap">
                            <thead class="thead-light">
                            <tr class="center-style">
                                <th width="10%" class="ac">T/r</th>
                                <th width="60%">Fakultet nomi</th>
                                <th width="30%" class="ac"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($allFaculties as $i=>$currentFaculty)
                                    @if($currentFaculty->faculty_university_id == $currentAdmin->admin_university_id)
                                        <tr>
                                            <td class="ac">{{++$i}}</td>
                                            <td>{{$currentFaculty->faculty_name}}</td>
                                            <td class="ac"><button class="btn btn-success btn-faculty mr-1" data-for-what="edit-faculty" data-id="{{$currentFaculty->id}}" data-edit-value = "{{$currentFaculty->faculty_name}}"><i class="icon-note"></i> Tahrirlash</button><button class="btn btn-faculty btn-danger" data-for-what="delete-faculty" data-id="{{$currentFaculty->id}}" data-edit-value = "{{$currentFaculty->faculty_name}}"><i class="icon-trash"></i> O'chirish</button></td>
                                        </tr>
                                    @endif
                                    @empty
                                @endforelse
                            </tbody>
                            <tfoot class="thead-light">
                            <tr class="center-style">
                                <th width="10%">T/r</th>
                                <th width="60%">Fakultet nomi</th>
                                <th width="30%"></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
{{-- -------------------------------------------------------------------------------------- --}}

{{-- //////////////////////////////   All specialties div  //////////////////////////////// --}}
        <div id="all-specialties-div" class="col-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-subtitle">
                        <div class="row">
                            <div class="col-6"></div>
                            <div class="col-2">
                                <div class="form-group mb-4">
                                    <select id="faculty-name-for-new-specialty" class="custom-select mr-sm-2">
                                        <option selected="" disabled>Fakultetni tanlang:</option>
                                        @forelse($allFaculties as $currentFaculty)
                                            @if($currentFaculty)
                                                <option value="{{$currentFaculty->id}}">{{$currentFaculty->faculty_name}}</option>
                                            @endif
                                            @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <input id="new-specialty-name-input" type="text" class="form-control" placeholder="Yangi yo'nalish nomi: ">
                                </div>
                            </div>
                            <div class="col-2">
                                <button id="new-specialty-name-submit" class="btn btn-rounded btn-success"><i data-feather="plus" class="feather-icon mr-1"></i>Qo'shish</button>
                            </div>
                        </div>
                        <hr>
                    </h6>
                    <div style="text-align: center"><h3>Barcha yo'nalishlar jadvali</h3></div>
                    <div class="table-responsive">
                        <table id="all-specialties-table" class="table table-hover table-bordered no-wrap">
                            <thead class="thead-light">
                            <tr class="ac">
                                <th width="10%">T/r</th>
                                <th width="30%">Fakultet nomi</th>
                                <th width="30%">Yo'nalish nomi</th>
                                <th width="30%"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($allSpecialties as $i=>$currentSpecialty)
                                    <tr>
                                        <td class="ac">{{++$i}}</td>
                                        <td>
                                            @forelse($allFaculties as $currentFaculty)
                                                @if($currentFaculty->id == $currentSpecialty->specialty_faculty_id)
                                                    {{$currentFaculty->faculty_name}}
                                                @endif
                                                @empty
                                            @endforelse
                                        </td>
                                        <td>{{$currentSpecialty->specialty_name}}</td>
                                        <td class="ac"><button class="btn btn-success btn-specialty mr-1" data-for-what="edit-specialty" data-id="{{$currentSpecialty->id}}" data-edit-value = "{{$currentSpecialty->specialty_name}}"><i class="icon-note"></i> Tahrirlash</button><button class="btn btn-specialty btn-danger" data-for-what="delete-specialty" data-id="{{$currentSpecialty->id}}" data-edit-value = "{{$currentSpecialty->specialty_name}}"><i class="icon-trash"></i> O'chirish</button></td>
                                    </tr>
                                    @empty
                                @endforelse
                            </tbody>
                            <tfoot class="thead-light">
                            <tr class="ac">
                                <th width="10%">T/r</th>
                                <th width="30%">Fakultet nomi</th>
                                <th width="30%">Yo'nalish nomi</th>
                                <th width="30%"></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
{{-- -------------------------------------------------------------------------------------- --}}

{{-- //////////////////////////////   All groups div  ///////////////////////////////////// --}}
        <div id="all-groups-div" class="col-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-subtitle">
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-2">
                                <div class="form-group mb-4">
                                    <select id = "select-faculty-for-new-group" class="custom-select mr-sm-2">
                                        <option selected="" disabled>Fakultetni tanlang:</option>
                                        @forelse($allFaculties as $currentFaculty)
                                            <option value="{{$currentFaculty->id}}">{{$currentFaculty->faculty_name}}</option>
                                            @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group mb-4">
                                    <select id = "select-specialty-for-new-group" class="custom-select mr-sm-2" disabled>
                                        <option selected="" disabled>Yo'nalishni tanlang:</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group mb-4">
                                    <select id = "select-course-number-for-new-group" class="custom-select mr-sm-2" disabled>
                                        @if($currentUniversity->univer_course_count)
                                            <option selected="" disabled>Bosqichni tanlang:</option>
                                            @for($i=1; $i<=$currentUniversity->univer_course_count; $i++)
                                                <option value="{{$i}}">{{$i}}-bosqich</option>
                                            @endfor
                                        @else
                                            <option selected="" disabled>Bosqich soni kiritilmagan!</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <input id="new-group-name-input" type="text" class="form-control" readonly placeholder="Yangi guruh nomi: ">
                                </div>
                            </div>
                            <div class="col-2">
                                <button id = "new-group-name-submit" class="btn btn-rounded btn-success"><i data-feather="plus" class="feather-icon mr-1"></i>Qo'shish</button>
                            </div>
                        </div>
                        <hr>
                    </h6>
                    <div style="text-align: center"><h3>Barcha guruhlar jadvali</h3></div>
                    <div class="table-responsive">
                        <table id="all-groups-table" class="table table-hover table-bordered no-wrap">
                            <thead class="thead-light">
                            <tr class="center-style">
                                <th width="5%">T/r</th>
                                <th width="20%">Fakultet nomi</th>
                                <th width="20%">Yo'nalish nomi</th>
                                <th width="20%">Bosqich</th>
                                <th width="15%">Guruh nomi</th>
                                <th width="20%"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($allGroups as $i=>$currentGroup)
                                    <tr>
                                        <td class="ac">{{++$i}}</td>
                                        <td>
                                            @forelse($allFaculties as $currentFaculty)
                                                @if($currentFaculty->id == $currentGroup->group_faculty_id)
                                                    {{$currentFaculty->faculty_name}}
                                                @endif
                                                @empty
                                            @endforelse
                                        </td>
                                        <td>
                                            @forelse($allSpecialties as $currentSpecialty)
                                                @if($currentSpecialty->id == $currentGroup->group_specialty_id)
                                                    {{$currentSpecialty->specialty_name}}
                                                @endif
                                            @empty
                                            @endforelse
                                        </td>
                                        <td class="ac">{{$currentGroup->group_course_number ?? 'x'}}-bosqich</td>
                                        <td class="ac">{{$currentGroup->group_name}}</td>
                                        <td class="ac">
                                            <button class="btn btn-groups btn-success mr-1" data-for-what="edit-group" data-id="{{$currentGroup->id}}" data-edit-value = "{{$currentGroup->group_name}}"><i class="icon-note"></i> Tahrirlash</button>
                                            <button class="btn btn-groups btn-danger" data-for-what="delete-group" data-id="{{$currentGroup->id}}" data-edit-value = "{{$currentGroup->group_name}}"><i class="icon-trash"></i> O'chirish</button>
                                        </td>
                                    </tr>
                                    @empty
                                @endforelse
                            </tbody>
                            <tfoot class="thead-light">
                            <tr class="center-style">
                                <th width="5%">T/r</th>
                                <th width="20%">Fakultet nomi</th>
                                <th width="20%">Yo'nalish nomi</th>
                                <th width="20%">Bosqich</th>
                                <th width="15%">Guruh nomi</th>
                                <th width="20%"></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
{{-- -------------------------------------------------------------------------------------- --}}
    </div>
    <div id="univer-change-logo-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-hidden="true"
         data-backdrop="static" data-keyboard="false" aria-labelledby="staticBackdropLabel">
        <div class="modal-dialog">
            <form id="univer-change-logo-form" action="{{route('admin.settings_post')}}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="modal-content">
                <div class="modal-header modal-colored-header bg-info">
                    <h4 class="modal-title" id="info-header-modalLabel">Sozlamalar</h4>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">×</button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <div class="col-12 mt-5 p-3 ac" style="border: 2px dashed silver">
                                    <b>Oliy o'quv yurti logotipini ko'rsating:</b><br><input type="file" name="univer-logo" accept=".jpg,.jpeg,.png" class="form-control-file mt-3">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 px-0 mt-3 progress">
                            <div id="logo-upload" class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                            data-dismiss="modal">Bekor qilish</button>
                    <button id="univer-change-logo-submit" type="submit" class="btn btn-info">Saqlash</button>
                </div>
            </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div>
    <div id="campus-change-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-hidden="true"
         data-backdrop="static" data-keyboard="false" aria-labelledby="staticBackdropLabel">
        <div class="modal-dialog">
            <form id="campus-change-form" action="{{route('admin.settings_post')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-info">
                        <h4 class="modal-title" id="info-header-modalLabel">ARM bo'limini tahrirlash</h4>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×</button>
                    </div>

                    <div class="modal-body">

                        <div id="campus-change-modal-body" class="row">

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
    <script src="{{asset('js/admin-page/settings/jquery.dataTables.min.js')}}"> </script>
    <script src="{{asset('js/admin-page/settings/settings.js')}}"> </script>
@endsection

