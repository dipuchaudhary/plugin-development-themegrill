/* global myscript */

jQuery(document).ready(function($) {

    jQuery("#register").click(function(e) {
        e.preventDefault();
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var username = $("#username").val();
        var displayname = $("#displayname").val();
        var email = $("#email").val();
        var password = $("#password").val();


        $.ajax({
            url: myscript.ajaxurl,
            method: 'post',
            data :{action:"user_register", fname:fname, lname:lname, username:username, displayname:displayname,email:email, password:password},
            success: function(result){
                console.log(result);
            }
        })

    })
    console.log(myscript.success_message);
})

