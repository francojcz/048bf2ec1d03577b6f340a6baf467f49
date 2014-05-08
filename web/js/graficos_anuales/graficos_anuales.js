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
            
//            //Cambios: 24 de febrero de 2014
//            //Codigos de los grupos de equipos seleccionados
            var gruposSeleccionados = grupos_gridpanel.selModel.getSelections();
            var gruposAFiltrar = [];
            for(j = 0; j < grupos_gridpanel.selModel.getCount(); j++){
                    gruposAFiltrar.push(gruposSeleccionados[j].json.gru_codigo);
            }
            var arrayGrupos = Ext.encode(gruposAFiltrar);  
            
            var params = '?anho=' + campoAnho.getValue() + '&codigo_operario=' + campoOperario.getValue() + '&cods_equipos=' + arrayEquipos + '&cods_grupos=' + arrayGrupos+ '&codigo_metodo=' + campoMetodo.getValue();            
            
            var so = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "500", "400", "8", "#FFFFFF");
            so.addVariable("path", urlWeb + "flash/amline/");
            so.addParam("wmode", "opaque");
            so.addVariable("settings_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarConfiguracionGraficoTiemposLineas')));
            so.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarDatosGraficoTiemposLineas' + params)));
            if (Ext.get('flashcontent1')) {
                so.write("flashcontent1");
            }
            
            var so = new SWFObject(urlWeb + "flash/ampie/ampie.swf", "ampie", "500", "400", "8", "#FFFFFF");
            so.addVariable("path", urlWeb + "flash/ampie/");
            so.addParam("wmode", "opaque");
            so.addVariable("settings_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarConfiguracionTortaTiempos')));
            so.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarDatosTortaTiempos' + params)));
            if (Ext.get('flashcontent2')) {
                so.write("flashcontent2");
            }
            
            var so = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "500", "400", "8", "#FFFFFF");
            so.addVariable("path", urlWeb + "flash/amline/");
            so.addParam("wmode", "opaque");
            so.addVariable("settings_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarConfiguracionGraficoIndicadoresLineas')));
            so.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarDatosGraficoIndicadoresLineas' + params)));
            if (Ext.get('flashcontent3')) {
                so.write("flashcontent3");
            }
            
            var so = new SWFObject(urlWeb + "flash/amcolumn/amcolumn.swf", "amcolumn", "500", "400", "8", "#FFFFFF");
            so.addVariable("path", urlWeb + "flash/amcolumn/");
            so.addParam("wmode", "opaque");
            so.addVariable("settings_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarConfiguracionGraficoIndicadoresColumnas')));
            so.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarDatosGraficoIndicadoresColumnas' + params)));
            if (Ext.get('flashcontent4')) {
                so.write("flashcontent4");
            }
            
            var so = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "500", "400", "8", "#FFFFFF");
            so.addVariable("path", urlWeb + "flash/amline/");
            so.addParam("wmode", "opaque");
            so.addVariable("settings_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarConfiguracionGraficoPerdidasLineas')));
            so.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarDatosGraficoPerdidasLineas' + params)));
            if (Ext.get('flashcontent5')) {
                so.write("flashcontent5");
            }
            
            var so = new SWFObject(urlWeb + "flash/ampie/ampie.swf", "ampie", "500", "400", "8", "#FFFFFF");
            so.addVariable("path", urlWeb + "flash/ampie/");
            so.addParam("wmode", "opaque");
            so.addVariable("settings_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarConfiguracionTortaPerdidas')));
            so.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('graficos_anuales', 'generarDatosTortaPerdidas' + params)));
            if (Ext.get('flashcontent6')) {
                so.write("flashcontent6");
            }
            
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
                    }
                }]
            }]
        }, new Ext.TabPanel({
            activeTab: 0,
            items: [{
                title: 'Tiempos',
                layout: 'column',
                items: [{
                    id: 'flashcontent1',
                    border: true
                }, {
                    id: 'flashcontent2',
                    border: true
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
            }],
            listeners: {
                tabchange: function(){
                    renderizarGraficos();
                }
            }
        })]
    });
});
