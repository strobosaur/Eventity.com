<?php
$regForm =
'<div class="container" id="register-container">
    <div class="header" id="register-header">
        <h2>Register</h2>
    </div>

    <form class="form" id="register-form" name="register-form" onsubmit="" action="register_process.php" method="POST">
                                
        <div class="form-control">
        <label>User name</label>
        <input type="text" placeholder="username" name="reg_name" id="reg_name">
        <small>Error message</small>
        </div>  

        <div class="form-control">
        <label>Email</label>
        <input type="email" placeholder="user@mail.com" name="reg_email" id="reg_email">
        <small>Error message</small>
        </div>
                        
        <div class="form-control">
        <label>Password</label>
        <input type="password" placeholder="Password" name="reg_pwd1" id="reg_pwd1">
        <small>Error message</small>
        </div>
                        
        <div class="form-control">
        <label>Password confirm</label>
        <input type="password" placeholder="Password" name="reg_pwd2" id="reg_pwd2">
        <small>Error message</small>
        </div>
                        
        <div class="form-control">
        <label>I agree to <a id="terms-conditions" href="">these terms and conditions</a></label>
        <input type="checkbox" id="check-terms" name="check-terms" value="1">
        <label for="check-terms"></label>
        <small>Error message</small>
        </div>

        <button type="submit" name="register" id="register">Register</button>
        
        <script>
            $(document).ready(function(){
                document.getElementById("register").style.display = "none";
            });
        </script>
    
    </form>
</div>';

echo $regForm;
?>