<!DOCTYPE html>
<html dir="ltr" lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="/sitev2/assets/images/favicon.png">
    <title>Esperança na Rua - Login</title>
    <link href="/sitev2/dist/css/style.min.css" rel="stylesheet">
</head>

<body>
    <div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
            style="background:url(/sitev2/assets/images/big/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box row">
                <div class="col-lg-7 col-md-5 modal-bg-img"
                    style="background-image: url(/sitev2/assets/images/voluntarios.jpg);">
                </div>
                <div class="col-lg-5 col-md-7 bg-white">
                    <div class="p-3">
                        <div class="text-center">
                            <img src="/sitev2/assets/images/logo-dj.png" alt="wrapkit">
                        </div>
                        <h2 class="mt-3 text-center">Login</h2>
                        <p class="text-center">Entre com seu email e senha para acessar a plataforma.</p>
                        <form class="mt-4" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="email">Email</label>
                                        <input class="form-control" id="email" name="email" type="email"
                                            placeholder="Digite seu email">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="pwd">Senha</label>
                                        <input class="form-control" id="pwd" name="password" type="password"
                                            placeholder="Digite sua senha">
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-block btn-dark">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/sitev2/assets/libs/jquery/dist/jquery.min.js "></script>
    <script src="/sitev2/assets/libs/popper.js/dist/umd/popper.min.js "></script>
    <script src="/sitev2/assets/libs/bootstrap/dist/js/bootstrap.min.js "></script>
    <script>
        $(".preloader ").fadeOut();
    </script>
</body>

</html>
