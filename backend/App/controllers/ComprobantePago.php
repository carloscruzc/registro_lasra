<?php

namespace App\controllers;

defined("APPPATH") or die("Access denied");
require_once dirname(__DIR__) . '/../public/librerias/fpdf/fpdf.php';

use \Core\View;
use \Core\Controller;
use \App\models\ComprobantePago as ComprobantePagoDao;
use \App\models\Talleres as TalleresDao;
use \App\models\Register as RegisterDao;

class ComprobantePago extends Controller
{

    private $_contenedor;

    function __construct()
    {
        parent::__construct();
        $this->_contenedor = new Contenedor;
        View::set('header', $this->_contenedor->header());
        View::set('footer', $this->_contenedor->footer());
    }

    public function getUsuario()
    {
        return $this->__usuario;
    }

    public function index()
    {
        $extraHeader = <<<html
html;
        $extraFooter = <<<html
    <!--footer class="footer pt-0">
              <div class="container-fluid">
                  <div class="row align-items-center justify-content-lg-between">
                      <div class="col-lg-6 mb-lg-0 mb-4">
                          <div class="copyright text-center text-sm text-muted text-lg-start">
                              © <script>
                                  document.write(new Date().getFullYear())
                              </script>,
                              made with <i class="fa fa-heart"></i> by
                              <a href="https://www.creative-tim.com" class="font-weight-bold" target="www.grupolahe.com">Creative GRUPO LAHE</a>.
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                              <li class="nav-item">
                                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">privacy policies</a>
                              </li>
                          </ul>
                      </div>
                  </div>
              </div>
          </footer--    >
          <!-- jQuery -->
            <script src="/js/jquery.min.js"></script>
            <!--   Core JS Files   -->
            <script src="/assets/js/core/popper.min.js"></script>
            <script src="/assets/js/core/bootstrap.min.js"></script>
            <script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
            <script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
            <!-- Kanban scripts -->
            <script src="/assets/js/plugins/dragula/dragula.min.js"></script>
            <script src="/assets/js/plugins/jkanban/jkanban.js"></script>
            <script src="/assets/js/plugins/chartjs.min.js"></script>
            <script src="/assets/js/plugins/threejs.js"></script>
            <script src="/assets/js/plugins/orbit-controls.js"></script>
            
          <!-- Github buttons -->
            <script async defer src="https://buttons.github.io/buttons.js"></script>
          <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
            <script src="/assets/js/soft-ui-dashboard.min.js?v=1.0.5"></script>

          <!-- VIEJO INICIO -->
            <script src="/js/jquery.min.js"></script>
          
            <script src="/js/custom.min.js"></script>

            <script src="/js/validate/jquery.validate.js"></script>
            <script src="/js/alertify/alertify.min.js"></script>
            <script src="/js/login.js"></script>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
          <!-- VIEJO FIN -->
   <script>
    $( document ).ready(function() {

          $("#form_vacunacion").on("submit",function(event){
              event.preventDefault();
              
                  var formData = new FormData(document.getElementById("form_vacunacion"));
                  for (var value of formData.values()) 
                  {
                     console.log(value);
                  }
                  $.ajax({
                      url:"/Talleres/uploadComprobante",
                      type: "POST",
                      data: formData,
                      cache: false,
                      contentType: false,
                      processData: false,
                      beforeSend: function(){
                      console.log("Procesando....");
                  },
                  success: function(respuesta){
                      if(respuesta == 'success'){
                         // $('#modal_payment_ticket').modal('toggle');
                         
                          swal("¡Se ha guardado tu prueba correctamente!", "", "success").
                          then((value) => {
                              window.location.replace("/Talleres/");
                          });
                      }
                      console.log(respuesta);
                  },
                  error:function (respuesta)
                  {
                      console.log(respuesta);
                  }
              });
          });

        

      });
</script>

html;

        View::set('tabla', $this->getAllComprobantesPagoById($_SESSION['user_id']));
        View::set('header', $this->_contenedor->header($extraHeader));
        View::render("comprobante_pago_all");
    }




    public function getAllComprobantesPagoById($id_user)
    {

        $html = "";
        foreach (ComprobantePagoDao::getAllComprobantes($id_user) as $key => $value) {

            $total_array = array();
            $array_pro = array();
            $precio = 0;

            // if ($value['status'] == 0) {
            //     // $icon_status = '<i class="fa fad fa-hourglass" style="color: #4eb8f7;"></i>';
            //     $status = '<span class="badge badge-info">En espera de validación</span>';
            // } else if ($value['status'] == 1) {
            //     // $icon_status = '<i class="far fa-check-circle" style="color: #269f61;"></i>';
            //     $status = '<span class="badge badge-success">Aceptado</span>';
            // } else {
            //     // $icon_status = '<i class="far fa-times-circle" style="color: red;"></i>';
            //     $status = '<span class="badge badge-danger">Carga un Archivo PDF valido</span>';
            // }

            if ($value['tipo_pago'] == "Efectivo" || $value['tipo_pago'] == "Transferencia" || $value['tipo_pago'] == "" || $value['tipo_pago'] == "Registro_Becado") {

                $reimprimir_ticket = '<a href="/comprobantePago/ticketImp/' . $value["clave"] . '" class="btn bg-pink btn-icon-only morado-musa-text text-center"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Reimprimir Ticket" target="_blank"><i class="fas fa-file"></i></a>';
            } 
            else if ($value['tipo_pago'] == "Paypal" && empty($value['url_archivo'])) {
                $total_array_paypal = array();
                $nombre_producto = '';

                foreach (ComprobantePagoDao::getAllComprobantesStatusCero($id_user, $value['clave']) as $key => $value) {

              

                    $precio = $value['monto'];

                    array_push($total_array_paypal, $precio);

                    $nombre_producto .= $value['nombre'] . ",";

                    $array_productos = [
                        'id_product' => $value['id_producto']
                    ];

                    array_push($array_pro,$array_productos);
                }

                $array_pro = json_encode($array_pro);

                $total_paypal = array_sum($total_array_paypal);
                $reimprimir_ticket = "<form method='POST'  action='https://www.paypal.com/es/cgi-bin/webscr' data-form-paypal=" . $value['id_pendiente_pago'] . " class='form-paypal'>
                                        <input type='hidden' name='business' value='pagos@grupolahe.com'> 
                                        <input type='hidden' name='item_name' value='" . $nombre_producto . "'> 
                                        <input type='hidden' name='item_number' value='" . $value['clave'] . "'> 
                                        <input type='hidden' name='amount' value='" . $total_paypal . "'> 
                                        <input type='hidden' name='currency_code' value='" . $value['tipo_moneda'] . "'> 
                                        <input type='hidden' name='notify_url' value=''> 
                                        <input type='hidden' name='return' value='https://registro.lasra-mexico.org/OrdenPago/PagoExistoso/?productos=$array_pro'> 
                                        <input type='hidden' name='cmd' value='_xclick'>  
                                        <input type='hidden' name='order' value='" . $value['clave'] . "'>  
                                        <input name='upload' type='hidden' value='1' />              
                                        <button class='btn btn-primary btn-only-icon mt-2 btn_pay_paypal' type='button'>Realizar pago Paypal</button>
                                    </form>";

                $nombre_producto = '';
            } else if ($value['tipo_pago'] == "Paypal" && !empty($value['url_archivo'])) {
                $reimprimir_ticket = '';
            }

            if ($value['tipo_pago'] == "Transferencia" && empty($value['url_archivo']) || $value['status'] == 2) {
                $button_comprobante = '<form method="POST" enctype="multipart/form-data" action="/ComprobantePago/uploadComprobante" data-id-pp=' . $value["id_pendiente_pago"] . '>
                                    <input type="hidden" name="id_pendiente_pago" id="id_pendiente_pago" value="' . $value["id_pendiente_pago"] . '"/>
                                    <input type="hidden" name="clave" id="clave" value="' . $value["clave"] . '"/>
                                    <span class="badge badge-info" style="font-size:8px;">Subir archivo jpg, jpeg, png ó pdf con un tamaño maximo de 5 mb</span>                                    
                                    <input type="file" accept="image/*,.pdf" class="form-control mt-1" id="file-input" name="file-input" style="width: auto; margin: 0 auto;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Subir archivo jpg, jpeg, png ó pdf con un tamaño maximo de 5 mb">
                                    <button class="btn btn-primary btn-only-icon mt-2" type="submit">Subir</button>
                                    </form>';
            } 
            else if($value['tipo_pago'] == "Paypal"){
                $button_comprobante = '';
            }
            else {
                $button_comprobante = '<a href="/comprobantesPago/'.$_SESSION['user_id'].'/' . $value["url_archivo"] . '" class="btn bg-pink btn-icon-only morado-musa-text text-center"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Ver mi comprobante" target="_blank"><i class="fas fa-print"> </i></a>';
            }


            $html .= <<<html
        <tr>
            <td style="width:70%">
                <div class="text-center"> 
html;

            foreach (ComprobantePagoDao::getAllComprobantesbyClave($id_user, $value['clave']) as $key => $value2) {

                

                // if($value2['es_congreso'] == 1 && $value2['clave_socio'] == ""){
                //     $precio = $value2['amout_due'];
                //     // $precio = $value2['precio_publico'];
                // }elseif($value2['es_congreso'] == 1 && $value2['clave_socio'] != ""){
                //     $precio = $value2['amout_due'];
                // }
                // else if($value2['es_servicio'] == 1 && $value2['clave_socio'] == ""){
                //     $precio = $value2['precio_publico'];
                // }else if($value2['es_servicio'] == 1 && $value2['clave_socio'] != ""){
                //     $precio = $value2['precio_socio'];
                // }
                // else if($value2['es_curso'] == 1  && $value2['clave_socio'] == ""){
                //     $precio = $value2['precio_publico'];
                // }else if($value2['es_curso'] == 1  && $value2['clave_socio'] != ""){
                //     $precio = $value2['precio_socio'];
                // }

                $precio = $value2['monto'];
                

                if($value2['comprado_en'] == 1){
                    $comprado_en = '<span style="text-decoration: underline;">Sito web</span>';
                }else if($value2['comprado_en'] == 2){
                    $comprado_en = '<span style="text-decoration: underline;">Caja</span>';
                }else{
                    $comprado_en = '';
                }


                if ($value2['status'] == 0) {
                    $icon_status = '<i class="fa fad fa-hourglass" style="color: #4eb8f7;"></i>';
                    $status = '<span class="badge badge-info">En espera de validación</span>';
                } else if ($value2['status'] == 1) {
                    $icon_status = '<i class="far fa-check-circle" style="color: #269f61;"></i>';
                    $status = '<span class="badge badge-success">Aceptado</span>';
                } else {
                    $icon_status = '<i class="far fa-times-circle" style="color: red;"></i>';
                    $status = '<span class="badge badge-danger">Carga un archivo válido</span>';
                }

                if($value2['status'] == 0 || $value2['status'] == 2){
                    array_push($total_array, $precio);

                    $precio = number_format($precio, 2);
                }else{
                    $reimprimir_ticket = '';
                }
    
                    $html .= <<<html
                        <p>{$icon_status} {$value2['nombre']} $ {$precio} {$comprado_en} - {$status}</p>
html;
                

               
            }
            $total = number_format(array_sum($total_array), 2);
            // <p>{$icon_status} {$value['nombre']}</p>                       
            $html .= <<<html
                </div>
            </td>
     
            

            <td style="text-align:left; vertical-align:middle;" >                 
                <div class="text-center">                
                <p>$ {$total} {$value['tipo_moneda']}</p>
            </div>
          
        </td>

            <td style="text-align:left; vertical-align:middle;" > 
                
                <div class="text-center">
                    <p>{$value['tipo_pago']}</p>
                </div>
            
            </td>  

            <td>
                {$reimprimir_ticket}
            </td>

            
            <td  class="text-center">
               {$button_comprobante}
                
            </td>

    </tr>
html;
        }

        return $html;
    }

    // public function ticketImp($clave)
    // {

    //     date_default_timezone_set('America/Mexico_City');


    //     $metodo_pago = $_POST['metodo_pago'];
    //     $user_id = $_SESSION['user_id'];
    //     // $clave = $this->generateRandomString();
    //     $datos_user = RegisterDao::getUser($this->getUsuario())[0];
    //     $productos = TalleresDao::getTicketUser($user_id, $clave);


    //     $fecha =  date("Y-m-d");       



    //     // $d = $this->fechaCastellano($fecha);

    //     $nombre_completo = $datos_user['nombre'] . " " . $datos_user['apellidom'] . " " . $datos_user['apellidop'];


    //     $pdf = new \FPDF($orientation = 'P', $unit = 'mm', $format = 'A4');
    //     $pdf->AddPage();
    //     $pdf->SetFont('Arial', 'B', 8);    //Letra Arial, negrita (Bold), tam. 20
    //     $pdf->setY(1);
    //     $pdf->SetFont('Arial', 'B', 16);
    //     $pdf->Image('constancias/plantillas/orden.png', 0, 0, 210, 300);
    //     // $pdf->SetFont('Arial', 'B', 25);
    //     // $pdf->Multicell(133, 80, $clave_ticket, 0, 'C');

    //     $espace = 142;
    //     $total = array();
    //     foreach ($productos as $key => $value) {


    //         // if($value['es_congreso'] == 1 && $value['clave_socio'] == ""){
    //         // $precio = $value['amout_due'];
    //         // // $precio = $value['precio_publico'];
    //         // }elseif($value['es_congreso'] == 1 && $value['clave_socio'] != ""){
    //         //     $precio = $value['amout_due'];
    //         // }
    //         // else if($value['es_servicio'] == 1 && $value['clave_socio'] == ""){
    //         //     $precio = $value['precio_publico'];
    //         // }else if($value['es_servicio'] == 1 && $value['clave_socio'] != ""){
    //         //     $precio = $value['precio_socio'];
    //         // }
    //         // else if($value['es_curso'] == 1  && $value['clave_socio'] == ""){
    //         //     $precio = $value['precio_publico'];
    //         // }else if($value['es_curso'] == 1  && $value['clave_socio'] != ""){
    //         //     $precio = $value['precio_socio'];
    //         // }
    //         $precio = $value['monto'];

    //         array_push($total, $precio);

    //         //Nombre Curso
    //         $pdf->SetXY(28, $espace);
    //         $pdf->SetFont('Arial', 'B', 8);
    //         $pdf->SetTextColor(0, 0, 0);
    //         $pdf->Multicell(100, 4, utf8_decode($value['nombre']), 0, 'C');

    //         //Costo
    //         $pdf->SetXY(129, $espace);
    //         $pdf->SetFont('Arial', 'B', 8);
    //         $pdf->SetTextColor(0, 0, 0);
    //         $pdf->Multicell(100, 4, '$ ' . $precio . ' ' . $value['tipo_moneda'], 0, 'C');

    //         $espace = $espace + 10;
    //     }

    //     //folio
    //     $pdf->SetXY(90, 60);
    //     $pdf->SetFont('Arial', 'B', 13);
    //     $pdf->SetTextColor(0, 0, 0);
    //     $pdf->Multicell(100, 10, $datos_user['referencia'], 0, 'C');

    //     //fecha
    //     $pdf->SetXY(88, 70);
    //     $pdf->SetFont('Arial', 'B', 13);
    //     $pdf->SetTextColor(0, 0, 0);
    //     $pdf->Multicell(100, 10, $fecha, 0, 'C');

    //     //nombre
    //     $pdf->SetXY(88, 80);
    //     $pdf->SetFont('Arial', 'B', 13);
    //     $pdf->SetTextColor(0, 0, 0);
    //     $pdf->Multicell(100, 10, utf8_decode($nombre_completo), 0, 'C');

    //      //total
    //     // $pdf->SetXY(118, 170);
    //     // $pdf->SetFont('Arial', 'B', 8);  
    //     // $pdf->SetTextColor(0, 0, 0);
    //     // $pdf->Multicell(100, 10, 'TOTAL : '.number_format(array_sum($total),2), 0, 'C');

    //     $pdf->Output();
    //     // $pdf->Output('F','constancias/'.$clave.$id_curso.'.pdf');

    //     // $pdf->Output('F', 'C:/pases_abordar/'. $clave.'.pdf');
    // }

    public function ticketImp($clave)
    {

        date_default_timezone_set('America/Mexico_City');


        $user_id = $_SESSION['user_id'];
        // $clave = $this->generateRandomString();
        $datos_user = RegisterDao::getUser($this->getUsuario())[0];
        $productos = TalleresDao::getTicketUser($user_id, $clave);


        $fecha =  date("Y-m-d"); 
        
        $fecha_limite = date("d-m-Y",strtotime($fecha."+ 5 days"));

        // $d = $this->fechaCastellano($fecha);

        $nombre_completo = $datos_user['nombre'] . " " . $datos_user['apellidom'] . " " . $datos_user['apellidop'];


        $pdf = new \FPDF($orientation = 'P', $unit = 'mm', $format = 'A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 8);    //Letra Arial, negrita (Bold), tam. 20
        $pdf->setY(1);
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Image('constancias/plantillas/orden2.png', 0, 0, 210, 300);
        // $pdf->SetFont('Arial', 'B', 25);
        // $pdf->Multicell(133, 80, $clave_ticket, 0, 'C');

        $espace = 142;
        $total = array();
        foreach ($productos as $key => $value) {


            $precio = $value['monto'];

            $metodo_pago = $value['tipo_pago'];

            $tipo_moneda = $value['t_moneda'];

            array_push($total, $precio);

            // //Nombre Curso
            // $pdf->SetXY(28, $espace);
            // $pdf->SetFont('Arial', 'B', 8);
            // $pdf->SetTextColor(0, 0, 0);
            // $pdf->Multicell(100, 4, utf8_decode($value['nombre']), 0, 'C');

            // //Costo
            // $pdf->SetXY(129, $espace);
            // $pdf->SetFont('Arial', 'B', 8);
            // $pdf->SetTextColor(0, 0, 0);
            // $pdf->Multicell(100, 4, '$ ' . $precio . ' ' . $value['tipo_moneda'], 0, 'C');

            $espace = $espace + 10;
        }

        //folio
        $pdf->SetXY(3, 137);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Multicell(80, 10, $clave.'-'.$user_id, 0, 'C');

        //fecha
        $pdf->SetXY(6, 152);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Multicell(100, 10, $fecha_limite, 0, 'C');

        //nombre
        $pdf->SetXY(10, 61);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Multicell(100, 10, utf8_decode($nombre_completo), 0, 'C');

        //metodo pago
        $pdf->SetXY(16, 68);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Multicell(80, 10, utf8_decode($metodo_pago), 0, 'C');



        // total
        $pdf->SetXY(2, 144.5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Multicell(100, 10, number_format(array_sum($total), 2) . ' '.$tipo_moneda, 0, 'C');

        $pdf->Output();
        // $pdf->Output('F','constancias/'.$clave.$id_curso.'.pdf');

        // $pdf->Output('F', 'C:/pases_abordar/'. $clave.'.pdf');
    }

    public function uploadComprobante()
    {
        $numero_rand = $this->generateRandomString();
        $id_pendiente_pago = $_POST['id_pendiente_pago'];
        $clave = $_POST['clave'];
        $file = $_FILES["file-input"];
        $name_archivo = '';


        $formatos_permitidos_img = array("image/jpg", "image/jpeg", "image/gif", "image/png");

        if (in_array($_FILES['file-input']['type'], $formatos_permitidos_img)) {
            
            $tipos  = $_FILES['file-input']['type'];
            $tipo = explode("/", $tipos);  
            $name_archivo = $numero_rand.'.'.$tipo[1];
        }else{
            $name_archivo = $numero_rand.'.pdf';
        }

        $nombre_fichero = 'comprobantesPago/'.$_SESSION['user_id'];


        if (!file_exists($nombre_fichero)) {
            mkdir('comprobantesPago/'.$_SESSION['user_id'], 0777, true);
        } 

        if ($file['name'] != "") {

            // if (move_uploaded_file($file["tmp_name"], "comprobantesPago/" . $numero_rand . ".pdf")) {
            if (move_uploaded_file($file["tmp_name"], "comprobantesPago/".$_SESSION['user_id']."/" . $name_archivo)) {

                $documento = new \stdClass();
                $documento->_id_pendiente_pago = $id_pendiente_pago;
                $documento->_clave = $clave;
                $documento->_url = $name_archivo;

                $id = ComprobantePagoDao::updateComprobante($documento);

                if ($id) {

                    // $data = [
                    //     'status' => 'success',
                    //     'img' => $numero_rand.'.png'
                    // ];
                    // echo "success";
                    echo "<script>
                     alert('Archivo subido correctamente');
                    window.location.href = /ComprobantePago/;
                </script>";
                } else {
                    // echo "fail";
                    echo "<script>
                         alert('Hubo un error al subir el archivo');
                        window.location.href = /ComprobantePago/;
                    </script>";

                    // $data = [
                    //     'status' => 'fail'

                    // ];
                }
            }else{
                echo "<script>
                         alert('Hubo un error al subir el archivo');
                        window.location.href = /ComprobantePago/;
                    </script>";
            }
            // move_uploaded_file($file["tmp_name"], "comprobantesPago/".$numero_rand.".pdf");

            // echo json_encode($data);


        } else {
            echo "<script>
                 alert('No selecciono ningun archivo');
                window.location.href = /ComprobantePago/;
            </script>";
        }
    }

    function fechaCastellano($fecha)
    {
        $fecha = substr($fecha, 0, 10);
        $numeroDia = date('d', strtotime($fecha));
        $dia = date('l', strtotime($fecha));
        $mes = date('F', strtotime($fecha));
        $anio = date('Y', strtotime($fecha));

        $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
        $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $nombredia = str_replace($dias_EN, $dias_ES, $dia);
        $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mes);

        return $nombredia . " " . $numeroDia . " de " . $nombreMes . " de " . $anio;
    }

    function generateRandomString($length = 10)
    {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }
}
