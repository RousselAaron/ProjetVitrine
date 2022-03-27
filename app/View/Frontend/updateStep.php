<div class="main-container">

    <div class="col-md-3 col-6 p-4 d-flex flex-column position-static">
        <strong class="d-inline-block mb-2 text-primary">Etape <?= substr($vars['step']->getStepsId(), strlen(strval($vars['tutorial']->getPlaneId()))) ?> </strong>
        <?php $img = $vars['step']->getImg(); echo '<img src="../../src/IMG/'.$vars['tutorial']->getPlaneId()."/tutorial/".$img.'" alt="" class="img-fluid img-thumbnail mb-2"> '?>
        <p><?= $vars['step']->getContent(); ?><p>
    </div>
    <form action="/updateStep/<?php echo $this->params['id'] ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="StepId">Numéros de l'étape</label>
            <select required class="form-control" id="StepId" name="StepId">
                <?php for ($x=1; $x<=20; $x++) {
                    if ($x == substr($vars['step']->getStepsId(), strlen(strval($vars['tutorial']->getPlaneId()))) ){
                        echo '<option value="' . $x . '" selected="selected" >etape ' . $x . '</option>';
                    }
                    elseif (in_array(intval($vars['tutorial']->getPlaneId().$x),$vars['stepsId'])) {
                        echo '<option value="' . $x . '" disabled > Etape ' . $x . '</option>';
                    }
                    else
                    {
                        echo '<option value="' . $x . '">etape ' . $x . '</option>';
                    }

                }?>
            </select>
        </div>
        <div class="form-group">
            <label for="Content">Content</label>
            <textarea required minlength="10" class="form-control" id="Content" name="Content" rows="3"><?=$vars['step']->getContent()?></textarea>
        </div>
        <div class="mb-3">
            <label for="StepImage" class="form-label">Image de l'etape</label>
            <input class="form-control" type="file" id="StepImage" name="StepImage">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>