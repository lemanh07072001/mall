@php
    use App\Helper\FormatFunction;
 $getAll = FormatFunction::getCategory();

@endphp

@extends('Admin.LayoutAdmin.LayoutMatter')

@section('title','Thêm slide')

@section('breadcrumb')
    {{ Breadcrumbs::render('createSlide') }}
@endsection

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-lg-6 ">
            <div class="card card-primary">

                <!-- form start -->
                <form method="POST" action="{{route('slide.store')}}">
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
                            <label class="d-block">Chọn danh mục <span class="text-danger">(*)</span></label>
                            <div class="input-group ">

                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        Hoạt động
                                    </button>
                                    <ul class="dropdown-menu" style="" id="checkCategory">
                                        <li class="dropdown-item tab check"><a href="#">Danh mục</a></li>
                                        <li class="dropdown-item tab"><a href="#">Đường dẫn</a></li>
                                    </ul>
                                </div>
                                <!-- /btn-group -->
                                <select class="form-control d-none pane {{!empty(old('link'))?'':'check'}}" id="parent_id" name="parent_id">
                                    @foreach($getAll as $item)
                                        <option value="{{$item->id}}"{{old('parent_id')==$item->id?'selected':''}}> {{str_repeat('/---',$item->depth)}}{{$item->name}}</option>
                                    @endforeach
                                </select>

                                <input type="text"
                                       name="link"
                                       value="{{old('link')}}"
                                       class="form-control pane pr-lg-5 position-relative d-none {{!empty(old('link'))?'check':''}}"
                                       id="link" placeholder="Nhập đường dẫn">
                            </div>
                            @error('link')
                            <span class="text-danger text-sm">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Hình ảnh <span class="text-danger">(*)</span></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"  id="upload" >
                                    <label class="custom-file-label preImage" for="exampleInputFile">Chọn ảnh...</label>
                                    <input type="hidden" id="image" name="image" value="{{old('image')}}"/>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                            <div id="preview">
                                <img class="pt-2 imagePre" src="{{asset('images/4323901ada.png')}}" width="auto" height="100px">
                            </div>
                            @error('image')
                            <span class="text-danger text-sm">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea class="form-control" rows="3" name="description" placeholder="Enter ...">{{old('description')}}</textarea>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="status" {{old('status')=='on'?'checked':''}}>
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
                            <a href="{{route('slide.index')}}" class="btn btn-warning">Quay lại</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
