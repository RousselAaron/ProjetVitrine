<div class="main-container">

    <form action="/updatePlane" method="POST"  enctype="multipart/form-data">
        <div class="mb-3">
            <label for="PlaneName" class="form-label">Plane name</label>
            <input type="text" required class="form-control" id="PlaneName" name="PlaneName" aria-describedby="PlaneNameHelp">
            <div id="PlaneNameHelp" class="form-text">Name it well, he can become precious</div>
        </div>
        <div class="mb-3">
            <label for="PlaneImage" class="form-label">Image of your plane</label>
            <input class="form-control" required type="file" id="PlaneImage" name="PlaneImage">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>