<form action="<?php echo getUrl("costos","cotizacion","aprobarCotizacion"); ?>" method="post" class="m-auto">
    <div class="modal-body">
        <div class="form-group row">
            <label class="control-label col-md-6 col-sm-6 ">Codigo Cotizacion:</label>
            <div class="col-md-6 col-sm-6 ">
                <input type="text" id="codigoPedido" name="Ped_id" class="form-control" placeholder=""
                    readonly="readonly" value="<?php echo $id; ?>">
            </div>
        </div>

        <?php if($detalleCotizacion->num_rows >0){ ?>


        <p style="font-size: 15px">Esta a punto de aprobar la cotizacion, ¿Desea continuar?</p>

        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <table id="datatable-responsive-costos-cotizacion-pendiente"
                            class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                            width="100%">
                            <thead style="background-color:#17A481; color:#fff;">
                                <tr>
                                    <th cope="col">No. Item</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Valor Total</th>
                                </tr>
                            <tbody>
                                <?php
                                        echo "<tr>";
                                    $contadorItem = 0;
                                    foreach($detalleCotizacion as $dc){
                                        $contadorItem++;
                                        echo "
                                        <td>".$contadorItem."</td>
                                        <td>".$dc['Pba_descripcion']."</td>
                                        <td>".$dc['Dpe_cantidad']."</td>
                                        <td>".$dc['Dpe_valorTotal']."</td>
                                        </tr>
                                        ";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success">Aceptar</button>
    </div>





    <?php  
        }else{ ?>
        <br>
    <p style="font-size: 20px" >Esta cotizacion no se puede aprobar debido a que no cuenta con ningun producto relacionado.</p>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success"  disabled = "disabled" >Aceptar</button>
    </div>



    <?php
        }               
        ?>
</form>