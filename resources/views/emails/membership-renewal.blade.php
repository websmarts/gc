<!DOCTYPE html>
<html>

<head>
    <title>Membership Renewal Notice</title>
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
                                                <td style="height:100px; text-align:center;color: white; background-color: #66cc44;">
                                                    <p style="font-size:130%; font-weight: bold">{{ $details['organisation_name'] }}</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height:60px; text-align: center">
                                                    <p style="font-size:110%; font-weight:bold">Membership renewal notice for 2020/21</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center">
                                                    <table style="width: 75%">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:20px">&nbsp;</td>
                                                                <td>
                                                                    <p>Dear {{ $details['primary_contact'] }},</p>
                                                                    <p>Just letting you know that the {{ $details['membership_name'] }} membership with {{ $details['organisation_name'] }} will expire {{ $details['subscription_period_end_date'] }}</p>

                                                                    <p style="line-height:2em; text-align: center">To renew your membership please<br> 
                                                                    <a style="font-size:110%" href="{{ route('membership-renewal',['membershipIdHash'=>$details['membership_id_hash']]) }}">visit our subscription renewal page</a> <br>
                                                                    </p>



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
                                                <td style="background-color: #66cc44; color: white; height:65px; padding:10px;text-align: center">
                                                    Neerim District Landcare Group Membership <br>Renewal Service provided by GroupCare
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


</html>