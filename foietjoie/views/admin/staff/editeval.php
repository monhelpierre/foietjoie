<?php
    $CI=&get_instance();
?>

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

                                            <h4 class="text-info"><b>Informations sur l'evaluation</b></h4>

                                            <?php if($onlyshow == null){?>

                                                <span class="btn btn-primary btn-sm pull-right" style="text-align: right;" id="addnewliine">Ajouter une nouvelle question</span>
                                            
                                            <?php }?>

                                        </div>                 

                                    </div>

                                </div>

                                <div class="widget-content widget-content-area"><br>

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

                                    <form class="needs-validation" method="post" data-return="<?= base_url('allusers') ?>" novalidate action="<?= base_url('editevaluation/'.$id) ?>" id="form_add_evaluate." autocomplete="off">

                                        <?php echo $this->customlib->getCSRF(); ?> 

                                            <div class="form-horizontal app" id="TextBoxContainer" role="form">

                                                <?php foreach ($evals as $value): ?>

                                                    <?php 
                                                        $questionsAndAnswers = $CI->decodeJson($value['form']); 
                                                    ?>

                                                    <?php $nb=0; foreach ($questionsAndAnswers as $q): ?>

                                                        <?php 
                                                            $que = $CI->decodeJson($q['questions']) ;

                                                            $choices = $que['choices'];

                                                            $answers = $que['answers'];
                                                        ?>

                                                        <div class="form-row app">

                                                            <input type="hidden" name="i[]" value="<?php echo $nb;?>"/>

                                                                <div class="">

                                                                    <span>&nbsp</span>

                                                                    <span> <?php echo $nb+1; ?> </span>

                                                                    <span>&nbsp</span>

                                                                </div>


                                                                <div class="col-md-5 mb-5">

                                                                    <label for="question_<?php echo $nb;?>">Entrer la question</label>

                                                                    <input <?php echo $onlyshow!=null?'disabled':''; ?> type="text"  id="question_<?php echo $nb;?>" name="question_<?php echo $nb;?>" class="form-control" placeholder="Entrer question" required  value="<?php echo $que['titre']; ?>"/>

                                                                    </br>

                                                                    <div class="col-md-12 row">

                                                                        <input <?php echo $onlyshow!=null?'disabled':''; ?>  type="text"  id="choix1_<?php echo $nb;?>" value="<?php echo $choices[1];?>" name="choix1_<?php echo $nb;?>" class="form-control col-md-6" placeholder="Entrer choix reponse 1" required />

                                                                        <input <?php echo $onlyshow!=null?'disabled':''; ?>  type="text"  id="choix2_<?php echo $nb;?>" value="<?php echo $choices[2];?>" name="choix2_<?php echo $nb;?>" class="form-control col-md-6" placeholder="Entrer choix reponse 2" required />

                                                                    </div>


                                                                    <div class="col-md-12 row">

                                                                        <input <?php echo $onlyshow!=null?'disabled':''; ?>  type="text"  id="choix3_<?php echo $nb;?>" value="<?php echo $choices[3];?>" name="choix3_<?php echo $nb;?>" class="form-control col-md-6" placeholder="Entrer choix reponse 3" required />

                                                                        <input <?php echo $onlyshow!=null?'disabled':''; ?>  type="text"  id="choix4_<?php echo $nb;?>" value="<?php echo $choices[4];?>" name="choix4_<?php echo $nb;?>" class="form-control col-md-6" placeholder="Entrer choix reponse 4" required />

                                                                    </div>

                                                                </div>


                                                                <div class="col-md-5 mb-5">

                                                                    <label for="reponse_<?php echo $nb;?>">Réponse à cette question</label>';

                                                                    <input <?php echo $onlyshow!=null?'disabled':''; ?>  type="text"  id="reponse_<?php echo $nb;?>" value="<?php echo $answers[1];?>" name="reponse_<?php echo $nb;?>" class="form-control" placeholder="Reponse à cette question" required />

                                                                    <div class="col-md-12 row">

                                                                        <input <?php echo $onlyshow!=null?'disabled':''; ?>  type="text"  id="reponse1_<?php echo $nb;?>" value="<?php echo $answers[2];?>" name="reponse1_<?php echo $nb;?>" class="form-control col-md-6" placeholder="Entrer reponse 1"  />

                                                                        <input <?php echo $onlyshow!=null?'disabled':''; ?>  type="text"  id="reponse2_<?php echo $nb;?>" value="<?php echo $answers[3];?>" name="reponse2_<?php echo $nb;?>" class="form-control col-md-6" placeholder="Entrer reponse 2"  />

                                                                    </div>
                                                                        

                                                                    <div class="col-md-12 row">';

                                                                        <input <?php echo $onlyshow!=null?'disabled':''; ?>  type="text"  id="reponse3_<?php echo $nb;?>" value="<?php echo $answers[4];?>" name="reponse3_<?php echo $nb;?>" class="form-control col-md-6" placeholder="Entrer reponse 3"  />

                                                                        <input <?php echo $onlyshow!=null?'disabled':''; ?>  type="text"  id="reponse4_<?php echo $nb;?>" value="<?php echo $answers[4];?>" name="reponse4_<?php echo $nb;?>" class="form-control col-md-6" placeholder="Entrer reponse 4"  />

                                                                    </div>

                                                                </div>

                                                                <?php 

                                                                    if($onlyshow == null){

                                                                        if($nb > 0){?>

                                                                            <div class="col-md-1 mb-1"><button id="btnRemove" style="" title="Supprimer" class="btn btn-sm btn-danger form-control" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button></div>
                                                                
                                                                <?php } }?>

                                                            </div>
                                                                
                                                        <?php $nb++; endforeach; ?>

                                                    <?php endforeach; ?>

                                                </div>                                                                                                         
                                                
                                                <?php if($onlyshow == null){?>

                                                    <div class="pull-right">

                                                        <button class="btn btn-primary mt-3 save_button" type="submit"> Modifier</button>

                                                    </div>

                                                 <?php }?>

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