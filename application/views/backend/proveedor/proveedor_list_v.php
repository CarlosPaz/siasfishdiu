<style> body{font-size: 1.5em;}
</style>
<!-- MAIN BODY -->
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Proveedores</h1>
            </div>
            <!-- /.col-lg-12 -->

            <button id="btnNew" class="btn btn-info btn" data-toggle="modal" >Nuevo</button>
            <button id="btnEdit" class="btn btn-info btn" data-toggle="modal" >Modificar</button>
            <!-- ModalNew -->
            <div id="dlgNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="font-size: 1.07em;">
                    <!-- Aquí se cargarán los fomularios -->
                </div>
            <!-- /.ModalNew -->
            <div class=" " style="margin-top: 1%;"><!-- TABLA KENDO -->
                <div id="tbData" class="table table-striped table-condensed">
                </div>
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<!-- END MAIN BODY -->
<script type="text/javascript">
    var post_data = {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'}
    $(document).ready(function () {
        $('#btnNew').on('click', (function () {
            var param = post_data;
            $.openModal('#btnNew', 'proveedor/nuevo_proveedor', '#dlgNew', param, "Procesando...");
        }));
        $('#btnEdit').on('click', (function() {
            var grid = $("#tbData").data("kendoGrid");
            var row = grid.select();
            if ( grid.dataItem(grid.select()) !== undefined){
                var id = grid.dataItem(grid.select()).id_proveedor;
                var param = {id : id};                
                $.openModal('#btnEdit', 'proveedor/editar_proveedor', '#dlgNew', param, "Procesando...");
            } else{
                console.log('Seleccion un Registro');
            }
        }));
        var dataSource = new kendo.data.DataSource({
            transport: {
                read: function (options) {
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "<?php echo base_url('proveedor/get_proveedor_list'); ?>",
                        success: function (resultado) {
                            options.success(resultado);
                        }
                    });
                }
            },
            requestStart: function () {kendo.ui.progress($("#tbData"), true);},
            requestEnd: function () {kendo.ui.progress($("#tbData"), false);},
            error: function (e) { alert('Error en la transaccion');},
            complete: function () { kendo.ui.progress($("#tbData"), false);},
            pageSize: 10,
            schema: {
                model: {
                    id: 'id_proveedor',
                    fields: {
                        id_proveedor: {type: "number"},
                        nombre_completo: {type: "string"},
                        numero_identificacion: {type: "string"},
                        telefono:{type: "number"},
                        estado: {type: "string"}
                    }
                }
            }
        });

        $("#tbData").kendoGrid({
            dataSource: dataSource,
            selectable: "row",
            sortable: true,
            filterable: false,
            pageable: {
                refresh: true,
                pageSize: true
            },
            columns: [
                {field: "nombre_completo", title: "Nombre"},
                {field: "numero_identificacion", title: "Identificación"},
                {field: "telefono", title: "Teléfono"},
                {field: "estado", title: "Estado"}         
            ]
        });
    });

</script>