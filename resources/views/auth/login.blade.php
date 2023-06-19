<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="loginn/images/icons/favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="loginn/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="loginn/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="loginn/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="loginn/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="loginn/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="loginn/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="loginn/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="loginn/css/util.css">
    <link rel="stylesheet" type="text/css" href="loginn/css/main.css">
</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('loginn/images/bg-01.jpg');">
            <div class="wrap-login100 p-t-30 p-b-50">
                <span class="login100-form-title p-b-41">
                    Login
                </span>
                <div class="row" id="alertError" style="display: none;">
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <p>Whoops! Ocurrieron algunos errores</p>
                            <ul id="listaErrores">
                                @error('user_name')
                                    <li>{{ $message }}</li>
                                @enderror
                                @error('user_password')
                                    <li>{{ $message }}</li>
                                @enderror
                            </ul>
                        </div>
                    </div>
                </div>
                <form class="login100-form validate-form p-b-33 p-t-5" id="frmLogin">
                    @csrf
                    <div class="wrap-input100">
                        <input class="input100 @error('username') is-invalid @enderror" type="text" name="username"
                            id="user_name" placeholder="Usuario">
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    </div>

                    <div class="wrap-input100">
                        <input class="input100 @error('password') is-invalid @enderror" type="password" name="password"
                            id="user_password" placeholder="Contraseña">
                        <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="recuerdame" name="recuerdame"
                            value="1">
                        <label class="form-check-label" for="recuerdame">Recuerdame</label>
                    </div>


                    <div class="container-login100-form-btn m-t-32">
                        <button type="submit" class="login100-form-btn" id="btnLogin">
                            Login
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>



    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="loginn/vendor/animsition/js/animsition.min.js"></script>
    <script src="loginn/vendor/select2/select2.min.js"></script>
    <script src="loginn/vendor/daterangepicker/moment.min.js"></script>
    <script src="loginn/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="loginn/vendor/countdowntime/countdowntime.js"></script>
    <script src="loginn/js/main.js"></script>

    <script>
        $(function() {
            enviarLogin();
        });

        var enviarLogin = function() {
            $("#frmLogin").on("submit", function(e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ route('login.validar') }}',
                    method: 'POST',
                    dataType: 'json',
                    data: new FormData($("#frmLogin")[0]),
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $("#alertError").hide();
                        $('#btnLogin').attr("disabled", true);
                        $('#btnLogin').html(
                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Verificando...'
                        );
                    },
                    success: function(data) {
                        if (!data.error) {
                            let mensaje = data.mensaje;
                            let usuario = data.user_name;
                            $("#frmLogin")[0].reset();
                            let timerInterval
                            Swal.fire({
                                title: 'Login Exitoso!',
                                html: 'Ingresando al sistema en <b></b> milisegundos.',
                                timer: 700,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                    const b = Swal.getHtmlContainer().querySelector('b')
                                    timerInterval = setInterval(() => {
                                        b.textContent = Swal.getTimerLeft()
                                    }, 100)
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                            }).then((result) => {
                                /* Read more about handling dismissals below */
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    window.location.href = '{{ route('welcome.index') }}';
                                }
                            });
                        } else {
                            let mensaje = data.mensaje;
                            $("#listaErrores").html('<li>' + mensaje + '</li>');
                            $("#alertError").show();
                        }
                    },
                    error: function(data) {
                        let errores = data.responseJSON.errors;
                        let msjError = '';
                        Object.values(errores).forEach(function(valor) {
                            msjError += '<li>' + valor[0] + '</li>';
                        });
                        $("#listaErrores").html(msjError);
                        $("#alertError").show();
                        $('#btnLogin').text('LOGIN');
                        $('#btnLogin').attr("disabled", false);
                    },
                    complete: function() {
                        $('#btnLogin').text('LOGIN');
                        $('#btnLogin').attr("disabled", false);
                    },
                });
            });
        }
    </script>
</body>

</html>
