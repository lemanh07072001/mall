
$(document).ready(function() {
    // Gọi hàm ở đây
    activeAction();
    previewData()
    checkAll()
    previewImageSlide();
});


function activeAction() {

    var tabs = $('.tab');
    let panes = $('.pane');

    $(tabs).each(function (index,value) {
        const pane = panes[index];
        $(value).click(function (e) {
            // Loại bỏ class 'check' từ tất cả các tab và pane
            $('.tab.check').removeClass('check');
            $('.pane.check').removeClass('check');



            // Thêm class 'check' cho tab và pane được chọn
            $(this).addClass('check');
            $(pane).addClass('check');

            if (!$(pane).is('#link')){
                console.log($('#link').val())
                $('#link').val("")
            }
        })
    })

    $('#clear').click(function () {
        $('#link').val("")
    })
}


function urlHost() {
    const fullUrl = window.location.href;
    return fullUrl.split('/').slice(0, 3).join('/');
}


function oldImage() {
    let hostUrl = urlHost();
    $('#preview .imagePre').attr('src',hostUrl+'/images/4323901ada.png');
    $('.preImage').html('Chọn ảnh...')
}


function getUrlImagePrv(data) {

    oldInputUpload(data)
}

function getFullUrl(data) {

    let url = data.url;

/*    let host = urlHost();*/
    return url;
}


function oldInputUpload(data) {
    let fullUrl = getFullUrl(data)

    $('#image').attr('value',fullUrl)

    if (fullUrl !== undefined){
        previewData();

    }
}

function previewData() {
    let fulls = $('#image').val();
    $('#preview .imagePre').attr('src',fulls);
    $('.preImage').html(fulls)
    $("#image").attr('value',fulls)
}

/* Check All*/
function checkAll() {
    var checkAllCheckbox = document.getElementById('checkAll');
    var checkboxes = document.querySelectorAll('.checkItem');

    checkAllCheckbox.addEventListener('change', function () {
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = checkAllCheckbox.checked;
        });

        updateCheckboxCount();
    });

    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            updateCheckboxCount();

            if (!checkbox.checked) {
                // If the checkbox is unchecked, uncheck the "Check All" checkbox
                checkAllCheckbox.checked = false;
            } else {
                // Check if all checkboxes have been checked
                var allChecked = Array.from(checkboxes).every(function (cb) {
                    return cb.checked;
                });

                // Update the "Check All" checkbox state
                checkAllCheckbox.checked = allChecked;
            }
        });
    });
}
function updateCheckboxCount() {
    var checkedCheckboxes = document.querySelectorAll('.checkItem:checked');
    document.getElementById('countCheckBox').innerText = checkedCheckboxes.length;
}
/* Preview Image Slide */
function previewImageSlide() {

    $('.previewImage').click(function () {
        let urlImage = $(this).attr('src');
        let altImage =  $(this).attr('alt');

        Swal.fire({
            title: "Tên Slide!",
            text: altImage,
            imageUrl: urlImage,
            imageWidth: 400,
            imageHeight: "auto",
            imageAlt: altImage
        });
    })
}