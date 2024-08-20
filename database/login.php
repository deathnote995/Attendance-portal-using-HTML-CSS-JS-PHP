
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <style>
        .loginbtn:hover{
            transform: translateX(-30px);
        }
        </style> -->
        <link rel="stylesheet" href="/PHPATMS/css/login.css">
</head>
    
<body>
    <div class="loginForm">
        <div class="inputGroup">
            <input type="text" id="username" required>
            <label for="username">USER NAME</label>
        </div>
            
        <div class="inputGroup top_margin">
            <input type="password" id="paswd" required>
            <label for="paswd">PASSWORD</label>
        </div>

        <div class="callForAction">
            <button class="loginbtn inactiveColor" id="btnlogin">LOGIN</button>
        </div>
    </div>
    <script src="/PHPATMS/javascript/jquery.js"></script>
    <script src="/PHPATMS/javascript/login.js"></script>
</body>
</html>