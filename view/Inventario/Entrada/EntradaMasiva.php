<div class="x_panel text-center">
    <h2 class="display-4">AGREGAR ARTÍCULOS</h2>
</div>
<form class="needs-validation" invalidate action="<?php echo getUrl("Entrada", "Entrada", "postentradaMasiva"); ?>" method="post">
    <!-- div cartas entrada artículos -->
    <div id="conten">
        <div class="shadow card bg-light text-success mb-3 pb-3">
            <div class="form-group col-12 mt-3 ml-0">
                <div class="form-check ml-0">
                    <label for="tipo">Tipo articulo:</label>
                    <select name="tipo[]" id="tipo" class="custom-select" required data-url="<?= getUrl("Entrada", "Entrada", "SelectEntrada", false, "ajax") ?>">
                        <option selected disabled value="">Seleccione..</option>
                        <option value="Materia Prima">Materia Prima </option>
                        <option value="Insumos">Insumos </option>
                        <option value="Maquina">Maquina </option>
                        <option value="Herramienta">Herramienta </option>
                    </select>
                    <div class="invalid-feedback">Selecione un tipo de articulo</div>
                    <div class="valid-feedback">La herramienta es correcta!!</div>
                </div>
            </div>
            <div class="form-group col-12">
                <div class="form-check ml-0">
                    <label for="Articulos">Nombre articulo:</label>
                    <select name="Arti_id[]" id="Articulos" class="custom-select" required>
                        <option selected disabled value="">Seleccione..</option>
                    </select>
                    <div class="invalid-feedback">Seleccione el articulo</div>
                    <div class="valid-feedback">El articulo es correcto</div>
                </div>
            </div>

            <div class="form-group col-12">
                <div class="form-check ml-0">
                    <label for="Arti_cantidad">Cantidad</label>
                    <input type="number" id="Arti_cantidad"  name="Arti_cantidad[]" class="form-control" required min="0" value="">
                    <div class="invalid-feedback">Agrege la cantidad deseada</div>
                    <div class="valid-feedback">La cantidad es valida</div>
                </div>
            </div>

        </div>
    </div>

    <div class="d-flex justify-content-end x_panel">
        <button id="agregarDiv" title="+ Articulo" type="button" class="btn btn-primary justify-content-end mr-0">
            <i class="fa fa-plus"></i>
        </button>
    </div>

    <div class="x_title"></div>

    <div class="x_panel" style="z-index: 100;">
        <button id="send" type="submit" name="enviar" class="btn btn-success btn-lg btn-block">
            AGREGAR
        </button>
    </div>
</form>