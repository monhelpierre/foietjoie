<div class="layout-px-spacing">                

    <div class="row layout-top-spacing">    

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing table-responsive">

            <div class="widget-content widget-content-area br-6">                

               <div class="card">

                   <div class="card-header">

                       <a class="btn btn-primary btn-sm" href="<?= base_url('addcourse') ?>"> Ajouter un nouveau Cours</a>

                   </div>

                   <div class="card-body">

                        <table id="style-2" class="table style-2  table-hover" style="width:100%">

                            <thead>

                                <tr>

                                    <th>#</th>

                                    <th>TITRE</th>

                                    <th>CONTENU COURS</th>

                                    <th>DESCRIPTION</th>

                                    <th>POST&Eacute; PAR</th>

                                    <th>STATUS</th>

                                    <th class="text-center dt-no-sorting">ACTION</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php $i=1; foreach ($allressources as $key => $v): ?>

                                    <tr>

                                        <td><?php echo $i++; ?></td>

                                        <td><a class="text-info" href="<?php echo base_url('listcoursesgrile') ?>"><?php echo $v['titre_cours'] ?></a></td>

                                        <td>

                                            <video width="100" height="100" controls class="avatar avatar-lg avatar-indicators avatar-online">>

                                              <source src="<?php echo base_url($v['file']) ?>" type="video/mp4">

                                              <!-- <source src="<?php echo base_url($v['file']) ?>" type="video/ogg"> -->

                                                Votre explorateur ne supporte pas la balise video.

                                            </video>

                                        </td>

                                        <td><?php echo substr($v['description'], 0,30) ?><a href="javascript:void(0)">...</a></td>

                                        <td><?= $v['nom'] ?> <?= $v['prenom'] ?></td>

                                        <td><?= ($v['is_public']=='no')?'<span class="badge badge-danger ">Non Publié</span>':'<span class="badge badge-success"> Publié</span>' ?></td>

                                       

                                        <td class="text-center">

                                            <div class="dropdown">

                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">

                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>

                                                </a>



                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink7">

                                                <?php if($v['is_public'] == 'no'): ?>

                                                    <a class="dropdown-item" href="<?= base_url('evaluatecourse/'.$v['id']) ?>">Ajouter une évaluation</a>

                                                    <a class="dropdown-item" data-return="<?php echo base_url('listcourses') ?>" id="deletecourse" data-iddelete="<?php echo $v['id'] ?>" href="javascript:void(0);">Supprimer Cours</a>

                                                <?php endif; ?>

                                                   <a class="dropdown-item" href="<?php echo base_url('viewcourse/'.$v['id']) ?>">Voir cours</a>

                                                </div>

                                            </div>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            </tbody>

                        </table>

                   </div>

               </div>

            </div>

        </div>

    </div>

</div>