<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>login otp varification</title>
  <style>
  .btn{background-image: linear-gradient(to right, #f2bf31 0%, #291670 100%);}
  .btn:hover{    background-image: linear-gradient(to right, #291670 0%, #f2bf31 100%);}
  h2{ margin-top:30px; font-size:25px;}
  .social{ padding:10px;}
  .social a{ margin:0 5px;}
  body{font-family: "Open Sans", sans-serif;}
  @media only screen and (max-width: 600px) {
      table{ width:100%!important;}
      
  }
  </style>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  </head>

  <body style=" font-size:15px; margin:0; color:#222;">
  <table style="background:#ddd; width:100%;    height: 100vh;">
    <tr>
      <td><table width="600"  style=" background:#fff; padding-top:20px; margin:auto;">
          <tr>
            <td align="center" style="background:#ddd; padding:10px;">
            Makka Construction
                {{-- <img src="https://portal.richmint.com/images/logo.png"  alt="logo"/> --}}
            </td>
          </tr>
          <tr>
            <td class="name" style="padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:14px;">Hello {{ $data->name }},</td>
          </tr>
    
          <tr>
            <td class="name" style="padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:14px; border-bottom:1px solid #ddd;">Someone has been try to contact you.Please see the user information as below:-</td>
          </tr>
          <tr>
            <td class="name" style="padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:14px; border-bottom:1px solid #ddd;">Name: <b>{{ $data->name }}</b></td>
          </tr>
          <tr>
            <td class="name" style="padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:14px; border-bottom:1px solid #ddd;">Email: <b>{{ $data->email }}</b></td>
          </tr>
          <tr>
            <td class="name" style="padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:14px; border-bottom:1px solid #ddd;">Password: <b> {{$data->password }}</b></td>
          </tr>
          <tr>
            <td class="name" style="padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:14px;"> Best regards,<br />
              Makka Construction<br />
              <a href="#" style="color:#3378bb; text-decoration:none;" target="_blank">Click Here</a></td>
          </tr>
            <tr>
            <td bgcolor="#fff" height="20px" align="center"></td>
          </tr>
          <tr>
            <td bgcolor="#0f1e3d" height="50px" align="center"></td>
          </tr>
        </table></td>
    </tr>
  </table>
  </body>
  </html>'