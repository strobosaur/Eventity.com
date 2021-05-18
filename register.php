
<div class="flex-container">
    <div class="container">
        <div class="formbox">
    
            <div class="header">
                <h2>Register</h2>    
            </div>

            <form class="form" id="form" onsubmit="checkRegInput();" action="register_process.php" method="POST">
                
                <div class="form-control">
                <label>First name</label>
                <input type="text" placeholder="first name..." name="fname" id="fname">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>Last name</label>
                <input type="text" placeholder="last name..." name="lname" id="lname">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>User name</label>
                <input type="text" placeholder="nickname..." name="uname" id="uname">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>Street adress</label>
                <input type="text" placeholder="mainstreet 101..." name="sadress" id="sadress">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>Zip code</label>
                <input type="text" placeholder="12345..." name="zadress" id="zadress">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>City</label>
                <input type="text" placeholder="storköping..." name="cadress" id="cadress">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>Personal nr</label>
                <input type="text" placeholder="person nr..." name="pnr" id="pnr">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>Email adress</label>
                <input type="email" placeholder="user@mail.com..." name="email" id="email">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>Phone nr</label>
                <input type="email" placeholder="070 123 45 67..." name="cellnr" id="cellnr">
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
