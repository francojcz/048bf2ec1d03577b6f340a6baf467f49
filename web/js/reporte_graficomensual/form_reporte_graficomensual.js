Ext.onReady(function(){

    var reporgrafmens_analista_codigo_datastore = new Ext.data.JsonStore({
        id: 'reporgrafmens_analista_codigo_datastore',
        url: getAbsoluteUrl('reporte_graficomensual', 'listarAnalistas'),
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
    reporgrafmens_analista_codigo_datastore.load();
    
    
    var reporgrafmens_analista_codigo_combobox = new Ext.form.ComboBox({
        xtype: 'combo',
        store: reporgrafmens_analista_codigo_datastore,
        hiddenName: 'analista_codigo',
        name: 'reporgrafmens_analista_codigo_combobox',
        id: 'reporgrafmens_analista_codigo_combobox',
        mode: 'local',
        valueField: 'empl_usu_codigo',
        forceSelection: true,
        displayField: 'empl_nombre_completo',
        triggerAction: 'all',
        emptyText: 'Seleccione un analista...',
        selectOnFocus: true,
        hideLabel: true
    });
    
    
    var reporgrafmens_maquina_codigo_datastore = new Ext.data.JsonStore({
        id: 'reporgrafmens_maquina_codigo_datastore',
        url: getAbsoluteUrl('reporte_graficomensual', 'listarEquiposActivos'),
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
    reporgrafmens_maquina_codigo_datastore.load();
    
    
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
        ds: reporgrafmens_maquina_codigo_datastore,
        cm: maquina_colmodel,
        sm: maquina_selmodel
});

var win_maquinas_mensual = new Ext.Window(
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
            win_maquinas_mensual.hide();
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
var reporgrafmens_grupo_codigo_datastore = new Ext.data.JsonStore({
    id: 'reporgrafmens_grupo_codigo_datastore',
    url: getAbsoluteUrl('reporte_graficomensual', 'listarGruposActivos'),
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
reporgrafmens_grupo_codigo_datastore.load();
    
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
        ds: reporgrafmens_grupo_codigo_datastore,
        cm: grupo_colmodel,
        sm: grupo_selmodel
});

var win_grupos_mensual = new Ext.Window(
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
            win_grupos_mensual.hide();
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
    
    var reporgrafmens_metodo_codigo_datastore = new Ext.data.JsonStore({
        id: 'reporgrafmens_metodo_codigo_datastore',
        url: getAbsoluteUrl('reporte_graficomensual', 'listarMetodos'),
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
    reporgrafmens_metodo_codigo_datastore.load();
    
    
    var reporgrafmens_metodo_codigo_combobox = new Ext.form.ComboBox({
        xtype: 'combo',
        store: reporgrafmens_metodo_codigo_datastore,
        hiddenName: 'metodo_codigo',
        name: 'reporgrafmens_metodo_codigo_combobox',
        id: 'reporgrafmens_metodo_codigo_combobox',
        mode: 'local',
        valueField: 'met_codigo',
        forceSelection: true,
        displayField: 'met_nombre',
        triggerAction: 'all',
        emptyText: 'Seleccione un método...',
        selectOnFocus: true,
        hideLabel: true
    });
    
    var reporgrafmens_fecha = new Date();
    var reporgrafmens_anio = new Ext.form.SpinnerField({
        xtype: 'spinnerfield',
        id: 'reporgrafmens_anio',
        name: 'reporgrafmens_anio',
        minValue: reporgrafmens_fecha.getFullYear() - 10,
        maxValue: reporgrafmens_fecha.getFullYear(),
        value: reporgrafmens_fecha.getFullYear(),
        width: 80,
        accelerate: true,
        listeners: {
            'spin': function(){
            }
        },
        hideLabel: true
    });
    
    
    var reporgrafmens_mes_data = [['01', 'Enero'], ['02', 'Febrero'], ['03', 'Marzo'], ['04', 'Abril'], ['05', 'Mayo'], ['06', 'Junio'], ['07', 'Julio'], ['08', 'Agosto'], ['09', 'Septiembre'], ['10', 'Octubre'], ['11', 'Noviembre'], ['12', 'Diciembre']];
    
    var reporgrafmens_mes_store = new Ext.data.ArrayStore({
        fields: [{
            name: 'mes_codigo'
        }, {
            name: 'mes_nombre'
        }]
    });
    reporgrafmens_mes_store.loadData(reporgrafmens_mes_data);
    
    function obtenerMesActual(){
        if (reporgrafmens_fecha.getMonth() < 9) {
            return '0' + (reporgrafmens_fecha.getMonth() + 1)
        }
        else {
            reporgrafmens_fecha.getMonth() + 1
        }
    }
    var reporgrafmens_mes_combobox = new Ext.form.ComboBox({
        xtype: 'combo',
        store: reporgrafmens_mes_store,
        hiddenName: 'mes',
        name: 'reporgrafmens_mes_combobox',
        id: 'reporgrafmens_mes_combobox',
        mode: 'local',
        valueField: 'mes_codigo',
        forceSelection: true,
        displayField: 'mes_nombre',
        triggerAction: 'all',
        emptyText: 'Seleccione un mes...',
        selectOnFocus: true,
        value: obtenerMesActual(),
        hideLabel: true
    });
    
    
    var reporgrafmens_configuracion = new Ext.FormPanel({
        //        title: 'CONFIGURACI&Oacute;N DE REPORTE MENSUAL',
        layout: 'form',
        frame: true,
        padding: 10,
        labelWidth: 100,
        items: [{
            xtype: 'compositefield',
            hideLabel: true,
            items: [{
                xtype: 'displayfield',
                html: 'A&ntilde;o'
            }, reporgrafmens_anio, {
                xtype: 'displayfield',
                html: 'Mes',
                style: 'padding: 0px 0px 0px 20px'
            }, reporgrafmens_mes_combobox]
        }, {
            xtype: 'compositefield',
            hideLabel: true,
            items: [{
                xtype: 'displayfield',
                value: 'Analista'
            }, reporgrafmens_analista_codigo_combobox, {
                xtype: 'displayfield',
                value: 'M&eacute;todo',
                style: 'padding: 0px 0px 0px 20px'
            }, reporgrafmens_metodo_codigo_combobox, {
                text: 'Seleccionar Equipos',
                xtype: 'button',
                iconCls: 'equipo',
                style: 'padding: 0px 0px 0px 20px',
                handler: function(){
                    Ext.getBody().mask();
                    win_maquinas_mensual.show();
                }
            }, {
                text: 'Seleccionar Grupo de Equipos',
                xtype: 'button',
                iconCls: 'grupo',
                style: 'padding: 0px 0px 0px 20px',
                handler: function(){
                    Ext.getBody().mask();
                    win_grupos_mensual.show();
                }
            }, {
                text: 'Generar gr&aacute;ficos',
                xtype: 'button',
                iconCls: 'reload',
                style: 'padding: 0px 0px 0px 20px',
                handler: function(){
                    reporgrafmens_cargardatosreportes();
                    
                    //Codigos de los equipos seleccionados
                    var equiposSeleccionados = maquinas_gridpanel.selModel.getSelections();
                    var equiposAFiltrar = [];
                    for(i = 0; i < maquinas_gridpanel.selModel.getCount(); i++){
                            equiposAFiltrar.push(equiposSeleccionados[i].json.maq_codigo);
                    }
                    var arrayEquipos = Ext.encode(equiposAFiltrar);        

                    //Codigos de los grupos de equipos seleccionados
                    var gruposSeleccionados = grupos_gridpanel.selModel.getSelections();
                    var gruposAFiltrar = [];
                    for(j = 0; j < grupos_gridpanel.selModel.getCount(); j++){
                            gruposAFiltrar.push(gruposSeleccionados[j].json.gru_codigo);
                    }
                    var arrayGrupos = Ext.encode(gruposAFiltrar);
                    
                    //Recargar datos consolidado de tiempos
                    tiemposmensual_datastore.load({
                        params: {
                            'mes': reporgrafmens_mes_combobox.getValue(),
                            'anio': reporgrafmens_anio.getValue(),
                            'cods_equipos': arrayEquipos,
                            'cods_grupos': arrayGrupos
                        }
                    });
                    //Recargar datos consolidado de indicadores
                    indicadoresmensual_datastore.load({
                        params: {
                            'mes': reporgrafmens_mes_combobox.getValue(),
                            'anio': reporgrafmens_anio.getValue(),
                            'cods_equipos': arrayEquipos,
                            'cods_grupos': arrayGrupos
                        }
                    });
                    //Recargar datos consolidado de indicadores
                    perdidasmensual_datastore.load({
                        params: {
                            'mes': reporgrafmens_mes_combobox.getValue(),
                            'anio': reporgrafmens_anio.getValue(),
                            'cods_equipos': arrayEquipos,
                            'cods_grupos': arrayGrupos,
                            'metodo_codigo': reporgrafmens_metodo_codigo_combobox.getValue(),
                            'analista_codigo': reporgrafmens_analista_codigo_combobox.getValue()
                        }
                    });
                    
                    //Obtener el nombre de los equipos seleccionados
                    maqmensual_datastore.load({
                        params: {
                            'cods_equipos': arrayEquipos
                        }
                    });
                    
                    //Obtener el nombre de los grupos seleccionados
                    grumensual_datastore.load({
                        params: {
                            'cods_grupos': arrayGrupos
                        }
                    });
                }
            }]
        }],
        renderTo: 'div_form_reporte_graficomensual'
    });




//TABLAS CONSOLIDADO TIEMPOS
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña tiempos una tabla con el consolidado de tiempos por indicador
var tiemposmensual_datastore = new Ext.data.Store({
    proxy: new Ext.data.HttpProxy({
        url: getAbsoluteUrl('reporte_graficomensual', 'consolidadoTiemposMes'),
        method: 'POST'
    }),
    baseParams: {},
    reader: new Ext.data.JsonReader({
        root: 'results',
        totalProperty: 'total'
    }, [{
        name: 'mes_tiempo',
        type: 'string'
    }, {
        name: 'mes_horas',
        type: 'string'
    }, {
        name: 'mes_porcentaje',
        type: 'string'
    }])
});

//Codigos de los equipos seleccionados
var equiposSeleccionados = maquinas_gridpanel.selModel.getSelections();
var equiposAFiltrar = [];
for(i = 0; i < maquinas_gridpanel.selModel.getCount(); i++){
        equiposAFiltrar.push(equiposSeleccionados[i].json.maq_codigo);
}
var arrayEquipos = Ext.encode(equiposAFiltrar);        

//Codigos de los grupos de equipos seleccionados
var gruposSeleccionados = grupos_gridpanel.selModel.getSelections();
var gruposAFiltrar = [];
for(j = 0; j < grupos_gridpanel.selModel.getCount(); j++){
        gruposAFiltrar.push(gruposSeleccionados[j].json.gru_codigo);
}
var arrayGrupos = Ext.encode(gruposAFiltrar); 

//Recargar datos
tiemposmensual_datastore.load({
    params: {
        'mes': reporgrafmens_mes_combobox.getValue(),
        'anio': reporgrafmens_anio.getValue(),
        'cods_equipos': arrayEquipos,
        'cods_grupos': arrayGrupos
    }
});

var tiemposmensual_colmodel = new Ext.grid.ColumnModel({        
    columns: [{
        header: "Indicador",
        width: 75,
        align : 'center',
        dataIndex: 'mes_tiempo'
    }, {
        header: "Horas",
        width: 83,
        align : 'center',
        dataIndex: 'mes_horas'
    }, {
        header: "Porcentaje (%)",
        width: 85,
        align : 'center',
        dataIndex: 'mes_porcentaje'
    }, ]
});

var tiemposmensual_gridpanel = new Ext.grid.GridPanel({
    title: 'Consolidado tiempos / Mes',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: tiemposmensual_datastore,
    cm: tiemposmensual_colmodel,
    width: 270,
    height: 120
});
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña tiempos una tabla con el nombre de los equipos seleccionados
var maqmensual_datastore = new Ext.data.Store({
    proxy: new Ext.data.HttpProxy({
        url: getAbsoluteUrl('reporte_graficomensual', 'equiposSeleccionados'),
        method: 'POST'
    }),
    baseParams: {},
    reader: new Ext.data.JsonReader({
        root: 'results',
        totalProperty: 'total'
    }, [{
        name: 'maq_men_nombre',
        type: 'string'
    }])
});

//Obtener el nombre de los equipos seleccionados
maqmensual_datastore.load({
    params: {        
        'cods_equipos': arrayEquipos
    }
});

var maqmensual_colmodel = new Ext.grid.ColumnModel({        
    columns: [{
        header: "Nombre equipo",
        width: 230,
        align : 'left',
        dataIndex: 'maq_men_nombre'
    }]
});

var maqmensual_gridpanel_tiemp = new Ext.grid.GridPanel({
    title: 'Equipos seleccionados',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: maqmensual_datastore,
    cm: maqmensual_colmodel,
    width: 270,
    height: 85
});
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña tiempos una tabla con el nombre de los equipos seleccionados
var grumensual_datastore = new Ext.data.Store({
    proxy: new Ext.data.HttpProxy({
        url: getAbsoluteUrl('reporte_graficomensual', 'gruposSeleccionados'),
        method: 'POST'
    }),
    baseParams: {},
    reader: new Ext.data.JsonReader({
        root: 'results',
        totalProperty: 'total'
    }, [{
        name: 'gru_men_nombre',
        type: 'string'
    }])
});

//Obtener el nombre de los grupos seleccionados
grumensual_datastore.load({
    params: {
        'cods_grupos': arrayGrupos
    }
});

var grumensual_colmodel = new Ext.grid.ColumnModel({        
    columns: [{
        header: "Nombre grupo",
        width: 230,
        align : 'left',
        dataIndex: 'gru_men_nombre'
    }]
});

var grumensual_gridpanel_tiemp = new Ext.grid.GridPanel({
    title: 'Grupos seleccionados',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: grumensual_datastore,
    cm: grumensual_colmodel,
    width: 270,
    height: 85
});
/*********************************************************************************/





//TABLAS CONSOLIDADO INDICADORES
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña indicadores una tabla con el consolidado del valor por indicador
var indicadoresmensual_datastore = new Ext.data.Store({
    proxy: new Ext.data.HttpProxy({
        url: getAbsoluteUrl('reporte_graficomensual', 'consolidadoIndicadoresMes'),
        method: 'POST'
    }),
    baseParams: {},
    reader: new Ext.data.JsonReader({
        root: 'results',
        totalProperty: 'total'
    }, [{
        name: 'mes_indicador',
        type: 'string'
    }, {
        name: 'mes_actual',
        type: 'string'
    }, {
        name: 'mes_meta',
        type: 'string'
    }])
});

//Recargar datos
indicadoresmensual_datastore.load({
    params: {
        'mes': reporgrafmens_mes_combobox.getValue(),
        'anio': reporgrafmens_anio.getValue(),
        'cods_equipos': arrayEquipos,
        'cods_grupos': arrayGrupos
    }
});

var indicadoresmensual_colmodel = new Ext.grid.ColumnModel({        
    columns: [{
        header: "Indicador",
        width: 87,
        align : 'center',
        dataIndex: 'mes_indicador'
    }, {
        header: "Valor Actual (%)",
        width: 93,
        align : 'center',
        dataIndex: 'mes_actual'
    }, {
        header: "Meta (%)",
        width: 70,
        align : 'center',
        dataIndex: 'mes_meta'
    }, ]
});

var indicadoresmensual_gridpanel = new Ext.grid.GridPanel({
    title: 'Consolidado indicadores / Mes',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: indicadoresmensual_datastore,
    cm: indicadoresmensual_colmodel,
    width: 270,
    height: 160
});
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña indicadores una tabla con el nombre de los equipos seleccionados
var maqmensual_gridpanel_ind = new Ext.grid.GridPanel({
    title: 'Equipos seleccionados',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: maqmensual_datastore,
    cm: maqmensual_colmodel,
    width: 270,
    height: 70
});
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña indicadores una tabla con el nombre de los equipos seleccionados
var grumensual_gridpanel_ind = new Ext.grid.GridPanel({
    title: 'Grupos seleccionados',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: grumensual_datastore,
    cm: grumensual_colmodel,
    width: 270,
    height: 70
});
/*********************************************************************************/





//TABLAS CONSOLIDADO PÉRDIDAS
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña pérdidas una tabla con el consolidado del valor por indicador
var perdidasmensual_datastore = new Ext.data.Store({
    proxy: new Ext.data.HttpProxy({
        url: getAbsoluteUrl('reporte_graficomensual', 'consolidadoPerdidasMes'),
        method: 'POST'
    }),
    baseParams: {},
    reader: new Ext.data.JsonReader({
        root: 'results',
        totalProperty: 'total'
    }, [{
        name: 'mes_perdida',
        type: 'string'
    }, {
        name: 'mes_horas_perd',
        type: 'string'
    }, {
        name: 'mes_porcentaje_perd',
        type: 'string'
    }])
});

//Recargar datos
perdidasmensual_datastore.load({
    params: {
        'mes': reporgrafmens_mes_combobox.getValue(),
        'anio': reporgrafmens_anio.getValue(),
        'cods_equipos': arrayEquipos,
        'cods_grupos': arrayGrupos,
        'metodo_codigo': reporgrafmens_metodo_codigo_combobox.getValue(),
        'analista_codigo': reporgrafmens_analista_codigo_combobox.getValue()
    }
});

var perdidasmensual_colmodel = new Ext.grid.ColumnModel({        
    columns: [{
        header: "Indicador",
        width: 91,
        align : 'center',
        dataIndex: 'mes_perdida'
    }, {
        header: "Horas",
        width: 70,
        align : 'center',
        dataIndex: 'mes_horas_perd'
    }, {
        header: "Porcentaje (%)",
        width: 85,
        align : 'center',
        dataIndex: 'mes_porcentaje_perd'
    }]
});

var perdidasmensual_gridpanel = new Ext.grid.GridPanel({
    title: 'Consolidado de pérdidas / Mes',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: perdidasmensual_datastore,
    cm: perdidasmensual_colmodel,
    width: 270,
    height: 97
});
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña tiempos una tabla con el nombre de los equipos seleccionados
var maqmensual_gridpanel_perd = new Ext.grid.GridPanel({
    title: 'Equipos seleccionados',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: maqmensual_datastore,
    cm: maqmensual_colmodel,
    width: 270,
    height: 97
});
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña tiempos una tabla con el nombre de los equipos seleccionados
var grumensual_gridpanel_perd = new Ext.grid.GridPanel({
    title: 'Grupos seleccionados',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: grumensual_datastore,
    cm: grumensual_colmodel,
    width: 270,
    height: 97
});
/*********************************************************************************/



    var reporgrafmens_reportes_tabpanel = new Ext.TabPanel({
        frame: true,
        items: [{
            xtype: 'panel',
            title: 'Tiempos',
            layout: 'column',
            autoScroll: true,
            monitorResize: true,
            items: [{
                columnWidth: '.5',
                contentEl: 'div_reporte_graficomensual_tiempos_dispersion'
            }, {
                columnWidth: '.5',
                contentEl: 'div_reporte_graficomensual_tiempos_torta'
            }, 
            tiemposmensual_gridpanel,
            maqmensual_gridpanel_tiemp,
            grumensual_gridpanel_tiemp]
        }, {
            xtype: 'panel',
            title: 'Indicadores',
            layout: 'column',
            autoScroll: true,
            monitorResize: true,
            items: [{
                columnWidth: '.5',
                contentEl: 'div_reporte_graficomensual_indicadores_dispersion'
            }, {
                columnWidth: '.5',
                contentEl: 'div_reporte_graficomensual_indicadores_barras'
            },{
                xtype: 'panel',
                items: [
                    indicadoresmensual_gridpanel,
                    maqmensual_gridpanel_ind,
                    grumensual_gridpanel_ind
                ]
            }]
        }, {
            xtype: 'panel',
            title: 'P&eacute;rdidas',
            layout: 'column',
            autoScroll: true,
            monitorResize: true,
            items: [{
                columnWidth: '.5',
                contentEl: 'div_reporte_graficomensual_perdidas_dispersion'
            }, {
                columnWidth: '.5',
                contentEl: 'div_reporte_graficomensual_perdidas_torta'
            },
            {
                xtype: 'panel',
                items: [
                    perdidasmensual_gridpanel,
                    maqmensual_gridpanel_perd,
                    grumensual_gridpanel_perd
                ]
            }]
        }, {
            xtype: 'panel',
            title: 'Lotes e inyecciones',
            layout: 'column',
            autoScroll: true,
            monitorResize: true,
            items: [{
                columnWidth: '.5',
                contentEl: 'div_reporte_graficomensual_muestras_dispersion'
            }, {
                columnWidth: '.5',
                contentEl: 'div_reporte_graficomensual_inyecciones_dispersion'
            }]
        }],
        activeTab: 0,
        height: 430,
        deferredRender: false,
        renderTo: 'div_form_reporte_graficomensual',
        listeners: {
            tabchange: function(){
                redirigirSiSesionExpiro();
            }
        }
    });
    
    function reporgrafmens_cargardatosreportes(){
        redirigirSiSesionExpiro();
        
        var mes = reporgrafmens_mes_combobox.getValue();
        var anio = reporgrafmens_anio.getValue();
        var metodo_codigo = reporgrafmens_metodo_codigo_combobox.getValue();
        var analista_codigo = reporgrafmens_analista_codigo_combobox.getValue();
        
        //Cambios: 24 de febrero de 2014
        //Codigos de los equipos seleccionados
        var equiposSeleccionados = maquinas_gridpanel.selModel.getSelections();
        var equiposAFiltrar = [];
        for(i = 0; i < maquinas_gridpanel.selModel.getCount(); i++){
                equiposAFiltrar.push(equiposSeleccionados[i].json.maq_codigo);
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
        
        var params = '?mes=' + mes + '&anio=' + anio + '&cods_equipos=' + arrayEquipos + '&cods_grupos=' + arrayGrupos + '&metodo_codigo=' + metodo_codigo + '&analista_codigo=' + analista_codigo;
        
        //Tiempos
        var reporgrafmens_tiempos_dispersion = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "520", "400", "8", "#FFFFFF");
        reporgrafmens_tiempos_dispersion.addVariable("path", urlWeb + "flash/amline/");
        reporgrafmens_tiempos_dispersion.addParam("wmode", "opaque");
        reporgrafmens_tiempos_dispersion.addVariable("settings_file", urlWeb + 'js/reporte_graficomensual/amline_st_grafico_tiempos.php');
        reporgrafmens_tiempos_dispersion.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_graficomensual', 'generarDatosGraficoTiempos') + params));
        reporgrafmens_tiempos_dispersion.addVariable("loading_data", "... CARGANDO ...");
        reporgrafmens_tiempos_dispersion.write("div_reporte_graficomensual_tiempos_dispersion");
        
        //Cambios: 24 de febrero de 2014
        //Para modificar el margen entre el gráfico de líneas y el de torta, cambiar el valor 430
        var reporgrafmens_tiempos_torta = new SWFObject(urlWeb + "flash/ampie/ampie.swf", "ampie", "430", "400", "8");
        reporgrafmens_tiempos_torta.addVariable("path", urlWeb + "flash/ampie/");
        reporgrafmens_tiempos_torta.addParam("wmode", "opaque");
        reporgrafmens_tiempos_torta.addVariable("settings_file", urlWeb + 'js/reporte_graficomensual/ampie_st_grafico_tiempos_torta.php');
        reporgrafmens_tiempos_torta.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_graficomensual', 'generarDatosGraficoTiemposTorta') + params));
        reporgrafmens_tiempos_torta.addVariable("loading_data", "... CARGANDO ...");
        reporgrafmens_tiempos_torta.write("div_reporte_graficomensual_tiempos_torta");
        
        
        //Indicadores
        var reporgrafmens_indicadores_dispersion = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "485", "400", "8", "#FFFFFF");
        reporgrafmens_indicadores_dispersion.addVariable("path", urlWeb + "flash/amline/");
        reporgrafmens_indicadores_dispersion.addParam("wmode", "opaque");
        reporgrafmens_indicadores_dispersion.addVariable("settings_file", urlWeb + 'js/reporte_graficomensual/amline_st_grafico_indicadores.php');
        reporgrafmens_indicadores_dispersion.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_graficomensual', 'generarDatosGraficoIndicadores') + params));
        reporgrafmens_indicadores_dispersion.addVariable("loading_data", "... CARGANDO ...");
        reporgrafmens_indicadores_dispersion.write("div_reporte_graficomensual_indicadores_dispersion");        
        
        var reporgrafmens_indicadores_barras = new SWFObject(urlWeb + "flash/amcolumn/amcolumn.swf", "amcolumn", "520", "400", "8", "#FFFFFF");
        reporgrafmens_indicadores_barras.addVariable("path", urlWeb + "flash/amcolumn/");
        reporgrafmens_indicadores_barras.addParam("wmode", "opaque");
        reporgrafmens_indicadores_barras.addVariable("settings_file", urlWeb + 'js/reporte_graficomensual/amcolumn_st_grafico_indicadores_barras.php');
        reporgrafmens_indicadores_barras.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_graficomensual', 'generarDatosGraficoIndicadoresBarras') + params));
        reporgrafmens_indicadores_barras.addVariable("loading_data", "... CARGANDO ...");
        reporgrafmens_indicadores_barras.write("div_reporte_graficomensual_indicadores_barras");
        
        
        //Pérdidas
        var reporgrafmens_perdida_dispersion = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "510", "400", "8", "#FFFFFF");
        reporgrafmens_perdida_dispersion.addVariable("path", urlWeb + "flash/amline/");
        reporgrafmens_perdida_dispersion.addParam("wmode", "opaque");
        reporgrafmens_perdida_dispersion.addVariable("settings_file", urlWeb + 'js/reporte_graficomensual/amline_st_grafico_perdidas.php');
        reporgrafmens_perdida_dispersion.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_graficomensual', 'generarDatosGraficoPerdidas') + params));
        reporgrafmens_perdida_dispersion.addVariable("loading_data", "... CARGANDO ...");
        reporgrafmens_perdida_dispersion.write("div_reporte_graficomensual_perdidas_dispersion");
        
        var reporgrafmens_tiempo_torta = new SWFObject(urlWeb + "flash/ampie/ampie.swf", "ampie", "500", "390", "8", "#FFFFFF");
        reporgrafmens_tiempo_torta.addVariable("path", urlWeb + "flash/ampie/");
        reporgrafmens_tiempo_torta.addParam("wmode", "opaque");//turco ee
        reporgrafmens_tiempo_torta.addVariable("settings_file", urlWeb + 'js/reporte_graficomensual/ampie_st_grafico_perdidas_torta.php');
        reporgrafmens_tiempo_torta.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_graficomensual', 'generarDatosGraficoPerdidasTorta') + params));
        reporgrafmens_tiempo_torta.write("div_reporte_graficomensual_perdidas_torta");
        
        //muestras
        var reporgrafmens_muestras_dispersion = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "520", "400", "8", "#FFFFFF");
        reporgrafmens_muestras_dispersion.addVariable("path", urlWeb + "flash/amline/");
        reporgrafmens_muestras_dispersion.addParam("wmode", "opaque");
        reporgrafmens_muestras_dispersion.addVariable("settings_file", urlWeb + 'js/reporte_graficomensual/amline_st_grafico_muestras.php');
        reporgrafmens_muestras_dispersion.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_graficomensual', 'generarDatosGraficoMuestras') + params));
        reporgrafmens_muestras_dispersion.write("div_reporte_graficomensual_muestras_dispersion");
        
        var reporgrafmens_inyecciones_dispersion = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "520", "400", "8", "#FFFFFF");
        reporgrafmens_inyecciones_dispersion.addVariable("path", urlWeb + "flash/amline/");
        reporgrafmens_inyecciones_dispersion.addParam("wmode", "opaque");
        reporgrafmens_inyecciones_dispersion.addVariable("settings_file", urlWeb + 'js/reporte_graficomensual/amline_st_grafico_inyecciones.php');
        reporgrafmens_inyecciones_dispersion.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_graficomensual', 'generarDatosGraficoInyecciones') + params));
        reporgrafmens_inyecciones_dispersion.write("div_reporte_graficomensual_inyecciones_dispersion");
    }
    
    reporgrafmens_cargardatosreportes();
    
    
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
    
    function reporgrafmens_reajustar(){
        var ancho = obtenerAncho(reporgrafmens_configuracion, 1024);
        if (ancho == 1024) {
            reporgrafmens_configuracion.setWidth(ancho);
            reporgrafmens_reportes_tabpanel.setWidth(ancho);
            
            reporgrafmens_configuracion.doLayout();
            reporgrafmens_reportes_tabpanel.doLayout();
        }
    }
    
    reporgrafmens_reajustar();
});
