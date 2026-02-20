@extends('layouts.admin')
@section('title', "Barcha adabiyotlar")

@section('headerStyles')
    @parent
    <link rel="stylesheet" href="{{asset('css/DataTable/bootstrapTable.css')}}">
    <link rel="stylesheet" href="{{asset('css/bi.css')}}">
@endsection

@section('content')
    <div class="col-12 mt-3 profileCard">
        <form id="cbook-form" action="{{route('admin.all_books.post')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-2 pt-2">
                    <h4><i data-feather="file-plus" class="feather-icon mb-1 mr-2"></i> Adabiyotni nusxalash: </h4>
                </div>
                <div class="col-2">
                    <input type="number" autocomplete="off" name="cbook-id" data-toggle="tooltip" data-placement="top" class="form-control font-weight-bold boxShadow borderRadius20 inputPR20" placeholder="ID:" data-original-title="ID">
                </div>
                <div class="col-2">
                    <input type="number" autocomplete="off" name="cbook-copy-count" data-toggle="tooltip" data-placement="top" title="" class="form-control font-weight-bold boxShadow borderRadius20 inputPR20" placeholder="Nusxalar soni:" data-original-title="Adabiyot nusxalar soni.">
                </div>
                <div class="col-2">
                    <select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 inputPR20" name="cbook-for-home" data-toggle="tooltip" data-placement="top" data-original-title="Adabiyot uyga beriladimi ?">
                        <option selected disabled>Uyga beriladimi ?</option>
                        <option value="1">Ha</option>
                        <option value="2">Yo'q</option>
                    </select>
                </div>
                <div class="col-2">
                    <select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 inputPR20" name="cbook-campus-id" data-toggle="tooltip" data-placement="top" data-original-title="Adabiyot tili.">
                        <option selected disabled>ARM bo'limi...</option>
                        @foreach($allCampuses as $currentCampus)
                            <option value="{{$currentCampus->id}}">{{$currentCampus->campus_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2 ac">
                    <button type="submit" class="btn btn-primary"><i data-feather="save" class="feather-icon mr-2"></i>Saqlash</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row mt-5">
        <div class="col-12">

        </div>
        <div class="col-12 ac">
        <h3>Barcha adabiyotlar jadvali (bosma taboq)</h3>
    </div>

    <div id="table-div" class="col">
        <table id="all-books-table" class="table table-hover table-bordered" style="display: none;width:100%">
            <thead>
            <tr class="ac">
                <th width="5%" class="font-weight-bold">ID</th>
                <th width="23%" class="font-weight-bold">Nomi</th>
                <th width="15%" class="font-weight-bold">Muallifi</th>
                <th width="5%" class="font-weight-bold">Yili</th>
                <th width="20" class="font-weight-bold">ARM bo'limi</th>
                <th width="15%" class="font-weight-bold">Kiritgan hodim</th>
                <th width="17%" ></th>
            </tr>
            </thead>
            <tbody>
               @forelse($allBooks as $currentBook)
                   <tr>
                       <td class="ac font-weight-bold @if($currentBook->book_file) text-orange @endif ">{{$currentBook->id}}</td>
                       <td>{{$currentBook->book_name}}</td>
                       <td>{{$currentBook->book_author}}</td>
                       <td class="ac">{{$currentBook->book_year}}</td>
                       <td class="ac">
                           {{$currentBook->campus_name}}
{{--                           @forelse($allCampuses as $currentCampus)--}}
{{--                               @if($currentCampus->id == $currentBook->book_campus_id)--}}
{{--                                {{$currentCampus->campus_name}}--}}
{{--                               @endif--}}
{{--                               @empty--}}

{{--                           @endforelse--}}
                       </td>
                       <td class="ac">
                           @if($currentBook->book_added_admin_id == '')
                               ARM hodimlari
                           @else
                               {{$currentBook->admin_name}}
{{--                               @forelse($allAdmins as $choosedAdmin)--}}
{{--                                   @if($choosedAdmin->id == $currentBook->book_added_admin_id)--}}
{{--                                       {{$choosedAdmin->name}}--}}
{{--                                   @endif--}}
{{--                               @empty--}}
{{--                                   ARM hodimlari--}}
{{--                               @endforelse--}}
                           @endif
                       </td>
                       <td class="ac">
                            {{-- <a data-for-what="bookQRCodeDownload" data-id = "{{$currentBook->id}}" class="btn btn-info btn-book"><i class="fa fa-qrcode"></i></a> --}}

                            <button data-for-what="bookQRCodeDownload"  data-id = "{{$currentBook->id}}" id="generate-button" class="btn btn-info btn-book"><i class="fa fa-qrcode"></i></button>

                           <button data-for-what="edit-book" data-id = "{{$currentBook->id}}" class="btn btn-info btn-book" data-toggle="modal" data-target="#choosed-book-modal"><i class="icon-note"></i></button>
                           <button data-for-what="delete-book" data-id = "{{$currentBook->id}}" class="btn btn-danger btn-book"><i class="icon-trash"></i></button>
                       </td>
                   </tr>
                   @empty
               @endforelse
            </tbody>
            <tfoot>
            <tr class="ac">
                <th width="5%" class="font-weight-bold">ID</th>
                <th width="23%" class="font-weight-bold">Nomi</th>
                <th width="15%" class="font-weight-bold">Muallifi</th>
                <th width="5%" class="font-weight-bold">Yili</th>
                <th width="20" class="font-weight-bold">ARM bo'limi</th>
                <th width="15%" class="font-weight-bold">Kiritgan hodim</th>
                <th width="17%" ></th>
            </tr>
            </tfoot>
            <div id="qrcode-container"></div>
        </table>
    </div>
</div>
    <div id="choosed-book-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-hidden="true"
         data-backdrop="static" data-keyboard="false" aria-labelledby="staticBackdropLabel">
        <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-info">
                        <h4 class="modal-title" id="info-header-modalLabel">Sozlamalar</h4>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×</button>
                    </div>
                    <div class="row p-3">
                        <div class="col m-auto">
                            <form id="choosed-book-form" action="{{route('admin.all_books.post')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row" id="choosed-book-content-div">
                                    <div class="col-4">
                                    </div>
                                    <div class="col-4 ac">
                                        <img width="100" src="{{asset('images/core/loader.svg')}}" alt="">
                                    </div>
                                    <div class="col-4"></div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection
@section('footerScripts')
    @parent
    <script>
        var qrcodeLink = "{{route("admin.book.download.qr_code.current")}}";
    </script>
    <script src="{{asset('js/admin-page/add_books/jqueryForm.js')}}"></script>
    <script src="{{asset('js/DataTable/jqueryTable.js')}}"></script>
    <script src="{{asset('js/DataTable/bootstrapTable.js')}}"></script>
    <script src="{{asset('js/admin-page/all_books/all_books.js')}}"></script>
    <script src="{{asset('qrCodeJs/qrcode.min.js')}}"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

@endsection
