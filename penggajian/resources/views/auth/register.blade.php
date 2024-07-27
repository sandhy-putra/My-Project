<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
      background: #456;
      font-family: 'Open Sans', sans-serif;
    }
    .login {
      width: 400px;
      margin: 16px auto;
      font-size: 16px;
      margin-top:150px;
    }
    /* Reset top and bottom margins from certain elements */
    .login-header,
    .login p {
      margin-top: 0;
      margin-bottom: 0;
    }
    .login-header {
      background: #28d;
      padding: 20px;
      font-size: 1.4em;
      font-weight: normal;
      text-align: center;
      text-transform: uppercase;
      color: #fff;
    }
    .login-container {
      background: #ebebeb;
      padding: 12px;
    }
    /* Every row inside .login-container is defined with p tags */
    .login p {
      padding: 12px;
    }
    .login input {
      box-sizing: border-box;
      display: block;
      width: 100%;
      border-width: 1px;
      border-style: solid;
      padding: 16px;
      outline: 0;
      font-family: inherit;
      font-size: 0.95em;
    }
    .login input[type="email"],
    .login input[type="password"] {
      background: #fff;
      border-color: #bbb;
      color: #555;
    }
    /* Text fields' focus effect */
    .login input[type="email"]:focus,
    .login input[type="password"]:focus {
      border-color: #888;
    }
    .login input[type="submit"] {
      background: #28d;
      border-color: transparent;
      color: #fff;
      cursor: pointer;
    }
    .login input[type="submit"]:hover {
      background: #17c;
    }
    /* Buttons' focus effect */
    .login input[type="submit"]:focus {
      border-color: #05a;
    }
    </style>
</head>
<body>
    <div class="login">
        <h2 class="login-header">Register</h2>
                <form class="login-container" action="{{ route('register') }}" method="post">
                    @csrf
                <p>
                    <input type="text" placeholder="Name" name="name" required>
                </p>
                <p>
                    <input type="email" placeholder="Email" name="email" required>
                </p>
                <p>
                    <input type="password" placeholder="Password" name="password" required>
                </p>
                <p>
                    <input type="password" name="password_confirmation" placeholder="Password Confirm" required>
                </p>
                <p>
                    <input type="submit" value="Register">
                    <a href="/login" style="text-decoration:none">Login</a>
                </p>
            </form>
    </div>
    
</body>
</html>
