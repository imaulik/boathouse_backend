<!DOCTYPE html>
<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i,900" rel="stylesheet">
        <style type="text/css" rel="stylesheet" media="all">
            /* Media Queries */
            @media only screen and (max-width: 500px) {
                .button {
                    width: 100% !important;
                }
            }
        </style>
    </head>
    <?php
    $style = [
        /* Layout ------------------------------ */

        'body' => 'margin: 0; padding: 0; width: 100%; background-color: #F2F4F6;font-family: "Lato", sans-serif;',
        'email-wrapper' => 'width: 100%; margin: 0; padding: 0; background-color: #F2F4F6;',
        /* Masthead ----------------------- */
        'email-masthead' => 'padding: 0px 0 0; text-align: center;',
        'email-masthead-logo' => 'padding: 0 0 20px; text-align: center;',
        'email-masthead_name' => 'font-size: 16px; font-weight: bold; color: #2F3133; text-decoration: none; text-shadow: 0 1px 0 white; display: inline-block; vertical-align: top; margin: 17px 20px 0 0',
        'email-body' => 'width: 100%; margin: 0; padding: 0; border-top: 1px solid #EDEFF2; border-bottom: 1px solid #EDEFF2; background-color: #FFF;',
        'email-body_inner' => 'width: auto; max-width: 570px; margin: 30px auto; padding: 0; border: 1px solid #ddd; background: #F2F4F6; ',
        'email-body_cell' => 'padding: 15px 20px;',
        'email-footer' => 'width: auto; max-width: 570px; margin: 0 auto; padding: 0; text-align: center;',
        'email-footer_cell' => 'color: #AEAEAE; padding: 0px; text-align: center;',
        /* Body ------------------------------ */
        'body_action' => 'width: 100%; margin: 20px auto; padding: 0; text-align: center;  border: 1px solid #ddd; background: #fff;',
        'body_sub' => 'margin-top: 25px; padding-top: 25px; border-top: 1px solid #EDEFF2;',
        'body_box' => ' border-bottom: 1px solid #ddd; padding: 10px;font-family: "Lato", sans-serif;font-size: 14px; color:#666; text-align: left;border-right: 1px solid #ddd;',
        'body_Box_Last' => ' padding: 15px;font-family: "Lato", sans-serif;font-size: 14px; color:#666; text-align: center;',
        
        /* Type ------------------------------ */
        'anchor' => 'color: #3869D4;',
        'header-1' => 'margin-top: 0; color: rgb(223, 132, 98); font-family: "Lato", sans-serif;font-size: 24px; font-weight: 700; text-align: left;',
        'paragraph' => 'margin-top: 0; color: #74787E; font-size: 14px; line-height: 1.5em;font-family: "Lato", sans-serif; ',
        'paragraph-sub' => 'margin-top: 12px; color: #74787E; font-size: 12px; line-height: 1.5em;',
        'paragraph-center' => 'text-align: center;',
        /* Buttons ------------------------------ */
        'button' => 'display: block; display: inline-block; width: 200px; min-height: 20px; padding: 10px;
                 background-color: #3869D4; border-radius: 3px; color: #ffffff; font-size: 15px; line-height: 25px;
                 text-align: center; text-decoration: none; -webkit-text-size-adjust: none;',
        'button--green' => 'background-color: #22BC66;',
        'button--red' => 'background-color: #dc4d2f;',
        'button--blue' => 'background-color: #3869D4; ',
    ];
    ?>

    <?php $fontFamily = 'font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;'; ?>
    <body style="{{ $style['body'] }}">


        <table width="100%" cellpadding="0" cellspacing="0">

            <tr>
                <td style="{{ $style['email-wrapper'] }}" align="center">
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <!-- Logo -->
                        <tr>
                            <td style="{{ $style['email-masthead'] }}">
                                <a style="{{ $fontFamily }} {{ $style['email-masthead_name'] }}" href="{{ url('/') }}" target="_blank">
                                    <!-- {{ config('app.name') }} -->
                                    <img src="{{asset('http://yieldorg.eworkdemo.com/assets/img/logo.png')}}" alt="" />
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td style="{{ $style['email-body'] }}" width="100%">
                                <table style="{{ $style['email-body_inner'] }}" align="center" width="570" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td style="{{ $fontFamily }} {{ $style['email-body_cell'] }}">
                                            <!-- Greeting -->
                                            <h1 style="{{ $style['header-1'] }}">
                                                @if (! empty($greeting))
                                                {{ $greeting }}
                                                @else
                                                @if ($level == 'error')
                                                Whoops!
                                             
                                                @endif
                                                @endif
                                            </h1>
                                            <p>
                                                <!-- Intro -->
                                                @foreach ($introLines as $line)
                                            <p style="{{ $style['paragraph'] }}">
                                                {{ $line }}
                                            </p>
                                            @endforeach

                                            <!-- Order Details -->
                                            @if (isset($user))
                                            <table border="0" style="{{ $style['body_action'] }}" align="center" width="100%" cellpadding="0" cellspacing="0">
                                                
                                                <tr>
                                                    <td align="center" style="{{ $style['body_box'] }}">
                                                        <b>Username:</b>
                                                    </td>
                                                    <td style="{{ $style['body_box'] }}; border-right: none">
                                                        {{ $user->getUserName() }}
                                                    </td>
                                                </tr><tr>
                                                    <td align="center" style="{{ $style['body_box'] }}">
                                                        <b>Email:</b>
                                                    </td>
                                                    <td style="{{ $style['body_box'] }}; border-right: none">
                                                        {{ $user->getEmail() }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center" style="{{ $style['body_box'] }}">
                                                        <b>Phone:</b>
                                                    </td>
                                                    <td style="{{ $style['body_box'] }}; border-right: none">
                                                        {{ $user->getPhone() }}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td align="center" style="{{ $style['body_box'] }}">
                                                        <b>Type:</b>
                                                    </td>
                                                    <td style="{{ $style['body_box'] }}; border-right: none">
                                                        {{ $user->getRoles()[0]->getName() }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center" style="{{ $style['body_box'] }}">
                                                        <b>Date:</b>
                                                    </td>
                                                    <td style="{{ $style['body_box'] }}; border-right: none">
                                                        {{ $user->getCreated_at() }}
                                                    </td>
                                                </tr>
                                            </table>
                                            @endif

                                            <!-- Outro -->
                                            @foreach ($outroLines as $line)
                                            <p style="{{ $style['paragraph'] }}">
                                                {{ $line }}
                                            </p>
                                            @endforeach

                                            <!-- Salutation -->
                                            <p style="{{ $style['paragraph'] }}">
                                                Best Regards,<br>{{ config('app.name') }}
                                            </p>

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <!-- Footer -->
                        <tr>
                            <td>
                                <table style="{{ $style['email-footer'] }}" align="center" width="570" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td style="{{ $fontFamily }} {{ $style['email-footer_cell'] }}">
                                            <p style="{{ $style['paragraph-sub'] }}">
                                                &copy; {{ date('Y') }}
                                                <a style="{{ $style['anchor'] }}; color: #8dc648;" href="{{ url('/') }}" target="_blank">{{ config('app.name') }}</a>.
                                                All rights reserved.
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html><?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

