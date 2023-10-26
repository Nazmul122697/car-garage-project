<!DOCTYPE htmlPUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DOF</title>
    <style type="text/css">
        body {
          background-color: #cccccc;
          margin: 0;
        }
        table {
          border-spacing: 0;
        }
        td {
          padding: 0;
        }
        .main-table {
          position: relative;
          width: 100%;
          max-width: 700px;
          background-color: #fff;
          border-spacing: 0;
          font-family: sans-serif;
          margin: 0 auto;
          padding: 30px;
        }

        img {
          max-width: 100%;
        }
      </style>
  </head>

  <body>
    <center class="all-center">
      <table class="main-table" width="100%">

        <!--bg shape -->
        <tr>
          <td>
            <img class="left_shape" style="width:100%;"
                src="{{$message->embed('email_templete/image/bg.png')}}"
                alt="left-shape" />
          </td>
        </tr>
        <!-- verfication email -->
        <tr>
          <td>
            <h2 style="text-align: center; color: #64a72c; margin-top: 30px">
              VERIFICATION EMAIL
            </h2>
            <br />
            <hr
              style="
                margin-bottom: 60px;
                height: 2px;
                background: black;
                width: 85%;
              "
            />
          </td>
        </tr>
        <!-- email body text -->
        <tr>
          <td style="padding: 0px 50px">
            <h5 style="font-size: 14px">
              <strong>Hello, {{@$data['name']}},</strong>
            </h5>
            <p style="font-size: 14px; margin-bottom: 0">
              To complete your registration, please enter the one-time password
              provided below:
            </p>
            <h5 style="font-size: 14px; margin-bottom: 5px">
              <span>User email: {{@$data['email']}}</span>
            </h5>
            <h5 style="font-size: 14px; margin-bottom: 5px">
              <span>User phone: {{@$data['phone']}}</span>
            </h5>
            <h5 style="font-size: 14px; margin-top: 0">
              <span>Password: {{@$data['password']}}</span>
            </h5>
            <p style="font-size: 14px; line-height: 20px">
              This password is confidential and should not be shared with
              anybody. If the password does not work, please use the link
              provided below.
            </p>
            <h5 style="font-size: 14px"><strong>Link: <a href="{{@$data['reset_link']}}">{{@$data['reset_link']}}</a></strong></h5>
          </td>
        </tr>
        <!-- thank you -->
        <tr>
          <td style="padding: 0px 50px">
            <p style="font-size: 14px; margin-bottom: 0">Thank you,</p>
            <p style="font-size: 14px; margin-top: 0">BFSA</p>
          </td>
        </tr>
      </table>
    </center>
  </body>
</html>
