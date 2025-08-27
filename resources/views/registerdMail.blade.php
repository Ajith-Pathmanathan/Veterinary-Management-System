<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Your App Name</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            background: white;
            padding: 20px;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .header img {
            width: 100%;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .content {
            padding: 20px;
            text-align: left;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #555;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Header with Welcome Image -->
    <div class="header">
        <img src="https://img.freepik.com/free-vector/stylish-welcome-lettering-banner-opening-new-office_1017-50438.jpg" alt="Welcome Image">
    </div>

    <!-- Content -->
    <div class="content">
        <h2>Welcome, {{ $name }}!</h2>
        <p>Your account has been created successfully.</p>
        <p><strong>Email:</strong> {{ $email }}</p>
        <p><strong>Password:</strong> {{ $password }}</p>
        <p>Please login and change your password immediately.</p>

        <!-- Login Button -->
        <a href="{{ url('/login') }}" class="button">Login Now</a>

        <p>Thank you for joining us!</p>
        <p><strong>Your App Name Team</strong></p>
    </div>

    <!-- Footer -->
    <div class="footer">
        &copy; {{ date('Y') }} Your App Name. All rights reserved.
    </div>
</div>
</body>
</html>
