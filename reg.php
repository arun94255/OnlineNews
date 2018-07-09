<?php require_once 'header.php';?>
<?php require_once 'include/form_func.php';?>
	<script>
jQuery.validator.addMethod("phoneno", function(phone_number, element) {
    	    phone_number = phone_number.replace(/\s+/g, "");
    	    return this.optional(element) || phone_number.length > 9 && 
    	    phone_number.match(/^0?[6-9]{1}\d{9}$/);
    	}, "<br />Please specify a valid phone number");
	$().ready(function() {
		$("#myForm").validate({
			rules: {
				uname: "required",
				uname: {
					required: true,
					minlength: 2
				},
				pass: {
					required: true,
					minlength: 5
				},
				cpass: {
					required: true,
					minlength: 5,
					equalTo: "#pass"
				},
				email: {
					required: true,
					email: true
				},
				pn: {
                                      phoneno: true
				},
			messages: {
				uname: "Please enter your user name",
				uname: {
					required: "Please enter a username",
					minlength: "Your username must consist of at least 2 characters"
				},
				pass: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				},
				cpass: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long",
					equalTo: "Please enter the same password as above"
				},
				email: "Please enter a valid email address",
				pn: "Please enter a valid phone no"
			}
                        }
		});
	});
	</script>

<?php
check_admin();
if(isset($_POST["uname"])){
$err="";
if(!check_required($_POST["uname"])){
    $err = "User Name is req!"; 
}    
else if(!check_required($_POST["email"])){
    $err = "E Mail is required!";     
}
else if(!check_email ($_POST["email"])){
    $err = "E Mail is incorrect!";     
}
else if(is_exist($_POST["email"])){
    $err = "E Mail is already reg!";     
}
else if(!check_required($_POST["pass"])){
    $err = "Password is required!";     
}
else if(check_password ($_POST["pass"])!=""){
    $err = check_password ($_POST["pass"]);     
}
else if(!check_required($_POST["cpass"])){
    $err = "C Password is required!";     
}
else if($_POST["pass"]!=$_POST["cpass"]){
    $err = "Password does not match!";     
}
else if(!check_phone_no ($_POST["pn"])){
    $err = "Phone no is encorrect!";     
}
else if(!check_cambo ($_POST["sec_q"])){
    $err = "Seq q is required!";     
}
else if(!check_required($_POST["sec_a"])){
    $err = "Sec a is required!";     
}
else { 
    $query= "INSERT INTO  `app_users` (`email`, `uname`, 
    `pass`, `sec_q`, `sec_a`, `roll`, `pn`, `status`) 
    VALUES ('$_POST[email]', '$_POST[uname]', '$_POST[pass]', 
    '$_POST[sec_q]', '$_POST[sec_a]', 'user', '$_POST[pn]', 
    'approved');";
run_sql($query);
redirect("login.php?msg=1");
}
}
?>
<h1>Register</h1>
<form method="post" id="myForm">
    <table>
        <tr>
            <td>User Name</td>
            <td><input type="text" name="uname" value="<?php echo "$_POST[uname]";?>"/></td>
        </tr>
        <tr>
            <td>EMail</td>
            <td><input type="text" name="email" value="<?php echo "$_POST[email]";?>"/></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="pass" id="pass"/></td>
        </tr>
        <tr>
            <td>Confirm Password</td>
            <td><input type="password" name="cpass" id="cpass"/></td>
        </tr>
        <tr>
            <td>Phone No</td>
            <td><input type="text" name="pn" value="<?php echo "$_POST[pn]";?>"/></td>
        </tr>
        <tr>
            <td>Security Question</td>
            <td>
                <select name="sec_q" style="width: 140px">
                    <option>Select</option>
                    <?php
                    $r = run_sql("select * from sec_q");
                    while($row = mysql_fetch_array($r)){
                        $sel="";
                        if($_POST["sec_q"]==$row[que])
                        {
                           $sel=" selected='selected'"; 
                        }
                        echo "<option $sel>$row[que]</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Security Ans</td>
            <td><input type="text" name="sec_a" value="<?php echo "$_POST[sec_a]";?>"/></td>
        </tr>
        <tr>
            <td><input type="submit" value="Register"/></td>
            <td><input type="reset"/></td>
        </tr>
        <tr>
            <td colspan="2" style="color: red;"><?php echo $err?></td>
        </tr>
    </table>
</form>
<?php require_once 'footer.php';?>