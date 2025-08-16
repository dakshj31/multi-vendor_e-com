$(document).ready(function(){

    // Check Admin password is correct or not
    $("#current_pwd").keyup(function(){
        var current_pwd = $("#current_pwd").val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url: '/admin/verify-password',
            data: {current_pwd:current_pwd},
            success:function(resp){
                if(resp == "false"){
                    $("#verifypwd").html("<font color='red'>Current Password is incorrect</font>");
                } else if(resp == "true"){
                    $("#verifypwd").html("<font color='green'>Current Password is correct</font>");
                }
            },
            error:function(){
                alert("Error");
            }
        });
    });

    $(document).on('click','#deleteProfileImage',function(){
        if (confirm('Are you sure you want to remove your profile image?')) {
            var admin_id = $(this).data('admin-id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'post',
                url:'delete-profile-image',
                data:{admin_id:admin_id},
                success:function(resp){
                    if(resp['status'] == true){
                        alert(resp['message']);
                        $('#profileImageBlock').remove();
                    }
                },error:function(){
                    alert("Error occured while deleting the image.");
                }
            });
        }
    });

    // Update Subadmin Status
    $(document).on("click", ".updateSubadminStatus", function() {
        var status = $(this).children("i").data("status");
        var subadmin_id = $(this).data("subadmin_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-subadmin-status',
            data: {status: status, subadmin_id: subadmin_id },
            success: function(resp) {
                if (resp['status'] == 0) {
                    $("a[data-subadmin_id='" + subadmin_id + "']").html("<i class='fas fa-toggle-off' style='color:grey' data-status='Inactive'></i>");
                } else if  (resp['status'] == 1) {
                    $("a[data-subadmin_id='" + subadmin_id + "']").html("<i class='fas fa-toggle-on' style='color:#3f6ed3' data-status='Active'></i>");
                }
            },
            error: function() {
                alert("Error");
            }
        });
    });

    // Update Category Status
    $(document).on("click", ".updateCategoryStatus", function() {
        var status = $(this).find("i").data("status");
        var category_id = $(this).data("category-id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-category-status',
            data: {status: status, category_id: category_id },
            success: function(resp) {
                if (resp['status'] == 0) {
                    $("a[data-category-id='" + category_id + "']").html("<i class='fas fa-toggle-off' style='color:grey' data-status='Inactive'></i>");
                } else if  (resp['status'] == 1) {
                    $("a[data-category-id='" + category_id + "']").html("<i class='fas fa-toggle-on' style='color:#3f6ed3' data-status='Active'></i>");
                }
            },
            error: function() {
                alert("Error");
            }
        });
    });

    //delete category image in edit category
    $(document).on("click", "#deleteCategoryImage", function(){
        if(confirm('Are you sure you want to remove this category image?')) {
            var category_id = $(this).data('category-id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/admin/delete-category-image',
                data: {category_id: category_id },
                success:function(resp){
                    if(resp['status'] == true) {
                        alert(resp['message']);
                        $('#categoryImageBlock').remove();
                    }
                },error:function() {
                    alert("Error occurred while deleting the image.");
                }
            });
        }
    });

    // delete sizechart image in edit category
    $(document).on("click", "#deleteSizeChartImage", function(){
        if(confirm('Are you sure you want to remove this size chart image?')) {
            var category_id = $(this).data('category-id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/admin/delete-sizechart-image',
                data: {category_id: category_id },
                success:function(resp){
                    if(resp['status'] == true) {
                        alert(resp['message']);
                        $('#sizechartImageBlock').remove();
                    }
                },error:function() {
                    alert("Error occurred while deleting the image.");
                }
            });
        }
    });

    // $(".confirmDelete").click(function() {
    //     var name = $(this).attr('name');
    //     if (confirm('Are you sure to delete this ' + name + '?')) {
    //         return true;
    //     }
    //     return false;
    // });

    $(document).on("click", ".confirmDelete", function(e){
        e.preventDefault();
        let button = $(this);
        let module = button.data("module");
        let moduleid = button.data("id");
        let form = button.closest("form");
        let redirectUrl = "/admin/delete-" + module + "/" + moduleid;
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes,delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                if (form.length > 0) {
                    form.submit();
                } else {
                    window.location.href = redirectUrl;
                }
            }
        });
    });

});