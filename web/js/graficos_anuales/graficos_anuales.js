Ext.onReady(function(){
    var renderizarGraficos = function(){
        redirigirSiSesionExpiro();
        if (campoAnho.getValue() != '') {
            
            //Cambios: 24 de febrero de 2014
            //Codigos de los equipos seleccionados
            var equiposSeleccionados = maquinas_gridpanel.selModel.getSelections();
            var equiposAFiltrar = [];
            for(i = 0; i < maquinas_gridpanel.selModel.getCount(); i++){
                    equiposAFiltrar.push(equiposSeleccionados[i].json.codigo);
            }
            var arrayEquipos = Ext.encode(equiposAFiltrar);
            
            //Cambios: 24 de febrero de 2014
            //Codigos de los grupos de equipos seleccionados
            var gruposSeleccionados = grupos_gridpanel.selModel.getSelections();
            var gruposAFiltrar = [];
            for(j = 0; j < grupos_gridpanel.selModel.getCount(); j++){
                    gruposAFiltrar.push(gruposSeleccionados[j].json.gru_codigo);
            }
            var arrayGrupos = Ext.encode(gruposAFiltrar);  
            
            var params = '?anho=' + campoAnho.getValue() + '&codigo_operario=' + campoOperario.getValue() + '&cods_equipos=' + arrayEquipos + '&cods_grupos=' + arrayGrupos+ '&codigo_metodo=' + campoMetodo.getValue();            
            
            //Cambios: 24 de febrero de 2014
            //Se cargan los datos de la tabla consolidados pérdidas
            perdidasanual_datastore.load({
                params: {
                    'ano' : campoAnho.getValue(),
                    'codigo_operario' : campoOperario.getValue(),
                    'cods_equipos' : arrayEquipos,
                    'cods_grupos' : arrayGrupos,
                    'codigo_metodo' : campoMetodo.getValue()
                }
            });
            
            //Cambios: 24 de febrero de 2014
            //Se cargan los datos de la tabla consolidado tiempos
            tiemposanual_datastore.load({
                params: {
                    'ano' : campoAnho.getValue(),
                    'codigo_operario' : campoOperario.getValue(),
                    'cods_equipos' : arrayEquipos,
                    'cods_grupos' : arrayGrupos,
                    'codigo_metodo' : campoMetodo.getValue()
                }
            });
            
            //Cambios: 24 de febrero de 2014
            //Se cargan los datos de la tabla consolidados indicadores
            indicadoresanual_datastore.load({
                params: {
                    'ano' : campoAnho.getValue(),
                    'codigo_operario' : campoOperario.getValue(),
                    'cods_equipos' : arrayEquipos,
                    'cods_grupos' : arrayGrupos,
                    'codigo_metodo' : campoMetodo.getValue()
                }
            });
            
            //Cambios: 24 de febrero de 2014
            //Se cargan los datos de la tabla consolidados pérdidas
            ahorrosanual_datastore.load({
                params: {
                    'ano' : campoAnho.getValue(),
                    'codigo_operario' : campoOperario.getValue(),
                    'cods_equipos' : arrayEquipos,
                    'cods_grupos' : arrayGrupos,
                    'codigo_metodo' : campoMetodo.getValue()
                }
            });
            
            
            
            //Obtener el nombre de los equipos seleccionados
            maqanual_datastore.load({
                params: {
                    'cods_equipos' : arrayEquipos
                }
            });

            //Obtener el nombre de los equipos seleccionados
            gruanual_datastore.load({
                params: {
                    'cods_grupos' : arrayGrupos
                }
            });
            
            //Tiempos
            var so = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "500", "400", "8", "#FFFFFF");
            so.addVariable("path", urlWeb + "flash/amline/");
            so.addParam("wmode", "opaque");
            so.addVariable("settings_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarConfiguracionGraficoTiemposLineas')));
            so.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarDatosGraficoTiemposLineas' + params)));
            if (Ext.get('flashcontent1')) {
                so.write("flashcontent1");
            }
            
            var so = new SWFObject(urlWeb + "flash/ampie/ampie.swf", "ampie", "420", "400", "8", "#FFFFFF");
            so.addVariable("path", urlWeb + "flash/ampie/");
            so.addParam("wmode", "opaque");
            so.addVariable("settings_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarConfiguracionTortaTiempos')));
            so.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarDatosTortaTiempos' + params)));
            if (Ext.get('flashcontent2')) {
                so.write("flashcontent2");
            }
            
            
            //Indicadores
            var so = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "480", "400", "8", "#FFFFFF");
            so.addVariable("path", urlWeb + "flash/amline/");
            so.addParam("wmode", "opaque");
            so.addVariable("settings_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarConfiguracionGraficoIndicadoresLineas')));
            so.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarDatosGraficoIndicadoresLineas' + params)));
            if (Ext.get('flashcontent3')) {
                so.write("flashcontent3");
            }
            
            var so = new SWFObject(urlWeb + "flash/amcolumn/amcolumn.swf", "amcolumn", "460", "400", "8", "#FFFFFF");
            so.addVariable("path", urlWeb + "flash/amcolumn/");
            so.addParam("wmode", "opaque");
            so.addVariable("settings_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarConfiguracionGraficoIndicadoresColumnas')));
            so.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarDatosGraficoIndicadoresColumnas' + params)));
            if (Ext.get('flashcontent4')) {
                so.write("flashcontent4");
            }
            
            
            //Pérdidas
            var so = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "500", "400", "8", "#FFFFFF");
            so.addVariable("path", urlWeb + "flash/amline/");
            so.addParam("wmode", "opaque");
            so.addVariable("settings_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarConfiguracionGraficoPerdidasLineas')));
            so.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarDatosGraficoPerdidasLineas' + params)));
            if (Ext.get('flashcontent5')) {
                so.write("flashcontent5");
            }
            
            var so = new SWFObject(urlWeb + "flash/ampie/ampie.swf", "ampie", "430", "400", "8", "#FFFFFF");
            so.addVariable("path", urlWeb + "flash/ampie/");
            so.addParam("wmode", "opaque");
            so.addVariable("settings_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarConfiguracionTortaPerdidas')));
            so.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarDatosTortaPerdidas' + params)));
            if (Ext.get('flashcontent6')) {
                so.write("flashcontent6");
            }
            
            
            //Lotes e inyecciones            
            var so = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "500", "400", "8", "#FFFFFF");
            so.addVariable("path", urlWeb + "flash/amline/");
            so.addParam("wmode", "opaque");
            so.addVariable("settings_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarConfiguracionGraficoMuestrasLineas')));
            so.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarDatosGraficoMuestrasLineas' + params)));
            if (Ext.get('flashcontent7')) {
                so.write("flashcontent7");
            }
            
            var so = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "500", "400", "8", "#FFFFFF");
            so.addVariable("path", urlWeb + "flash/amline/");
            so.addParam("wmode", "opaque");
            so.addVariable("settings_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarConfiguracionGraficoInyeccionesLineas')));
            so.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarDatosGraficoInyeccionesLineas' + params)));
            if (Ext.get('flashcontent8')) {
                so.write("flashcontent8");
            }
            
            
            //Ahorros
            var so = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "500", "400", "8", "#FFFFFF");
            so.addVariable("path", urlWeb + "flash/amline/");
            so.addParam("wmode", "opaque");
            so.addVariable("settings_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarConfiguracionGraficoAhorrosLineas')));
            so.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarDatosGraficoAhorrosLineas' + params)));
            if (Ext.get('flashcontent9')) {
                so.write("flashcontent9");
            }
            
            var so = new SWFObject(urlWeb + "flash/ampie/ampie.swf", "ampie", "430", "400", "8", "#FFFFFF");
            so.addVariable("path", urlWeb + "flash/ampie/");
            so.addParam("wmode", "opaque");
            so.addVariable("settings_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarConfiguracionTortaAhorros')));
            so.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarDatosTortaAhorros' + params)));
            if (Ext.get('flashcontent10')) {
                so.write("flashcontent10");
            }
        }
    }
    
    var maquinas_datastore = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: getAbsoluteUrl('graficos_anuales', 'listarEquiposActivos'),
            method: 'POST'
        }),
        reader: new Ext.data.JsonReader({
            root: 'data'
        }, [{
            name: 'codigo',
            type: 'string'
        }, {
            name: 'nombre',
            type: 'string'
        }])
    });    
    maquinas_datastore.load();
    
/**********************************************************************/
//Cambios: 24 de febrero de 2014
//Interfaz para seleccionar los equipos a filtrar en el reporte
var maquina_selmodel = new Ext.grid.CheckboxSelectionModel({
        singleSelect:false
});

var maquina_colmodel = new Ext.grid.ColumnModel({
        defaults:{sortable: true, locked: false, resizable: true},
        columns:[
            maquina_selmodel,
            { header: "Id", width: 30, dataIndex: 'codigo', hidden:true},
            { header: "Nombre del Equipo", width: 430, dataIndex: 'nombre'}
        ]
});

var maquinas_gridpanel = new Ext.grid.GridPanel({
        id: 'maquinas_gridpanel',
        stripeRows:true,
        frame: true,
        ds: maquinas_datastore,
        cm: maquina_colmodel,
        sm: maquina_selmodel
});

var win_maquinas_anual = new Ext.Window(
{
    layout : 'fit',
    width : 500,
    height : 400,
    closeAction : 'hide',
    plain : true,
    title : 'Equipos',
    items : maquinas_gridpanel,
    buttons : [
    {
          text : 'Aceptar',
          handler : function()
          {
            win_maquinas_anual.hide();
        }
    }],
    listeners :
    {
          hide : function()
          {
            Ext.getBody().unmask();
          }
    }
});
/**********************************************************************/
//Cambios: 24 de febrero de 2014
//Interfaz para seleccionar los grupos de equipos a filtrar en el reporte
var grupos_datastore = new Ext.data.Store({
    proxy: new Ext.data.HttpProxy({
        url: getAbsoluteUrl('graficos_anuales', 'listarGruposActivos'),
        method: 'POST'
    }),
    reader: new Ext.data.JsonReader({
        root: 'data'
    }, [{
        name: 'gru_codigo',
        type: 'string'
    }, {
        name: 'gru_nombre',
        type: 'string'
    }])
});    
grupos_datastore.load();
    
var grupo_selmodel = new Ext.grid.CheckboxSelectionModel({
        singleSelect:false
});

var grupo_colmodel = new Ext.grid.ColumnModel({
        defaults:{sortable: true, locked: false, resizable: true},
        columns:[
            grupo_selmodel,
            { header: "Id", width: 30, dataIndex: 'gru_codigo', hidden:true},
            { header: "Nombre del Grupo", width: 430, dataIndex: 'gru_nombre'}
        ]
});

var grupos_gridpanel = new Ext.grid.GridPanel({
        id: 'grupos_gridpanel',
        stripeRows:true,
        frame: true,
        ds: grupos_datastore,
        cm: grupo_colmodel,
        sm: grupo_selmodel
});

var win_grupos_anual = new Ext.Window(
{
    layout : 'fit',
    width : 500,
    height : 400,
    closeAction : 'hide',
    plain : true,
    title : 'Grupo de Equipos',
    items : grupos_gridpanel,
    buttons : [
    {
          text : 'Aceptar',
          handler : function()
          {
            win_grupos_anual.hide();
        }
    }],
    listeners :
    {
          hide : function()
          {
            Ext.getBody().unmask();
          }
    }
});
/**********************************************************************/   
    
    var metodos_datastore = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: getAbsoluteUrl('graficos_anuales', 'listarMetodos'),
            method: 'POST'
        }),
        reader: new Ext.data.JsonReader({
            root: 'data'
        }, [{
            name: 'codigo',
            type: 'string'
        }, {
            name: 'nombre',
            type: 'string'
        }])
    });
    
    metodos_datastore.load({
        callback: function(){
            metodos_datastore.loadData({
                data: [{
                    'codigo': '-1',
                    'nombre': 'TODOS'
                }]
            }, true);
            campoMetodo.setValue('-1');
            renderizarGraficos();
        }
    });
    
    var operarios_datastore = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: getAbsoluteUrl('graficos_anuales', 'listarOperarios'),
            method: 'POST'
        }),
        reader: new Ext.data.JsonReader({
            root: 'data'
        }, [{
            name: 'codigo',
            type: 'string'
        }, {
            name: 'nombre',
            type: 'string'
        }])
    });
    
    operarios_datastore.load({
        callback: function(){
            operarios_datastore.loadData({
                data: [{
                    'codigo': '-1',
                    'nombre': 'TODOS'
                }]
            }, true);
            campoOperario.setValue('-1');
            renderizarGraficos();
        }
    });
    
    var campoAnho = new Ext.ux.form.SpinnerField({
        fieldLabel: 'Año',
        value: (new Date()).getFullYear(),
        minValue: 0,
        maxValue: 9999,
        incrementValue: 1,
        width: 60
    });
    
    var campoOperario = new Ext.form.ComboBox({
        fieldLabel: 'Analista',
        store: operarios_datastore,
        displayField: 'nombre',
        valueField: 'codigo',
        mode: 'local',
        triggerAction: 'all',
        forceSelection: true,
        allowBlank: false,
        width: 130
    });
    
    var campoMetodo = new Ext.form.ComboBox({
        fieldLabel: 'Método',
        store: metodos_datastore,
        displayField: 'nombre',
        valueField: 'codigo',
        mode: 'local',
        triggerAction: 'all',
        forceSelection: true,
        allowBlank: false,
        width: 130
    });


//Cambios: 24 de febrero de 2014
//Color de celdas de las tablas de consolidado
var generarRendererTiempos = function()
{
    return function(valor, metaData, record, rowIndex, colIndex, store)
    {
        if (rowIndex == 0) {
            return '<div style="background-color: #47d552; color: #000000">' + valor + '</div>';
        } else if(rowIndex == 1) {
            return '<div style="background-color: #ffdc44; color: #000000">' + valor + '</div>';
        } else if(rowIndex == 2) {
            return '<div style="background-color: #ff5454; color: #000000">' + valor + '</div>';
        } else if(rowIndex == 3) {
            return '<div style="background-color: #72a8cd; color: #000000">' + valor + '</div>';
        } else {
            return valor;
        }
    }
}
var generarRendererIndicadores = function()
{
    return function(valor, metaData, record, rowIndex, colIndex, store)
    {
        if (rowIndex == 0) {
            return '<div style="background-color: #ff5454; color: #000000">' + valor + '</div>';
        } else if(rowIndex == 1) {
            return '<div style="background-color: #47d552; color: #000000">' + valor + '</div>';
        } else if(rowIndex == 2) {
            return '<div style="background-color: #f0a05f; color: #000000">' + valor + '</div>';
        } else if(rowIndex == 3) {
            return '<div style="background-color: #ffdc44; color: #000000">' + valor + '</div>';
        } else if(rowIndex == 4) {
            return '<div style="background-color: #72a8cd; color: #000000">' + valor + '</div>';
        } else if(rowIndex == 5) {
            return '<div style="background-color: #b97a57; color: #000000">' + valor + '</div>';
        } else {
            return valor;
        }
    }
}
var generarRendererPerdidas = function()
{
    return function(valor, metaData, record, rowIndex, colIndex, store)
    {
        if (rowIndex == 0) {
            return '<div style="background-color: #ff5454; color: #000000">' + valor + '</div>';
        } else if(rowIndex == 1) {
            return '<div style="background-color: #47d552; color: #000000">' + valor + '</div>';
        } else if(rowIndex == 2) {
            return '<div style="background-color: #47d599; color: #000000">' + valor + '</div>';
        } else {
            return valor;
        }
    }
}
var generarRendererAhorros = function()
{
    return function(valor, metaData, record, rowIndex, colIndex, store)
    {
        if (rowIndex == 0) {
            return '<div style="background-color: #5cd65c; color: #000000">' + valor + '</div>';
        } else if(rowIndex == 1) {
            return '<div style="background-color: #33add6; color: #000000">' + valor + '</div>';
        } else {
            return valor;
        }
    }
}



//TABLAS CONSOLIDADO TIEMPOS
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña tiempos una tabla con el consolidado de tiempos
var tiemposanual_datastore = new Ext.data.Store({
    proxy: new Ext.data.HttpProxy({
        url: getAbsoluteUrl('graficos_anuales', 'consolidadoTiemposAno'),
        method: 'POST'
    }),
    baseParams: {},
    reader: new Ext.data.JsonReader({
        root: 'results',
        totalProperty: 'total'
    }, [{
        name: 'ano_tiempo',
        type: 'string'
    }, {
        name: 'ano_horas',
        type: 'string'
    }, {
        name: 'ano_porcentaje',
        type: 'string'
    }])
});

var tiemposanual_colmodel = new Ext.grid.ColumnModel({        
    columns: [{
        header: "Indicador",
        width: 75,
        align : 'center',
        dataIndex: 'ano_tiempo',
        renderer : generarRendererTiempos()
    }, {
        header: "Días",
        width: 83,
        align : 'center',
        dataIndex: 'ano_horas',
        renderer : generarRendererTiempos()
    }, {
        header: "Porcentaje (%)",
        width: 85,
        align : 'center',
        dataIndex: 'ano_porcentaje',
        renderer : generarRendererTiempos()
    }, ]
});

var tiemposanual_gridpanel = new Ext.grid.GridPanel({
    title: 'Consolidado tiempos / Año',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: tiemposanual_datastore,
    cm: tiemposanual_colmodel,
    width: 270,
    height: 150
});
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña tiempos una tabla con el nombre de los equipos seleccionados
var maqanual_datastore = new Ext.data.Store({
    proxy: new Ext.data.HttpProxy({
        url: getAbsoluteUrl('graficos_anuales', 'equiposSeleccionados'),
        method: 'POST'
    }),
    baseParams: {},
    reader: new Ext.data.JsonReader({
        root: 'results',
        totalProperty: 'total'
    }, [{
        name: 'maq_anu_nombre',
        type: 'string'
    }])
});

var maqanual_colmodel = new Ext.grid.ColumnModel({        
    columns: [{
        header: "Nombre equipo",
        width: 230,
        align : 'left',
        dataIndex: 'maq_anu_nombre'
    }]
});

var maqanual_gridpanel_tiemp = new Ext.grid.GridPanel({
    title: 'Equipos seleccionados',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: maqanual_datastore,
    cm: maqanual_colmodel,
    width: 270,
    height: 105
});
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña tiempos una tabla con el nombre de los equipos seleccionados
var gruanual_datastore = new Ext.data.Store({
    proxy: new Ext.data.HttpProxy({
        url: getAbsoluteUrl('graficos_anuales', 'gruposSeleccionados'),
        method: 'POST'
    }),
    baseParams: {},
    reader: new Ext.data.JsonReader({
        root: 'results',
        totalProperty: 'total'
    }, [{
        name: 'gru_anu_nombre',
        type: 'string'
    }])
});

var gruanual_colmodel = new Ext.grid.ColumnModel({        
    columns: [{
        header: "Nombre grupo",
        width: 230,
        align : 'left',
        dataIndex: 'gru_anu_nombre'
    }]
});

var gruanual_gridpanel_tiemp = new Ext.grid.GridPanel({
    title: 'Grupos seleccionados',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: gruanual_datastore,
    cm: gruanual_colmodel,
    width: 270,
    height: 105
});
/*********************************************************************************/





//TABLAS CONSOLIDADO INDICADORES
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña indicadores una tabla con el consolidado del valor por indicador
var indicadoresanual_datastore = new Ext.data.Store({
    proxy: new Ext.data.HttpProxy({
        url: getAbsoluteUrl('graficos_anuales', 'consolidadoIndicadoresAno'),
        method: 'POST'
    }),
    baseParams: {},
    reader: new Ext.data.JsonReader({
        root: 'results',
        totalProperty: 'total'
    }, [{
        name: 'ano_indicador',
        type: 'string'
    }, {
        name: 'ano_actual',
        type: 'string'
    }, {
        name: 'ano_meta',
        type: 'string'
    }])
});

var indicadoresanual_colmodel = new Ext.grid.ColumnModel({        
    columns: [{
        header: "Indicador",
        width: 87,
        align : 'center',
        dataIndex: 'ano_indicador',
        renderer : generarRendererIndicadores()
    }, {
        header: "Valor Actual (%)",
        width: 93,
        align : 'center',
        dataIndex: 'ano_actual',
        renderer : generarRendererIndicadores()
    }, {
        header: "Meta (%)",
        width: 70,
        align : 'center',
        dataIndex: 'ano_meta',
        renderer : generarRendererIndicadores()
    }, ]
});

var indicadoresanual_gridpanel = new Ext.grid.GridPanel({
    title: 'Consolidado indicadores / Año',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: indicadoresanual_datastore,
    cm: indicadoresanual_colmodel,
    width: 270,
    height: 190
});
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña indicadores una tabla con el nombre de los equipos seleccionados
var maqanual_gridpanel_ind = new Ext.grid.GridPanel({
    title: 'Equipos seleccionados',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: maqanual_datastore,
    cm: maqanual_colmodel,
    width: 270,
    height: 90
});
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña indicadores una tabla con el nombre de los equipos seleccionados
var gruanual_gridpanel_ind = new Ext.grid.GridPanel({
    title: 'Grupos seleccionados',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: gruanual_datastore,
    cm: gruanual_colmodel,
    width: 270,
    height: 90
});
/*********************************************************************************/





//TABLAS CONSOLIDADO PÉRDIDAS
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña pérdidas una tabla con el consolidado del valor por indicador
var perdidasanual_datastore = new Ext.data.Store({
    proxy: new Ext.data.HttpProxy({
        url: getAbsoluteUrl('graficos_anuales', 'consolidadoPerdidasAno'),
        method: 'POST'
    }),
    baseParams: {},
    reader: new Ext.data.JsonReader({
        root: 'results',
        totalProperty: 'total'
    }, [{
        name: 'ano_perdida',
        type: 'string'
    }, {
        name: 'ano_dias_perd',
        type: 'string'
    }, {
        name: 'ano_porcentaje_perd',
        type: 'string'
    }])
});

var perdidasanual_colmodel = new Ext.grid.ColumnModel({        
    columns: [{
        header: "Indicador",
        width: 91,
        align : 'center',
        dataIndex: 'ano_perdida',
        renderer : generarRendererPerdidas()
    }, {
        header: "Días",
        width: 70,
        align : 'center',
        dataIndex: 'ano_dias_perd',
        renderer : generarRendererPerdidas()
    }, {
        header: "Porcentaje (%)",
        width: 85,
        align : 'center',
        dataIndex: 'ano_porcentaje_perd',
        renderer : generarRendererPerdidas()
    }, ]
});

var perdidasanual_gridpanel = new Ext.grid.GridPanel({
    title: 'Consolidado pérdidas / Año',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: perdidasanual_datastore,
    cm: perdidasanual_colmodel,
    width: 270,
    height: 130
});
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña pérdidas una tabla con el nombre de los equipos seleccionados
var maqanual_gridpanel_perd = new Ext.grid.GridPanel({
    title: 'Equipos seleccionados',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: maqanual_datastore,
    cm: maqanual_colmodel,
    width: 270,
    height: 115
});
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña pérdidas una tabla con el nombre de los equipos seleccionados
var gruanual_gridpanel_perd = new Ext.grid.GridPanel({
    title: 'Grupos seleccionados',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: gruanual_datastore,
    cm: gruanual_colmodel,
    width: 270,
    height: 115
});
/*********************************************************************************/





//TABLAS CONSOLIDADO AHORROS
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña ahorros una tabla con el consolidado del valor por indicador
var ahorrosanual_datastore = new Ext.data.Store({
    proxy: new Ext.data.HttpProxy({
        url: getAbsoluteUrl('graficos_anuales', 'consolidadoAhorrosAno'),
        method: 'POST'
    }),
    baseParams: {},
    reader: new Ext.data.JsonReader({
        root: 'results',
        totalProperty: 'total'
    }, [{
        name: 'ano_ahorro',
        type: 'string'
    }, {
        name: 'ano_dias_ahorro',
        type: 'string'
    }, {
        name: 'ano_porcentaje_ahorro',
        type: 'string'
    }])
});

var ahorrosanual_colmodel = new Ext.grid.ColumnModel({        
    columns: [{
        header: "Indicador",
        width: 91,
        align : 'center',
        dataIndex: 'ano_ahorro',
        renderer : generarRendererAhorros()
    }, {
        header: "Días",
        width: 70,
        align : 'center',
        dataIndex: 'ano_dias_ahorro',
        renderer : generarRendererAhorros()
    }, {
        header: "Porcentaje (%)",
        width: 85,
        align : 'center',
        dataIndex: 'ano_porcentaje_ahorro',
        renderer : generarRendererAhorros()
    }, ]
});

var ahorrosanual_gridpanel = new Ext.grid.GridPanel({
    title: 'Consolidado ahorros / Año',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: ahorrosanual_datastore,
    cm: ahorrosanual_colmodel,
    width: 270,
    height: 110
});
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña pérdidas una tabla con el nombre de los equipos seleccionados
var maqanual_gridpanel_ahorro = new Ext.grid.GridPanel({
    title: 'Equipos seleccionados',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: maqanual_datastore,
    cm: maqanual_colmodel,
    width: 270,
    height: 125
});
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña pérdidas una tabla con el nombre de los equipos seleccionados
var gruanual_gridpanel_ahorro = new Ext.grid.GridPanel({
    title: 'Grupos seleccionados',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: gruanual_datastore,
    cm: gruanual_colmodel,
    width: 270,
    height: 125
});
/*********************************************************************************/

    
    var panelGraficoTiemposAnual = new Ext.FormPanel({
        renderTo: 'panel_graficos_anuales',
        border: true,
        frame: true,
        items: [{
            layout: 'column',
            bodyStyle: 'padding-top:10px; padding-bottom:10px;',
            items: [{
                layout: 'form',
                labelWidth: 30,
                bodyStyle: 'padding-right:30px;',
                items: [campoAnho]
            }, {
                layout: 'form',
                labelWidth: 50,
                bodyStyle: 'padding-right:30px;',
                items: [campoOperario]
            }, {
                layout: 'form',
                labelWidth: 50,
                bodyStyle: 'padding-right:30px;',
                items: [campoMetodo]
            }, {
                layout: 'form',
                bodyStyle: 'padding-right:30px;',
                items: [{
                    xtype: 'button',
                    text: 'Seleccionar Equipos',
                    iconCls: 'equipo',
                    handler: function(){
                        Ext.getBody().mask();
                        win_maquinas_anual.show();
                    }
                }]
            }, {
                layout: 'form',
                bodyStyle: 'padding-right:30px;',
                items: [{
                    xtype: 'button',
                    text: 'Seleccionar Grupo de Equipos',
                    iconCls: 'grupo',
                    handler: function(){
                        Ext.getBody().mask();
                        win_grupos_anual.show();
                    }
                }]
            }, {
                layout: 'form',
                items: [{
                    xtype: 'button',
                    text: 'Generar gr&aacute;ficos',
                    iconCls: 'reload',
                    handler: function(){
                        renderizarGraficos();
                        
                        //Cambios: 24 de febrero de 2014
                        //Codigos de los equipos seleccionados
                        var equiposSeleccionados = maquinas_gridpanel.selModel.getSelections();
                        var equiposAFiltrar = [];
                        for(i = 0; i < maquinas_gridpanel.selModel.getCount(); i++){
                                equiposAFiltrar.push(equiposSeleccionados[i].json.codigo);
                        }
                        var arrayEquipos = Ext.encode(equiposAFiltrar);

                        //Cambios: 24 de febrero de 2014
                        //Codigos de los grupos de equipos seleccionados
                        var gruposSeleccionados = grupos_gridpanel.selModel.getSelections();
                        var gruposAFiltrar = [];
                        for(j = 0; j < grupos_gridpanel.selModel.getCount(); j++){
                                gruposAFiltrar.push(gruposSeleccionados[j].json.gru_codigo);
                        }
                        var arrayGrupos = Ext.encode(gruposAFiltrar);
                        
                        //Recargar datos consolidado de tiempos indicadores
                        tiemposanual_datastore.load({
                            params: {
                                'ano' : campoAnho.getValue(),
                                'codigo_operario' : campoOperario.getValue(),
                                'cods_equipos' : arrayEquipos,
                                'cods_grupos' : arrayGrupos,
                                'codigo_metodo' : campoMetodo.getValue()
                            }
                        });
                        
                        //Obtener el nombre de los equipos seleccionados
                        maqanual_datastore.load({
                            params: {
                                'cods_equipos' : arrayEquipos
                            }
                        });
                        
                        //Obtener el nombre de los equipos seleccionados
                        gruanual_datastore.load({
                            params: {
                                'cods_grupos' : arrayGrupos
                            }
                        });
                    }
                }]
            }]
        }, new Ext.TabPanel({
            frame: true,
            activeTab: 0,
            items: [{
                xtype: 'panel',
                title: 'Tiempos',
                layout: 'column',
                autoScroll: true,
                monitorResize: true,
                items: [{
                    id: 'flashcontent1',
                    border: true
                }, {
                    id: 'flashcontent2',
                    border: true
                }, 
                {
                    xtype: 'panel',
                    items: [
                        tiemposanual_gridpanel,
                        maqanual_gridpanel_tiemp,
                        gruanual_gridpanel_tiemp
                    ]
                }]
            }, {
                title: 'Indicadores',
                layout: 'column',
                items: [{
                    id: 'flashcontent3',
                    border: true
                }, {
                    id: 'flashcontent4',
                    border: true
                }, {
                    xtype: 'panel',
                    items: [
                        indicadoresanual_gridpanel,
                        maqanual_gridpanel_ind,
                        gruanual_gridpanel_ind
                    ]
                }]
            }, {
                title: 'Pérdidas',
                layout: 'column',
                items: [{
                    id: 'flashcontent5',
                    border: true
                }, {
                    id: 'flashcontent6',
                    border: true
                }, 
                {
                    xtype: 'panel',
                    items: [
                        perdidasanual_gridpanel,
                        maqanual_gridpanel_perd,
                        gruanual_gridpanel_perd
                    ]
                }]
            }, {
                title: 'Lotes e inyecciones',
                layout: 'column',
                items: [{
                    id: 'flashcontent7',
                    border: true
                }, {
                    id: 'flashcontent8',
                    border: true
                }]
            }, {
                title: 'Ahorros',
                layout: 'column',
                items: [{
                    id: 'flashcontent9',
                    border: true
                }, {
                    id: 'flashcontent10',
                    border: true
                }, {
                    xtype: 'panel',
                    items: [
                        ahorrosanual_gridpanel,
                        maqanual_gridpanel_ahorro,
                        gruanual_gridpanel_ahorro
                    ]
                }]
            }],
            listeners: {
                tabchange: function(){
                    renderizarGraficos();
                }
            }
        })]
    });
});
