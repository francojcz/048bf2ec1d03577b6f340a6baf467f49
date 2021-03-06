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
                    
                    //Recargar datos consolidado de tiempos
                    tiempossemanal_datastore.load({
                        params: {
                            'fecha_inicio': fechaInicioField.getRawValue(),
                            'fecha_fin': fechaFinField.getRawValue(),
                            'cods_equipos': arrayEquipos,
                            'cods_grupos': arrayGrupos,
                            'metodo_codigo': reporgrafseman_metodo_codigo_combobox.getValue(),
                            'analista_codigo': reporgrafseman_analista_codigo_combobox.getValue()
                        }
                    });
                    //Recargar datos consolidado de indicadores
                    indicadoressemanal_datastore.load({
                        params: {
                            'fecha_inicio': fechaInicioField.getRawValue(),
                            'fecha_fin': fechaFinField.getRawValue(),
                            'cods_equipos': arrayEquipos,
                            'cods_grupos': arrayGrupos,
                            'metodo_codigo': reporgrafseman_metodo_codigo_combobox.getValue(),
                            'analista_codigo': reporgrafseman_analista_codigo_combobox.getValue()
                        }
                    });
                    //Recargar datos consolidado de perdidas
                    perdidassemanal_datastore.load({
                        params: {
                            'fecha_inicio': fechaInicioField.getRawValue(),
                            'fecha_fin': fechaFinField.getRawValue(),
                            'cods_equipos': arrayEquipos,
                            'cods_grupos': arrayGrupos,
                            'metodo_codigo': reporgrafseman_metodo_codigo_combobox.getValue(),
                            'analista_codigo': reporgrafseman_analista_codigo_combobox.getValue()
                        }
                    });
                    //Recargar datos consolidado de ahorros
                    ahorrossemanal_datastore.load({
                        params: {
                            'fecha_inicio': fechaInicioField.getRawValue(),
                            'fecha_fin': fechaFinField.getRawValue(),
                            'cods_equipos': arrayEquipos,
                            'cods_grupos': arrayGrupos,
                            'metodo_codigo': reporgrafseman_metodo_codigo_combobox.getValue(),
                            'analista_codigo': reporgrafseman_analista_codigo_combobox.getValue()
                        }
                    });
                    //Obtener el nombre de los equipos seleccionados
                    maqsemanal_datastore.load({
                        params: {
                            'cods_equipos': arrayEquipos
                        }
                    });
                    //Obtener el nombre de los grupos de equipos seleccionados
                    grusemanal_datastore.load({
                        params: {
                            'cods_grupos': arrayGrupos
                        }
                    });
                }
            }]
        }],
        renderTo: 'div_form_reporte_graficosemanal'
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
var tiempossemanal_datastore = new Ext.data.Store({
    proxy: new Ext.data.HttpProxy({
        url: getAbsoluteUrl('reporte_graficosemanal', 'consolidadoTiemposSemana'),
        method: 'POST'
    }),
    baseParams: {},
    reader: new Ext.data.JsonReader({
        root: 'results',
        totalProperty: 'total'
    }, [{
        name: 'sem_tiempo',
        type: 'string'
    }, {
        name: 'sem_horas',
        type: 'string'
    }, {
        name: 'sem_porcentaje',
        type: 'string'
    }])
});

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

//Recargar datos
tiempossemanal_datastore.load({
    params: {
        'fecha_inicio': fechaInicioField.getRawValue(),
        'fecha_fin': fechaFinField.getRawValue(),
        'cods_equipos': arrayEquipos,
        'cods_grupos': arrayGrupos,
        'metodo_codigo': reporgrafseman_metodo_codigo_combobox.getValue(),
        'analista_codigo': reporgrafseman_analista_codigo_combobox.getValue()
    }
});

var tiempossemanal_colmodel = new Ext.grid.ColumnModel({        
    columns: [{
        header: "Indicador",
        width: 75,
        align : 'center',
        dataIndex: 'sem_tiempo',
        renderer : generarRendererTiempos()
    }, {
        header: "Horas",
        width: 83,
        align : 'center',
        dataIndex: 'sem_horas',
        renderer : generarRendererTiempos()
    }, {
        header: "Porcentaje (%)",
        width: 85,
        align : 'center',
        dataIndex: 'sem_porcentaje',
        renderer : generarRendererTiempos()
    }]
});

var tiempossemanal_gridpanel = new Ext.grid.GridPanel({
    title: 'Consolidado de tiempos / Semana',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: tiempossemanal_datastore,
    cm: tiempossemanal_colmodel,
    width: 270,
    height: 120
});
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña tiempos una tabla con el nombre de los equipos seleccionados
var maqsemanal_datastore = new Ext.data.Store({
    proxy: new Ext.data.HttpProxy({
        url: getAbsoluteUrl('reporte_graficosemanal', 'equiposSeleccionados'),
        method: 'POST'
    }),
    baseParams: {},
    reader: new Ext.data.JsonReader({
        root: 'results',
        totalProperty: 'total'
    }, [{
        name: 'maq_sem_nombre',
        type: 'string'
    }])
});

//Obtener el nombre de los equipos seleccionados
maqsemanal_datastore.load({
    params: {
        'cods_equipos': arrayEquipos
    }
});

var maqsemanal_colmodel = new Ext.grid.ColumnModel({        
    columns: [{
        header: "Nombre equipo",
        width: 230,
        align : 'left',
        dataIndex: 'maq_sem_nombre'
    }]
});

var maqsemanal_gridpanel_tiemp = new Ext.grid.GridPanel({
    title: 'Equipos seleccionados',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: maqsemanal_datastore,
    cm: maqsemanal_colmodel,
    width: 270,
    height: 85
});
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña tiempos una tabla con el nombre de los equipos seleccionados
var grusemanal_datastore = new Ext.data.Store({
    proxy: new Ext.data.HttpProxy({
        url: getAbsoluteUrl('reporte_graficosemanal', 'gruposSeleccionados'),
        method: 'POST'
    }),
    baseParams: {},
    reader: new Ext.data.JsonReader({
        root: 'results',
        totalProperty: 'total'
    }, [{
        name: 'gru_sem_nombre',
        type: 'string'
    }])
});

//Obtener el nombre de los grupos seleccionados
grusemanal_datastore.load({
    params: {
        'cods_grupos': arrayGrupos
    }
});

var grusemanal_colmodel = new Ext.grid.ColumnModel({        
    columns: [{
        header: "Nombre grupo",
        width: 230,
        align : 'left',
        dataIndex: 'gru_sem_nombre'
    }]
});

var grusemanal_gridpanel_tiemp = new Ext.grid.GridPanel({
    title: 'Grupos seleccionados',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: grusemanal_datastore,
    cm: grusemanal_colmodel,
    width: 270,
    height: 85
});
/*********************************************************************************/





//TABLAS CONSOLIDADO INDICADORES
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña indicadores una tabla con el consolidado del valor por indicador
var indicadoressemanal_datastore = new Ext.data.Store({
    proxy: new Ext.data.HttpProxy({
        url: getAbsoluteUrl('reporte_graficosemanal', 'consolidadoIndicadoresSemana'),
        method: 'POST'
    }),
    baseParams: {},
    reader: new Ext.data.JsonReader({
        root: 'results',
        totalProperty: 'total'
    }, [{
        name: 'sem_indicador',
        type: 'string'
    }, {
        name: 'sem_actual',
        type: 'string'
    }, {
        name: 'sem_meta',
        type: 'string'
    }])
});

//Recargar datos
indicadoressemanal_datastore.load({
    params: {
        'fecha_inicio': fechaInicioField.getRawValue(),
        'fecha_fin': fechaFinField.getRawValue(),
        'cods_equipos': arrayEquipos,
        'cods_grupos': arrayGrupos,
        'metodo_codigo': reporgrafseman_metodo_codigo_combobox.getValue(),
        'analista_codigo': reporgrafseman_analista_codigo_combobox.getValue()
    }
});

var indicadoressemanal_colmodel = new Ext.grid.ColumnModel({        
    columns: [{
        header: "Indicador",
        width: 87,
        align : 'center',
        dataIndex: 'sem_indicador',
        renderer : generarRendererIndicadores()
    }, {
        header: "Valor Actual (%)",
        width: 93,
        align : 'center',
        dataIndex: 'sem_actual',
        renderer : generarRendererIndicadores()
    }, {
        header: "Meta (%)",
        width: 70,
        align : 'center',
        dataIndex: 'sem_meta',
        renderer : generarRendererIndicadores()
    }]
});

var indicadoressemanal_gridpanel = new Ext.grid.GridPanel({
    title: 'Consolidado de indicadores / Semana',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: indicadoressemanal_datastore,
    cm: indicadoressemanal_colmodel,
    width: 270,
    height: 160
});
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña indicadores una tabla con el nombre de los equipos seleccionados
var maqsemanal_gridpanel_ind = new Ext.grid.GridPanel({
    title: 'Equipos seleccionados',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: maqsemanal_datastore,
    cm: maqsemanal_colmodel,
    width: 270,
    height: 70
});
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña indicadores una tabla con el nombre de los equipos seleccionados
var grusemanal_gridpanel_ind = new Ext.grid.GridPanel({
    title: 'Grupos seleccionados',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: grusemanal_datastore,
    cm: grusemanal_colmodel,
    width: 270,
    height: 70
});
/*********************************************************************************/





//TABLAS CONSOLIDADO PÉRDIDAS
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña pérdidas una tabla con el consolidado del valor por indicador
var perdidassemanal_datastore = new Ext.data.Store({
    proxy: new Ext.data.HttpProxy({
        url: getAbsoluteUrl('reporte_graficosemanal', 'consolidadoPerdidasSemana'),
        method: 'POST'
    }),
    baseParams: {},
    reader: new Ext.data.JsonReader({
        root: 'results',
        totalProperty: 'total'
    }, [{
        name: 'sem_perdida',
        type: 'string'
    }, {
        name: 'sem_horas_perd',
        type: 'string'
    }, {
        name: 'sem_porcentaje_perd',
        type: 'string'
    }])
});

//Recargar datos
perdidassemanal_datastore.load({
params: {
    'fecha_inicio': fechaInicioField.getRawValue(),
    'fecha_fin': fechaFinField.getRawValue(),
    'cods_equipos': arrayEquipos,
    'cods_grupos': arrayGrupos,
    'metodo_codigo': reporgrafseman_metodo_codigo_combobox.getValue(),
    'analista_codigo': reporgrafseman_analista_codigo_combobox.getValue()
}
});

var perdidassemanal_colmodel = new Ext.grid.ColumnModel({        
    columns: [{
        header: "Indicador",
        width: 91,
        align : 'center',
        dataIndex: 'sem_perdida',
        renderer : generarRendererPerdidas()
    }, {
        header: "Horas",
        width: 70,
        align : 'center',
        dataIndex: 'sem_horas_perd',
        renderer : generarRendererPerdidas()
    }, {
        header: "Porcentaje (%)",
        width: 85,
        align : 'center',
        dataIndex: 'sem_porcentaje_perd',
        renderer : generarRendererPerdidas()
    }]
});

var perdidassemanal_gridpanel = new Ext.grid.GridPanel({
    title: 'Consolidado de pérdidas / Semana',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: perdidassemanal_datastore,
    cm: perdidassemanal_colmodel,
    width: 270,
    height: 97
});
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña tiempos una tabla con el nombre de los equipos seleccionados
var maqsemanal_gridpanel_perd = new Ext.grid.GridPanel({
    title: 'Equipos seleccionados',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: maqsemanal_datastore,
    cm: maqsemanal_colmodel,
    width: 270,
    height: 97
});
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña tiempos una tabla con el nombre de los equipos seleccionados
var grusemanal_gridpanel_perd = new Ext.grid.GridPanel({
    title: 'Grupos seleccionados',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: grusemanal_datastore,
    cm: grusemanal_colmodel,
    width: 270,
    height: 97
});
/*********************************************************************************/





//TABLAS CONSOLIDADO AHORROS
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña ahorros una tabla con el consolidado de ahorros
var ahorrossemanal_datastore = new Ext.data.Store({
    proxy: new Ext.data.HttpProxy({
        url: getAbsoluteUrl('reporte_graficosemanal', 'consolidadoAhorrosSemana'),
        method: 'POST'
    }),
    baseParams: {},
    reader: new Ext.data.JsonReader({
        root: 'results',
        totalProperty: 'total'
    }, [{
        name: 'sem_ahorro',
        type: 'string'
    }, {
        name: 'sem_horas_ahorro',
        type: 'string'
    }, {
        name: 'sem_porcentaje_ahorro',
        type: 'string'
    }])
});

//Recargar datos
ahorrossemanal_datastore.load({
    params: {
        'fecha_inicio': fechaInicioField.getRawValue(),
        'fecha_fin': fechaFinField.getRawValue(),
        'cods_equipos': arrayEquipos,
        'cods_grupos': arrayGrupos,
        'metodo_codigo': reporgrafseman_metodo_codigo_combobox.getValue(),
        'analista_codigo': reporgrafseman_analista_codigo_combobox.getValue()
    }
});

var ahorrossemanal_colmodel = new Ext.grid.ColumnModel({        
    columns: [{
        header: "Ahorro",
        width: 90,
        align : 'center',
        dataIndex: 'sem_ahorro',
        renderer : generarRendererAhorros()
    }, {
        header: "Horas",
        width: 65,
        align : 'center',
        dataIndex: 'sem_horas_ahorro',
        renderer : generarRendererAhorros()
    }, {
        header: "Porcentaje (%)",
        width: 85,
        align : 'center',
        dataIndex: 'sem_porcentaje_ahorro',
        renderer : generarRendererAhorros()
    }]
});

var ahorrossemanal_gridpanel = new Ext.grid.GridPanel({
    title: 'Consolidado de ahorros / Semana',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: ahorrossemanal_datastore,
    cm: ahorrossemanal_colmodel,
    width: 270,
    height: 80
});
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña ahorros una tabla con el nombre de los equipos seleccionados
var maqsemanal_gridpanel_ahorro = new Ext.grid.GridPanel({
    title: 'Equipos seleccionados',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: maqsemanal_datastore,
    cm: maqsemanal_colmodel,
    width: 270,
    height: 105
});
/*********************************************************************************/
//Cambios: 24 de febrero de 2014
//Se agregó en la pestaña ahorros una tabla con el nombre de los equipos seleccionados
var grusemanal_gridpanel_ahorro = new Ext.grid.GridPanel({
    title: 'Grupos seleccionados',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: grusemanal_datastore,
    cm: grusemanal_colmodel,
    width: 270,
    height: 105
});
/*********************************************************************************/
    
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
            },
            tiempossemanal_gridpanel,
            maqsemanal_gridpanel_tiemp,
            grusemanal_gridpanel_tiemp]
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
            },
            {
                xtype: 'panel',
                items: [
                    indicadoressemanal_gridpanel,
                    maqsemanal_gridpanel_ind,
                    grusemanal_gridpanel_ind
                ]
            }            
            ]
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
            },
            {
                xtype: 'panel',
                items: [
                    perdidassemanal_gridpanel,
                    maqsemanal_gridpanel_perd,
                    grusemanal_gridpanel_perd
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
                contentEl: 'div_reporte_graficosemanal_muestras_dispersion'
            }, {
                columnWidth: '.5',
                contentEl: 'div_reporte_graficosemanal_inyecciones_dispersion'
            }]
        }, {
            xtype: 'panel',
            title: 'Ahorros',
            layout: 'column',
            autoScroll: true,
            monitorResize: true,
            items: [{
                columnWidth: '.5',
                contentEl: 'div_reporte_graficosemanal_ahorros_dispersion'
            }, {
                columnWidth: '.5',
                contentEl: 'div_reporte_graficosemanal_ahorros_torta'
            },
            {
                xtype: 'panel',
                items: [
                    ahorrossemanal_gridpanel,
                    maqsemanal_gridpanel_ahorro,
                    grusemanal_gridpanel_ahorro
                ]
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
        
        //Tiempos
        var reporgrafseman_tiempos_dispersion = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "490", "400", "8", "#FFFFFF");
        reporgrafseman_tiempos_dispersion.addVariable("path", urlWeb + "flash/amline/");
        reporgrafseman_tiempos_dispersion.addParam("wmode", "opaque");
        reporgrafseman_tiempos_dispersion.addVariable("settings_file", urlWeb + 'js/reporte_graficosemanal/amline_st_grafico_tiempos.php');
        reporgrafseman_tiempos_dispersion.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_graficosemanal', 'generarDatosGraficoTiempos') + params));
        reporgrafseman_tiempos_dispersion.addVariable("loading_data", "... CARGANDO ...");
        reporgrafseman_tiempos_dispersion.write("div_reporte_graficosemanal_tiempos_dispersion");
        
        //Cambios: 24 de febrero de 2014
        //Para modificar el margen entre el gráfico de líneas y el de torta, cambiar el valor 430
        var reporgrafseman_tiempos_torta = new SWFObject(urlWeb + "flash/ampie/ampie.swf", "ampie", "430", "400", "8");
        reporgrafseman_tiempos_torta.addVariable("path", urlWeb + "flash/ampie/");
        reporgrafseman_tiempos_torta.addParam("wmode", "opaque");
        reporgrafseman_tiempos_torta.addVariable("settings_file", urlWeb + 'js/reporte_graficosemanal/ampie_st_grafico_tiempos_torta.php');
        reporgrafseman_tiempos_torta.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_graficosemanal', 'generarDatosGraficoTiemposTorta') + params));
        reporgrafseman_tiempos_torta.addVariable("loading_data", "... CARGANDO ...");
        reporgrafseman_tiempos_torta.write("div_reporte_graficosemanal_tiempos_torta");       
        
        
        //Indicadores
        var reporgrafseman_indicadores_dispersion = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "490", "400", "8", "#FFFFFF");
        reporgrafseman_indicadores_dispersion.addVariable("path", urlWeb + "flash/amline/");
        reporgrafseman_indicadores_dispersion.addParam("wmode", "opaque");
        reporgrafseman_indicadores_dispersion.addVariable("settings_file", urlWeb + 'js/reporte_graficosemanal/amline_st_grafico_indicadores.php');
        reporgrafseman_indicadores_dispersion.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_graficosemanal', 'generarDatosGraficoIndicadores') + params));
        reporgrafseman_indicadores_dispersion.addVariable("loading_data", "... CARGANDO ...");
        reporgrafseman_indicadores_dispersion.write("div_reporte_graficosemanal_indicadores_dispersion");        
        
        var reporgrafseman_indicadores_barras = new SWFObject(urlWeb + "flash/amcolumn/amcolumn.swf", "amcolumn", "430", "400", "0", "#FFFFFF");
        reporgrafseman_indicadores_barras.addVariable("path", urlWeb + "flash/amcolumn/");
        reporgrafseman_indicadores_barras.addParam("wmode", "opaque");
        reporgrafseman_indicadores_barras.addVariable("settings_file", urlWeb + 'js/reporte_graficosemanal/amcolumn_st_grafico_indicadores_barras.php');
        reporgrafseman_indicadores_barras.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_graficosemanal', 'generarDatosGraficoIndicadoresBarras') + params));
        reporgrafseman_indicadores_barras.addVariable("loading_data", "... CARGANDO ...");
        reporgrafseman_indicadores_barras.write("div_reporte_graficosemanal_indicadores_barras");
        
        
        //Pérdidas
        var reporgrafseman_perdida_dispersion = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "490", "400", "8", "#FFFFFF");
        reporgrafseman_perdida_dispersion.addVariable("path", urlWeb + "flash/amline/");
        reporgrafseman_perdida_dispersion.addParam("wmode", "opaque");
        reporgrafseman_perdida_dispersion.addVariable("settings_file", urlWeb + 'js/reporte_graficosemanal/amline_st_grafico_perdidas.php');
        reporgrafseman_perdida_dispersion.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_graficosemanal', 'generarDatosGraficoPerdidas') + params));
        reporgrafseman_perdida_dispersion.addVariable("loading_data", "... CARGANDO ...");
        reporgrafseman_perdida_dispersion.write("div_reporte_graficosemanal_perdidas_dispersion");
        
        var reporgrafseman_tiempo_torta = new SWFObject(urlWeb + "flash/ampie/ampie.swf", "ampie", "490", "390", "8", "#FFFFFF");
        reporgrafseman_tiempo_torta.addVariable("path", urlWeb + "flash/ampie/");
        reporgrafseman_tiempo_torta.addParam("wmode", "opaque");//turco ee
        reporgrafseman_tiempo_torta.addVariable("settings_file", urlWeb + 'js/reporte_graficosemanal/ampie_st_grafico_perdidas_torta.php');
        reporgrafseman_tiempo_torta.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_graficosemanal', 'generarDatosGraficoPerdidasTorta') + params));
        reporgrafseman_tiempo_torta.write("div_reporte_graficosemanal_perdidas_torta");
        
        
        //Lotes e inyecciones
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
        
        
        //Ahorros
        //Cambios: 24 de febrero de 2014
        //Se agrega la pestaña ahorros al reporte semanal
        var reporgrafseman_ahorros_dispersion = new SWFObject(urlWeb + "flash/amline/amline.swf", "amline", "490", "400", "8", "#FFFFFF");
        reporgrafseman_ahorros_dispersion.addVariable("path", urlWeb + "flash/amline/");
        reporgrafseman_ahorros_dispersion.addParam("wmode", "opaque");
        reporgrafseman_ahorros_dispersion.addVariable("settings_file", urlWeb + 'js/reporte_graficosemanal/amline_st_grafico_ahorros.php');
        reporgrafseman_ahorros_dispersion.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_graficosemanal', 'generarDatosGraficoAhorros') + params));
        reporgrafseman_ahorros_dispersion.addVariable("loading_data", "... CARGANDO ...");
        reporgrafseman_ahorros_dispersion.write("div_reporte_graficosemanal_ahorros_dispersion");
                
        var reporgrafseman_ahorros_torta = new SWFObject(urlWeb + "flash/ampie/ampie.swf", "ampie", "390", "390", "8");
        reporgrafseman_ahorros_torta.addVariable("path", urlWeb + "flash/ampie/");
        reporgrafseman_ahorros_torta.addParam("wmode", "opaque");
        reporgrafseman_ahorros_torta.addVariable("settings_file", urlWeb + 'js/reporte_graficosemanal/ampie_st_grafico_ahorros_torta.php');
        reporgrafseman_ahorros_torta.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('reporte_graficosemanal', 'generarDatosGraficoAhorrosTorta') + params));
        reporgrafseman_ahorros_torta.addVariable("loading_data", "... CARGANDO ...");
        reporgrafseman_ahorros_torta.write("div_reporte_graficosemanal_ahorros_torta");   
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
