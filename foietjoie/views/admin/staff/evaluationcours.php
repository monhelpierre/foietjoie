<?php
    $CI=&get_instance();
?>

<div class="layout-px-spacing">

    <div id="headerWrapper">

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-12 col-sm-12 col-12 text-center">

                    <h2 class="main-heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>

                    Posté(e) par : <?php echo $eval['nom'] ?> <?php echo $eval['prenom'] ?> (<?php echo $eval['user_type'] ?>)</h2>

                </div>

            </div>

        </div>

    </div>
    
    <div id="privacyWrapper" class="">

        <div class="privacy-container">

            <div class="privacyContent">

                <div class="d-flex justify-content-between privacy-head">

                    <div class="privacyHeader">

                        <h1><b>Evaluation pour le cours : </b><?php echo $eval['titre_cours'] ?></h1>

                        <p class="text-info"><blockquote><i><b>Evaluation ajoutée le :</b></i> <?php  echo date("l j F Y, H:i a ", strtotime($eval['date_add'])) ?></blockquote></p>

                    </div>
                    
                </div>
                
                <div class="privacy-content-container">
                    
                    <section>

                        <h5><b>Evaluation pour le cours : </b><?php echo $eval['titre_cours'] ?></h5>

                        <form action="<?php echo base_url('homework/responseevaluate') ?>" data-return="<?php echo base_url('responseevaluate/'.$eval['id_course']) ?>"  method="post" accept-charset="utf-8" id="form_add_rep_evaluate">
                        
                            <input type="hidden" name="eval_id" id="eval_id" value="<?php echo $eval['id'] ?>">

                            <input type="hidden" name="id_course" id="id_course" value="<?php echo $eval['id_course'] ?>">

                            <?php 
                            
                                $questionsAndAnswers = $CI->decodeJson($eval['form']);  

                                $nbQ = sizeof($questionsAndAnswers);

                                foreach ($questionsAndAnswers as $key => $value): ?>

                                    <?php 
                                    
                                        $q = json_decode($value['questions']);

                                        $c = $q->choices;

                                        $a = $q->answers;
                                    
                                    ?> 

                                    <div class="form-row col-md-12" style="display: inline-block;">

                                        <b style="padding-right:150px;"><?php echo 1; ?>. &nbsp; <label  for="titre_cours"><?php echo $q->titre ?><sup class="text-danger"><b>*</b></sup></label></b>
                                                    
                                        <div style="padding-left:30px;">

                                            <?php foreach ($c as $ck => $cv): ?>

                                                <div class="form-group form-check">

                                                    <input type="checkbox" class="form-check-input" value="<?php echo $cv; ?>" name="rep_<?php echo $key?>[]" id="rep_<?php echo $ck;  ?>" >

                                                    <label class="form-check-label" for="rep_<?php echo $ck  ?>"><?php echo $cv ?></label>

                                                </div>
                                                
                                            <?php endforeach;   ?>

                                        </div>                                               

                                    </div>
                                   
                                <?php endforeach; 
                            
                            ?>

                            <span class="text-danger"><b>Evaluation Sur <?php echo 100 ?></b></span><br>

                            <button class="btn btn-primary mt-3 " type="submit"> <span class="loader"></span> Soumettre  <?=$nbQ>1?'les ' . $nbQ:"l'unique"; ?> question<?=$nbQ>1?'s':''; ?>. </button>

                        </form>

                    </section>

                </div>
            
            </div>

        </div>

    </div>

</div>