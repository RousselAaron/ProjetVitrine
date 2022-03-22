<div class="main-container">

    <? echo '<form action="/addStep/'.$this->params['id'].'" method="POST"  enctype="multipart/form-data">' ?>
        <div class="form-group">
            <label for="StepID">Position de l'etape</label>
            <select required class="form-control" id="StepID" name="StepID">
                <?for ($x=1; $x<=20; $x++) {

                    if($stepId = $vars['steps'][$x-1])
                    {
                        if ($stepId->getStepsId() == intval(strval($vars['tutorial']->getPlaneId()) . strval($x))) {
                            echo '<option value="' . $x . '" disabled>etape ' . $x . '</option>';
                        }
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
            <textarea required minlength="10" class="form-control" id="Content" name="Content" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="StepImage" class="form-label">Image de l'etape</label>
            <input class="form-control" required type="file" id="StepImage" name="StepImage">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>