<div class="main-container">
    <h2>Tutoriel</h2>

    <article class="blog-post">
        <br/>
        <h2 class="blog-post-title"><?= $vars['plane']->getName(); ?></h2>
        <br/>
        <? $img = $vars['plane']->getImg(); echo '<img src="../../src/IMG/'.$vars['plane']->getPlaneId()."/".$img.'" alt="" class="img-fluid img-thumbnail mb-2"> '?>
        <? echo '<a class="btn btn-primary" href="/updatePlane/'.$vars['plane']->getPlaneId().'">Modifier</a>'?>
    </article>
    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <?php if(!$vars['tutorial']) echo '
        <form action="/addTutorial/'.$vars['plane']->getPlaneId().'" method="post">
        <button class="btn btn-primary" type="submit" name="addTutorial" value="addTutorial">Créer un Tutoriel</button>
        </form>
        '?>
    <?php $x=0; if($vars['tutorial']) echo '<a class="btn btn-primary" href="/addStep/'.$vars['tutorial']->getTutorialId().'">Ajouter une étape</a>
        '; if($vars['steps']) foreach ($vars['steps'] as $steps) :?>
            <div class="col-md-3 col-6 p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-primary">Etape <?= $x+=1?> </strong>
                <? $img = $steps->getImg(); echo '<img src="../../src/IMG/'.$vars['plane']->getPlaneId()."/tutorial/".$img.'" alt="" class="img-fluid img-thumbnail mb-2"> '?>
                <p><?= $steps->getContent(); ?><p>
                    <button class="btn btn-primary">Modifier</button>
            </div>
    <?php endforeach; ?>
    </div>
</div>