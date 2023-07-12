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

                                            <h4 class="text-info"><b>Liste d'evaluation par cours</b></h4>

                                        </div>                 

                                    </div>

                                </div>

                                <div class="widget-content widget-content-area">

                                    <form class="needs-validation" novalidate action="#">
                                        
                                        <div class="form-row">

                                            <div class="col-md-12 mb-3">

                                                <label for="id_departement">Nom du cours</label>

                                                <select class="form-control" id="id_choosen_course" name="id_choosen_course" data-live-search="true">

                                                    <option selected="selected" disabled="disabled" value="">Choisir le cours </option>

                                                    <?php $nb = 1; foreach ($ressources as $key => $value): ?>

                                                        <option  value="<?php echo $value['id'] ?>"><?php echo ($nb++) . ' : '. $value['titre_cours']; ?></option>

                                                    <?php endforeach; ?>

                                                </select>

                                                 <div class="invalid-feedback"><div class="invalid-feedback"><?php echo form_error('id_departement'); ?></div></div>

                                            </div>

                                        </div>

                                    </form>

                                    <div class="layout-spacing table-responsive" id="evaltablelist">

                                    </div>

                                </div>

                            </div>

                        </div>

                     </div>

                </div>

            </div>

        </div>

    </div>

</div>