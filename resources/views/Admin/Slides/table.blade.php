

<table class="table table-hover text-nowrap ">
    <thead>
    <tr>
         <th width="5%">
             <input type="checkbox" id="checkAll"/>
         </th>
        <th width="5%">ID</th>
        <th width="20%">Ảnh</th>
        <th width="45%" >Tên Slide</th>
        <th width="10%">Trạng thái</th>
        <th width="10%">Thời gian</th>
        <th width="10%">Hoạt động</th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($getAll))
        @if(count($getAll) > 0)
            @foreach($getAll as $item)
                <tr>
                     <td>
                         <input type="checkbox" class="checkItem"/>
                     </td>
                    <td>
                        {{$item->id}}
                    </td>

                    <td>
                        <img src="{{$item->image}}" alt="{{$item->name}}" width="100%" class="image previewImage"/>
                    </td>

                    <td>
                        <div>
                            <a class="d-block textx"
                               href="{{route('slide.edit',['id'=>$item->id])}}"
                               data-toggle="tooltip"
                               data-placement="top"
                               title="{{$item->name}}">
                                {{$item->name}}
                            </a>
                            <div class="d-inline-block">{!! checkCategoryAndLink($item) !!}</div>
                        </div>
                    </td>

                    <td>
                        {!! FormatStatus($item->status) !!}
                    </td>

                    <td>
                        {{FormatTime($item->created_at)}}
                    </td>

                    <td>
                        <button class="btn btn-primary btn-sm">
                            <i class="fas fa-folder">
                            </i>
                            View
                        </button>
                        <a class="btn btn-info btn-sm" href="{{route('slide.edit',['id'=>$item->id])}}">
                            <i class="fas fa-pencil-alt"></i>
                            Edit
                        </a>
                        <a href="{{route('slide.destroy',['id'=>$item->id])}}" class="btn btn-danger btn-sm " data-id="{{$item->id}}" data-confirm-delete="true">
                            <i class="fas fa-trash"></i>
                            Delete
                        </a>

                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td class="alert alert-danger text-center" colspan="7">Không có dữ liệu</td>
            </tr>
        @endif
    @else
        <tr>
            <td class="alert alert-danger text-center" colspan="7">Lỗi hệ thống vui lòng liên hệ: 0335641332</td>
        </tr>
    @endif
    </tbody>

</table>

@push('js')
    <script>
        var url = '/admin/category/destroy/';
        deleteAjax(url,'dataDelete');
    </script>
@endpush