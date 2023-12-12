@php
    use App\Helper\FormatFunction;

    $getUser = FormatFunction::getUser();

@endphp

@extends('Admin.LayoutAdmin.LayoutMatter')

@section('title','Quản lý danh mục')

@section('breadcrumb')
    {{ Breadcrumbs::render('slide') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <form>
                        <div class="row">
                            <div class="col-1 ">
                                <a href="{{route('slide.create')}}" class="btn btn-primary btn-sm btn-block">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>
                            <div class="col-1 ">
                                <button class="btn btn-danger btn-sm btn-block deleteAll">
                                    Xóa (<span id="countCheckBox">0</span>)
                                </button>
                            </div>
                            <div class="col-1 "> </div>
                            <div class="col-2 ">
                                <select class="form-control form-control-sm" name="arrange">
                                    <option value="">Xắp xếp</option>
                                    <option value="ASC" {{request()->status == 'ASC'?'selected':''}}>Xắp xếp: Thấp->Cao</option>
                                    <option value="DESC" {{request()->status == 'DESC'?'selected':''}}>Xắp xếp: Cao->Thấp<i class="fas fa-sort-alpha-down-alt"></i></option>
                                </select>
                            </div>
                            <div class="col-2 ">
                                <select class="form-control form-control-sm" name="user_id">
                                    <option value="">Người tạo</option>

                                    @if(!empty($getUser))
                                        @foreach($getUser as $item)
                                            <option value="{{$item->id}}"{{request()->user_id==$item->id?'selected':''}}>{{$item->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-2 ">
                                <select class="form-control form-control-sm" name="status">
                                    <option value="">Trạng thái</option>
                                    <option value="active" {{request()->status == 'active'?'selected':''}}>Kích hoạt</option>
                                    <option value="unactive" {{request()->status == 'unactive'?'selected':''}}>Không kích hoạt</option>
                                </select>
                            </div>
                            <div class="col-2 ">
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 100%;">
                                        <input type="search" value="{{request()->table_search}}" name="table_search" class="form-control float-right" placeholder="Search">

                                        <div class="input-group-append">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1 ">
                                <button type="submit" class="btn btn-success btn-sm btn-block">
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>


                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" >
                    @include('Admin.Slides.table',['getAll' => $getAll])
                </div>
                <!-- /.card-body -->
            </div>
            <div class="d-flex justify-content-end">
                {{$getAll->links()}}
            </div>
        </div>
    </div>
@endsection
