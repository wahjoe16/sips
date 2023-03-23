// const { default: Swal } = require("sweetalert2");

$(document).ready(function(){

    // memanggil class datatables
    $("#dosen").DataTable();
    $("#mahasiswa").DataTable();
    $("#semester").DataTable();
    $("#tahun_ajaran").DataTable();
    $("#daftarSidangMahasiswa").DataTable();
    
    
    $(".nav-item").removeClass("active");
    $(".nav-link").removeClass("active");

    // mengecek password lama apakah sesuai atau tidak
    $("#current_password").keyup(function(){
        var current_password = $("#current_password").val();
        // alert(current_password);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: 'check-current-password',
            data: {current_password:current_password},
            success:function(resp){
                if (resp == "false") {
                    $("#check_password").html("<font color='red'>Password lama anda salah</font>")
                }else if(resp == "true"){
                    $("#check_password").html("<font color='green'>Password lama anda benar</font>")
                }
            }, error:function(resp){
                alert('Error');
            }
        });
    })

    // update Admin Status
    $(document).on("click", ".updateAdminStatus", function(){
        // alert("test");
        var status = $(this).children("i").attr("status");
        var admin_id = $(this).attr("admin_id");
        // alert(status);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/admin/update-admin-status",
            data: {status:status, admin_id:admin_id},
            success: function(resp){
                // alert(resp);
                if (resp['status']==0) {
                    $("#admin-"+admin_id).html("<i class='mdi mdi-bookmark-outline' style='font-size:25px' status='Inactive'></i>");
                }else if (resp['status']==1) {
                    $("#admin-"+admin_id).html("<i class='mdi mdi-bookmark-check' style='font-size:25px' status='Active'></i>");
                }
            }, error: function(){
                alert("Error");
            }
        })
    });

    // update Section Status
    $(document).on("click", ".updateDosenStatus", function(){
        // alert("test");
        var status = $(this).children("i").attr("status");
        var dosen_id = $(this).attr("dosen_id");
        // alert(status);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/admin/update-dosen-status/id",
            data: {status:status, dosen_id:dosen_id},
            success: function(resp){
                // alert(resp);
                if (resp['status']==0) {
                    $("#dosen-"+dosen_id).html("<i class='mdi mdi-bookmark-outline' style='font-size:25px' status='Inactive'></i>");
                }else if (resp['status']==1) {
                    $("#dosen-"+dosen_id).html("<i class='mdi mdi-bookmark-check' style='font-size:25px' status='Active'></i>");
                }
            }, error: function(){
                alert("Error");
            }
        })
    });

    // update Brand Status
    $(document).on("click", ".updateBrandStatus", function(){
        // alert("test");
        var status = $(this).children("i").attr("status");
        var brand_id = $(this).attr("brand_id");
        // alert(status);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/admin/update-brand-status",
            data: {status:status, brand_id:brand_id},
            success: function(resp){
                // alert(resp);
                if (resp['status']==0) {
                    $("#brand-"+brand_id).html("<i class='mdi mdi-bookmark-outline' style='font-size:25px' status='Inactive'></i>");
                }else if (resp['status']==1) {
                    $("#brand-"+brand_id).html("<i class='mdi mdi-bookmark-check' style='font-size:25px' status='Active'></i>");
                }
            }, error: function(){
                alert("Error");
            }
        })
    });

    // update Category Status
    $(document).on("click", ".updateCategoryStatus", function(){
        // alert("test");
        var status = $(this).children("i").attr("status");
        var category_id = $(this).attr("category_id");
        // alert(status);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/admin/update-category-status",
            data: {status:status, category_id:category_id},
            success: function(resp){
                // alert(resp);
                if (resp['status']==0) {
                    $("#category-"+category_id).html("<i class='mdi mdi-bookmark-outline' style='font-size:25px' status='Inactive'></i>");
                }else if (resp['status']==1) {
                    $("#category-"+category_id).html("<i class='mdi mdi-bookmark-check' style='font-size:25px' status='Active'></i>");
                }
            }, error: function(){
                alert("Error");
            }
        })
    });

    // update Product Status
    $(document).on("click", ".updateProductStatus", function(){
        // alert("test");
        var status = $(this).children("i").attr("status");
        var product_id = $(this).attr("product_id");
        // alert(status);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/admin/update-product-status",
            data: {status:status, product_id:product_id},
            success: function(resp){
                // alert(resp);
                if (resp['status']==0) {
                    $("#product-"+product_id).html("<i class='mdi mdi-bookmark-outline' style='font-size:25px' status='Inactive'></i>");
                }else if (resp['status']==1) {
                    $("#product-"+product_id).html("<i class='mdi mdi-bookmark-check' style='font-size:25px' status='Active'></i>");
                }
            }, error: function(){
                alert("Error");
            }
        })
    });

    // update Attribute Status
    $(document).on("click", ".updateAttributeStatus", function(){
        // alert("test");
        var status = $(this).children("i").attr("status");
        var attribute_id = $(this).attr("attribute_id");
        // alert(status);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/admin/update-attribute-status",
            data: {status:status, attribute_id:attribute_id},
            success: function(resp){
                // alert(resp);
                if (resp['status']==0) {
                    $("#attribute-"+attribute_id).html("<i class='mdi mdi-bookmark-outline' style='font-size:25px' status='Inactive'></i>");
                }else if (resp['status']==1) {
                    $("#attribute-"+attribute_id).html("<i class='mdi mdi-bookmark-check' style='font-size:25px' status='Active'></i>");
                }
            }, error: function(){
                alert("Error");
            }
        })
    });

    // confirm delete (Simple JavaScript)
    // $(".confirm-delete").click(function(){
    //     var title = $(this).attr("title");
    //     if (confirm("Are you sure you want to delete this "+title+"?")) {
    //         return true;
    //     }else {
    //         return false;
    //     }
    // })

    // Konfirmasi Delete
    $(".confirm-delete").click(function(){
        var module = $(this).attr("module");
        var module_id = $(this).attr("module_id");
        var module_name = $(this).attr("module_name");
        Swal.fire({
            title: "Apakah anda yakin menghapus "+module+" "+module_name+ "?",
            text: module+" "+module_name+" Akan terhapus permanen",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"  
        }).then((result) =>{
            if (result.isConfirmed) {
            Swal.fire(
                "Terhapus!",
                module+" "+module_name+" sudah terhapus.",
                "success"
            )
            window.location = "/admin/delete-"+module+"/"+module_id;
            }
        })
    })

    // proses append kategori level(subcategory)
    $("#section_id").change(function(){
        var section_id = $(this).val();
        // alert(section_name);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "get",
            url: '/admin/append-categories-level',
            data: {section_id:section_id},
            success:function(resp){
                // alert(resp);
                $("#appendCategoriesLevel").html(resp);
            },error:function(){
                alert("An error occurred");
            }   
        })
    });

    // Product Attribute add/remove scripts
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><div style="height: 10px;"></div><input type="text" name="size[]" placeholder="Size" style="width: 120px;"/>&nbsp;<input type="text" name="sku[]" placeholder="SKU" style="width: 120px;"/>&nbsp;<input type="text" name="price[]" placeholder="Price" style="width: 120px;"/>&nbsp;<input type="text" name="stock[]" placeholder="Stock" style="width: 120px;"/>&nbsp;<a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
        
});