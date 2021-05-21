<div class="container" id="login-container">
    <div class="header" id="login-header">
        <h2>Log in</h2>
    </div>

    <form class="form" id="login-form" name="login-form" onsubmit="" action="login_process.php" method="POST">
                                
            <div class="form-control">
            <label>Login</label>
            <input type="text" placeholder="username / email" name="login_name" id="login_name">
            <small>Error message</small>
            </div>
                            
            <div class="form-control">
            <label>Password</label>
            <input type="password" placeholder="Password" name="login_password" id="login_password">
            <small>Error message</small>
            </div>
            
            <button type="submit" name="login" id="login">Login</button>
    
    </form>
</div>