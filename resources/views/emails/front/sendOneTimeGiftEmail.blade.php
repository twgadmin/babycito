<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" style="font-family:arial, 'helvetica neue', helvetica, sans-serif"> 
 <head> 
  <meta charset="UTF-8"> 
  <meta content="width=device-width, initial-scale=1" name="viewport"> 
  <meta name="x-apple-disable-message-reformatting"> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <meta content="telephone=no" name="format-detection"> 
  <title>Your Order Has Been Received</title>
  <!--[if (mso 16)]>
    <style type="text/css">
    a {text-decoration: none;}
    </style>
    <![endif]--><!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--><!--[if gte mso 9]>
<xml>
    <o:OfficeDocumentSettings>
    <o:AllowPNG></o:AllowPNG>
    <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
</xml>
<![endif]--> 
<style type="text/css">
a { text-decoration: none; }
.eHeader { background-color: #3cb488; text-align: center; padding: 30px 20px; }
.eHeader .logo { width: 100%; max-width: 264px; display: block; margin: 0 auto; }
.eHeader .logo img { width: 100%; height: auto; display: block; }
.eContent { background-color: #fff; text-align: center; padding: 30px 20px; }
.eContent,
.eContent p { font-size: 16px; line-height: 24px; color: #4c4f51; text-align: center; }
.eContent strong { font-weight: 600; }
.eContent .green { color: #3cb488; }
.eFooter { padding: 30px 20px; background-color: #000; font-size: 12px; line-height: 20px; color: #fff; text-align: center; }
.eFooter ul { list-style: none; margin: 0 auto 15px; padding: 0; display: table; }
.eFooter ul li { font-weight: 400; font-size: 12px; line-height: 20px; color: #fff; margin: 0 5px; padding: 0; float: left; }
.eFooter ul li a { color: inherit; text-decoration: none; }
.eFooter a:hover { color: #3cb488; }
.eFooter .copyrights { font-weight: 400; font-size: 12px; line-height:20px; color: #fff; margin: 0; padding: 0; }
.eFooter .copyrights a { font-weight: 600; color: #3cb488; }
</style> 
</head> 
<body data-new-gr-c-s-loaded="14.1068.0" style="width:100%;font-family: Arial, Helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;margin:0"> 
  <div class="es-wrapper-color" style="background-color:#F6F6F6"><!--[if gte mso 9]>
		<v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
			<v:fill type="tile" color="#f6f6f6"></v:fill>
			</v:background>
		<![endif]--> 
        <table style="width:100%;max-width:560px;margin:0 auto;">
            <tr> 
                <td class="eHeader" style="background-color: #3cb488; text-align: center; padding: 30px 20px;">
                    <a target="_blank" href="#" class="logo" style="width: 100%; max-width: 264px; display: block; margin: 0 auto;"><img src="{!! asset('assets/frontend/images/logo-white.png') !!}" alt="" style="width: 100%; height: auto; display: block;" /></a>
                </td>
            </tr>
            <tr>
                <td class="eContent" style="background-color: #fff; text-align: center; padding: 30px 20px; font-size: 16px; line-height: 24px; color: #4c4f51; text-align: center;">
                    <p style="font-size: 16px; line-height: 24px; color: #4c4f51; text-align: center;">Hi <strong class="green" style="font-weight: 600; color: #3cb488;">{{ $receivername }}</strong>,</p>
                    <p style="font-size: 16px; line-height: 24px; color: #4c4f51; text-align: center;">{{ $sendername }} sent you a {{ '$'.$amount.".00" }} gift.</p>
                    <p style="font-size: 16px; line-height: 24px; color: #4c4f51; text-align: center;">"{{ $messages }}"</p>
                    <a style="display: table; background-color: #3cb488; margin: 0 auto 15px; padding: 5px 15px; font-weight: 700; font-size: 20px; line-height: 30px; color: #fff; text-transform: uppercase; border-radius: 3px;" href="{{ $urldata }}">Receive Gift</a>
                    <p style="font-size: 16px; line-height: 24px; color: #4c4f51; text-align: center;">Thanks,</p>
                    <p style="font-size: 16px; line-height: 24px; color: #4c4f51; text-align: center;"><strong style="font-weight: 600;">Best Regards,<br /><span class="green" style="color: #3cb488;">{{ config('app.name') }}</span></strong></p>
                </td>
            </tr>
            <tr>
                <td class="eFooter" style="padding: 30px 20px; background-color: #000; font-size: 12px; line-height: 20px; color: #fff; text-align: center;">
                    <ul style="list-style: none; margin: 0 auto 15px; padding: 0; display: table;">
                        <li style="font-weight: 400; font-size: 12px; line-height: 20px; color: #fff; margin: 0 5px; padding: 0; float: left;"><a style="color: inherit; text-decoration: none;" target="_blank" href="{!! route('contact-us') !!}">Contact us</a></li>
                        <li style="font-weight: 400; font-size: 12px; line-height: 20px; color: #fff; margin: 0 5px; padding: 0; float: left;"><a style="color: inherit; text-decoration: none;" target="_blank" href="{!! route('terms-and-conditions') !!}">Terms & Conditions</a></li>
                        <li style="font-weight: 400; font-size: 12px; line-height: 20px; color: #fff; margin: 0 5px; padding: 0; float: left;"><a style="color: inherit; text-decoration: none;" target="_blank" href="{!! route('privacy-policy') !!}">Privacy Policy</a></li>
                    </ul>
                    <p class="copyrights" style="font-weight: 400; font-size: 12px; line-height:20px; color: #fff; margin: 0; padding: 0;">&copy; {!! date('Y') !!} <a href="{!! route('public.index') !!}" style="font-weight: 600; color: #3cb488;">BabyCito</a>. All rights reserved.</p>
                </td>
            </tr>
        </table>

  </div>  
 </body>
</html>