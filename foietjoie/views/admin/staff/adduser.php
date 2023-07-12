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

                                                    </div>                 

                                                </div>

                                            </div>

                                            <div class="widget-content widget-content-area">

                                                <form class="needs-validation" method="post" data-return="<?= base_url('allusers') ?>" novalidate action="<?= base_url('admin/staff/addusertodb') ?>" id="form_add_user">

                                                     <?php echo $this->customlib->getCSRF(); ?>  

                                                    <div class="form-row">

                                                        <input type="hidden" name="id" id="id" value="">

                                                        <div class="col-md-3 mb-3">

                                                            <label for="name">Nom<sup class="text-danger"><b>*</b></sup></label>

                                                            <input type="text" class="form-control" name="name" id="name" placeholder="Nom" value="<?php echo set_value('name')?>" required>

                                                            <div class="invalid-feedback"><?php echo form_error('name'); ?></div>

                                                        </div>



                                                        <div class="col-md-3 mb-3">

                                                            <label for="pname">Prénom<sup class="text-danger"><b>*</b></sup></label>

                                                            <input type="text" class="form-control" name="pname" id="pname" placeholder="Prénom" value="<?php echo set_value('pname')?>" required>

                                                            <div class="invalid-feedback"><?php echo form_error('pname'); ?></div>

                                                        </div>



                                                        <div class="col-md-3 mb-3">

                                                            <label for="dob">Date de naissance<sup class="text-danger"><b>*</b></sup></label>

                                                            <input id="dob" name="dob" value="<?php echo set_value('dob')?>" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Choisir date de naissance" required>

                                                            <div class="invalid-feedback"><?php echo form_error('dob'); ?></div>

                                                        </div>



                                                        <div class="col-md-3 mb-3">

                                                          <label for="sexe">Sexe<sup class="text-danger"><b>*</b></sup></label>

                                                          <select class="form-control" id="sexe" name="sexe" required>

                                                                <option selected="selected" disabled="disabled" value="">Selectionner Sexe </option>

                                                                <?php foreach ($genderList as $key => $value): ?>

                                                                     <option value="<?php echo $key; ?>" <?php echo set_select('sexe', $key, set_value('sexe')); ?>><?php echo $value; ?></option>

                                                                <?php endforeach; ?>

                                                            </select>

                                                            <div class="invalid-feedback"><div class="invalid-feedback"><?php echo form_error('sexe'); ?></div></div>

                                                        </div>

                                                    </div>

                                                    <!-- 2nd line -->

                                                     <div class="form-row">

                                                        <div class="col-md-3 mb-3">

                                                            <label for="phone">Téléphone<sup class="text-danger"><b>*</b></sup></label>

                                                             <input id="phone" type="text" name="phone" id="phone" class="form-control" placeholder="" required>

                                                            <div class="invalid-feedback"><?php echo form_error('phone'); ?></div>

                                                        </div>



                                                        <div class="col-md-3 mb-3">

                                                            <label for="nif">NIF<sup class="text-danger"><b>*</b></sup></label>

                                                             <input id="nif" type="text" name="nif" class="form-control" placeholder="" required>

                                                            <div class="invalid-feedback"><?php echo form_error('nif'); ?></div>

                                                        </div>



                                                        <div class="col-md-3 mb-3">

                                                            <label for="email">E-mail <sup class="text-danger"><b>*</b></sup></label>

                                                           <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" value="<?php echo set_value('email')?>" required>

                                                            <div class="invalid-feedback"><?php echo form_error('email'); ?></div>

                                                        </div>



                                                        <div class="col-md-3 mb-3">

                                                          <label for="status">Stus Matrimonial<sup class="text-danger"><b>*</b></sup></label>

                                                          <select class=" form-control" id="status" name="status" data-live-search="true" required>

                                                                <option selected="selected" disabled="disabled" value="">Status Matrimonial </option>

                                                                 <?php foreach ($marital_status as $key => $value): ?>

                                                                     <option value="<?php echo $value; ?>" <?php echo set_select('status', $value, set_value('status')); ?>><?php echo $value; ?></option>

                                                                <?php endforeach; ?>

                                                            </select>

                                                            <div class="invalid-feedback"><div class="invalid-feedback"><?php echo form_error('status'); ?></div></div>

                                                        </div>

                                                    </div>

                                                    <!-- end -->



                                                     <!-- 2nd line -->

                                                     <div class="form-row">

                                                        <div class="col-md-3 mb-3">

                                                            <label for="adresse">Adresse<sup class="text-danger"><b>*</b></sup></label>

                                                             <input id="adresse" type="text" name="adresse" class="form-control" placeholder="Adresse" required>

                                                            <div class="invalid-feedback"><?php echo form_error('adresse'); ?></div>

                                                        </div>



                                                        <div class="col-md-3 mb-3">

                                                          <label for="id_departement">Département<sup class="text-danger"><b>*</b></sup></label>

                                                          <select class="form-control" id="id_departement" name="id_departement" data-live-search="true" required>

                                                                <option selected="selected" disabled="disabled" value="">Choisir Département </option>

                                                                 <?php foreach ($departement as $key => $value): ?>

                                                                     <option  value="<?php echo $value['id_departement'] ?>" <?php echo set_select('id_departement', $value['id_departement'], set_value('id_departement')); ?>><?php echo $value['nom']; ?></option>

                                                                <?php endforeach; ?>

                                                            </select>

                                                            <div class="invalid-feedback"><div class="invalid-feedback"><?php echo form_error('id_departement'); ?></div></div>

                                                        </div>



                                                       <div class="col-md-3 mb-3">

                                                          <label for="id_commune">Commune<sup class="text-danger"><b>*</b></sup></label>

                                                          <select class="selectpickers form-control" id="id_commune" name="id_commune" data-live-search="true" required>

                                                                <option selected="selected" disabled="disabled" value="">Choisir commune </option>

                                                           </select>

                                                            <div class="invalid-feedback"><div class="invalid-feedback"><?php echo form_error('id_commune'); ?></div></div>

                                                        </div>



                                                        <div class="col-md-3 mb-3">

                                                          <label for="section">Section Communale<sup class="text-danger"><b>*</b></sup></label>

                                                          <select class="selectpickers form-control" name="section" id="section" data-live-search="true" required>

                                                            <option selected="selected" disabled="disabled" value="">Choisir Section Communale</option>

                                                            </select>

                                                            <div class="invalid-feedback"><div class="invalid-feedback"><?php echo form_error('section'); ?></div></div>

                                                        </div>

                                                    </div>

                                                    <!-- end -->



                                                     <!-- 3rd line -->

                                                     <div class="form-row">

                                                        <div class="col-md-3 mb-3">

                                                            <label for="profession">Profession<sup class="text-danger"><b>*</b></sup></label>

                                                             <input id="profession" type="text" name="profession" class="form-control" placeholder="Profession" required>

                                                            <div class="invalid-feedback"><?php echo form_error('profession'); ?></div>

                                                        </div>



                                                        <div class="col-md-3 mb-3">

                                                            <label for="username">Username<sup class="text-danger"><b>*</b></sup></label>

                                                             <input id="username" type="text" name="username" class="form-control" placeholder="Nom d'utilisateur" required>

                                                            <div class="invalid-feedback"><?php echo form_error('username'); ?></div>

                                                        </div>



                                                        <div class="col-md-3 mb-3">

                                                            <label for="password">Mot de passe<sup class="text-danger"><b>*</b></sup></label>

                                                           <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe" value="<?php echo set_value('password')?>" required>

                                                            <div class="invalid-feedback"><?php echo form_error('password'); ?></div>

                                                        </div>



                                                        <div class="col-md-3 mb-3">

                                                          <label for="user_type">Type utilisateur<sup class="text-danger"><b>*</b></sup></label>

                                                          <select class=" form-control" id="user_type" name="user_type" data-live-search="true" required>

                                                                <option selected="selected" disabled="disabled" value="">Type Utilisateur </option>

                                                                 <?php foreach ($roles as $key => $value): ?>

                                                                     <option value="<?php echo $value['id']; ?>" <?php echo set_select('user_type', $value['name'], set_value('user_type')); ?>><?php echo $value['name']; ?></option>

                                                                <?php endforeach; ?>

                                                            </select>

                                                            <div class="invalid-feedback"><div class="invalid-feedback"><?php echo form_error('user_type'); ?></div></div>

                                                        </div>

                                                    </div>

                                                    <!-- end -->

                                                    

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