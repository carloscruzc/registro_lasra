<title>
    Cursos - APM
</title>
<?php echo $header; ?>
<style>
    .badge-carrito {
        height: 17px;
        width: 17px;
        border-radius: 50%;
        position: relative;
        right: 9px;
        top: -13px;
        font-size: 9px;        
        background-color: red;
        color: white;

    }
</style>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <script language="javascript" type="text/javascript">
        // function textodeiframe(){
        //     var frame = document.getElementById('iframe-video');
        //     var v = frame.contentDocument.getElementsByTagName('video');
        //     // document.getElementById('txt2').value = txt;

        //     // var v = document.getElementById("transmision_prueba");
        //     // v[0].attr('muted',true);
        //     v[0].addEventListener("timeupdate",function(ev){
        //         document.getElementById("time_2").innerHTML = v[0].currentTime;
        //         // console.log(v[0].currentTime);
        //     },true);
        // }

        function textodeiframeJQ(){
            let frame = $('#iframe-video');
            let video = frame.contents().find('video');

            video.prop('muted',true);
            video.prop('autoplay',true);

            video.on('timeupdate', function(){
                $('#time_1').html(video[0].currentTime);
            });
            // console.log(doc);
            // var frame = document.getElementById('iframe-video');
            // var v = frame.contentDocument.getElementsByTagName('video');
            // document.getElementById('txt2').value = txt;

            // var v = document.getElementById("transmision_prueba");
            // v[0].attr('muted',true);
            // v[0].addEventListener("timeupdate",function(ev){
            //     document.getElementById("time_2").innerHTML = v[0].currentTime;
            //     // console.log(v[0].currentTime);
            // },true);
        }
        function textodeiframeJQ2(){
            let frame = $('#iframe-video-2');
            let video = frame.contents().find('video');

            video.prop('muted',true);
            video.prop('autoplay',true);

            video.on('timeupdate', function(){
                $('#time_2').html(video[0].currentTime);
            });
            // console.log(doc);
            // var frame = document.getElementById('iframe-video');
            // var v = frame.contentDocument.getElementsByTagName('video');
            // document.getElementById('txt2').value = txt;

            // var v = document.getElementById("transmision_prueba");
            // v[0].attr('muted',true);
            // v[0].addEventListener("timeupdate",function(ev){
            //     document.getElementById("time_2").innerHTML = v[0].currentTime;
            //     // console.log(v[0].currentTime);
            // },true);
        }

        $(document).ready(function(){
            // textodeiframe();
            textodeiframeJQ();
        })
    </script>
    <nav class="navbar navbar-main navbar-expand-lg position-sticky mt-4 top-1 px-0 mx-4 shadow-none border-radius-xl z-index-sticky" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-2">
                    <li class="breadcrumb-item text-sm">
                        <a class="opacity-3 text-dark" href="javascript:;">
                            <svg width="12px" height="12px" class="mb-1" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>shop </title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#252f40" fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"></path>
                                                <path d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z"></path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/Home/">Inicio</a></li>
                    <li class="breadcrumb-item text-sm">Talleres</li>
                </ol>
            </nav>

            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group"></div>
                </div>

                <!-- <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item d-flex align-items-center">
                        <a href="/Home/" class="nav-link text-body font-weight-bold mx-lg-4 mx-0 px-0">
                            <i class="fa fa-home me-sm-0"></i>
                            <span class="d-sm-inline d-none">Inicio</span>
                        </a>
                    </li>
                </ul>
                
                
                <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item d-flex align-items-center">
                        <a href="/Login/cerrarSession" class="nav-link text-body font-weight-bold px-0">
                            <i class="fa fa-power-off me-sm-1"></i>
                            <span class="d-sm-inline d-none">Logout</span>
                        </a>
                    </li>
                </ul> -->
            </div>

            <!-- <li class="nav-item dropdown pe-2 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell cursor-pointer" style="margin-left: 23px;"></i>
                    <span class="badge text-center" id="num_noti_sin_leer"></span>

                </a>
                <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                    <h5><b>Notificaciones de Sistema</b></h5>
                    <div class="scroll-notif" id="cont-notif">

                    </div>
                </ul>
            </li> -->

            <li class="nav-item d-flex align-items-center">
                <a href="/Talleres/cart" class="nav-link text-body font-weight-bold mx-lg-4 mx-0 px-0">
                    <i class="fa far fa-shopping-cart"></i>
                    <span class="badge-carrito text-center" id="num_prod_carrito"></span>
                </a>
            </li>

            <li class="nav-item d-flex align-items-center">
                <a href="/Home/" class="nav-link text-body font-weight-bold mx-lg-4 mx-0 px-0">
                            <i class="fa fa-home me-sm-0"></i>
                    <span class="d-sm-inline d-none">Inicio</span>
                </a>
            </li>
            <li class="nav-item d-flex align-items-center">            
                <a href="/Login/cerrarSession" class="nav-link text-body font-weight-bold px-0">
                    <i class="fa fa-power-off me-sm-1"></i>
                    <span class="d-sm-inline d-none">Logout</span>
                </a>
            </li>

        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-">
    <input type="hidden" id="user_id" name="user_id" value="<?=$_SESSION['user_id']?>">
        <div class="row mt-0 m-auto">
            <div class="col-lg-1">
            </div>
            <div class="card col-lg-10 mt-lg-5 mt-1" >
                
            <!--Congreso  -->
            <div class="card-header pb-0 p-3">
                    <div class="row">
                    <!-- <img src="/assets/img/cinta_menu.jpeg" style="border-radius: 20px; height: 38px;" alt=""> -->
                    <div style="background-color: rgb( 0 145 135 ); border-radius: 20px; height: 38px;"></div>
                    </div>
                    <h4 class="mb-1 mt-4 text-left"><i class="fa fa-desktop"></i> IV CONGRESO MUNDIAL DE PATOLOGÍA DUAL</h4>
                    <p>(CONGRESO)</p>
                    
                </div>
                
                <div class="card-body p-3">

                    <div class="row mt-3">
                        <?php echo $card_congresos ?>
                    </div>

                    <div hidden class="row mt-4">
                        <div class="col-xl-4 col-md-3 mb-xl-0 mb-4 "></div>
                        <table class="table align-items-center mb-0 table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Nombre</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Fecha de curso</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">¿Tiene costo?</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Modalidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $tabla_cursos ?>
                            </tbody>
                        </table>
                        <div class="col-xl-4 col-md-0 mb-xl-0 mb-4"></div>
                    </div>
                    <!-- <div class="row">
                        <div class="button-row d-flex mt-4 col-12">
                            <a class="btn bg-gradient-light mb-0 js-btn-prev" href="/Home/" title="Prev">Regresar</a>
                        </div>
                    </div> -->
                </div>
            <!-- Fin congreso -->


                <div class="card-header pb-0 p-3">
                    <div class="row">
                    <!-- <img src="/assets/img/cinta_menu.jpeg" style="border-radius: 20px; height: 38px;" alt=""> -->
                    <div style="background-color: rgb( 0 145 135 ); border-radius: 20px; height: 38px;"></div>
                    </div>
                    <h4 class="mb-1 mt-4 text-left"><i class="fa fa-desktop"></i> IV CONGRESO MUNDIAL DE PATOLOGÍA DUAL</h4>
                    <p>(CURSOS TRASCONGRESO)</p>
                    
                </div>
                
                <div class="card-body p-3">
                   

                    <div class="row mt-3">
                        <?php echo $card_cursos ?>
                    </div>

                    <div hidden class="row mt-4">
                        <div class="col-xl-4 col-md-3 mb-xl-0 mb-4 "></div>
                        <table class="table align-items-center mb-0 table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Nombre</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Fecha de curso</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">¿Tiene costo?</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Modalidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $tabla_cursos ?>
                            </tbody>
                        </table>
                        <div class="col-xl-4 col-md-0 mb-xl-0 mb-4"></div>
                    </div>
                    <div class="row">
                        <div class="button-row d-flex mt-4 col-12">
                            <a class="btn bg-gradient-light mb-0 js-btn-prev" href="/Home/" title="Prev">Regresar</a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <br>
        <br>
    </div>
    <br>
    <br>

    <div class="fixed-bottom navbar-dark">
        <!-- <a class="navbar-brand" href="#!">Footer</a> -->
        <?php echo $footer; ?>
    </div>

</main>
<?php echo $modalComprar?>


<script>
    $(document).ready(function(){

        $(".btn_obtener_curso").on("click",function(){
           var id_producto = $(this).val();

            $.ajax({
                url: "/Talleres/AsignarCursoSocio",
                type: "POST",
                data: {id_producto},
                beforeSend: function() {
                    console.log("Procesando....");
                },
                success: function(respuesta) {
                    console.log(respuesta);

                    if(respuesta == "success"){
                        Swal.fire("Se asigno el curso","","success");
                        setTimeout(function(){
                            location.reload();
                        },1000)
                    }else{
                        Swal.fire("Hubo un error al asignar el curso.","Consulte a soporte.","success");
                    }
                    
                },
                error: function(respuesta) {
                    Swal.fire("Hubo un error al asignar el curso.","Consulte a soporte.","success");
                    console.log(respuesta);
                }
            });
            
        })
        
        let identificadorIntervaloDeTiempo;

        function repetirCadaSegundo() {
            identificadorIntervaloDeTiempo = setInterval(mandarMensaje, 1000);
        }

        function mandarMensaje() {
            console.log("Ha pasado 1 segundo.");
        }

        getNumberPorducts();

        $('.heart-not-like').on('click', function(){
            let clave = $(this).attr('data-clave');
            let heart = $(this);

            if (heart.hasClass('heart-like')) {
                heart.removeClass('heart-like').addClass('heart-not-like');
            } else {
                heart.removeClass('heart-not-like').addClass('heart-like');
            }
            console.log('se cambió a like: '+clave);
            $.ajax({
                url: "/Talleres/Likes",
                type: "POST",
                data: {clave},
                beforeSend: function() {
                    console.log("Procesando....");
                },
                success: function(respuesta) {
                    console.log(respuesta);
                    
                },
                error: function(respuesta) {
                    console.log(respuesta);
                }
            });
        })

        $('.heart-like').on('click', function(){
            let clave = $(this).attr('data-clave');
            let heart = $(this);

            if (heart.hasClass('heart-like')) {
                heart.removeClass('heart-like').addClass('heart-not-like');
            } else {
                heart.removeClass('heart-not-like').addClass('heart-like');
            }
            console.log('se cambió a like: '+clave);
            $.ajax({
                url: "/Talleres/Likes",
                type: "POST",
                data: {clave},
                beforeSend: function() {
                    console.log("Procesando....");
                },
                success: function(respuesta) {
                    console.log(respuesta);
                    
                },
                error: function(respuesta) {
                    console.log(respuesta);
                }
            });
        })

       

        $('.metodo_pago').on('change',function(e){
            var tipo = $(this).val();
           
            if(tipo == 'Paypal'){
                // $(".form_compra").attr('action','/OrdenPago/PagarPaypal');
                $(".form_compra").attr('action','https://www.paypal.com/es/cgi-bin/webscr'); 
                $(".btn_comprar").val('Paypal');
                $(".tipo_pago").val('Paypal');
            }else if(tipo == 'Efectivo'){
                $(".form_compra").attr('action','/OrdenPago/ordenPago');
                $(".btn_comprar").val('Efectivo');
                $(".tipo_pago").val('Efectivo');
             
            }

        });

        $(".btn_comprar").on("click",function(e){
            e.preventDefault();
            var tipo = $(this).val();
            var dataId = $(this).attr('data-id');

            if(tipo == 'Efectivo'){
                Swal.fire({
                    title: '¿Quieres comprar el curso?',
                    text: "Una vez que confirmes se emitira tu orden de pago.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Comprar'
                    }).then((result) => {
                    if (result.isConfirmed) {                        
                        $(this).closest(".form_compra").submit();                        
                        setTimeout(function() { 
                            location.reload();
                        }, 1000);    
                    }
                    
                })
                
            }

            else if(tipo == 'Paypal'){
                Swal.fire({
                    title: '¿Quieres comprar el curso?',
                    text: "Una vez que confirmes se enviara a PayPal.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Comprar'
                    }).then((result) => {
                    if (result.isConfirmed) {                                               
                        $(this).closest(".form_compra").submit();
                        $("#form_compra_paypal"+dataId).on("submit",function(event){
                            event.preventDefault();
                            var formData = $(this).serialize();

                            $.ajax({
                                url: "/OrdenPago/PagarPaypal",
                                type: "POST",
                                data: formData,
                                beforeSend: function() {
                                    console.log("Procesando....");
                                },
                                success: function(respuesta) {
                                    console.log("Rregreso respuesta");
                                    console.log(respuesta); 
                                    location.reload(); 
                                    //               


                                },
                                error: function(respuesta) {
                                    console.log(respuesta);
                                }

                            });
                        });

                        $("#form_compra_paypal"+dataId).submit();
                        
                       
                    }
                })
            }else{

                Swal.fire(
                    "Debes seleccionar un metodo de pago.",
                    '',
                    'info'
                );   

            }
            

        });

        $(".btn_cart").on("click",function(){            
            var id_producto = $(this).val();
            $.ajax({
                url: "/Talleres/cartShopping",
                type: "POST",
                dataType: 'json',
                data: {id_producto},
                beforeSend: function() {
                    console.log("Procesando....");
                },
                success: function(respuesta) {
                    console.log(respuesta);

                    Swal.fire(
                        respuesta.msg,
                        '',
                        respuesta.status
                    );   
                    getNumberPorducts();             
                    
                },
                error: function(respuesta) {
                    console.log(respuesta);
                }
            });
        });

        $(".btn_comprar_individual").on("click",function(){
            var id_producto = $(this).val();
            // $(this).prop("data-toggle","modal");            
            
            $.ajax({
                url: "/Talleres/searchProductCart",
                type: "POST",
                dataType: 'json',
                data: {id_producto},
                beforeSend: function() {
                    console.log("Procesando....");
                },
                success: function(respuesta) {
                    console.log(respuesta);
                    
                    if(respuesta.status == "success"){
                        // $(this).attr("data-toggle","modal");
                        $("#comprar-curso"+id_producto).modal('show');
                        
                    }else{
                        Swal.fire(
                            respuesta.msg,
                            '',
                            respuesta.status
                        );
                    }                
                                
                    
                },
                error: function(respuesta) {
                    console.log(respuesta);
                }
            });


            // $(this).attr("data-toggle","modal");
            // // data-toggle="modal"
            // alert(id_producto);
        })

        // $("#form_compra_paypal").on("submit",function(event){
        //     event.preventDefault();
        //     var formData = $(this).serialize();

        //     $.ajax({
        //         url: "/OrdenPago/PagarPaypal",
        //         type: "POST",
        //         data: formData,
        //         beforeSend: function() {
        //             console.log("Procesando....");
        //         },
        //         success: function(respuesta) {
        //             console.log("Rregreso respuesta");
        //             console.log(respuesta); 
        //             // location.reload(); 
        //             //               


        //         },
        //         error: function(respuesta) {
        //             console.log(respuesta);
        //         }

        //     });
        // });

        function getNumberPorducts(){
            $.ajax({
                url: "/Talleres/getNumberPorducts",
                type: "POST",
                beforeSend: function() {
                    console.log("Procesando....");
                },
                success: function(respuesta) {
                    console.log(respuesta);
                    
                    if(respuesta == 0){
                        $("#num_prod_carrito").html('');
                    }else{
                        $("#num_prod_carrito").html(respuesta);
                        $("#num_prod_carrito").css("padding", "0.55em 0.9em");
                    }
                    
                },
                error: function(respuesta) {
                    console.log(respuesta);
                }
            });
        }

        

        // repetirCadaSegundo();

        // var v = document.getElementById("transmision_prueba");

        // v.addEventListener("timeupdate",function(ev){
        //     document.getElementById("tiempo_segundos").innerHTML = v.currentTime;
        //     // console.log(v);
        // },true);
    })
    
</script>
