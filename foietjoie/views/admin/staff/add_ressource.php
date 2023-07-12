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
                                                        <h4 class="text-info"><b>Enregistrer un cours</b></h4>
                                                    </div>                 
                                                </div>
                                            </div>
                                            <div class="widget-content widget-content-area">
                                                <form class="needs-validation" method="post" data-return="<?= base_url('listcourses') ?>" novalidate action="<?= base_url('homework/addcourseajax') ?>" id="form_add_ressources" accept-charset="utf-8" enctype="multipart/form-data">
                                                     <?php echo $this->customlib->getCSRF(); ?>  
                                                    <div class="form-row">
                                                        <input type="hidden" name="id" id="id" value="">
                                                        <div class="col-md-4 mb-4">
                                                            <label for="titre_cours">Titre Cours<sup class="text-danger"><b>*</b></sup></label>
                                                            <input type="text" class="form-control" name="titre_cours" id="titre_cours" placeholder="Entrer Titre Cours" value="<?php echo set_value('titre_cours')?>" required>
                                                            <div class="invalid-feedback"><?php echo form_error('titre_cours'); ?></div>
                                                        </div>
                                                        <div class="col-md-8 mb-8">
                                                             <label for="file">Choisir le fichier video depuis votre appareil<sup class="text-danger"><b>*</b></sup></label>
                                                            <input type="file" class="form-control-file" name="file" accept="video/*" id="file" value="<?php echo set_value('file')?>" required>
                                                            <div class="invalid-feedback"><?php echo form_error('file'); ?></div>

                                                          <!--   <div class="custom-file-container" data-upload-id="myFirstImage">
                                                                <label>Choisir le fichier video depuis votre appareil <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Cliquez ici pour supprimer le fichier" data-toggle="tooltip">X</a></label>
                                                                <label class="custom-file-container__custom-file" >
                                                                    <input type="file" name="file_upload" id="file_upload" class="custom-file-container__custom-file__custom-file-input" accept="video/*" required>
                                                                    <<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                                </label>
                                                                <div class="custom-file-container__image-preview"></div>
                                                            </div> -->
                                                        </div>                                                       
 
                                                        <div class="col-md-12 mb-12">
                                                           <label for="description">Description cours<sup class="text-danger"><b>*</b></sup></label>
                                                            <div class="widget-content widget-content-area">
                                                                <textarea id="description" name="description" required></textarea>
                                                            </div>
                                                            <div class="invalid-feedback"><div class="invalid-feedback"><?php echo form_error('description'); ?></div></div>
                                                        </div>
                                                    </div>
                                                                                                                                                        
                                                    <div class="pull-right">
                                                        <button class="btn btn-primary mt-3 " type="submit"> <span class="loader"></span> Enregistrer</button>
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