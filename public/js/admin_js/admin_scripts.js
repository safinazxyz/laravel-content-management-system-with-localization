$(document).ready(function() {
//Check Admin Password is Correct
    $("#current_password").keyup(function() {

        var current_pwd = $("#current_password").val();
        $.ajax({
            type:'post',
            url:actionURL+'/check-current-admin-pwd',
            data:{current_pwd:current_pwd},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function (resp) {
                if(resp==='false'){
                    $("#chkCurrentPwd").html(
                        "<div style='color: red'>"+checkPasswordFalse+"</div>")
                }else if(resp==='true'){
                    $("#chkCurrentPwd").html("<div style='color: green'>"
                        +checkPasswordTrue+"</div>")
                }else{
                    $("#chkCurrentPwd").html("<div></div>")
                }
            },error:function () {
                $("#chkCurrentPwd").html("<div  style='color: red'>*Service Error.</div>")
            }
        })
    });

    //Admin User Edit Modal
    $('#edit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var admin_id = button.data('myid');
        var admin_name = button.data('myname');
        var admin_status = button.data('mystatus');
        var admin_type = button.data('mytype');
        var admin_photo = button.data('myphoto');
        var modal = $(this);
        var url='';
        if(admin_photo.length>0){
            url='/img/admin_img/admin_profile/'+admin_photo;
        }else{
            url='/img/admin_img/admin_constant/admin_constant_photo.png';
        }
        $('.modal-body #admin_photo').attr('src',url);
        if((admin_type).toLowerCase()==='admin'){
            $('.modal-body .adminStatus').hide();
            $('.modal-footer .adminStatus').hide();
        }else{
            $('.modal-body .adminStatus').show();
            $('.modal-footer .adminStatus').show();
            modal.find('.modal-body #admin_status').val(admin_status);
        }
        if(Number(admin_status)){
            $('.modal-body #admin_status_checkbox').prop("checked",1);
        }else{
            $('.modal-body #admin_status_checkbox').prop("checked",0);
        }
        modal.find('.modal-body #admin_id').val(admin_id);
        modal.find('.modal-body #admin_name').val(admin_name);
        modal.find('.modal-body #admin_type').val(admin_type);
        modal.find('.modal-body #admin_photo').val(admin_photo);
    });

    //SweetAlert Jquery for Delete
    $('.deleteRecord').on('click',function(e){
        var id = $(this).attr('rel');
        var deleteFunction = $(this).attr('rel1');
        Swal.fire({
            title: sweetAlertDeleteTitle,
            text: sweetAlertDeleteText,
            icon: sweetAlertDeleteIcon,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: sweetAlertDeleteConfirmButtonText,
            cancelButtonText: sweetAlertDeleteCancelButtonText,
        }).then((result) => {
            if (result.value) {
                window.location.href=actionURL+"/"+deleteFunction+"/"+id;
                Swal.fire(
                    sweetAlertDeleteAfter1,
                    sweetAlertDeleteAfter2,
                    sweetAlertDeleteAfter3
                )
            }
        })
    });
});
