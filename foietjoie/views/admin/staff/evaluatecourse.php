<div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                                                  
                            <div class="container">
                                <div class="row">
                                    <div id="browser_default" class="col-lg-12 layout-spacing col-md-12">
                                        <div class="statbox widget box box-shadow">
                                            <div class="widget-header">
                                                <div class="row">
                                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                        <h4 class="text-info"><b>Informations personnelles de l'utilisateur</b></h4>
                                                        <span class="btn btn-primary btn-sm pull-right" style="text-align: right;" id="addnewliine">Ajouter une nouvelle question</span>
                                                    </div>                 
                                                </div>
                                            </div>
                                            <div class="widget-content widget-content-area">
                                                <br>
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
                                                <form class="needs-validation" method="post" data-return="<?= base_url('allusers') ?>" novalidate action="<?= base_url('evaluatecourse/'.$id) ?>" id="form_add_evaluate." autocomplete="off">
                                                     <?php echo $this->customlib->getCSRF(); ?> 
                                                    <input type="hidden" name="id" id="id" value="<?php echo $id ?>"> 
                                                    <div class="form-horizontal" id="TextBoxContainer" role="form"></div>                                                                                                         
                                                    <div class="pull-right">
                                                        <button class="btn btn-primary mt-3 save_button" type="submit"> Enregistrer</button>
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