<div class="jumbotron text-center mb-0">
    <h1>RESTAR ARTÍCULOS</h1>
</div>
<form action="<?php echo getUrl("Salida", "Salida", "postSalidaMasiva"); ?>" method="post">
    <div id="conten">
        <div class="shadow card bg-light text-success mb-3 mt-3 pb-3">
            <div class="form-group mr-3">
                <div class="form-check">
                    <label for="tipo">Tipo articulo:</label>
                    <select name="tipo" id="tipo" class="custom-select" required data-url="<?= getUrl("Salida", "Salida", "SelectEntrada", false, "ajax") ?>">
                        <option selected disabled value="">Seleccione..</option>
                        <?php foreach ($tipos as $tp) {
                            echo "<option value='" . $tp["Tart_id"] . "'>" . $tp["Tart_descripcion"] . "</option>";
                        } ?>
                    </select>
                    <div class="invalid-feedback">Seleccione el tipo de articulo</div>
                    <div class="valid-feedback">El tipo de articulo es correcto</div>
                </div>
            </div>
            <div class="form-group mr-3">
                <div class="form-check">
                    <label for="Articulos">Nombre articulo:</label>
                    <select name="Arti_id[]" id="Articulos" class="custom-select" required data-url="<?= getUrl("Salida", "Salida", "cantidad", false, "ajax") ?>">
                        <option selected disabled value="">Seleccione..</option>
                    </select>
                    <div class="invalid-feedback">Seleccione el articulo</div>
                    <div class="valid-feedback">El articulo es correcto</div>
                </div>
            </div>
            <div class="invalid-feedback">Seleccione el articulo</div>
            <div class="valid-feedback">El articulo es correcto</div>
            <div id="noHay" class="alert alert-danger d-none" role="alert">
                <strong>ps!</strong> no hay suficiente stock de ese articulo para tal cantidad
            </div>
            <div id="contieneInput" class="form-check col-12">
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end x_panel">
        <button id="agregarDiv" type="button" class="btn btn-primary justify-content-end">
            <i class="fa fa-plus"></i>
        </button>
    </div>
    <div class="x_title"></div>
    <div class="x_panel">
        <button type="submit" name="enviar" id="send" class="btn btn-success btn-lg btn-block">
            DAR SALIDA
        </button>
    </div>
</form>