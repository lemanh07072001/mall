

<table class="table table-hover text-nowrap ">
    <thead>
    <tr>
       {{-- <th width="5%">
            <input type="checkbox" />
        </th>--}}
        <th width="5%">ID</th>
        <th>Tên danh mục</th>
        <th width="10%">Order</th>
        <th width="10%">Người tạo</th>
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
                       {{-- <td>
                            <input type="checkbox" />
                        </td>--}}
                        <td>
                            {{$item->id}}
                        </td>
                        <td>

                            {{str_repeat('/---',$item->depth)}}{{$item->name}}{!! checkParent($item) !!}
                        </td>
                        <td>
                            {!! checkOrder($item) !!}
                        </td>
                        <td>
                            {{$item->user->name}}
                        </td>
                        <td>
                            {!! FormatStatus($item->status) !!}
                        </td>
                        <td>
                            {{FormatTime($item->created_at)}}
                        </td>
                        <td>
                            <button class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                            </button>
                            <a href="{{route('category.edit',['id'=>$item->id])}}" class="btn btn-warning btn-sm">
                                <i class="fas fa-pen"></i>
                            </a>
                            <a href="{{route('category.destroy',['id'=>$item->id])}}" class="btn btn-danger btn-sm " data-confirm-delete="true">
                                <i class="fas fa-trash-alt"></i>
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

