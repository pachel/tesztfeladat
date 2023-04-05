<!--[layout:layout.php]-->
<!--[name:content]-->
<div class="bd-callout bd-callout-info">
    Ha nem zöld a háttere minden sornak, akkor az eredményeket nem lehet véglegesíteni, mert valami hiba van!
    <br>
    pl.: A felvitt és kitöltött célok cáma nem <b>{{min_ct}} és {{max_ct}}</b> között van, vagy valamelyik prioritás nagyobb arányban van, mint amennyi engedélyezett!
    <br>
    Ha valamelyik nagyobb prioritású cél nagyobb arányban van jelen az értékelésben a dolgozó értékelésénél, akkor az piros háttérrelvan kiemelve, ezeket a sorokat törölni kell, vagy hozzá kell adni új sorokat, hogy az arányok jók legyenek!
</div>
<h2>Eddigi eredmény: <span class="badge bg-success" id="eredmeny">%</span></h2>
<table class="table table-striped" id="dolgozok">
    <thead>
    <tr>

        <th>Név</th>
        <th>Munkakör</th>
        <th>Törzsszám</th>
        <th>Kitöltve</th>
        <th>Értékelés</th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>
<button class="btn btn-success form-control mb-5 mt-5" type="button" id="veglegesit">Az értékelés véglegesítése</button>
<div class="alert alert-warning fade" role="alert">
    asjda sdj k
</div>
<div class="modal hide" tabindex="-1" id="dolgozoModal">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dolgozó hozzáadása/szerkesztése</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table" id="ertekeles">
                    <thead>
                    <tr>
                        <th>Cél</th>
                        <th>Prioritás</th>
                        <th>Érték</th>
                        <th></th>
                    </tr>
                    <tr class="proto">
                        <td class="cel">
                            <input type="hidden" value="">
                        </td>
                        <td class="prioritas"></td>
                        <td class="ertek"></td>
                        <td>
                            <button type="button" class="btn btn-danger ertTorol">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                    <tr>
                        <th class="cel">
                            <form id="addForm">
                            <select class="form-select" name="cel">
                                <option value="-1">Válasszon!</option>
                                <?php
                                if(isset($_celok)) {
                                    foreach ($_celok as $cel) {
                                        echo "<option value=\"".$cel->id."\">".$cel->nev."</option>";
                                    }
                                }
                                ?>
                            </select>
                        </th>
                        <th class="prioritas">
                            <select class="form-select" name="prioritas">
                                <option value="-1">Válasszon!</option>
                                <?php
                                if(isset($_prioritasok)) {
                                    foreach ($_prioritasok as $cel) {
                                        echo "<option value=\"".$cel->ertek."\" data-max=\"".$cel->maximum."\">".$cel->nev."</option>";
                                    }
                                }
                                ?>
                            </select>
                        </th>
                        <th class="ertek">
                            <select class="form-select" name="ertek">
                                <option value="-1">Válasszon!</option>
                                <?php
                                if(isset($_ertekek)) {
                                    foreach ($_ertekek as $cel) {
                                        echo "<option value=\"".$cel->pont."\">".$cel->nev."</option>";
                                    }
                                }
                                ?>
                            </select>
                        </th>
                        <th>
                            <button class="btn btn-success add" type="button">+</button>
                            </form>
                        </th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezár</button>
            </div>
        </div>
    </div>
</div>

<!--[name:js]-->
<script>
    var min_ = {{min_ct}};
    var max_ = {{max_ct}};
    var mentheto = true;
</script>
<script src="ui/js/ertekeles.js?key=<?=\Pachel\EasyFrameWork\Functions::get_random_string()?>"></script>
<script src="ui/js/main.js"></script>