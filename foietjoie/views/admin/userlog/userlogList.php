<div class="layout-px-spacing">                
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing table-responsive">
            <div class="widget-content widget-content-area br-6">                
                <div class="card">
                    <div class="card-herder">
                        
                    </div>
                    <div class="card-body">
                        <table id="style-2" class="table style-2  table-hover" style="width:100%">
                    <!-- <a class="btn btn-primary btn-sm" href="<?= base_url('addcourse') ?>"> Ajouter Cours</a><br> -->
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>UTILISATEUR</th>
                            <th>ROLE</th>
                            <th>ADRESSE IP</th>
                            <th>DATE CONNECT&Eacute;E</th>
                            <th>NAVIGATEUR</th>
                            <!-- <th class="text-center dt-no-sorting">ACTION</th> -->
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                        if (!empty($userlogList)) {
                            $count = 1;
                            foreach ($userlogList as $userlogParent) {
                                ?>
                                <tr>
                                    <td><?php echo $count++ ?></td>                                                
                                    <td><?php echo $userlogParent['user']; ?></td>                                                
                                    <td><?php echo ucfirst($userlogParent['role']); ?></td>
                                    <td><?php echo $userlogParent['ipaddress']; ?></td>
                                    <td>
                                        <?php
                                        $date_time = strtotime($userlogParent['login_datetime']);
                                        $date = date('l m F Y', $date_time);
                                        $time = date('H:i:s', $date_time);
                                        echo $date.', '.$time;
                                        ?>

                                    </td>
                                    <td><?php echo $userlogParent['user_agent']; ?></td>  
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

