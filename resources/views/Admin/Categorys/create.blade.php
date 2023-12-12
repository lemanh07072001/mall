@php
    use App\Helper\FormatFunction;
    $getAll = FormatFunction::getCategory();

@endphp

@extends('Admin.LayoutAdmin.LayoutMatter')

@section('title','Thêm danh mục')

@section('breadcrumb')
    {{ Breadcrumbs::render('createCategory') }}
@endsection

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-lg-6 ">
            <div class="card card-primary">

                <!-- form start -->
                <form method="POST" action="{{route('category.store')}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục <span class="text-danger">(*)</span></label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên danh mục">

                            @error('name')
                                <span class="text-danger text-sm">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Chọn danh mục <span class="text-danger">(*)</span></label>
                            <select class="form-control" name="parent_id">
                                <option value="NULL">Danh mục cha </option>
                                @foreach($getAll as $item)
                                    <option value="{{$item->id}}"{{old('parent_id')==$item->id?'selected':''}}> {{str_repeat('/---',$item->depth)}}{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="status">
                            <label class="form-check-label" for="exampleCheck1">Kích hoạt</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck2" name="preview">
                            <label class="form-check-label" for="exampleCheck2">Quay về trang chủ</label>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mr-2">Xác nhận</button>
                            <a href="{{route('category.index')}}" class="btn btn-warning">Quay lại</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
