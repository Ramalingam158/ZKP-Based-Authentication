<!DOCTYPE html>
<html>
  <head>
    <title>Registration form</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="styles/login.css">
  </head>
  <body>
    <form onsubmit="register()">
      <h1>Registration Form</h1>
      <div class="formcontainer">
      <hr/>
      <div class="container">
        <label for="uname"><strong>Username</strong></label>
        <input type="text" placeholder="Enter your Username" id="uname" required>
        <label for="psw"><strong>Password</strong></label>
        <input type="password" placeholder="Enter your Password" id="psw" required>
        <label for="scb"><strong>Pass Number</strong></label><br>
        <input type="number" min = "0" placeholder="Enter your Pass Number" id="scb" required>
      </div>
      <button type="submit">Register</button>
    </form>
    <a href="login.php">Login here...</a>
    <div class="alert" id = "alert" style="display: none;">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
      <strong>Registration Failed!</strong> This Mail ID alredy exists
    </div>
    <script type="text/javascript">

      const register = () => {
        event.preventDefault();
        const username = document.getElementById('uname').value;
        const password = document.getElementById('psw').value;
        const scrambler = document.getElementById('scb').value;

        const pass = xorStrings(password, scrambler);
        const xmlObj = new XMLHttpRequest();
        xmlObj.onload = function(){
          console.log("Onload function entered");
          if(this.responseText == "true"){
            window.location = "login.php";
          } else {
            document.getElementById("alert").style.display = 'inherit';
            console.log(this.responseText);
          }
        }

        xmlObj.open("POST", "includes/register.inc.php");
        xmlObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlObj.send("uname="+username+"&pass="+pass);
      }

      const xorStrings = (a, b) => {
        let s = '';

        if(a.length < b.length){
          let ptr = 0;
          let length = b.length - a.length;
          for(let i = 0; i < length; i++){
            a += a.charAt(ptr);
            ptr = ptr + 1;
            if(ptr == a.length){
              ptr = 0;
            }
          }
        } else if(a.length > b.length){
          let ptr = 0;
          let length = a.length - b.length;
          for(let i = 0; i < length; i++){
            b += b.charAt(ptr);
            ptr = ptr + 1;
            if(ptr == b.length){
              ptr = 0;
            }
          }
        }

        // use the longer of the two words to calculate the length of the result
        for (let i = 0; i < Math.max(a.length, b.length); i++) {
          // append the result of the char from the code-point that results from
          // XORing the char codes (or 0 if one string is too short)

          s += String.fromCharCode(
            (a.charCodeAt(i) || 0) ^ (b.charCodeAt(i) || 0)
          );
        }

        return s;
      };
    </script>
  </body>
</html>