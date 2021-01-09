<!DOCTYPE html>
<html>

<head>
    <title>Please verify your email adddress</title>
</head>

<body>

<table style="width:100%; font-family:'Century Gothic', Arial, sans-serif; font-size: 16px;">
        <tbody>
            <tr>
                <td></td>
                <td width="500" align="center" style="background-color: #eee">
                    <table width="98%" style=" margin-left: auto; margin-right: auto; margin-top: 20px; margin-bottom: 20px; " cellpadding="0" cellspacing="0">
                        <tbody style="background-color: #fff">
                            <tr>
                                <td style="background-color: #ffffff; padding:5px">

                                    <table style="width:100%">
                                        <tbody>
                                            <tr>
                                                <td style="height:100px; text-align:center;color: white; background-color: #014451">
                                                    <p style="font-size:130%; font-weight: bold">Email verification required</p>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td align="center">
                                                    <table style="width: 75%">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:20px">&nbsp;</td>
                                                                <td>
                                                                    <p>Your email address ({{$details['email']}}) has been registered with Groupcare and needs to be verified before it can be used</p>
                                                                    

                                                                    <p style="line-height:2em; text-align: center"> <a style="font-size:110%" href="{{ route('verify-contact-email',['token'=>$details['token']]) }}">Click on this link  to verify your email address now</a>
                                                                    </p>

                                                                    <p>Note: If you do not wish to verify your email for use on Groupcare then just ignore this email and the registration will be discarded without being activated   </p>



                                                                </td>
                                                                <td style="width:20px">&nbsp;</td>

                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style=" color: #444; font-style: italic; height:35px; padding:10px;text-align: center">
                                                    This email has been sent by GroupCare on behalf of Neerim District Landcare Group
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="background-color: #014451; color: white; height:65px; padding:10px;text-align: center">
                                                    Neerim District Landcare Group Membership <br>Management Services provided by GroupCare
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>


                                </td>
                            </tr>


                        </tbody>
                    </table>
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>
</body>
</html>