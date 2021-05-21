<div class="flex-container">
    <div class="container">
        <div class="formbox">
    
            <div class="header">
                <h2>Register</h2>    
            </div>

            <form class="form" id="form" onsubmit="checkRegInput();" action="register_process.php" method="POST">
                
                <div class="form-control">
                <label>User name</label>
                <input type="text" placeholder="nickname..." name="uname" id="uname">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>Email adress</label>
                <input type="email" placeholder="user@mail.com..." name="email" id="email">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>Password</label>
                <input type="password" placeholder="password..." name="password1" id="password1">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>Repeat password</label>
                <input type="password" placeholder="password..." name="password2" id="password2">
                <small>Error message</small>
                </div>
                
                <button type="submit" name="register" id="register">Registrera</button>
                
            </form>
        </div>
    </div>
</div>