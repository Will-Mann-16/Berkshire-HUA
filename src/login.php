<div class="modal" id="login-modal">
    <form class="modal-content modal-animate" id="login-form" method="post">
    <span onclick="closeLogin();" class="close" title="Close Login">&times;</span>
        <div class="modal-container">
            <label><b>Email Address</b></label>
            <input type="email" placeholder="Enter Email Address" name="email" required>

            <label><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>
            <input type="checkbox" checked="checked"> Remember me?
        </div>
        <div class="modal-container" style="background-color:#f1f1f1">
            <button type="button" class="cancelbtn" onclick="closeLogin();">Cancel</button>
            <button class="submitbutton" type="button" id="login-button">Login</button>
            <span class="psw"> <a href="javascript:void(0)" onclick="openForgotPassword();">Forgot password?</a></span>
        </div>
    </form>
</div>
<div class="modal" id="forgot-password-modal">
    <form action="php/forgotpassword.php" class="modal-content modal-animate" id="forgot-password-form" method="post">
    <span onclick="closeForgotPassword();" class="close" title="Close Popup">&times;</span>
        <div class="modal-container">
            <label><b>Email Address</b></label>
            <input type="email" placeholder="Enter Email Address" name="email" required>
        </div>
        <div class="modal-container" style="background-color:#f1f1f1">
            <button type="button" class="cancelbtn" onclick="closeForgotPassword();">Cancel</button>
            <button class="submitbutton" type="button">Send Email</button>
        </div>
    </form>
</div>
<script>
    var redirect = false;
    $(document).ready(function () {
                var loginModal = document.getElementById('login-modal');
                var forgotPasswordModal = document.getElementById('forgot-password-modal');
                window.onclick = function (event) {
                    if (event.target == loginModal) {
                        loginModal.style.display = "none";
                    }else if(event.target == forgotPasswordModal){{
                        forgotPasswordModal.style.display = "none";
                    }}
                }
                $(".login-open").click(function(){
                    openLogin();
                });
                $("#login-button").click(function(){
                    validateLogin();
                });
                <?php
                    if(isset($requireLogin) && $requireLogin){
                        echo 'openLogin();';
                        echo 'redirect = true;';
                    }
                ?>
    });

    function validateLogin(){
        var email = $("#login-form input[name=email]");
        var password = $("#login-form input[name=password]");
        if(!email.val() || !password.val()){
            $("#login-form input").removeClass("alert-incomplete");
            var emailClass = !email.val() ? "alert-incomplete" : "";
            var passwordClass = !password.val() ? "alert-incomplete" : "";
            email.addClass(emailClass);
            password.addClass(passwordClass);
        }else{
            $.ajax({
                url: "php/authlogin.php",
                method: "post",
                data: {email: email.val(), password: password.val()},
                success: function(callback){
                    if(callback === "Correct Login"){
                        closeLogin();
                        //window.location.reload();
                    }else{
                        console.log(callback);
                    }
                }

            })
        }
    }

    function closeLogin(){
        $("#login-modal").css("display", "none");
        if(redirect){
            window.location.href = "index.php";
        }
    }
    function openLogin(){
        $("#login-modal").css("display", "block");
    }
    function closeForgotPassword(){
        $("#forgot-password-modal").css("display", "none");
        if(redirect){
            window.location.href = "index.php";
        }
    }
    function openForgotPassword(){
        closeLogin();
        $("#forgot-password-modal").css("display", "block");
    }
</script>
<link rel="stylesheet" type="text/css" href="css/login-style.css"/>