<div class="main-container" style="max-width: 80%; margin: 50px auto;">
    <h2>Our articles</h2>
    <div class="col mb-2" style='width:100%;'>
        <?php
        foreach ($vars as $avion) :
            ?>
            <div class="col-md-6" style='width:100%;'>
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative" style='width:100%;'>
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary">Post</strong>
                        <h3 class="mb-0"><?= $avion->getNom(); ?></h3>
                        <div class="mb-1 text-muted"><?= $avion->getCurrentDate(); ?></div>
                        <p class="card-text mb-auto"><?= substr($avion->getContent(), 0, 150); ?>...</p>
                        <a class="btn btn-outline-primary" href="/article/<?= $avion->getId(); ?>">Lire plus</a>
                    </div>
                    <?php if(!empty($avion->getImage())) : ?>
                        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative" style="width:50%;max-height:300px;margin-bottom:0!important;">
                            <img src="./../src/Image/<?php echo $avion->getImage(); ?>" alt="" style="width: 100%">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php
        endforeach;

        ?>
    </div>
</div>