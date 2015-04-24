<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SiAsCont - Registrese para ingresar</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo site_url() ?>/css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo site_url() ?>/css/sb-admin-2/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo site_url() ?>/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!-- jQuery -->
    <script src="<?php echo site_url() ?>/js/jquery/dist/jquery.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading" style="background-color: #aeef97; color: #666666;">
                        <br>
                        <h1 class="panel-title" style="font-size: 1.4em;"><center>Sistema de Asistencia Contable v 0.3</center></h1>
                        <br>
<!--                        <h4 ><center>Login</center></h4>-->
                    </div>
                    <div class="panel-body">
                        <?php echo form_open('login/isValid', array('id' => 'formlogin')); ?>
<!--                        <form id="formlogin" action="< ?= site_url('login/isValid') ?>" method="POST"  role="form">-->
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" tabindex="1" id="txtUsername" name="txtUsername" placeholder="Usuario" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" tabindex="2" id="txtPassword" name="txtPassword" placeholder="Contraseña" type="password" >
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input tabindex="3" id="chkRemember" name="chkRemember" type="checkbox" value="Remember Me">Recuerdame Pe'
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                    <button type="submit" class="btn btn-lg btn-primary btn-block ">Acceder</button>
                            </fieldset>
<!--                        </form>-->
                        <?php echo form_close(); ?>
                        <div class="row-fluid">
                            <center style='color: #c00'><?php if (isset($sMsgError)) echo $sMsgError; ?></center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div >
        <center>Lumbre Consulting - Todos los plagios reservados.</center>
    </div>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo site_url() ?>/js/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>
