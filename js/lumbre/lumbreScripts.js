
var globalApp = "Lumbre Consulting";
var arrMensajes = new Array("No se admite el valor ", //0
                            "No se pudo procesar su petición, comuniquese con el area de soporte!",//1
                            "Usted no tiene acceso a esta funcionalidad", //2
                            "Error 320!"//3
                            );

jQuery.onlyNumbers = function( objeto ){
    // solo permite ingresar numeros
    $(objeto).keydown(function(e) {
        if ((e.keyCode < 48 || e.keyCode > 57) && 
            (e.keyCode < 96 || e.keyCode > 105) && 
            e.keyCode != 8 && e.keyCode != 9 && 
            e.keyCode != 35 && e.keyCode != 36 && 
            e.keyCode != 37 && e.keyCode != 39 && e.keyCode != 46)
            e.preventDefault();
    });
};

jQuery.saveModal = function( objeto, boton, grid, msgForm, txtProce, redirect){
    // solo permite ingresar numeros
    $(objeto).submit(function(event) {  
        event.preventDefault();  
        var url = $(this).attr('action');  
        var datos = $(this).serialize();
        
        var jon = $(this).serializeArray();
        var tmp, val1, val2, pivot = '_input';
        
        for (var k in jon){
            val1 = '', val2 = '';
            tmp = jon[k].name;
            if (tmp.indexOf(pivot) < 0 && tmp.substring(0, 3) === 'cb_'){
                //if ( tmp.length == (pivot.length + tmp.indexOf(pivot) - 1 ) ){ }
                //console.log(tmp);
                var combobox = $("#"+tmp).data("kendoComboBox");
                if (combobox !== undefined){
                    if (combobox.text() !== '' && combobox.value() != ''){
                        if (combobox.text() === combobox.value()){
                            jAlert(arrMensajes[0] + combobox.text(), globalApp);
                            return;
                        }
                    }
                }
            }
        }
        
        if (boton !== ''){
            $(boton).attr("disabled", "disabled");
            var txtBoton = $(boton).html();
            $(boton).html(txtProce);
        }
        $.ajax({
            type: "POST",
            dataType: "html",
            url: url,
            data: datos,
            beforeSend: function(){
                $("#loading").show();
            },
            success: function(resultado){
                resultado = $.trim(resultado);
                if (resultado === ''){
                    if(grid !== null){
                        var objGrid = $(grid).data("kendoGrid");
                        objGrid.dataSource.read();
                        objGrid.refresh();
                    }                        
                    if(redirect !== null){
//                       if(gs_idioma === 'es')  
                            if(redirect === "main/logout"){
                            jAlert("La contraseña se cambio correctamente",globalApp);
                            window.location = redirect; // QUITADO, REDIRECCIONABA A UNDEFINED
                            }
                           // else{window.location = redirect; } // QUITADO, REDIRECCIONABA A UNDEFINED
//                        else
//                            jAlert("The password was changed successfully",globalApp);
                    }
                    $('#close').trigger('click');
                }else {
                    jAlert(resultado, globalApp);
                }
                //$(msgForm).html(resultado);
                if (boton !== ''){
                    $(boton).html(txtBoton);
                    $(boton).removeAttr("disabled");                    
                }
            },
            error: function(){
                //$(msgForm).html("Ops Error!");
                jAlert(arrMensajes[1], globalApp);
                if (boton !== ''){
                    $(boton).html(txtBoton);
                    $(boton).removeAttr("disabled");
                }
            },
            complete: function() {
                $("#loading").fadeOut();
            }
        });
    });
}


jQuery.openModal = function( boton, url, dialog, param, txtProce){
    if (boton !== ''){
        $(boton).attr("disabled", "disabled");
        var txtBoton = $(boton).html();
        $(boton).html(txtProce);
    }
    $.ajax({
        type: "POST",
        dataType: "html",
        url: url,
        data: param,
        beforeSend: function(){
            $("#loading").show();
        },
        success: function(resultado){
            if (resultado){
                $(dialog).html(resultado);
                $(dialog).modal('show');
            } else {
                jAlert ('Error2: '+arrMensajes[2], globalApp);
            }
            if (boton !== ''){
                $(boton).html(txtBoton);
                $(boton).removeAttr("disabled");                    
            }
        },
        error: function(){
            if (boton !== ''){
                $(boton).html(txtBoton);
                $(boton).removeAttr("disabled");                    
            }
            jAlert('Error3: '+arrMensajes[3], globalApp);
        },
        complete: function() {
            $("#loading").fadeOut();
        }
    });
    
}

jQuery.populateDropDownList = function( objeto, textplace, cbtext, cbvalue, URL, modo, arrKCB ){
    
    var sVal    = '',
        sText   = '', 
        bBind   = true;
    
    if ( arrKCB != undefined && arrKCB.length == 3 ){
        sVal  = arrKCB[0];
        sText = arrKCB[1];
        bBind = arrKCB[2];
    }    
    
    if (modo == 0){
        $(objeto).kendoDropDownList({
            index: 0,
            optionLabel: textplace,
            dataTextField: cbtext,
            dataValueField: cbvalue,
            text : sText,
            value : sVal,
            autoBind : bBind,
            filter: "contains",
            dataSource: {
                serverPaging: true,
                pageSize: 20,
                transport: {
                    read: {
                        type: "POST",
                        dataType: "json",
                        url: URL
                    }
                }
            }
        });
    } else if (modo == 1) {
        
        if (URL == null){
            URL = '';
        }
        var valor = new kendo.data.ObservableArray(URL);
        
        $(objeto).kendoDropDownList({
            index: 0,
            optionLabel: textplace,
            dataTextField: cbtext,
            dataValueField: cbvalue,
            filter: "contains",
            dataSource: valor
        });
        
        if(arrKCB != undefined )
        {
            $(objeto).data("kendoDropDownList").value(sVal);
            $(objeto).data("kendoDropDownList").text(sText);
        }
    }
    
    try
    {
        if(arrKCB == undefined )
        {
            if($(objeto).data("kendoDropDownList").dataSource._total == 1)
            {
                $(objeto).data("kendoDropDownList").value($(objeto).data("kendoDropDownList").dataSource._data[0][cbvalue]);
            }
        }
    }
    catch(Ex)
    {}
    
}

jQuery.populateComboBox = function( objeto, textplace, cbtext, cbvalue, URL, modo, arrKCB ){
    // solo permite ingresar numeros
    var sVal    = '',
        sText   = '', 
        bBind   = true;
    
    if ( arrKCB !== undefined && arrKCB.length === 3 ){
        sVal  = arrKCB[0];
        sText = arrKCB[1];
        bBind = arrKCB[2];
    }
    
    if (modo === 0){
        $(objeto).kendoComboBox({
            index: -1,
            placeholder: textplace,
            dataTextField: cbtext,
            dataValueField: cbvalue,
            text : sText,
            value : sVal,
            autoBind : bBind,
            filter: "contains",
            dataSource: {
                serverPaging: true,
                pageSize: 20,
                transport: {
                    read: {
                        type: "POST",
                        dataType: "json",
                        url: URL
                    }
                }
            }
        });
    } else if (modo === 1) {
        
        if (URL === null){
            URL = '';
        }
        var valor = new kendo.data.ObservableArray(URL);
        $(objeto).kendoComboBox({
            index: -1,
            placeholder: textplace,
            dataTextField: cbtext,
            dataValueField: cbvalue,
            filter: "contains",
            dataSource: valor
        });
        
        if(arrKCB !== undefined )
        {
            $(objeto).data("kendoComboBox").value(sVal);
            $(objeto).data("kendoComboBox").text(sText);
        }
    }
    
    try
    {
        if(arrKCB === undefined)
        {
            if($(objeto).data("kendoComboBox").dataSource._total === 1)
            {
                $(objeto).data("kendoComboBox").value($(objeto).data("kendoComboBox").dataSource._data[0][cbvalue]);
            }
        }
    }
    catch(Ex)
    {}
    
}

    //Funcion de obj read only 
    function readOnly(obj){
        $("#"+obj).attr('readonly',true);            
    }
    
    function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if( !emailReg.test( $email ) ) {
      return false;
    } else {
      return true;
    }
  }