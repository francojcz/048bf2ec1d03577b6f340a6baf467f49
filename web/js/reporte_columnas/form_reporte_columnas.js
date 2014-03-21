Ext.onReady(function(){
    var reporcol_analista_codigo_datastore = new Ext.data.JsonStore({
        id: 'reporcol_analista_codigo_datastore',
        url: getAbsoluteUrl('reporte_columnas', 'listarAnalistas'),
        root: 'results',
        totalProperty: 'total',
        fields: [{
            name: 'empl_usu_codigo',
            type: 'string'
        }, {
            name: 'empl_nombre_completo',
            type: 'string'
        }, ]
    });
    reporcol_analista_codigo_datastore.load();    
    
    var reporcol_analista_codigo_combobox = new Ext.form.ComboBox({
        xtype: 'combo',
        store: reporcol_analista_codigo_datastore,
        hiddenName: 'analista_codigo',
        name: 'reporcol_analista_codigo_combobox',
        id: 'reporcol_analista_codigo_combobox',
        mode: 'local',
        valueField: 'empl_usu_codigo',
        forceSelection: true,
        displayField: 'empl_nombre_completo',
        triggerAction: 'all',
        emptyText: 'Seleccione un analista...',
        selectOnFocus: true
    });
    
    
    var reporcol_maquina_codigo_datastore = new Ext.data.JsonStore({
        id: 'reporcol_maquina_codigo_datastore',
        url: getAbsoluteUrl('reporte_columnas', 'listarEquiposActivos'),
        root: 'results',
        totalProperty: 'total',
        fields: [{
            name: 'maq_codigo',
            type: 'string'
        }, {
            name: 'maq_nombre',
            type: 'string'
        }, ]
    });
    reporcol_maquina_codigo_datastore.load();
    
/**********************************************************************/
//Cambios: 28 de febrero de 2014
//Interfaz para seleccionar los equipos a filtrar en el reporte
var maquina_selmodel = new Ext.grid.CheckboxSelectionModel({
        singleSelect:false
});

var maquina_colmodel = new Ext.grid.ColumnModel({
        defaults:{sortable: true, locked: false, resizable: true},
        columns:[
            maquina_selmodel,
            { header: "Id", width: 30, dataIndex: 'maq_codigo', hidden:true},
            { header: "Nombre del Equipo", width: 430, dataIndex: 'maq_nombre'}
        ]
});

var maquinas_gridpanel = new Ext.grid.GridPanel({
        id: 'maquinas_gridpanel',
        stripeRows:true,
        frame: true,
        ds: reporcol_maquina_codigo_datastore,
        cm: maquina_colmodel,
        sm: maquina_selmodel
});

var win = new Ext.Window(
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
            win.hide();
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
          
    var reporcol_desde_fecha_datefield = new Ext.form.DateField({
        xtype: 'datefield',
        format: 'Y-m-d',
        value: new Date()
    });
    
    var reporcol_hasta_fecha_datefield = new Ext.form.DateField({
        xtype: 'datefield',
        format: 'Y-m-d',
        value: new Date()
    }); 
    
    var reporcol_configuracion = new Ext.FormPanel({
        title: 'CONFIGURACI&Oacute;N DE REPORTE COLUMNAS',
        layout: 'form',
        monitorResize: true,
        frame: true,
        padding: 10,
        labelWidth: 0,
        items: [{
            xtype: 'compositefield',
            fieldLabel: '',
            hideLabel: true,
            items: [{
                xtype: 'displayfield',
                value: 'Desde'
            }, reporcol_desde_fecha_datefield, {
                xtype: 'displayfield',
                value: 'Hasta',
                style: 'padding: 0px 0px 0px 20px'
            }, reporcol_hasta_fecha_datefield, {
                xtype: 'button',
                style: 'padding: 0px 0px 0px 20px',
                iconCls: 'exportar_excel',
                text: 'Guardar en formato Excel',
                handler: function(){                        
                }
            }]
        }, {
            xtype: 'compositefield',
            fieldLabel: '',
            hideLabel: true,
            items: [{
                xtype: 'displayfield',
                value: 'Analista'
            }, reporcol_analista_codigo_combobox, {
                text: 'Seleccionar Equipos',
                xtype: 'button',
                iconCls: 'equipo',
                style: 'padding: 0px 0px 0px 20px',
                handler: function(){
                    Ext.getBody().mask();
                    win.show();
                }
            }, {
                text: 'Buscar',
                xtype: 'button',
                iconCls: 'filtrar',
                style: 'padding: 0px 0px 0px 20px',
                handler: function(){
                
                    var desde = '';
                    if (reporcol_desde_fecha_datefield.getValue() != '') {
                        desde = reporcol_desde_fecha_datefield.getValue().format('Y-m-d');
                    }
                    var hasta = '';
                    if (reporcol_hasta_fecha_datefield.getValue() != '') {
                        hasta = reporcol_hasta_fecha_datefield.getValue().format('Y-m-d');
                    }
                    
                    //Codigos de los equipos seleccionados
                    var equiposSeleccionados = maquinas_gridpanel.selModel.getSelections();
                    var equiposAFiltrar = [];
                    for(i = 0; i< maquinas_gridpanel.selModel.getCount(); i++){
                            equiposAFiltrar.push(equiposSeleccionados[i].json.maq_codigo);
                    }
                    var arrayEquipos = Ext.encode(equiposAFiltrar);
                    
                    reporcol_datastore.reload({
                        params: {
                            cods_equipos: arrayEquipos,
                            analista_codigo: reporcol_analista_codigo_combobox.getValue(),
                            desde_fecha: desde,
                            hasta_fecha: hasta
                        }
                    });
                    
                    reporcol_cargardatosreportes();
                }
            }]
        }],
        renderTo: 'div_form_reporte_columnas'
    });    
    
    var reporcol_datastore = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: getAbsoluteUrl('reporte_columnas', 'listarReporteColumnasUtilizadas'),
            method: 'POST'
        }),
        baseParams: {},
        reader: new Ext.data.JsonReader({
            root: 'results',
            totalProperty: 'total'
        }, [{
            name: 'rum_col_maquina',
            type: 'string'
        }, {
            name: 'rum_col_analista',
            type: 'string'
        }, {
            name: 'rum_col_fecha',
            type: 'string'
        }, {
            name: 'rum_col_nombre',
            type: 'string'
        }, {
            name: 'rum_col_platos_teoricos',
            type: 'string'
        }, {
            name: 'rum_col_tiempo_retencion',
            type: 'string'
        }, {
            name: 'rum_col_resolucion',
            type: 'string'
        }, {
            name: 'rum_col_tailing',
            type: 'string'
        }])
    });
    reporcol_datastore.load();
    
    
    var reporcol_colmodel = new Ext.grid.ColumnModel({
        defaults: {
            sortable: true,
            locked: false,
            resizable: true
        },
        columns: [{
            header: "M&aacute;quina",
            width: 130,
            align : 'center',
            dataIndex: 'rum_col_maquina'
        }, {
            header: "Analista",
            width: 130,
            align : 'center',
            dataIndex: 'rum_col_analista'
        }, {
            header: "Fecha",
            width: 80,
            align : 'center',
            dataIndex: 'rum_col_fecha'
        }, {
            header: "Columna",
            width: 140,
            align : 'center',
            dataIndex: 'rum_col_nombre'
        },{
            header: "Platos Te&oacute;ricos (N)",
            width: 120,
            align : 'center',
            dataIndex: 'rum_col_platos_teoricos'
        },{
            header: "Tiempo Retenci&oacute;n (min)",
            width: 130,
            align : 'center',
            dataIndex: 'rum_col_tiempo_retencion'
        },{
            header: "Resoluci&oacute;n (R)",
            width: 120,
            align : 'center',
            dataIndex: 'rum_col_resolucion'
        },{
            header: "Tailing (T)",
            width: 120,
            align : 'center',
            dataIndex: 'rum_col_tailing'
        }]
    });
    
    var reporcol_gridpanel = new Ext.grid.GridPanel({
        title: 'Columnas Utilizadas',
        columnWidth: '.6',
        region: 'center',
        stripeRows: true,
        frame: true,
        ds: reporcol_datastore,
        cm: reporcol_colmodel,
        height: 400
    });
    
    var reporcol_panel = new Ext.Panel({
        frame: true,
        monitorResize: true,
        layout: 'border',
        items: [reporcol_gridpanel, {
            xtype: 'tabpanel',
            activeTab: 0,
            title: 'Gr&aacute;ficos estadisticos',
            region: 'east',
            width: 700,
            minWidth: 500,
            collapsible: true,
            split: true,
            deferredRender: false,
            items: [{
                xtype: 'panel',
                title: 'Platos Teóricos',
                contentEl: 'div_reporte_columnas_platos_teoricos'
            }, {
                xtype: 'panel',
                title: 'Tiempo Retención',
                contentEl: 'div_reporte_columnas_tiempo_retencion'
            }, {
                xtype: 'panel',
                title: 'Resolución',
                contentEl: 'div_reporte_columnas_resolucion'
            }, {
                xtype: 'panel',
                title: 'Tailing',
                contentEl: 'div_reporte_columnas_tailing'
            }],
            listeners: {
                tabchange: function(){
                    redirigirSiSesionExpiro();
                }
            }
        }]  ,
        height: 450,
        renderTo: 'div_form_reporte_columnas'
    });
    
    function reporcol_cargardatosreportes(){
        redirigirSiSesionExpiro();
        
        //Codigos de los equipos seleccionados
        var equiposSeleccionados = maquinas_gridpanel.selModel.getSelections();
        var equiposAFiltrar = [];
        for(i = 0; i< maquinas_gridpanel.selModel.getCount(); i++){
                equiposAFiltrar.push(equiposSeleccionados[i].json.maq_codigo);
        }
        var arrayEquipos = Ext.encode(equiposAFiltrar);
        
        var analista_codigo = reporcol_analista_codigo_combobox.getValue();        
        
        var desde = '';
        if (reporcol_desde_fecha_datefield.getValue() != '') {
            desde = reporcol_desde_fecha_datefield.getValue().format('Y-m-d');
        }
        var hasta = '';
        if (reporcol_hasta_fecha_datefield.getValue() != '') {
            hasta = reporcol_hasta_fecha_datefield.getValue().format('Y-m-d');
        }
        
        var params = '?cods_equipos=' + arrayEquipos + '&analista_codigo=' + analista_codigo;
        params += '&desde_fecha=' + desde + '&hasta_fecha=' + hasta;
        
        //Platos Teóricos
        var reporcol_platos_teoricos = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "700", "400", "8", "#FFFFFF");
        reporcol_platos_teoricos.addVariable("path", urlWeb + "flash/amline/");
        reporcol_platos_teoricos.addParam("wmode", "opaque");
        reporcol_platos_teoricos.addVariable("settings_file", urlWeb + 'js/reporte_columnas/amline_st_grafico_platos_teoricos.php');
        reporcol_platos_teoricos.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_columnas', 'generarDatosPlatosTeoricos') + params));
        reporcol_platos_teoricos.addVariable("loading_data", "... CARGANDO ...");
        reporcol_platos_teoricos.write("div_reporte_columnas_platos_teoricos");  
        
        //Tiempo de Retención
        var reporcol_tiempo_retencion = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "700", "400", "8", "#FFFFFF");
        reporcol_tiempo_retencion.addVariable("path", urlWeb + "flash/amline/");
        reporcol_tiempo_retencion.addParam("wmode", "opaque");
        reporcol_tiempo_retencion.addVariable("settings_file", urlWeb + 'js/reporte_columnas/amline_st_grafico_tiempo_retencion.php');
        reporcol_tiempo_retencion.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_columnas', 'generarDatosTiempoRetencion') + params));
        reporcol_tiempo_retencion.addVariable("loading_data", "... CARGANDO ...");
        reporcol_tiempo_retencion.write("div_reporte_columnas_tiempo_retencion");
        
        //Resolución
        var reporcol_resolucion = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "700", "400", "8", "#FFFFFF");
        reporcol_resolucion.addVariable("path", urlWeb + "flash/amline/");
        reporcol_resolucion.addParam("wmode", "opaque");
        reporcol_resolucion.addVariable("settings_file", urlWeb + 'js/reporte_columnas/amline_st_grafico_resolucion.php');
        reporcol_resolucion.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_columnas', 'generarDatosResolucion') + params));
        reporcol_resolucion.addVariable("loading_data", "... CARGANDO ...");
        reporcol_resolucion.write("div_reporte_columnas_resolucion");
        
        //Tailing
        var reporcol_tailing = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "700", "400", "8", "#FFFFFF");
        reporcol_tailing.addVariable("path", urlWeb + "flash/amline/");
        reporcol_tailing.addParam("wmode", "opaque");
        reporcol_tailing.addVariable("settings_file", urlWeb + 'js/reporte_columnas/amline_st_grafico_tailing.php');
        reporcol_tailing.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_columnas', 'generarDatosTailing') + params));
        reporcol_tailing.addVariable("loading_data", "... CARGANDO ...");
        reporcol_tailing.write("div_reporte_columnas_tailing");
    }
    
    reporcol_cargardatosreportes();    
    
    function obtenerAncho(cmp, v_default){
        var ancho = cmp.getWidth();
        //alert(ancho);
        if (ancho > v_default) {
            return ancho;
        }
        else {
            return v_default;
        }
    }
    
    function reporevent_ajustarTamano(){
        var anchor1 = obtenerAncho(reporcol_panel, 800);
        if (anchor1 == 800) {
            reporcol_panel.setWidth(anchor1);
            reporcol_panel.doLayout();
            reporcol_configuracion.setWidth(anchor1);
            reporcol_configuracion.doLayout();
        }
    }
    reporevent_ajustarTamano();    
});