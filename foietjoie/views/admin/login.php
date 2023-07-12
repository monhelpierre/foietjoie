
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#424242" />
    <title>SE CONNECTER | SAQ-FOI ET JOIE HAITI</title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>backend/assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>backend/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>backend/assets/css/authentication/form-1.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>backend/assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>backend/assets/css/forms/switches.css">
</head>
<body class="form">
    

    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="">SAQ- <a href="javascript:void()"><span class="brand-name">FOI ET JOIE HAITI</span></a></h1>
                        <form class="text-left" action="<?php echo site_url('login') ?>" method="post">
                            <?php
                                if (isset($error_message)) {
                                    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                }
                                ?>
                                <?php
                                if ($this->session->flashdata('message')) {
                                    echo "<div class='alert alert-success'>" . $this->session->flashdata('message') . "</div>";
                                }
                            ?>
                            <div class="form">
                                 <div id="email-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
                                    <input id="username" name="username" type="text" placeholder="Email" value="<?php echo set_value('username')?>">
                                    <span class="text-danger"><?php echo form_error('username'); ?></span>
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Mot de passe">
                                    <span class="text-danger"><?php echo form_error('password'); ?></span>
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper toggle-pass">
                                        <p class="d-inline-block">Voir mot de passe</p>
                                        <label class="switch s-primary">
                                            <input type="checkbox" id="toggle-password" class="d-none">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="field-wrapper">
                                        <button data-toggle="tooltip" data-placement="top" title="SE CONNECTER" type="submit" class="btn btn-primary btn-round" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Please wait..">Se connecter</button>
                                    </div>
                                    
                                </div>

                            <!--     <div class="field-wrapper text-center keep-logged-in">
                                    <div class="n-chk new-checkbox checkbox-outline-primary">
                                        <label class="new-control new-checkbox checkbox-outline-primary">
                                          <input type="checkbox" class="new-control-input">
                                          <span class="new-control-indicator"></span>Rester Connecter
                                        </label>
                                    </div>
                                </div> -->

                                <div class="field-wrapper">
                                    <a href="javascript:void()" class="forgot-pass-link">Mot de passe oublié?</a>
                                </div>

                            </div>
                        </form> 
                        <div class="terms-conditions">
                            <p>© <?= date('Y') ?>  Tous droits reservés. </p>
                        <p><a href="index-2.html">FOI ET JOIE HAITI</a> en Partenariat  avec <a href="javascript:void(0);">MENFP</a> / <a href="javascript:void(0);">BID</a>.</p>
                        </div>                       
                        

                    </div>                    
                </div>
            </div>
        </div>
        <div class="form-image">
            <div class="l-image">
            </div>
        </div>
    </div>
    <script src="<?php echo base_url(); ?>backend/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/assets/js/authentication/form-1.js"></script>

</body>
</html>