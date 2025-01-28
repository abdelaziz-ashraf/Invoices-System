@extends('layouts.master')
@section('css')
@endsection

@section('title', 'تعديل منتج')

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المنتجات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل منتج</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
            @if($errors->any())
                <div class="alert alert-danger show" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card mg-b-20 p-3">
                <h3>تعديل المنتج</h3>
                <form action="{{route('products.update', $product)}}" method="post">
                    @method('PUT')
                    @csrf

                    <div class="row row-sm">
                        <div class="col-lg">
                            <input class="form-control" placeholder="اسم القسم" type="text" name="name" value="{{$product->name}}">
                        </div>
                    </div>

                    <div class="row row-sm mg-t-20">
                        <div class="col-lg">
                            <select class="form-control" name="section_id">
                                @foreach($sections as $section)
                                    <option value="{{$section->id}}" @selected($section->id == $product->section_id)>{{$section->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row row-sm mg-t-20">
                        <div class="col-lg">
                            <textarea class="form-control" placeholder="ملاحظات" rows="3" name="description">{{$product->description}}</textarea>
                        </div>
                    </div>
                    <div class="row row-sm mg-t-20">
                        <div class="col-lg">
                            <button class="btn ripple btn-primary" type="submit">تعديل</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection
