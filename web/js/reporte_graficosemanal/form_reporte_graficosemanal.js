Ext.onReady(function(){

    var reporgrafseman_analista_codigo_datastore = new Ext.data.JsonStore({
        id: 'reporgrafseman_analista_codigo_datastore',
        url: getAbsoluteUrl('reporte_graficosemanal', 'listarAnalistas'),
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
    reporgrafseman_analista_codigo_datastore.load();
    
    
    var reporgrafseman_analista_codigo_combobox = new Ext.form.ComboBox({
        xtype: 'combo',
        store: reporgrafseman_analista_codigo_datastore,
        hiddenName: 'analista_codigo',
        name: 'reporgrafseman_analista_codigo_combobox',
        id: 'reporgrafseman_analista_codigo_combobox',
        mode: 'local',
        valueField: 'empl_usu_codigo',
        forceSelection: true,
        displayField: 'empl_nombre_completo',
        triggerAction: 'all',
        emptyText: 'Seleccione un analista...',
        selectOnFocus: true,
        hideLabel: true
    });
    
    
    var reporgrafseman_maquina_codigo_datastore = new Ext.data.JsonStore({
        id: 'reporgrafseman_maquina_codigo_datastore',
        url: getAbsoluteUrl('reporte_graficosemanal', 'listarEquiposActivos'),
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
    reporgrafseman_maquina_codigo_datastore.load();
    
    
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
            { header: "Id", width: 30, dataIndex: 'maq_codigo', hidden:true},
            { header: "Nombre del Equipo", width: 430, dataIndex: 'maq_nombre'}
        ]
});

var maquinas_gridpanel = new Ext.grid.GridPanel({
        id: 'maquinas_gridpanel',
        stripeRows:true,
        frame: true,
        ds: reporgrafseman_maquina_codigo_datastore,
        cm: maquina_colmodel,
        sm: maquina_selmodel
});

var win_maquinas_semanal = new Ext.Window(
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
            win_maquinas_semanal.hide();
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
var reporgrafseman_grupo_codigo_datastore = new Ext.data.JsonStore({
        id: 'reporgrafseman_grupo_codigo_datastore',
        url: getAbsoluteUrl('reporte_graficosemanal', 'listarGruposActivos'),
        root: 'results',
        totalProperty: 'total',
        fields: [{
            name: 'gru_codigo',
            type: 'string'
        }, {
            name: 'gru_nombre',
            type: 'string'
        }, ]
    });
reporgrafseman_grupo_codigo_datastore.load();

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
        ds: reporgrafseman_grupo_codigo_datastore,
        cm: grupo_colmodel,
        sm: grupo_selmodel
});

var win_grupos_semanal = new Ext.Window(
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
            win_grupos_semanal.hide();
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


    var reporgrafseman_metodo_codigo_datastore = new Ext.data.JsonStore({
        id: 'reporgrafseman_metodo_codigo_datastore',
        url: getAbsoluteUrl('reporte_graficosemanal', 'listarMetodos'),
        root: 'results',
        totalProperty: 'total',
        fields: [{
            name: 'met_codigo',
            type: 'string'
        }, {
            name: 'met_nombre',
            type: 'string'
        }, ]
    });
    reporgrafseman_metodo_codigo_datastore.load();
    
    
    var reporgrafseman_metodo_codigo_combobox = new Ext.form.ComboBox({
        xtype: 'combo',
        store: reporgrafseman_metodo_codigo_datastore,
        hiddenName: 'metodo_codigo',
        name: 'reporgrafseman_metodo_codigo_combobox',
        id: 'reporgrafseman_metodo_codigo_combobox',
        mode: 'local',
        valueField: 'met_codigo',
        forceSelection: true,
        displayField: 'met_nombre',
        triggerAction: 'all',
        emptyText: 'Seleccione un método...',
        selectOnFocus: true,
        hideLabel: true
    });    
    
/**********************************************************************/
//Cambios: 24 de febrero de 2014
//Interfaz reporte semanal
var fechaInicioField = new Ext.form.DateField({
    xtype: 'datefield',
    allowBlank: false,
    value: new Date(),
    format: 'Y-m-d'
});
    
var fechaFinField = new Ext.form.DateField({
    xtype: 'datefield',
    allowBlank: false,
    value: new Date(),
    format: 'Y-m-d'
});
/**********************************************************************/
    
    var reporgrafseman_configuracion = new Ext.FormPanel({
        layout: 'form',
        frame: true,
        padding: 10,
        labelWidth: 100,
        items: [
            {
                xtype: 'compositefield',
                hideLabel: true,
                items: [
                {
                    xtype: 'displayfield',
                    html: 'Desde'
                }, fechaInicioField, {
                    xtype: 'displayfield',
                    html: 'Hasta',
                    style: 'padding: 0px 0px 0px 20px'
                }, fechaFinField ]
            }, 
            {
            xtype: 'compositefield',
            hideLabel: true,
            items: [{
                xtype: 'displayfield',
                value: 'Analista'
            }, reporgrafseman_analista_codigo_combobox, {
                xtype: 'displayfield',
                value: 'M&eacute;todo',
                style: 'padding: 0px 0px 0px 20px'
            }, reporgrafseman_metodo_codigo_combobox, {
                text: 'Seleccionar Equipos',
                xtype: 'button',
                iconCls: 'equipo',
                style: 'padding: 0px 0px 0px 20px',
                handler: function(){
                    Ext.getBody().mask();
                    win_maquinas_semanal.show();
                }
            }, {
                text: 'Seleccionar Grupo de Equipos',
                xtype: 'button',
                iconCls: 'grupo',
                style: 'padding: 0px 0px 0px 20px',
                handler: function(){
                    Ext.getBody().mask();
                    win_grupos_semanal.show();
                }
            }, {
                text: 'Generar gr&aacute;ficos',
                xtype: 'button',
                iconCls: 'reload',
                style: 'padding: 0px 0px 0px 20px',
                handler: function(){
                    reporgrafseman_cargardatosreportes();
                }
            }]
        }],
        renderTo: 'div_form_reporte_graficosemanal'
    });
    
    var reporgrafseman_reportes_tabpanel = new Ext.TabPanel({
        frame: true,
        items: [{
            xtype: 'panel',
            title: 'Tiempos',
            layout: 'column',
            autoScroll: true,
            monitorResize: true,
            items: [{
                columnWidth: '.5',
                contentEl: 'div_reporte_graficosemanal_tiempos_dispersion'
            }, {
                columnWidth: '.5',
                contentEl: 'div_reporte_graficosemanal_tiempos_torta'
            }]
        }, {
            xtype: 'panel',
            title: 'Indicadores',
            layout: 'column',
            autoScroll: true,
            monitorResize: true,
            items: [{
                columnWidth: '.5',
                contentEl: 'div_reporte_graficosemanal_indicadores_dispersion'
            }, {
                columnWidth: '.5',
                contentEl: 'div_reporte_graficosemanal_indicadores_barras'
            }]
        }, {
            xtype: 'panel',
            title: 'P&eacute;rdidas',
            layout: 'column',
            autoScroll: true,
            monitorResize: true,
            items: [{
                columnWidth: '.5',
                contentEl: 'div_reporte_graficosemanal_perdidas_dispersion'
            }, {
                columnWidth: '.5',
                contentEl: 'div_reporte_graficosemanal_perdidas_torta'
            }]
        }, {
            xtype: 'panel',
            title: 'Lotes e inyecciones',
            layout: 'column',
            autoScroll: true,
            monitorResize: true,
            items: [{
                columnWidth: '.5',
                contentEl: 'div_reporte_graficosemanal_muestras_dispersion'
            }, {
                columnWidth: '.5',
                contentEl: 'div_reporte_graficosemanal_inyecciones_dispersion'
            }]
        }],
        activeTab: 0,
        height: 430,
        deferredRender: false,
        renderTo: 'div_form_reporte_graficosemanal',
        listeners: {
            tabchange: function(){
                redirigirSiSesionExpiro();
            }
        }
    });
    
    function reporgrafseman_cargardatosreportes(){
        redirigirSiSesionExpiro();
        
        var fecha_inicio = fechaInicioField.getRawValue();
        var fecha_fin = fechaFinField.getRawValue();
        var metodo_codigo = reporgrafseman_metodo_codigo_combobox.getValue();
        var analista_codigo = reporgrafseman_analista_codigo_combobox.getValue();
        
        //Codigos de los equipos seleccionados
        var equiposSeleccionados = maquinas_gridpanel.selModel.getSelections();
        var equiposAFiltrar = [];
        for(i = 0; i< maquinas_gridpanel.selModel.getCount(); i++){
                equiposAFiltrar.push(equiposSeleccionados[i].json.maq_codigo);
        }
        var arrayEquipos = Ext.encode(equiposAFiltrar);
        
        //Codigos de los grupos seleccionados
        var gruposSeleccionados = grupos_gridpanel.selModel.getSelections();
        var gruposAFiltrar = [];
        for(j = 0; j < grupos_gridpanel.selModel.getCount(); j++){
                gruposAFiltrar.push(gruposSeleccionados[j].json.gru_codigo);
        }
        var arrayGrupos = Ext.encode(gruposAFiltrar);
        
        var params = '?fecha_inicio=' + fecha_inicio + '&fecha_fin=' + fecha_fin + '&cods_equipos=' + arrayEquipos + '&cods_grupos=' + arrayGrupos + '&metodo_codigo=' + metodo_codigo + '&analista_codigo=' + analista_codigo;
        
        //tiempos
        var reporgrafseman_tiempos_dispersion = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "520", "400", "8", "#FFFFFF");
        reporgrafseman_tiempos_dispersion.addVariable("path", urlWeb + "flash/amline/");
        reporgrafseman_tiempos_dispersion.addParam("wmode", "opaque");
        reporgrafseman_tiempos_dispersion.addVariable("settings_file", urlWeb + 'js/reporte_graficosemanal/amline_st_grafico_tiempos.php');
        reporgrafseman_tiempos_dispersion.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_graficosemanal', 'generarDatosGraficoTiempos') + params));
        reporgrafseman_tiempos_dispersion.addVariable("loading_data", "... CARGANDO ...");
        reporgrafseman_tiempos_dispersion.write("div_reporte_graficosemanal_tiempos_dispersion");
        
        var reporgrafseman_tiempos_torta = new SWFObject(urlWeb + "flash/ampie/ampie.swf", "ampie", "520", "400", "8");
        reporgrafseman_tiempos_torta.addVariable("path", urlWeb + "flash/ampie/");
        reporgrafseman_tiempos_torta.addParam("wmode", "opaque");
        reporgrafseman_tiempos_torta.addVariable("settings_file", urlWeb + 'js/reporte_graficosemanal/ampie_st_grafico_tiempos_torta.php');
        reporgrafseman_tiempos_torta.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_graficosemanal', 'generarDatosGraficoTiemposTorta') + params));
        reporgrafseman_tiempos_torta.addVariable("loading_data", "... CARGANDO ...");
        reporgrafseman_tiempos_torta.write("div_reporte_graficosemanal_tiempos_torta");
        
        //indicadores
        var reporgrafseman_indicadores_dispersion = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "520", "400", "8", "#FFFFFF");
        reporgrafseman_indicadores_dispersion.addVariable("path", urlWeb + "flash/amline/");
        reporgrafseman_indicadores_dispersion.addParam("wmode", "opaque");
        reporgrafseman_indicadores_dispersion.addVariable("settings_file", urlWeb + 'js/reporte_graficosemanal/amline_st_grafico_indicadores.php');
        reporgrafseman_indicadores_dispersion.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_graficosemanal', 'generarDatosGraficoIndicadores') + params));
        reporgrafseman_indicadores_dispersion.addVariable("loading_data", "... CARGANDO ...");
        reporgrafseman_indicadores_dispersion.write("div_reporte_graficosemanal_indicadores_dispersion");        
        
        var reporgrafseman_indicadores_barras = new SWFObject(urlWeb + "flash/amcolumn/amcolumn.swf", "amcolumn", "520", "400", "8", "#FFFFFF");
        reporgrafseman_indicadores_barras.addVariable("path", urlWeb + "flash/amcolumn/");
        reporgrafseman_indicadores_barras.addParam("wmode", "opaque");
        reporgrafseman_indicadores_barras.addVariable("settings_file", urlWeb + 'js/reporte_graficosemanal/amcolumn_st_grafico_indicadores_barras.php');
        reporgrafseman_indicadores_barras.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_graficosemanal', 'generarDatosGraficoIndicadoresBarras') + params));
        reporgrafseman_indicadores_barras.addVariable("loading_data", "... CARGANDO ...");
        reporgrafseman_indicadores_barras.write("div_reporte_graficosemanal_indicadores_barras");
        
        //perdidas
        var reporgrafseman_perdida_dispersion = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "520", "400", "8", "#FFFFFF");
        reporgrafseman_perdida_dispersion.addVariable("path", urlWeb + "flash/amline/");
        reporgrafseman_perdida_dispersion.addParam("wmode", "opaque");
        reporgrafseman_perdida_dispersion.addVariable("settings_file", urlWeb + 'js/reporte_graficosemanal/amline_st_grafico_perdidas.php');
        reporgrafseman_perdida_dispersion.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_graficosemanal', 'generarDatosGraficoPerdidas') + params));
        reporgrafseman_perdida_dispersion.addVariable("loading_data", "... CARGANDO ...");
        reporgrafseman_perdida_dispersion.write("div_reporte_graficosemanal_perdidas_dispersion");
        
        var reporgrafseman_tiempo_torta = new SWFObject(urlWeb + "flash/ampie/ampie.swf", "ampie", "520", "400", "8", "#FFFFFF");
        reporgrafseman_tiempo_torta.addVariable("path", urlWeb + "flash/ampie/");
        reporgrafseman_tiempo_torta.addParam("wmode", "opaque");//turco ee
        reporgrafseman_tiempo_torta.addVariable("settings_file", urlWeb + 'js/reporte_graficosemanal/ampie_st_grafico_perdidas_torta.php');
        reporgrafseman_tiempo_torta.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_graficosemanal', 'generarDatosGraficoPerdidasTorta') + params));
        reporgrafseman_tiempo_torta.write("div_reporte_graficosemanal_perdidas_torta");
        
        //muestras
        var reporgrafseman_muestras_dispersion = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "520", "400", "8", "#FFFFFF");
        reporgrafseman_muestras_dispersion.addVariable("path", urlWeb + "flash/amline/");
        reporgrafseman_muestras_dispersion.addParam("wmode", "opaque");
        reporgrafseman_muestras_dispersion.addVariable("settings_file", urlWeb + 'js/reporte_graficosemanal/amline_st_grafico_muestras.php');
        reporgrafseman_muestras_dispersion.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_graficosemanal', 'generarDatosGraficoMuestras') + params));
        reporgrafseman_muestras_dispersion.write("div_reporte_graficosemanal_muestras_dispersion");
        
        var reporgrafseman_inyecciones_dispersion = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "520", "400", "8", "#FFFFFF");
        reporgrafseman_inyecciones_dispersion.addVariable("path", urlWeb + "flash/amline/");
        reporgrafseman_inyecciones_dispersion.addParam("wmode", "opaque");
        reporgrafseman_inyecciones_dispersion.addVariable("settings_file", urlWeb + 'js/reporte_graficosemanal/amline_st_grafico_inyecciones.php');
        reporgrafseman_inyecciones_dispersion.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_graficosemanal', 'generarDatosGraficoInyecciones') + params));
        reporgrafseman_inyecciones_dispersion.write("div_reporte_graficosemanal_inyecciones_dispersion");
    }
    
    reporgrafseman_cargardatosreportes();
    
    
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
    
    function reporgrafseman_reajustar(){
        var ancho = obtenerAncho(reporgrafseman_configuracion, 1024);
        if (ancho == 1024) {
            reporgrafseman_configuracion.setWidth(ancho);
            reporgrafseman_reportes_tabpanel.setWidth(ancho);
            
            reporgrafseman_configuracion.doLayout();
            reporgrafseman_reportes_tabpanel.doLayout();
        }
    }
    
    reporgrafseman_reajustar();
});
