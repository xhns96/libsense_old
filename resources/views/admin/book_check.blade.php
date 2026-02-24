@extends('layouts.admin')
@section('title', "Barcha adabiyotlar")

@section('headerStyles')
    @parent
    <link rel="stylesheet" href="{{asset('css/DataTable/bootstrapTable.css')}}">
    <link rel="stylesheet" href="{{asset('css/bi.css')}}">
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4>gcxshacvb</h4>
    </div>
</div>
@endsection
@section('footerScripts')
    @parent
    <script src="{{asset('js/admin-page/add_books/jqueryForm.js')}}"></script>
    <script src="{{asset('js/DataTable/jqueryTable.js')}}"></script>
    <script src="{{asset('js/DataTable/bootstrapTable.js')}}"></script>
    <script src="{{asset('js/admin-page/all_books/all_books.js')}}"></script>
@endsection
