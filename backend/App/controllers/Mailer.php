<?php

namespace App\controllers;

defined("APPPATH") or die("Access denied");
require dirname(__DIR__) . '/../public/librerias/PHPMailer/Exception.php';
require dirname(__DIR__) . '/../public/librerias/PHPMailer/PHPMailer.php';
require dirname(__DIR__) . '/../public/librerias/PHPMailer/SMTP.php';

use \Core\MasterDom;
use \Core\Controller;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class Mailer
{


    public function mailer($msg)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'mujersalud2022@gmail.com';                     //SMTP username
            $mail->Password   = 'grupolahe664';                               //SMTP password
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPAutoTLS = false;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($msg['email'], 'MUSA 2022 Registro');
            $mail->addAddress($msg['email'], 'a');     //Add a recipient


            $html = '     
    <!DOCTYPE html>
        <html lang="en">

        <!-- Define Charset -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <!-- Responsive Meta Tag -->
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">

        <title>Email Template</title>

        <!-- Responsive and Valid Styles -->
        <style type="text/css">
            body {
                width: 100%;
                background-color: #FFF;
                margin: 0;
                padding: 0;
                -webkit-font-smoothing: antialiased;
                font-family: arial;
            }

            html {
                width: 100%;
            }
            .container{
                width: 80%;
                padding: 20px;
                margin: 0 auto;
                
            }

            img{
                width: 100%;
            }

        
        </style>

        </head>

        <body leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
                    
            <div class="container">
                <img src="https://registro.foromusa.com/img/musa-01.png" alt="">
                <br>
                <p>
                    Estamos ansiosos de volverlo a ver…
                </p>
                <p>
                    Este mensaje se le envió porque usted está intentando registrar su cuenta de correo electrónico a <b>Mujer Salud 2022 - MUSA</b>. Si no fue usted ignore este mensaje.
                </p>
                
                <p>
                    Copie este código de verificación y péguelo en el formulario de la plataforma a la que usted está intentando registrarse.
                </p>

                <p>
                    Su código es: <span><b style="background: #e389;">'. $msg['code'] .'</b></span>
                </p>
                <p>
                    El código es válido por 24 horas y sólo se puede usar una vez, atentamente su equipo ADIUM.
                </p> 
                
            </div>
            
                
        </body>

</html>';

            // $message = "<img src='https://convencionasofarma2022.mx/img/img_email.jpeg'/>";
            // $message .= "<h5>¡Thank you for submitting your pre-registration form!</h5>";
            // $message .= "<h5>" . $msg['code'] . "</h5><br>";

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Código de Registro';
            $mail->Body    = $html;
            $mail->CharSet = 'UTF-8';

            $mail->send();
        //    echo 'El mensaje ha sido enviado';
            
        } catch (Exception $e) {
            // echo "No se pudo enviar el email: {$mail->ErrorInfo}";
        }
    }

    public function mailerPago($msg)
    {
        $mail = new PHPMailer(true);
        
        $fecha_limite = date("d-m-Y",strtotime($msg['fecha_limite_pago']."+ 5 days"));
        

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'anestesiaregisonal@gmail.com';                     //SMTP username
            $mail->Password   = 'rtjkdhbmxkohnsmd';                               //SMTP password
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPAutoTLS = false;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($msg['email'], 'LASRA 2022 Registro');
            $mail->addAddress($msg['email'], 'a');     //Add a recipient

           


            $html = '     
            <!DOCTYPE html>
            <html lang="en">
    
            <!-- Define Charset -->
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
            <!-- Responsive Meta Tag -->
            <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
    
            <title>Email Template</title>
    
            <!-- Responsive and Valid Styles -->
            <style type="text/css">
                body {
                    width: 100%;
                    background-color: #FFF;
                    margin: 0;
                    padding: 0;
                    -webkit-font-smoothing: antialiased;
                    font-family: arial;
                }
    
                html {
                    width: 100%;
                }
                .container{
                    width: 80%;
                    padding: 20px;
                    margin: 0 auto;
                    
                }
    
                img{
                    width: 100%;
                }
    
            
            </style>
    
            </head>
    
            <body leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
                        
                <div class="container">
                    <img src="https://registro.foromcom/img/musa-01.png" alt="">
                    <br>
                    <p>
                        ¡Gracias por completar su formulario de registro!
                    </p>
                    <p>
                        <b>Estimado :</b>'.$msg['nombre'].'
                    </p>
                    <p>
                       <b>Método de pago:</b>'.$msg['metodo_pago'].' 
                    </p>
                    
                    <p>
                        <b>Imprima este formato para su depósito en cualquier banco.</b>
                    </p>
    
                    <p>
                        a) Número de cuenta: 0110402915
                        <br>
                        b)	Banco: BBVA
                        <br>
                        c)	Nombre: LASRA MÉXICO AC
                    </p>
                    <p>
                        <b>Referencia:</b> '.$msg['referencia'].'
                        <br>
                        <b>Importe a pagar:</b> $ '.$msg['importe_pagar'].' MXN
                        <br>
                        <b>Fecha límite de pago:</b> '.$fecha_limite.' 
                        
                    </p>
                    
                    <p>
                        Recuerde que su lugar en el congreso no se confirmará hasta que se reciba el pago completo y se le haya enviado un correo electrónico de confirmación. Las reservas incompletas se cancelarán después de la fecha límite de pago indicada anteriormente.
                    </p>
    
                    
                    
                </div>
                
                    
            </body>
    
    </html>';

            // $message = "<img src='https://convencionasofarma2022.mx/img/img_email.jpeg'/>";
            // $message .= "<h5>¡Thank you for submitting your pre-registration form!</h5>";
            // $message .= "<h5>" . $msg['code'] . "</h5><br>";

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->addAttachment("comprobantesPago/".$msg['clave'].".pdf");
            $mail->Subject = 'Preregistro LASRA';
            $mail->Body    = $html;
            $mail->CharSet = 'UTF-8';

            $mail->send();
        //    echo 'El mensaje ha sido enviado';
            
        } catch (Exception $e) {
            // echo "No se pudo enviar el email: {$mail->ErrorInfo}";
        }
    }

    public function mailerPagoPlataforma($msg)
    {
        $mail = new PHPMailer(true);
        
        $fecha_limite = date("d-m-Y",strtotime($msg['fecha_limite_pago']."+ 5 days"));
        

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'anestesiaregisonal@gmail.com';                     //SMTP username
            $mail->Password   = 'rtjkdhbmxkohnsmd';                               //SMTP password
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPAutoTLS = false;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($msg['email'], 'LASRA 2022 Registro');
            $mail->addAddress($msg['email'], 'a');     //Add a recipient

           


            $html = '     
            <!DOCTYPE html>
            <html lang="en">
    
            <!-- Define Charset -->
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
            <!-- Responsive Meta Tag -->
            <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
    
            <title>Email Template</title>
    
            <!-- Responsive and Valid Styles -->
            <style type="text/css">
                body {
                    width: 100%;
                    background-color: #FFF;
                    margin: 0;
                    padding: 0;
                    -webkit-font-smoothing: antialiased;
                    font-family: arial;
                }
    
                html {
                    width: 100%;
                }
                .container{
                    width: 80%;
                    padding: 20px;
                    margin: 0 auto;
                    
                }
    
                img{
                    width: 100%;
                }
    
            
            </style>
    
            </head>
    
            <body leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
                        
                <div class="container">
                    <img src="https://registro.foromcom/img/musa-01.png" alt="">
                    <br>
                    <p>
                        ¡Se ha generado tu formato de pago!
                    </p>
                    <p>
                        <b>Estimado :</b>'.$msg['nombre'].'
                    </p>
                    <p>
                       <b>Método de pago:</b>'.$msg['metodo_pago'].' 
                    </p>
                    
                    <p>
                        <b>Imprima este formato para su depósito en cualquier banco.</b>
                    </p>
    
                    <p>
                        a) Número de cuenta: 0110402915
                        <br>
                        b)	Banco: BBVA
                        <br>
                        c)	Nombre: LASRA MÉXICO AC
                    </p>
                    <p>
                        <b>Referencia:</b> '.$msg['referencia'].'
                        <br>
                        <b>Importe a pagar:</b> $ '.$msg['importe_pagar'].' MXN
                        <br>
                        <b>Fecha límite de pago:</b> '.$fecha_limite.' 
                        
                    </p>
                    
                    <p>
                        Recuerde que su lugar en el congreso no se confirmará hasta que se reciba el pago completo y se le haya enviado un correo electrónico de confirmación. Las reservas incompletas se cancelarán después de la fecha límite de pago indicada anteriormente.
                    </p>
    
                    
                    
                </div>
                
                    
            </body>
    
    </html>';

            // $message = "<img src='https://convencionasofarma2022.mx/img/img_email.jpeg'/>";
            // $message .= "<h5>¡Thank you for submitting your pre-registration form!</h5>";
            // $message .= "<h5>" . $msg['code'] . "</h5><br>";

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Formato de pago LASRA';
            $mail->Body    = $html;
            $mail->CharSet = 'UTF-8';

            $mail->send();
           // echo 'El mensaje ha sido enviado';
            
        } catch (Exception $e) {
            //echo "No se pudo enviar el email: {$mail->ErrorInfo}";
        }
    }


    public function mailerRegister($msg)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'mujersalud2022@gmail.com';                     //SMTP username
            $mail->Password   = 'grupolahe664';                               //SMTP password
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPAutoTLS = false;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($msg['email'], 'MUSA 2022 Registro');
            $mail->addAddress($msg['email'], 'a');     //Add a recipient

            $html = '     
            <!DOCTYPE html>
                <html lang="en">
        
                <!-- Define Charset -->
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
                <!-- Responsive Meta Tag -->
                <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
        
                <title>Email Template</title>
        
                <!-- Responsive and Valid Styles -->
                <style type="text/css">
                    body {
                        width: 100%;
                        background-color: #FFF;
                        margin: 0;
                        padding: 0;
                        -webkit-font-smoothing: antialiased;
                        font-family: arial;
                    }
        
                    html {
                        width: 100%;
                    }
                    .container{
                        width: 80%;
                        padding: 20px;
                        margin: 0 auto;
                        
                    }
        
                    img{
                        width: 100%;
                    }
        
                
                </style>
        
                </head>
        
                <body leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
                    
                    <div class="container">
                    <img src="https://registro.foromusa.com/img/musa-01.png" alt="">
                        <p style="text-align: center !important;">
                            Estimado, ' . $msg['name'] . ' : 
                            <strong>¡Su registro a MUSA fue exitoso! </strong>
                        </p>
                    </div>
                    
                        
                </body>
        
        </html>';
        

            // $message = "<img src='https://convencionasofarma2022.mx/img/img_email.jpeg'/>";
            // $message .= "<h2>Estimado " . $msg['nombre'] . "</h2><br>";
            // $message .= "<h5>Se ha generado tu registro exitosamente</h5><br>";


            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Registro';
            $mail->Body    = $html;
            $mail->CharSet = 'UTF-8';


            $mail->send();
            // echo 'El mensaje ha sido enviado';
        } catch (Exception $e) {
            // echo "No se pudo enviar el email: {$mail->ErrorInfo}";
        }
    }

    
}
