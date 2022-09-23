<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <div style="background-color: #f4f4f4; padding:10px; margin:auto; font-family: Arial, Helvetica, sans-serif; line-height:30px; ">
           <img src="{!! asset('assets/frontend/images/logo.png') !!}" alt="" width="180" style="margin:20px auto;"/>
           <div style="background: #ffffff; margin:10px; padding:10px;">
           <p><b>Hi Admin,</b></p>
            <p>A new account has been created, details given below.</p>
            <p>
                <b>First Name:</b> {{ $first_name }}
                <br />
                <b>Last Name:</b> {{ $last_name }}
                <br />
                <b>Phone:</b> {{ $phone }}
                <br />
                <b>Email:</b> {{ $email }}
                <br />
                <b>User Type:</b> {{ $user_type }}
            </p>
            <p>Thanks,</p>
            <br />
            {{ config('app.name') }}
            </p>
        </div>
        <div style="text-align:center; font-size:12px;">
            <a style="color:#373736; text-decoration: none;" href="#">Contact us</a>
            <a style="color:#373736; margin:0 15px;text-decoration: none;"  href="#">Terms & Conditions</a>
            <a style="color:#373736;text-decoration: none;"  href="#">Privacy Policy</a>
            <p style="margin:0px;">© {!! date('Y') !!} Baby Cito All rights reserved.</p>
        </div>
    </div>
</body>
</html>