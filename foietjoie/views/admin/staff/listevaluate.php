<?php
    $CI=&get_instance();
?>

<div class="layout-px-spacing">

    <div class="row layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing table-responsive">

            <div class="widget-content widget-content-area br-6">

                <table id="html5-extension" class="table table-hover non-hoverS" style="width:100%">

                    <a class="btn btn-primary" href="<?= base_url('addcourse') ?>"> Ajouter un cours</a>

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>NOM DU COURS</th>

                            <th>EVALUATION</th>

                            <th>NB DE QUESTIONS</th>

                            <th>DATE D´AJOUT</th>

                            <th class="dt-no-sorting">ACTION</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php $i=1; foreach ($evals as $value): ?>

                            <?php
                                $questionsAndAnswers = $CI->decodeJson($value['form']);  

                                $nbQ = sizeof($questionsAndAnswers);

                                if($nbQ <= 0){
                                    continue;
                                }
      
                                $premier_titre = $CI->decodeJson($questionsAndAnswers[0]['questions'], 'titre');  
                            ?>

                            <tr>

                                <td><?php echo $i++; ?></td>

                                <td><?php echo $value['titre_cours']; ?></td>

                                <td><?php echo $premier_titre; ?></td>

                                <td><?php echo $nbQ; ?></td>

                                <td><?php echo $value['date_add'] ?></td>


                                <td>

                                    <?php
                                        $can_edit = $this->staff_model->isAlreadyAnswered($value['id']);
                                    ?>

                                    <?php if($can_edit){?>
                                        <a data-return="#?>" href="<?php echo base_url('editevaluation/' . $value['id']) ?>" id="edit" data-accountedit="<?php echo $value['id'] ?>" class="text-success" title="Modifier evaluation" data-toggle="tooltip">                                                     

                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                        
                                        </a>&nbsp;

                                    <?php }else{?>
                                        <a data-return="#?>" href="<?php echo base_url('voirevaluation/' . $value['id']) ?>" id="voir" data-accountvoir="<?php echo $value['id'] ?>" class="text-success" title="Voir evaluation" data-toggle="tooltip">                                                     

                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                            
                                        </a>&nbsp;
                                    <?php }?>
                                    

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>