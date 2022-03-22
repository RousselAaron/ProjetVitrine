<div class="main-container">
    <h2>Les avions</h2>
    <a class="btn btn-outline-primary" href="/addPlane">ajouter un avion</a>
    <div class="col mb-2">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <?php
        foreach ($vars as $plane) :
            ?>
                    <div class="col-md-3 col-6 p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary">Post</strong>
                        <h3 class="mb-0"><?= $plane->getName(); ?></h3>

                        <? $img = $plane->getImg(); echo '<img src="../../src/IMG/'.$plane->getPlaneId()."/".$img.'" alt="" class="img-fluid img-thumbnail mb-2"> '?>
                        <? echo '<a class="btn btn-outline-primary" href="/tutorial/'.$plane->getPlaneId().'">Lire plus</a>'?>
                    </div>
        <?php
        endforeach; ?>
        </div>
    </div>
</div>