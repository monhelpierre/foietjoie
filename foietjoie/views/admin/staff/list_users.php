<div class="layout-px-spacing">
    
    <div class="row layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing table-responsive">

            <div class="widget-content widget-content-area br-6">

                <table id="html5-extension" class="table table-hover non-hoverS" style="width:100%">

                    <a class="btn btn-primary" href="<?= base_url('adduser') ?>"> Ajouter Utilisateur</a>

                        <thead>

                                    <tr>

                                        <th>#</th>

                                        <th>NOM</th>

                                        <th>PRENOM</th>

                                        <th>SEXE</th>

                                        <th>TELEPHONE</th>

                                        <th>TYPE UTILISATEUR</th>

                                        <th class="dt-no-sorting">ACTION</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php $i=1; foreach ($allusers as $key => $v): ?>

                                        <tr>

                                            <td><?php echo $i++; ?></td>

                                            <td><?php echo $v['nom'] ?></td>

                                            <td><?php echo $v['prenom'] ?></td>

                                            <td><?php echo $v['sexe'] ?></td>

                                            <td><?php echo $v['phone'] ?></td>

                                            <td><?php echo $v['user_type'] ?></td>

                                            <td>

                                                <?php if($v['id'] != 1 && $current_user['id'] != $v['id']){ 

                                                    if($v['is_active'] == 'no'){ ?>

                                                        <a  href="<?php echo base_url('enablestaff/' . $v['id']) ?>" id="activate" data-accountacivate="<?php echo $v['id'] ?>" class="text-danger" title="Activé compte" data-toggle="tooltip">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-unlock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 9.9-1"></path></svg>
                                                        </a>

                                                        <?php }else{ ?>

                                                            <a href="<?php echo base_url('disablestaff/' . $v['id']) ?>" id="desactivate" data-accountdesacivate="<?php echo $v['id'] ?>" class="text-info" title="Desactivé compte" data-toggle="tooltip">                                                     
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                                            </a>

                                                        <?php } ?>&nbsp;

                                                            <a data-return="#?>" href="<?php echo base_url('edituser/' . $v['id']) ?>" id="edit" data-accountedit="<?php echo $v['id'] ?>" class="text-success" title="Modifier compte" data-toggle="tooltip">                                                     
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                            </a>
                                                <?php } ?>&nbsp;

                                            </td>

                                        </tr>

                                    <?php endforeach; ?>

                                </tbody>

                            </table>

                        </div>

                    </div>



                </div>



            </div>