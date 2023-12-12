$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
uploadAjax();

function deleteAjax(url,classes) {
    console.log(url)
    $('.'+classes).each(function( index ,value) {
       $(value).click(function () {
           var id = $(this).data('id')
           Swal.fire({
               title: "Bạn chắc muốn xóa?",
               text: "Xóa không thể khôi phục lại được",
               icon: "warning",
               showCancelButton: true,
               confirmButtonColor: "#3085d6",
               cancelButtonColor: "#d33",
               confirmButtonText: "Có, Tôi đồng ý!"
           }).then((result) => {
               if (result.isConfirmed) {
                   $.ajax({
                       url : url+id,
                       type : 'DELETE',
                       success : function (data) {
                           if (data.status == 200){
                               Swal.fire({
                                   title: data.title,
                                   text: data.message,
                                   icon: "success"
                               });

                           }else{
                               Swal.fire({
                                   title: data.title,
                                   text: data.message,
                                   icon: "success"
                               });
                           }
                            setTimeout(function () {
                                location.reload();
                            },1000)
                       }
                   })

               }
           });

       })
    });
}

function uploadAjax() {
    $('#upload').change(function () {
        var form = new FormData();
        form.append('file',$(this)[0].files[0]);

        $.ajax({
            processData: false,
            contentType: false,
            type : 'POST',
            dataType : 'JSON',
            data : form,
            url : '/admin/upload/store',
            success:function (data) {
                if (data){
                    getUrlImagePrv(data);
                }
            }
        })

    })
}