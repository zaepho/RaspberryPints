<div id="logincontainer">
    <div id="loginbox">
        <div id="loginheader">
            <a href="../" style="text-decoration:none;"><h1><font color="#2DABD5">RaspberryPints Login</h1></font></a>
        </div>
        <div id="innerlogin">
            <form name="login" action="admin.php?action=login" method="POST">

                <p>Enter your username:</p>
                <input type="text" class="logininput" autofocus="autofocus" name="myusername" placeholder="Login Name" 
                    {if isset($_REQUEST['myusername'])}value={$_REQUEST['myusername']}{/if}
                />
                <p>Enter your password:</p>
                <input type="password" class="logininput"  name="mypassword" placeholder="Password"
                    {if isset($_REQUEST['mypassword'])}value={$_REQUEST['mypassword']}{/if}
                />
                {if isset($LoginError)}ERROR{/if}
                <input type="submit" class="loginbtn" value="Log In" /><br />
                <img src="admin/img/lock.png" height="50" width="50">
                <p><a href="admin/reset_account.php" title="Forgoteen Password?">Forgotten Password?</a></p>
            </form>
        </div>
    </div>
</div>