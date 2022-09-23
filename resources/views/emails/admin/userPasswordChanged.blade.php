<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <div style="background-color: #f4f4f4; padding:10px; margin:auto; font-family: Arial, Helvetica, sans-serif; line-height:30px; ">
            <img src="{!! asset('assets/frontend/logo.png') !!}" alt="" width="180" style="margin:20px auto;"/>
        <div style="background: #ffffff; margin:10px; padding:10px;">
           <p><b>Hi {{ $first_name .' '. $last_name  }},</b></p>
            <p>Your Password was changed, login details is given below.</p>

            <p>
                <b>Account Type:</b> {{ $user_type }}
                <br />
                <b>Email Address:</b> {{ $email }}
                <br />
                <b>Password:</b> {{ $password }}
            </p>

            <p>Thanks,</p>

            <p>
                <b>Best Regards,</b>
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