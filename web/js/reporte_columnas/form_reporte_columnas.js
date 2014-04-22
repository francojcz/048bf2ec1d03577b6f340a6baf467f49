Ext.onReady(function(){
    var reporcol_metodo_codigo_datastore = new Ext.data.JsonStore({
        id: 'reporcol_metodo_codigo_datastore',
        url: getAbsoluteUrl('reporte_columnas', 'listarMetodos'),
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
    reporcol_metodo_codigo_datastore.load();
    
    var reporcol_metodo_codigo_combobox = new Ext.form.ComboBox({
        xtype: 'combo',
        store: reporcol_metodo_codigo_datastore,
        hiddenName: 'metodo_codigo',
        name: 'reporcol_metodo_codigo_combobox',
        id: 'reporcol_metodo_codigo_combobox',
        mode: 'local',
        valueField: 'met_codigo',
        forceSelection: true,
        displayField: 'met_nombre',
        triggerAction: 'all',
        emptyText: 'Seleccione ..',
        selectOnFocus: true
    });    
    
    
    var reporcol_marca_codigo_datastore = new Ext.data.JsonStore({
        id: 'reporcol_marca_codigo_datastore',
        url: getAbsoluteUrl('reporte_columnas', 'listarMarcas'),
        root: 'results',
        totalProperty: 'total',
        fields: [{
            name: 'mar_codigo',
            type: 'string'
        }, {
            name: 'mar_nombre',
            type: 'string'
        }, ]
    });
    reporcol_marca_codigo_datastore.load();
    
    var reporcol_marca_codigo_combobox = new Ext.form.ComboBox({
        xtype: 'combo',
        store: reporcol_marca_codigo_datastore,
        hiddenName: 'marca_codigo',
        name: 'reporcol_marca_codigo_combobox',
        id: 'reporcol_marca_codigo_combobox',
        mode: 'local',
        valueField: 'mar_codigo',
        forceSelection: true,
        displayField: 'mar_nombre',
        triggerAction: 'all',
        emptyText: 'Seleccione ..',
        selectOnFocus: true,
        width: 140
    });
    
    
    var reporcol_modelo_codigo_datastore = new Ext.data.JsonStore({
        id: 'reporcol_modelo_codigo_datastore',
        url: getAbsoluteUrl('reporte_columnas', 'listarModelos'),
        root: 'results',
        totalProperty: 'total',
        fields: [{
            name: 'mod_codigo',
            type: 'string'
        }, {
            name: 'mod_nombre',
            type: 'string'
        }, ]
    });
    reporcol_modelo_codigo_datastore.load();
    
    var reporcol_modelo_codigo_combobox = new Ext.form.ComboBox({
        xtype: 'combo',
        store: reporcol_modelo_codigo_datastore,
        hiddenName: 'modelo_codigo',
        name: 'reporcol_modelo_codigo_combobox',
        id: 'reporcol_modelo_codigo_combobox',
        mode: 'local',
        valueField: 'mod_codigo',
        forceSelection: true,
        displayField: 'mod_nombre',
        triggerAction: 'all',
        emptyText: 'Seleccione ..',
        selectOnFocus: true,
        width: 140
    });    
    
    
    var reporcol_fase_codigo_datastore = new Ext.data.JsonStore({
        id: 'reporcol_fase_codigo_datastore',
        url: getAbsoluteUrl('reporte_columnas', 'listarFases'),
        root: 'results',
        totalProperty: 'total',
        fields: [{
            name: 'fase_codigo',
            type: 'string'
        }, {
            name: 'fase_nombre',
            type: 'string'
        }, ]
    });
    reporcol_fase_codigo_datastore.load();
    
    var reporcol_fase_codigo_combobox = new Ext.form.ComboBox({
        xtype: 'combo',
        store: reporcol_fase_codigo_datastore,
        hiddenName: 'fase_codigo',
        name: 'reporcol_fase_codigo_combobox',
        id: 'reporcol_fase_codigo_combobox',
        mode: 'local',
        valueField: 'fase_codigo',
        forceSelection: true,
        displayField: 'fase_nombre',
        triggerAction: 'all',
        emptyText: 'Seleccione ..',
        selectOnFocus: true,
        width: 130
    }); 
    
    
    var reporcol_dimension_codigo_datastore = new Ext.data.JsonStore({
        id: 'reporcol_dimension_codigo_datastore',
        url: getAbsoluteUrl('reporte_columnas', 'listarDimensiones'),
        root: 'results',
        totalProperty: 'total',
        fields: [{
            name: 'dim_codigo',
            type: 'string'
        }, {
            name: 'dim_nombre',
            type: 'string'
        }, ]
    });
    reporcol_dimension_codigo_datastore.load();
    
    var reporcol_dimension_codigo_combobox = new Ext.form.ComboBox({
        xtype: 'combo',
        store: reporcol_dimension_codigo_datastore,
        hiddenName: 'dimension_codigo',
        name: 'reporcol_dimension_codigo_combobox',
        id: 'reporcol_dimension_codigo_combobox',
        mode: 'local',
        valueField: 'dim_codigo',
        forceSelection: true,
        displayField: 'dim_nombre',
        triggerAction: 'all',
        emptyText: 'Seleccione ..',
        selectOnFocus: true,
        width: 130
    });    
    
    
    var reporcol_tamano_codigo_datastore = new Ext.data.JsonStore({
        id: 'reporcol_tamano_codigo_datastore',
        url: getAbsoluteUrl('reporte_columnas', 'listarTamanos'),
        root: 'results',
        totalProperty: 'total',
        fields: [{
            name: 'tam_codigo',
            type: 'string'
        }, {
            name: 'tam_nombre',
            type: 'string'
        }, ]
    });
    reporcol_tamano_codigo_datastore.load();
    
    var reporcol_tamano_codigo_combobox = new Ext.form.ComboBox({
        xtype: 'combo',
        store: reporcol_tamano_codigo_datastore,
        hiddenName: 'tamano_codigo',
        name: 'reporcol_tamano_codigo_combobox',
        id: 'reporcol_tamano_codigo_combobox',
        mode: 'local',
        valueField: 'tam_codigo',
        forceSelection: true,
        displayField: 'tam_nombre',
        triggerAction: 'all',
        emptyText: 'Seleccione ..',
        selectOnFocus: true,
        width: 130
    }); 
    
    
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
                style: 'padding: 4px 0px 0px 0px',
                value: 'Desde'
            }, reporcol_desde_fecha_datefield, {
                xtype: 'displayfield',
                style: 'padding: 4px 0px 0px 20px',
                value: 'Hasta'                
            }, reporcol_hasta_fecha_datefield, {
                xtype: 'displayfield',
                style: 'padding: 4px 0px 0px 30px',
                value: 'Método'
            }, reporcol_metodo_codigo_combobox, {
                xtype: 'button',
                style: 'padding: 0px 0px 0px 30px',
                iconCls: 'exportar_excel',
                text: 'Guardar en formato Excel',
                handler: function(){
                    redirigirSiSesionExpiro();
                    
                    var metodo_codigo = reporcol_metodo_codigo_combobox.getValue();
                    var marca_codigo = reporcol_marca_codigo_combobox.getValue();
                    var modelo_codigo = reporcol_modelo_codigo_combobox.getValue();
                    var fase_codigo = reporcol_fase_codigo_combobox.getValue();
                    var dimension_codigo = reporcol_dimension_codigo_combobox.getValue();
                    var tamano_codigo = reporcol_tamano_codigo_combobox.getValue();

                    var desde = '';
                    if (reporcol_desde_fecha_datefield.getValue() != '') {
                        desde = reporcol_desde_fecha_datefield.getValue().format('Y-m-d');
                    }
                    var hasta = '';
                    if (reporcol_hasta_fecha_datefield.getValue() != '') {
                        hasta = reporcol_hasta_fecha_datefield.getValue().format('Y-m-d');
                    }

                    var params = 'metodo_codigo=' + metodo_codigo + '&desde_fecha=' + desde + '&hasta_fecha=' + hasta;
                    params += '&marca_codigo=' + marca_codigo + '&modelo_codigo=' + modelo_codigo + '&fase_codigo=' + fase_codigo + '&dimension_codigo=' + dimension_codigo + '&tamano_codigo=' + tamano_codigo;
                    
                    window.location = getAbsoluteUrl('reporte_columnas', 'exportar') + '?' + params;                   
                }
            }]
        }, {
            xtype: 'compositefield',
            fieldLabel: '',
            hideLabel: true,
            items: [{
                xtype: 'displayfield',
                style: 'padding: 4px 0px 0px 0px',
                value: 'Marca'
            }, reporcol_marca_codigo_combobox, {
                xtype: 'displayfield',
                style: 'padding: 4px 0px 0px 10px',
                value: 'Modelo'
            }, reporcol_modelo_codigo_combobox, {
                xtype: 'displayfield',
                style: 'padding: 4px 0px 0px 10px',
                value: 'Fase Ligada'
            }, reporcol_fase_codigo_combobox, {
                xtype: 'displayfield',
                style: 'padding: 4px 0px 0px 10px',
                value: 'Dimensi&oacute;n'
            }, reporcol_dimension_codigo_combobox, {
                xtype: 'displayfield',
                style: 'padding: 4px 0px 0px 10px',
                value: 'Tama&ntilde;o de Part&iacute;cula (μm)'
            }, reporcol_tamano_codigo_combobox, {
                text: 'Buscar',
                xtype: 'button',
                iconCls: 'filtrar',
                style: 'padding: 0px 0px 0px 10px',
                handler: function(){                
                    var desde = '';
                    if (reporcol_desde_fecha_datefield.getValue() != '') {
                        desde = reporcol_desde_fecha_datefield.getValue().format('Y-m-d');
                    }
                    var hasta = '';
                    if (reporcol_hasta_fecha_datefield.getValue() != '') {
                        hasta = reporcol_hasta_fecha_datefield.getValue().format('Y-m-d');
                    }                    
                    reporcol_datastore.reload({
                        params: {                            
                            metodo_codigo: reporcol_metodo_codigo_combobox.getValue(),
                            marca_codigo: reporcol_marca_codigo_combobox.getValue(),
                            modelo_codigo: reporcol_modelo_codigo_combobox.getValue(),
                            fase_codigo: reporcol_fase_codigo_combobox.getValue(),
                            dimension_codigo: reporcol_dimension_codigo_combobox.getValue(),
                            tamano_codigo: reporcol_tamano_codigo_combobox.getValue(),
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
            name: 'rum_col_metodo',
            type: 'string'
        }, {
            name: 'rum_col_fecha',
            type: 'string'
        }, {
            name: 'rum_col_codigo_interno',
            type: 'string'
        }, {
            name: 'rum_col_configuracion',
            type: 'string'
        }, {
            name: 'rum_col_modelo',
            type: 'string'
        }, {
            name: 'rum_col_marca',
            type: 'string'
        }, {
            name: 'rum_etapa_nombre',
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
        }, {
            name: 'rum_col_presion',
            type: 'string'
        }, {
            name: 'rum_col_observaciones',
            type: 'string'
        }])
    });
//    reporcol_datastore.load();
    
    
    var reporcol_colmodel = new Ext.grid.ColumnModel({
        defaults: {
            sortable: true,
            locked: false,
            resizable: true
        },
        columns: [{
            header: "Fecha",
            width: 90,
            align : 'center',
            dataIndex: 'rum_col_fecha'
        }, {
            header: "C&oacute;digo Interno",
            width: 90,
            align : 'center',
            dataIndex: 'rum_col_codigo_interno'
        }, {
            header: "Configuraci&oacute;n",
            width: 150,
            align : 'center',
            dataIndex: 'rum_col_configuracion'
        }, {
            header: "Modelo",
            width: 110,
            align : 'center',
            dataIndex: 'rum_col_modelo'
        }, {
            header: "Marca",
            width: 110,
            align : 'center',
            dataIndex: 'rum_col_marca'
        }, {
            header: "Etapa",
            width: 90,
            align : 'center',
            dataIndex: 'rum_etapa_nombre'
        }, {
            header: "Tiempo Retenci&oacute;n (tr)",
            width: 130,
            align : 'center',
            dataIndex: 'rum_col_tiempo_retencion'
        }, {
            header: "Platos Te&oacute;ricos (N)",
            width: 120,
            align : 'center',
            dataIndex: 'rum_col_platos_teoricos'
        }, {
            header: "Factor de Cola (T)",
            width: 120,
            align : 'center',
            dataIndex: 'rum_col_tailing'
        }, {
            header: "Resoluci&oacute;n (R)",
            width: 120,
            align : 'center',
            dataIndex: 'rum_col_resolucion'
        }, {
            header: "Presi&oacute;n de Sistema (psi)",
            width: 130,
            align : 'center',
            dataIndex: 'rum_col_presion'
        }, {
            header: "Observaciones",
            width: 150,
            align : 'center',
            dataIndex: 'rum_col_observaciones'
        }, {
            header: "Método",
            width: 160,
            align : 'center',
            dataIndex: 'rum_col_metodo'
        }, {
            header: "Equipo",
            width: 150,
            align : 'center',
            dataIndex: 'rum_col_maquina'
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
                title: 'Tiempo Retención (tr)',
                contentEl: 'div_reporte_columnas_tiempo_retencion'
            }, {
                xtype: 'panel',
                title: 'Platos Teóricos (N)',
                contentEl: 'div_reporte_columnas_platos_teoricos'
            }, {
                xtype: 'panel',
                title: 'Factor de Cola (T)',
                contentEl: 'div_reporte_columnas_tailing'
            }, {
                xtype: 'panel',
                title: 'Resolución (R)',
                contentEl: 'div_reporte_columnas_resolucion'
            }, {
                xtype: 'panel',
                title: 'Presión de Sistema (psi)',
                contentEl: 'div_reporte_columnas_presion_sistema'
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
        
        var metodo_codigo = reporcol_metodo_codigo_combobox.getValue();
        var marca_codigo = reporcol_marca_codigo_combobox.getValue();
        var modelo_codigo = reporcol_modelo_codigo_combobox.getValue();
        var fase_codigo = reporcol_fase_codigo_combobox.getValue();
        var dimension_codigo = reporcol_dimension_codigo_combobox.getValue();
        var tamano_codigo = reporcol_tamano_codigo_combobox.getValue();
        
        var desde = '';
        if (reporcol_desde_fecha_datefield.getValue() != '') {
            desde = reporcol_desde_fecha_datefield.getValue().format('Y-m-d');
        }
        var hasta = '';
        if (reporcol_hasta_fecha_datefield.getValue() != '') {
            hasta = reporcol_hasta_fecha_datefield.getValue().format('Y-m-d');
        }
        
        var params = '?metodo_codigo=' + metodo_codigo + '&desde_fecha=' + desde + '&hasta_fecha=' + hasta;
        params += '&marca_codigo=' + marca_codigo + '&modelo_codigo=' + modelo_codigo + '&fase_codigo=' + fase_codigo + '&dimension_codigo=' + dimension_codigo + '&tamano_codigo=' + tamano_codigo;
                
        //Tiempo de Retención
        var reporcol_tiempo_retencion = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "690", "320", "8", "#FFFFFF");
        reporcol_tiempo_retencion.addVariable("path", urlWeb + "flash/amline/");
        reporcol_tiempo_retencion.addParam("wmode", "opaque");
        reporcol_tiempo_retencion.addVariable("settings_file", urlWeb + 'js/reporte_columnas/amline_st_grafico_tiempo_retencion.php');
        reporcol_tiempo_retencion.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_columnas', 'generarDatosTiempoRetencion') + params));
        reporcol_tiempo_retencion.addVariable("loading_data", "... CARGANDO ...");
        reporcol_tiempo_retencion.write("div_reporte_columnas_tiempo_retencion");
        
        //Platos Teóricos
        var reporcol_platos_teoricos = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "690", "320", "8", "#FFFFFF");
        reporcol_platos_teoricos.addVariable("path", urlWeb + "flash/amline/");
        reporcol_platos_teoricos.addParam("wmode", "opaque");
        reporcol_platos_teoricos.addVariable("settings_file", urlWeb + 'js/reporte_columnas/amline_st_grafico_platos_teoricos.php');
        reporcol_platos_teoricos.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_columnas', 'generarDatosPlatosTeoricos') + params));
        reporcol_platos_teoricos.addVariable("loading_data", "... CARGANDO ...");
        reporcol_platos_teoricos.write("div_reporte_columnas_platos_teoricos");  
        
        //Resolución
        var reporcol_resolucion = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "690", "320", "8", "#FFFFFF");
        reporcol_resolucion.addVariable("path", urlWeb + "flash/amline/");
        reporcol_resolucion.addParam("wmode", "opaque");
        reporcol_resolucion.addVariable("settings_file", urlWeb + 'js/reporte_columnas/amline_st_grafico_resolucion.php');
        reporcol_resolucion.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_columnas', 'generarDatosResolucion') + params));
        reporcol_resolucion.addVariable("loading_data", "... CARGANDO ...");
        reporcol_resolucion.write("div_reporte_columnas_resolucion");
        
        //Tailing
        var reporcol_tailing = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "690", "320", "8", "#FFFFFF");
        reporcol_tailing.addVariable("path", urlWeb + "flash/amline/");
        reporcol_tailing.addParam("wmode", "opaque");
        reporcol_tailing.addVariable("settings_file", urlWeb + 'js/reporte_columnas/amline_st_grafico_tailing.php');
        reporcol_tailing.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_columnas', 'generarDatosTailing') + params));
        reporcol_tailing.addVariable("loading_data", "... CARGANDO ...");
        reporcol_tailing.write("div_reporte_columnas_tailing");
        
        //Presión de Sistema
        var reporcol_presion_sistema = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "690", "320", "8", "#FFFFFF");
        reporcol_presion_sistema.addVariable("path", urlWeb + "flash/amline/");
        reporcol_presion_sistema.addParam("wmode", "opaque");
        reporcol_presion_sistema.addVariable("settings_file", urlWeb + 'js/reporte_columnas/amline_st_grafico_presion_sistema.php');
        reporcol_presion_sistema.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_columnas', 'generarDatosPresionSistema') + params));
        reporcol_presion_sistema.addVariable("loading_data", "... CARGANDO ...");
        reporcol_presion_sistema.write("div_reporte_columnas_presion_sistema");
    }
    
//    reporcol_cargardatosreportes();    
    
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