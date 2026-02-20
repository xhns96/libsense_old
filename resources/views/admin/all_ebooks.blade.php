@extends('layouts.admin')
@section('title', "Barcha adabiyotlar")

@section('headerStyles')
    @parent
    <link rel="stylesheet" href="{{asset('css/DataTable/bootstrapTable.css')}}">

@endsection

@section('content')
    <div class="row mt-3">
        <div class="col-12 ac">
            <h3>Barcha elektron adabiyotlar jadvali</h3>
        </div>
        {{--    <div id="table-loader" class="col-12 ac mt-3">--}}
        {{--        <img src="{{asset('images/core/loader.svg')}}" height="100" width="100" alt="Loader">--}}
        {{--    </div>--}}
        <div id="table-div" class="col">
            <table id="all-ebooks-table" class="table table-hover table-bordered" style="display: none;width:100%">
                <thead>
                <tr class="ac">
                    <th width="10%" class="font-weight-bold">ID</th>
                    <th width="28%" class="font-weight-bold">Nomi</th>
                    <th width="15%" class="font-weight-bold">Muallifi</th>
                    <th width="5%" class="font-weight-bold">Yili</th>
                    <th width="10%" class="font-weight-bold">Yuklanishlar soni</th>
                    <th width="15%" class="font-weight-bold">Kiritgan hodim</th>
                    <th width="17%" ></th>
                </tr>
                </thead>
                <tbody>
                @forelse($allEbooks as $currentBook)
                    <tr>
                        <td class="ac font-weight-bold">{{$currentBook->id}}</td>
                        <td>{{$currentBook->ebook_name}}</td>
                        <td>{{$currentBook->ebook_author}}</td>
                        <td class="ac">{{$currentBook->ebook_year}}</td>
                        <td class="ac">{{$currentBook->ebook_rating}}</td>

                        <td class="ac">
                            @if($currentBook->ebook_added_admin_id == '')
                                ARM hodimlari
                            @else
                                @forelse($allAdmins as $choosedAdmin)
                                    @if($choosedAdmin->id == $currentBook->ebook_added_admin_id)
                                        {{$choosedAdmin->name}}
                                    @endif
                                @empty
                                    ARM hodimlari
                                @endforelse
                            @endif
                        </td>
                        <td class="ac">
                            <button data-for-what="edit-book" data-id = "{{$currentBook->id}}" class="btn btn-info btn-book" data-toggle="modal" data-target="#choosed-book-modal"><i class="icon-note"></i> Tahrirlash</button>
                            <button data-for-what="delete-book" data-id = "{{$currentBook->id}}" class="btn btn-danger btn-book"><i class="icon-trash"></i> O'chirish</button>
                        </td>
                    </tr>
                @empty
                @endforelse
                </tbody>
                <tfoot>
                <tr class="ac">
                    <th width="10%" class="font-weight-bold">ID</th>
                    <th width="28%" class="font-weight-bold">Nomi</th>
                    <th width="15%" class="font-weight-bold">Muallifi</th>
                    <th width="5%" class="font-weight-bold">Yili</th>
                    <th width="10%" class="font-weight-bold">Yuklanishlar soni</th>
                    <th width="15%" class="font-weight-bold">Kiritgan hodim</th>
                    <th width="17%" ></th>
                </tr>
                </tfoot>
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
                        <form id="choosed-book-form" action="{{route('admin.all_ebooks.post')}}" method="post" enctype="multipart/form-data">
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
    <script src="{{asset('js/admin-page/add_books/jqueryForm.js')}}"></script>
    <script src="{{asset('js/DataTable/jqueryTable.js')}}"></script>
    <script src="{{asset('js/DataTable/bootstrapTable.js')}}"></script>
    <script src="{{asset('js/admin-page/all_ebooks/all_ebooks.js')}}"></script>
@endsection
