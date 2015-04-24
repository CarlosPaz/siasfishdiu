<style>
    span.k-datepicker, span.k-timepicker, span.k-datetimepicker, span.k-colorpicker, span.k-numerictextbox, span.k-combobox, span.k-dropdown {
        margin-right: 100%;
        width: 92%;
    }
    .k-block, .k-button, .k-textbox, .k-drag-clue, .k-touch-scrollbar, .k-window, .k-window-titleless .k-window-content, .k-window-action, .k-inline-block, .k-grid .k-filter-options, .k-grouping-header .k-group-indicator, .k-autocomplete, .k-multiselect, .k-combobox, .k-dropdown, .k-dropdown-wrap, .k-datepicker, .k-timepicker, .k-colorpicker, .k-datetimepicker, .k-numerictextbox, .k-picker-wrap, .k-numeric-wrap, .k-colorpicker.k-list-container, .k-calendar-container, .k-calendar td, .k-calendar .k-link, .k-treeview .k-in, .k-editor-inline, .k-tooltip, .k-tile, .k-slider-track, .k-slider-selection, .k-upload {
        margin-right: 100%;
        width: 100%;
    }

    .modal-title {font-size: 2em; padding-left: 2%;}
</style>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Modificar Persona</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <form id="frmNew" action="<?= site_url('persona/actualizar_persona') ?>" method="POST" role="form">
                         <input id="txt_id" name="txt_id" class="hide " value="<?php if (isset($txt_id)) echo $txt_id ?>">
                        <div class="form-group row-fluid " style="display: table">
                            <label for="normal-field" class="control-label col-lg-4">Nombre Completo</label>
                            <div class="controls col-lg-8">
                                <span class="row-fluid k-textbox">
                                    <input id="txt_nombre_completo" name="txt_nombre_completo" class="form-control " value="<?php if (isset($txt_nombre_completo)) echo $txt_nombre_completo ?>">
                                </span>
                            </div>
                        </div>
                        <div class="form-group row-fluid " style="display: table">
                            <label for="normal-field" class="control-label col-lg-4">Tipo de Persona</label>
                            <div class="controls col-lg-8">
                                <input id="cb_tipo_persona" name="cb_tipo_persona" class="row-fluid " value="<?php if (isset($cb_tipo_persona)) echo $cb_tipo_persona ?>" />
                            </div>
                        </div>
                        <div class="form-group row-fluid " style="display: table">
                            <label for="normal-field" class="control-label col-lg-4">Rol de Persona</label>
                            <div class="controls col-lg-8">
                                <input id="cb_rol_persona" name="cb_rol_persona" class="row-fluid " value="<?php if (isset($cb_rol_persona)) echo $cb_rol_persona ?>" />
                            </div>
                        </div>
                        <div class="form-group row-fluid " style="display: table">
                            <label for="normal-field" class="control-label col-lg-4">Nro. de Documento</label>
                            <div class="controls col-lg-8">
                                <span class="row-fluid k-textbox">
                                    <input id="txt_documento_identidad" name="txt_documento_identidad" class="form-control " value="<?php if (isset($txt_documento_identidad)) echo $txt_documento_identidad ?>">
                                </span>
                            </div>
                        </div>
                        <div class="form-group row-fluid " style="display: table">
                            <label for="normal-field" class="control-label col-lg-4">Telefono</label>
                            <div class="controls col-lg-8">
                                <span class="row-fluid k-textbox">
                                    <input id="txt_telefono" name="txt_telefono" class="form-control " value="<?php if (isset($txt_telefono)) echo $txt_telefono ?>">
                                </span>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button id="close" type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button id="submit" type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
<script type="text/javascript">
    var cb_rol_persona, cb_tipo_persona;

    $(document).ready(function () {

        $.populateComboBox('#cb_rol_persona', "Seleccione Rol", 'Rol', 'id_rol_persona', <?php echo (isset($arrRol)) ? $arrRol : 'null' ?>, 1);//, arr_TipEmp);       
        cb_rol_persona = $("#cb_rol_persona").data("kendoComboBox");

        $.populateComboBox('#cb_tipo_persona', "Seleccione Tipo", 'Tipo', 'id_tipo_persona', <?php echo (isset($arrTipo)) ? $arrTipo : 'null' ?>, 1);
        cb_tipo_persona = $("#cb_tipo_persona").data("kendoComboBox");

        $.saveModal('#frmNew', 'button#submit', '#tbData', '#msgForm', "Procesando...");

//        $('#submit').on('click', (function () {
//            $(dlgNew).modal('hide');
//        }));

    });
</script>