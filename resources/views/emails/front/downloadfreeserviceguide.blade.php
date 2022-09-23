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
            <p><b>Hi {{ $fullname }},</b></p>
            <p>Thank you so much for your interest in babycito and our Service Guide! You can now download the attached PDF file. If you have any questions after reviewing the guide, please don't hesitate to reach out to me (<a href="mailto:lindsay@babycito.co">lindsay@babycito.co</a>) or to set up a free service consultation with me.</p>
            <p>We appreciate your support as we grow our business. We're eager to support you as you grow your family!</p>
            <p>All the best,</p>
            <p>Lindsay Bermudez</p>
            <p>Founder, Chief Executive Mom</p>
            <p><a href="https://calendly.com/babycito/serviceconsultation">set up a free service consultation with me</a></p>
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