<div class="main-container">


    <div class="col-md-3 col-6 p-4 d-flex flex-column position-static">
        <strong class="d-inline-block mb-2 text-primary">Plane</strong>
        <h3 class="mb-0 text-secondary"><? echo $vars['plane']->getName();?></h3>

        <? $img = $vars['plane']->getImg(); echo '<img src="../../src/IMG/'.$vars['plane']->getPlaneId()."/".$img.'" alt="" class="img-fluid img-thumbnail mb-2"> '?>
    </div>

    <form action="/updatePlane/?id=<? echo $this->params['id'] ?>" method="POST"  enctype="multipart/form-data">
        <div class="mb-3">
            <label for="PlaneName" class="form-label">Plane name</label>
            <input type="text" class="form-control" id="PlaneName" name="PlaneName" value="<? echo $vars['plane']->getName(); ?>" aria-describedby="PlaneNameHelp">
            <div id="PlaneNameHelp" class="form-text">Name it well, he can become precious</div>
        </div>
        <div class="mb-3">
            <label for="PlaneImage" class="form-label">Image of your plane</label>
            <input class="form-control" type="file" id="PlaneImage" name="PlaneImage">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>