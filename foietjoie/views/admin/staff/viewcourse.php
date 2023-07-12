<?php
    $CI=&get_instance();
?>

<div class="layout-px-spacing">
    
    <div id="headerWrapper">

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-12 col-sm-12 col-12 text-center">

                    <h2 class="main-heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>

                    Posté(e) par : <?php echo $sr['nom'] ?> <?php echo $sr['prenom'] ?> (<?php echo $sr['user_type'] ?>)</h2>

                </div>

            </div>

        </div>

    </div>
    
    <div id="privacyWrapper" class="">

        <div class="privacy-container">

            <div class="privacyContent">

                <div class="d-flex justify-content-between privacy-head">

                    <div class="privacyHeader">

                        <h1><?php echo $sr['titre_cours'] ?></h1>

                        <p class="text-info"><blockquote><i><b>Ajouté le :</b></i> <?php  echo date("l j F Y, H:i a ", strtotime($sr['date_add'])) ?></blockquote></p>

                    </div>

                    <!-- <div class="get-privacy-terms align-self-center">

                        <button class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg> Print</button>

                     </div> -->

                 </div>

                <div class="privacy-content-container">

                    <section>

                        <h5><?php echo $sr['titre_cours'] ?></h5>

                        <p><?php echo $sr['description'] ?></p>

                    </section>
                    
                    <section>

                        <h5>Visualiser la vidéo</h5>

                        <p>

                            <video

                                id="my-video"

                                class="video-js col-md-12 col-sm-12 col-lg-12"

                                controls

                                preload="auto"

                                width="640"

                                height="364"

                                poster="<?php echo base_url('uploads/ressources/video/logo_bg.jpg') ?>"

                                data-setup="{'techOrder': ['html5'] }">

                                <source src="<?php echo base_url($sr['file']) ?>" type="video/webm"></source>

                                <source src="<?php echo base_url($sr['file']) ?>" type="video/ogg"></source>

                                <source src="<?php echo base_url($sr['file']) ?>" type="video/mp4"></source>

                                <source src="<?php echo base_url($sr['file']) ?>" type="video/avi"></source>

                            </video>

                        </p>

                    </section>

                    <section>

                        <h5> Résultat évaluation</h5>

                        <?php if (json_decode($this->customlib->getStaffRole())->name !== 'Enseignant(e)'){?>

                            <p>

                                <?php if($result == null){ ?>

                                        <a class="btn btn-primary btn-sm pull-right" href="<?php echo base_url('evaluateaftercourse/'.$sr['id']) ?>">Evaluer votre compétence sur ce cours</a> 

                                <?php }else{?> 

                                    <table class="table table-bordered table-responsive col-md-12 col-sm-12" disabled="disabled">

                                        <thead>

                                            <tr>

                                                <th>REPONSES ORIGNALES DE L'EVALUATION</th>

                                                <th>REPONSES FOURNIES</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php 

                                                $noteTotale = 0;

                                                foreach ($result as $key => $value) {
                                                    
                                                    $questionsAndAnswers = $CI->decodeJson($value['resultat']);

                                                    foreach ($questionsAndAnswers as $qk => $qv) {

                                                        $nb = 1; 

                                                        foreach ($qv as $tmpk => $tmpv) {

                                                            $qqv = $CI->decodeJson($tmpv);

                                                            $origninale = $qqv['originale'];
                                                            $fournie = $qqv['fournie'];
                                                            $notes = $qqv['notes'];?>

                                                                <input type="hidden" name="id_<?php echo $nb; ?>" id="<?php echo $nb; ?>" value="<?php echo $nb; ?>">

                                                                <tr>

                                                                    <td>

                                                                        <div class="form-row col-md-12" style="display: inline-block;" disabled="disabled">

                                                                            <b style="padding-right:150px;"><?php echo $nb; ?>. &nbsp; <label  for="titre_cours"><?php echo $qqv['titre']; ?><sup class="text-danger"><b>*</b></sup></label></b>

                                                                            <div style="padding-left:30px;">


                                                                                <?php foreach ($origninale as $ok => $ov) { ?>

                                                                                    <div class="n-chk">

                                                                                        <label class="new-control new-checkbox new-checkbox-text checkbox-primary">

                                                                                        <input type="checkbox" checked=checked disabled class="new-control-input new-checkbox-text">

                                                                                        <span class="new-control-indicator"></span><span class="new-chk-content"><?php echo $ov; ?></span>

                                                                                        </label>

                                                                                    </div>

                                                                                <?php }?>

                                                                            </div>                                               

                                                                        </div>

                                                                    </td>


                                                                    <td>

                                                                        <div class="form-row col-md-12" style="display: inline-block;" disabled="disabled">

                                                                            <b style="padding-right:150px;"><?php echo $nb; ?>. &nbsp; <label  for="titre_cours"><?php echo $qqv['titre']; ?><sup class="text-danger"><b>*</b></sup></label></b>

                                                                            <div style="padding-left:10px;">

                                                                                <?php foreach ($fournie as $fk => $fv) { ?>

                                                                                    <div class="n-chk">

                                                                                        <label class="new-control new-checkbox new-checkbox-text checkbox-<?php echo in_array($fv, $origninale)?'primary':'secondary'; ?> ">

                                                                                        <input type="checkbox" checked=checked disabled class="new-control-input new-checkbox-text">

                                                                                        <span class="new-control-indicator"></span><span class="new-chk-content"><?php echo $fv; ?></span>

                                                                                        </label>

                                                                                    </div>

                                                                                <?php }?>

                                                                            </div>                                               

                                                                        </div>

                                                                    </td>

                                                                </tr>

                                                        <?php 
                                                        $nb++; 
                                                        $noteTotale += intval($qqv['notes']);
                                                    }
                                                    } }
                                                ?>

                                            <tr>

                                                <td class="text-danger"><b>Évaluation sur <?php echo 100; ?></b></td>

                                                <td class="text-center text-primary" style="font-size: 16px;font-weight: bold; text-transform: !important;text-decoration: underline;">Note Obtenue : <?php echo $noteTotale ?></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                <?php } ?> 

                            </p>

                        <?php }else{ ?>

                    <p><blockquote class="text-danger text-center"><b>Vous n'etes pas un(e) apprenant(e)</b></blockquote></p>

                <?php } ?>

            </section>

        </div>
    </div>

</div>

</div>

</div>