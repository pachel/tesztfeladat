<!--[layout:layout.php]-->
<!--[name:content]-->
<button class="btn btn-info text-white mb-2" id="uj">
    <i class="fa-solid fa-circle-plus"></i>
    Új dolgozó
</button>
<table class="table table-striped" id="dolgozok">
    <thead>
    <tr>
        <th>Név</th>
        <th>Munkakör</th>
        <th>Törzsszám</th>
        <th>Vezető</th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>
<div class="modal hide" tabindex="-1" id="dolgozoModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dolgozó hozzáadása/szerkesztése</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form">
                    <div class="mb-3">
                        <label for="nev" class="form-label">Név</label>
                        <input type="text" class="form-control" id="nev" aria-describedby="nevHelp">
                        <div id="nevHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="munkakor" class="form-label">Munkakör</label>
                        <input type="text" class="form-control" id="munkakor" aria-describedby="munkakorHelp">
                        <div id="munkakorHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="torzsszam" class="form-label">Törzszszám</label>
                        <input type="number" class="form-control" id="torzsszam" aria-describedby="torzsszamHelp">
                        <div id="torzsszamHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="vezeto" class="form-label">Vezető</label>
                        <select id="vezeto" class="form-select">
                            <?php
                            /**
                             * @var \Teszt\Models\dolgozokDataModel[] $_vezetok
                             */
                            if(isset($_vezetok)) {
                                foreach ($_vezetok as $vezeto) {
                                    echo "<option value=\"" . $vezeto->id . "\">" . $vezeto->nev . "</option>";
                                }
                            }?>
                            <option value="0"> - Ő egy vezető -</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="torol">Töröl</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégsem</button>
                <button type="button" class="btn btn-primary" id="ment">Ment</button>
            </div>
        </div>
    </div>
</div>
<!--[name:js]-->
<script>
    var myModal = new bootstrap.Modal(document.getElementById('dolgozoModal'), {
        keyboard: false
    });
    var id = 0;
    var title = $("#dolgozoModal").find(".modal-title").text();
    function reset() {
        $("#form")[0].reset();
        $("#dolgozoModal").find(".modal-title").text(title);
    }

    var dt = $('#dolgozok').DataTable({
        ajax: "dolgozok/ajax/dolgozolista",
        dataSrc: "data",
        columns: [
            {data: "nev"},
            {data: "munkakor"},
            {data: "torzsszam"},
            {data: "vezeto"},
            {data: "buttons2"}
        ]
    });
    $(document).ready(function () {
        $("#uj").on("click", function () {
            id = 0;
            reset();
            myModal.show();
        });
        $("#delete").on("click", function () {

        });
        $(document).on("click",".mod", function () {
            id = $(this).attr("href");
            $.ajax({
                type: "GET",
                url: "dolgozok/ajax/dolgozo?id="+id,
                dataType: "json",
            }).done(function (data){
                if(data.status === 1){
                    $("#dolgozoModal").find(".modal-title").text(data.data.nev+" dolgozó adatainak módosítása")
                    $("#nev").val(data.data.nev);
                    $("#torzsszam").val(data.data.torzsszam);
                    $("#munkakor").val(data.data.munkakor);
                    $("#vezeto").val(data.data.vezeto);
                    myModal.show();
                }
                else{
                    id = 0;
                    sendText(data.message);
                }
            }).fail(function () {
                id = 0;
                console.error("HIBA");
            });
            return false;
        });
    });
</script>