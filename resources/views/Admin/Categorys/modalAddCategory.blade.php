<div class="modal fade" id="modalAddCategory">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm danh mục</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addCategoryForm">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên danh mục <span class="text-danger">(*)</span></label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên danh mục">
                        <span id="errorName" class="text-danger text-sm"></span>
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
                </form>


            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Thoát</button>
                <button id="submitForm" type="button" class="btn btn-primary">Xác nhận</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@push('js')
    <script>

        $('#submitForm').click(function (e) {
            e.preventDefault();

            var formData = new FormData($('#addCategoryForm')[0])

            $.ajax({
                url : '/admin/category/addAjax',
                type : 'POST',
                data : formData,
                processData: false,
                contentType: false,
                success:function (data) {
                    console.log(data);
                    $('#modalAddCategory').modal('hide')
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "bottom-end",
                        showConfirmButton: false,
                        timer: 1000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    if(data.status == 200){
                        Toast.fire({
                            icon: "success",
                            title: data.message,
                        });
                    }else{
                        Toast.fire({
                            icon: "error",
                            title: data.message,
                        });
                    }

                    setTimeout(function () {
                        location.reload();
                    },1000)
                },
                error: function(xhr, status, error) {
                    // Xử lý lỗi
                    var errors = xhr.responseJSON.errors;
                    // Kiểm tra xem có lỗi từ validator không
                    if (errors) {
                        // Xử lý lỗi từ validator ở đây
                        $('#errorName').html(errors.name.toString())
                    } else {
                        // Xử lý lỗi khác nếu có
                        console.log(error);
                    }
                }
            })
        })
    </script>
@endpush