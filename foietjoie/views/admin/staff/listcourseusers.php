
<div class="layout-px-spacing">
                
    <div class="row layout-top-spacing">
    
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing table-responsive">
            <div class="widget-content widget-content-area br-6">
         <div id="card_2" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4 class="text-info"><b><?php echo $title; ?></b></h4>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="widget-content widget-content-area">
                        <?php foreach ($allressources as $key => $value):  ?>
                            <div class="card col-lg-3 col-md-16 col-sm-12" style="display:inline-block;">
                                <video
                                    id="my-video"
                                    class="video-js card-img-tops"
                                    controls
                                    preload="auto"
                                    width="300"
                                    height="200"
                                    poster="<?php echo base_url('uploads/ressources/video/logo_bg.jpg') ?>"
                                    data-setup="{'techOrder': ['html5'] }"
                                  >
                                    <source src="<?php echo base_url($value['file']) ?>" type="video/webm"></source>
                                    <source src="<?php echo base_url($value['file']) ?>" type="video/ogg"></source>
                                    <source src="<?php echo base_url($value['file']) ?>" type="video/mp4"></source>
                                    <source src="<?php echo base_url($value['file']) ?>" type="video/avi"></source>
                                </video>
                                <div class="card-body">
                                    <h5 class="card-title text-info"><b><?php echo substr($value['titre_cours'], 0,20); ?>...</b></h5>
                                    <p class="card-text text-justify"><?php echo substr($value['description'], 0,40) ?>....</p>
                                    <a href="<?php echo base_url('viewcourse/'.$value['id']) ?>" class="btn btn-primary">Voir plus</a>
                                    <p class="text-muted" style="text-align: right;"><small><b>Auteur : </b><?php echo $value['nom'] ?> <?php echo $value['nom'] ?></small></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            </div>
        </div>

    </div>

</div>