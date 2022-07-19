<?php
echo $header;
?>

<body>
    <?php
    $data_user = base64_decode($_GET['d']);
    $data = json_decode($data_user, TRUE);

    // echo $data['usuario'];
    //  var_dump($data_user);


    ?>
    <main class="main-content main-content-bg mt-0">
        <section>
            <nav class="navbar navbar-expand-lg  blur blur-rounded top-0  z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                <div class="container-fluid">
                    <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 ">
                        <img src="/assets/img/logos/amh.png" height="40" alt="">
                        <!-- <img src="/assets/img/logos/waddn.png" style="width: 40px; height: 40px; margin-left: 5px; margin-right: 5px;"> -->
                        XVII Congreso Nacional de Hepatología
                    </a>

                    <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0" id="navigation">
                        <ul class="navbar-nav navbar-nav-hover mx-auto">
                        </ul>
                        <ul class="navbar-nav d-lg-block d-none">
                            <li class="nav-item">
                                <a href="/Inicio/" class="btn btn-sm  bg-gradient-info  btn-round mb-0 me-1" onclick="smoothToPricing('pricing-soft-ui')">INICIAR SESIÓN</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-10 col-lg-10 col-md-12 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-7">
                                <div class="container-fluid py-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="multisteps-form">
                                                <!--progress bar-->
                                                <div class="row" id="card_progress">
                                                    <div class="col-12 col-lg-12 mx-auto my-4">
                                                        <div class="multisteps-form__progress">
                                                            <button class="multisteps-form__progress-btn js-active" title="User Info" disabled>
                                                                <span>Información de usuario</span>
                                                            </button>
                                                            <button class="multisteps-form__progress-btn" title="Others" disabled>Otros</button>
                                                            <!-- <button class="multisteps-form__progress-btn" title="Payment" disabled>Pago</button> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--form panels-->
                                                <div class="row">
                                                    <div class="col-12 col-lg-12 m-auto">
                                                        <form class="multisteps-form__form" id="add" action="/Register/Success" method="POST">
                                                            <!--single form panel-->
                                                            <div id="card_one" class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active" id="card_one" data-animation="FadeIn">
                                                                <h5 class="font-weight-bolder mb-0">INFORMACIÓN PERSONAL</h5>
                                                                <p class="mb-0 text-sm">Completa el siguiente formulario para crear tu cuenta. Los campos marcados con un * son obligatorios.
                                                                    Escribe tu nombre(s) y apellido(s) como deseas que se lea en tu constancia.</p>
                                                                <div class="multisteps-form__content">
                                                                    <br>
                                                                    <p class="mb-0 text-sm">Para crear su cuenta del Congreso, proporcione una dirección de correo electrónico válida.</p>

                                                                    <div class="row mt-3">
                                                                        <div class="col-12 col-sm-6">
                                                                            <label>Correo Electrónico*</label>
                                                                            <input type="hidden" id="codigo_beca" name="codigo_beca" value="<?= $data['codigo_beca'] ?>">
                                                                            <input type="hidden" id="email_register" name="email_register" value="<?= $data['usuario'] ?>">
                                                                            <input type="hidden" id="id_categoria" name="id_categoria" value="<?= $data['id_categoria'] ?>">
                                                                            <input class="multisteps-form__input form-control all_input" type="email" id="email" name="email" placeholder="eg. user@domain.com" autocomplete="no" value="<?= $data['usuario'] ?>" readonly>
                                                                            <span class="mb-0 text-sm" id="error" style="display:none;color:red;">Correo incorrecto</span>
                                                                        </div>
                                                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                                            <label>Confirma tu Correo Electrónico *</label>
                                                                            <input class="multisteps-form__input form-control all_input all_email" type="email" id="confirm_email" name="confirm_email" placeholder="eg. user@domain.com" disabled autocomplete="no" value="<?= $data['usuario'] ?>">
                                                                            <span class="mb-0 text-sm" id="error_confirm" style="display:none;color:red;"><label style="color:red;"> El correo no coincide *</label></span>
                                                                        </div>
                                                                        <input type="hidden" id="email_validado" name="email_validado">

                                                                        <p class="mb-0 text-sm">Todas las notificaciones incluyendo las facuras e información general del evento, solo serán enviadas a este correo electrónico.</p>
                                                                    </div>
                                                                    <div class="row mt-3">
                                                                        <div class="col-12 col-sm-2">
                                                                            <label>Prefijo *</label>
                                                                            <select class="multisteps-form__select form-control all_input_select" name="title" id="title" required disabled>
                                                                                <option value="Dr.">Dr.</option>
                                                                                <option value="Dra.">Dra.</option>
                                                                                <option value="Sr.">Sr.</option>
                                                                                <option value="Sra.">Sra.</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-12 col-sm-4">
                                                                            <label>Nombre *</label>
                                                                            <input class="multisteps-form__input form-control all_input" type="text" id="nombre" name="nombre" maxlength="15" placeholder="eg. Christopher" required disabled value="<?= $data['nombre'] ?>" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" >
                                                                        </div>

                                                                        <div class="col-12 col-sm-5">
                                                                            <label>Primer apellido *</label>
                                                                            <input class="multisteps-form__input form-control all_input" type="text" id="apellidop" name="apellidop" maxlength="15" placeholder="eg. Jones" disabled value="<?= $data['apellidop'] ?>" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" >
                                                                        </div>

                                                                    </div>
                                                                    <div class="row mt-3">

                                                                        <div class="col-12 col-sm-5 mt-3 mt-sm-0">
                                                                            <label>Segundo apellido</label>
                                                                            <input class="multisteps-form__input form-control" type="text" id="apellidom" name="apellidom" maxlength="15" placeholder="eg. Wilson" disabled value="<?= $data['apellidom'] ?>" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" >
                                                                        </div>

                                                                        <div class="col-12 col-sm-4">
                                                                            <label>Teléfono</label>
                                                                            <input class="multisteps-form__input form-control" type="text" id="telephone" name="telephone" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="ej. (555) 555-1234" autocomplete="no" value="<?= $data['telefono'] ?>" disabled>
                                                                        </div>

                                                                    </div>

                                                                    <div class="row mt-3">


                                                                        <div class="col-12 col-sm-4" id="cont-categoria">

                                                                            <label>Categoria *</label>
                                                                            <select class="multisteps-form__select form-control all_input_select" name="categorias" id="categorias" disabled>
                                                                                <option value="" disabled selected>Selecciona una Opción</option>
                                                                            </select>

                                                                        </div>

                                                                        <div class="col-12 col-sm-4" id="cont-especialidades">

                                                                        <label id="label-especialidades">Especialidades *</label>
                                                                            <select class="multisteps-form__select form-control all_input_select" name="especialidades" id="especialidades" disabled>
                                                                                <option value="" disabled selected>Selecciona una Opción</option>
                                                                                
                                                                                <?=$especialidades?>

                                                                            </select>

                                                                        </div>




                                                                        <!-- <div class="col-12 col-sm-4" id="cont-especialidades">

                                                                            <label>Especialidades *</label>
                                                                            <select class="multisteps-form__select form-control all_input_select" name="especialidades" id="especialidades" disabled>
                                                                                <option value="" disabled selected>Selecciona una Opción</option>
                                                                                <option value="Psychiatrist">Psiquiatría</option>
                                                                                <option value="Child_Psychiatry">Psiquiatría infantil</option>
                                                                                <option value="Neurology">Neurología</option>
                                                                                <option value="Pediatric_Neurology">Neurología Pediátrica</option>
                                                                                <option value="Paidapsychiatry">Paidopsiquiatría</option>
                                                                                <option value="Pedagogy">Pedagogía</option>
                                                                                <option value="Psychogeriatrics">Psicogeriatría</option>
                                                                                <option value="Psychology">Psicología</option>
                                                                                <option value="Clinical_psychology">Psicología clínica</option>
                                                                                <option value="Residents">Residentes</option>
                                                                                <option value="Students">Estudiantes</option>
                                                                                <option value="Others">Otros</option>

                                                                            </select>

                                                                        </div> -->


                                                                        <div class="col-12 col-sm-4">
                                                                            <label>País *</label>
                                                                            <select class="multisteps-form__select form-control all_input_select" name="nationality" id="nationality" onchange="actualizaEdos();" disabled>
                                                                               <option value="" disabled selected>Selecciona una Opción</option> 
                                                                                <option value="156">Mexico</option> 
                                                                                <?php echo $idCountry; ?>
                                                                            </select>
                                                                        </div>


                                                                    </div>
                                                                    <div class="row mt-3">

                                                                        <div class="col-12 col-sm-4 mt-3 mt-sm-0">
                                                                            <label>Estado *</label>
                                                                            <select class="multisteps-form__select form-control all_input_select" name="state" id="state" disabled>

                                                                            </select>
                                                                        </div>


                                                                    </div>
                                                                    <div class="button-row d-flex mt-4">
                                                                        <button class="btn bg-gradient-dark ms-auto mb-0" id="btn_next_1" type="submit" title="Next" style="display:none;" disabled>Siguiente</button>
                                                                        <button class="btn bg-gradient-dark ms-auto mb-0" id="btn_next_update" type="button" title="Next" style="display:none;" disabled>Actualizar</button>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal -->
        <footer class="footer pt-12">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            © <script>
                                document.write(new Date().getFullYear())
                            </script>,
                            made with <i class="fa fa-heart"></i> by
                            <a href="" class="font-weight-bold" target="www.grupolahe.com">Creative GRUPO LAHE</a>.
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="#" class="nav-link pe-0 text-muted">privacy policies</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <?php echo $footer; ?>
    </main>


</body>

<script>
    $(document).ready(function() {


        //codigo de beca
        if ($("#codigo_beca").val() == '' || $("#codigo_beca").val() == 0) {
            $("#btn_next_1").show();
            $("#add").attr('action', '/Register/passTwo');
            $("#cont-especialidades").hide();
        }else{
            $("#add").attr('action', '/Register/UpdateData');
            $("#btn_next_update").show();
            $("#cont-categoria").hide();
            $("#cont-especialidades").show();
            // $("#especialidades").css('display','none');
            // $("#label-especialidades").css('display','none');
        }

        $("#btn_next_update").on("click", function() {

            var formData = new FormData(document.getElementById("add"));
            for (var value of formData.values()) {
                console.log(value);
            }

            $.ajax({
                url: "/Register/UpdateData",
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    console.log("Procesando....");


                },
                success: function(respuesta) {
                    console.log(respuesta);
                    if (respuesta == 'success') {
                        Swal.fire("¡Se actualizaron tus datos correctamente!", "", "success").
                        then((value) => {
                            window.location.replace("/Login/");
                        });
                    } else {
                        Swal.fire("¡Usted No Actualizo Nada!", "", "warning").
                        then((value) => {
                            window.location.replace("/Login/")
                        });
                    }
                },
                error: function(respuesta) {
                    console.log(respuesta);
                }

            });

        });


        if ($("#email_register").val() == '') {
            let email = localStorage.getItem("email");

            $("#email").val(email);
            if ($("#email").val() != '') {
                $("#confirm_email").removeAttr('disabled');
            }

            mostrarCategorias();

        } else {
            var email_uno = document.getElementById('email').value;
            var email_dos = document.getElementById('confirm_email').value;
            var id_categoria = $("#id_categoria").val();
            document.getElementById("btn_next_1").disabled = false;
            document.getElementById("btn_next_update").disabled = false;

            if (email_uno == email_dos) {
                document.getElementById('confirm_email').disabled = false;
                document.getElementById('title').disabled = false;
                document.getElementById('apellidop').disabled = false;
                document.getElementById('apellidom').disabled = false;
                document.getElementById('telephone').disabled = false;
                document.getElementById('nationality').disabled = false;
                document.getElementById('state').disabled = false;
                document.getElementById('nombre').disabled = false;
                document.getElementById('categorias').disabled = false;
                document.getElementById('especialidades').disabled = false;
                document.getElementById("email_validado").value = email_uno;

            }

            mostrarCategoriaByUser(id_categoria);

            console.log($("#categorias option:selected").val());

            if (id_categoria == 2) {
                $("#cont-especialidades").show();
            } else {
                $("#cont-especialidades").hide();
            }

        }

        $("#categorias").on("change", function() {
            id_categoria = $(this).val();

            //Especialista y residente
            if (id_categoria == 2 || id_categoria == 3) {
                $("#cont-especialidades").show();
            } else {
                $("#cont-especialidades").hide();
            }
        });




        // $("#linea_principal").on("change", function() {
        //     var linea_principal = $(this).val();

        function mostrarCategorias() {

            $.ajax({
                url: "/Register/getCategorias",
                type: "POST",
                data: {

                },
                dataType: "json",
                beforeSend: function() {
                    console.log("Procesando....");
                    $('#categorias')
                        .find('option')
                        .remove()
                        .end();

                },
                success: function(respuesta) {
                    console.log(respuesta);

                    $('#categorias')
                        .append($('<option>', {
                                value: ''
                            })
                            .text('Selecciona una opción'));


                    $.each(respuesta, function(key, value) {
                        //console.log(key);

                        console.log(value);
                        $('#categorias')
                            .append($('<option>', {
                                    value: value.id_categoria
                                })
                                .text(value.categoria));

                    });

                },
                error: function(respuesta) {
                    console.log(respuesta);
                }

            });

        }




        function mostrarCategoriaByUser(id_categoria) {

            $.ajax({
                url: "/Register/getCategorias",
                type: "POST",
                data: {

                },
                dataType: "json",
                beforeSend: function() {
                    console.log("Procesando....");
                    $('#categorias')
                        .find('option')
                        .remove()
                        .end();

                },
                success: function(respuesta) {
                    console.log(respuesta);

                    $('#categorias')
                        .append($('<option>', {
                                value: ''
                            })
                            .text('Selecciona una opción'));


                    $.each(respuesta, function(key, value) {
                        //console.log(key);
                        var selectedCategoria = value.id_categoria == id_categoria ? 'selected' : '';
                        console.log(value);
                        $('#categorias')
                            .append('<option value="' + value.id_categoria + '" ' + selectedCategoria + '>' + value.categoria + '</option>');
                    });

                },
                error: function(respuesta) {
                    console.log(respuesta);
                }

            });

        }


    });
</script>