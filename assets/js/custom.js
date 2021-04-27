(function($){
    $(document).ready(function(){

        // Staff image load
        $('input#staff-photo').change(function(e){
            let file_url  = URL.createObjectURL(e.target.files[0]);
            $('img#staff-photo-load').attr('src', file_url);
            $('img#image_loader').hide();
            $('a#remove_photo').show();
        });

        // Staff image load
        $('input#staff-photo-update').change(function(e){
            let file_url  = URL.createObjectURL(e.target.files[0]);
            $('img#staff-photo-load').attr('src', file_url);
            $('img#image_loader').hide();
            $('a#remove_photo').show();
        });

        // Remove Photos
        $(document).on('click', 'a#remove_photo' , function(e){
            e.preventDefault();
            $('img#staff-photo-load').attr('src', '');
            $('img#image_loader').show();
            $('a#remove_photo').hide();
        });


        // Staff form validation
        $(document).on('submit','form#staff-form', function(event){
            event.preventDefault();

            let name = $('form#staff-form input[name="name"]').val();
            let email = $('form#staff-form input[name="email"]').val();
            let cell = $('form#staff-form input[name="cell"]').val();

            if (name == '' || email == '' || cell == ''){
                $('.modal-msg').html('<p class="alert alert-danger"> All fields are required  !<button class="close" data-dismiss="alert">&times;</button></p>');
            }else {

                $.ajax({
                    url : 'ajax_template/staff_add.php',
                    method : "POST",
                    data : new FormData(this),
                    contentType : false,
                    processData:  false,
                    success : function(data){
                        $('.modal-msg').html(data);
                        $('form#staff-form')[0].reset();
                        $('img#staff-photo-load').attr('src', '');
                        $('img#image_loader').show();
                        $('a#remove_photo').hide();
                        allStaff();
                    }
                });

            }

        });

        // All staff load
        allStaff();
        function allStaff(){
            $.ajax({
                url : 'ajax_template/staff_all.php',
                success : function(data){
                    $('tbody#staff_all').html(data);
                }
            });
        }


        // Delete Staff
        $(document).on('click', 'a#delete_data', function(event){
            event.preventDefault();
            let user_id = $(this).attr('del_id');

            let conn = confirm('Are you sure ?');

            if(conn == false){
                return false;
            }else{
                $.ajax({
                    url : 'ajax_template/staff_delete.php',
                    method : "POST",
                    data : { id : user_id },
                    success : function(data){
                        allStaff();
                        $('.mess').html(data);
                    }
                });
            }

        });

        // Staff single view
        $(document).on('click', 'a#staff_view_modal', function(event){
            event.preventDefault();

            let user_id = $(this).attr('show_id');

            $.ajax({
                url : 'ajax_template/staff_show.php',
                method : 'POST',
                data : { id : user_id },
                success : function(data){
                    let single_staff = JSON.parse(data);
                    $('.staff-single-data img').attr('src', 'photos/staff/' + single_staff.photo);
                    $('.staff-single-data h2').html(single_staff.name);
                    $('.staff-single-data h3').html(single_staff.cell);
                    $('.staff-single-data table td#name').html(single_staff.name);
                    $('.staff-single-data table td#email').html(single_staff.email);
                    $('.staff-single-data table td#cell').html(single_staff.cell);
                    $('#staff_view').modal('show');

                }
            });

        });

        // Staff update
        $(document).on('click', 'a#staff_update', function (e){
            e.preventDefault();
            let user_id = $(this).attr('edit_id');

            $.ajax({
                url : 'ajax_template/staff_edit.php',
                method : 'POST',
                data : { id : user_id },
                success : function(data){
                    let edit_data = JSON.parse(data);

                    $('#staff-modal-update input[name="name"]').val(edit_data.name);
                    $('#staff-modal-update input[name="id"]').val(edit_data.id);
                    $('#staff-modal-update input[name="email"]').val(edit_data.email);
                    $('#staff-modal-update input[name="cell"]').val(edit_data.cell);
                    $('#staff-modal-update input[name="old_photo"]').val(edit_data.photo);
                    $('#staff-modal-update img#staff-photo-load').attr('src', 'photos/staff/' +  edit_data.photo);
                    $('#staff-modal-update').modal('show');

                }
            });

        });

        // Staff update
        $(document).on('submit', 'form#staff-update-form', function(e){
            e.preventDefault();

            $.ajax({
                url : 'ajax_template/staff_update.php',
                method : 'POST',
                data : new FormData(this),
                contentType: false,
                processData:  false,
                success : function(data){
                    $('.mess').html(data);
                    allStaff();
                    $('#staff-modal-update').modal('hide');
                }

            });

        });


        // Email validate system by keyup 
        $(document).on('keyup', 'input#email_validate', function(){

            let email = $(this).val();


            $.ajax({
                url : 'ajax_template/staff_email_check.php',
                method : 'POST',
                data : { email : email },
                success : function(data){

                    if(data == 'ok'){
                        $('#staff-form input[type="submit"]').removeAttr('disabled');
                        $('#email_check').html('');
                    }else {
                        $('#staff-form input[type="submit"]').attr('disabled', '');
                        $('#email_check').html('<span style="color:red;">Email already exists !</span>');
                    }




                }
            });

        });

        // Staff search
        $(document).on('keyup', 'input#staff-search', function (){
            let search_text = $(this).val();

            $.ajax({
                url : 'ajax_template/staff_search.php',
                data : { search : search_text },
                method : 'POST',
                success : function (data){
                    $('#search_res').html(data);
                }
            });

        });


    });
})(jQuery)