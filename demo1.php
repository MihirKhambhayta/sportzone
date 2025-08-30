<html>

<head>
    <title>SportZone Login </title>
    <style>
body
    {
      align-items: center;
      justify-content: center;
      display: flex;
      align-items: center;
      font-family: sans-serif;
      line-height: 1.5;
      min-height: 100vh;
      background: #f3f3f3;
      flex-direction: column;
      margin: 0;
    }   

  .main {
    background-color: #fff;
    border-radius: 15px;
    padding: 10px 20px;
    box-shadow: 0 0 20px burlywood;
    width: 500px;
    text-align: center;
}

h1 {
    color: #4CAF50;
}

label {
    display: block;
    width: 100%;
    margin-top: 10px;
    margin-bottom: 5px;
    text-align: left;
    color: #555;
    font-weight: bold;
}




input {
    display: block;
    width: 100%;
    margin-bottom: 15px;
    padding: 10px;
    box-sizing: border-box;
    border: 1px solid #ddd;
    border-radius: 5px;
}

button {
    padding: 15px;
    border-radius: 10px;
    margin-top: 15px;
    margin-bottom: 15px;
    border: none;
    color: white;
    background-color: #4CAF50;
    width: 100%;
    font-size: 16px;
}

bt {
    
    justify-content: center;
    align-items: center;
}


.password-container {
      position: relative;
      max-width: 300px;
    }

    

    </style>
    
</head>





       <body>
        
    

    <div class="main">
        <h1>Login</h1>
        <h3>Enter your login </h3>

        <form   id="alertp" action="login.php" method="POST">
            <label for="firstname">First Name:</label>
            <input type="firstname" id="firstname" name="firstname" placeholder="Enter your FirstName" required>







            <label for="password">Password:</label>
             <input type="password" id="password" name="password" placeholder="Enter your Password" required>
            



            <script>
  const form = document.getElementById('alertp');

     form.addEventListener('submit', function (e) {
    
    const password = form.password.value;
   

    
    
     if (password.length < 6) {
      e.preventDefault();
      alert("Password must be at least 6 characters.");
      return;
    }


     


  });
</script>




          <div class="bt">
                <button type="submit">  Submit</button>
            </div>
     </form>
        
     <p>Not registered?
            <a href="Registration.html" style="text-decoration: none;">
                Create an account
            </a>
       
        
    
        </div>
    </body>
       
     


</html>