var ayuda_fase_codigo = '';
var ayuda_fase_nombre = 'Escriba el valor para la fase ligada de la columna';
var largo_panel = 500;

var crud_fase_datastore = new Ext.data.Store({
    id: 'crud_fase_datastore',
    proxy: new Ext.data.HttpProxy({
        url: getAbsoluteUrl('crud_faseligada', 'listarFaseLigada'),
        method: 'POST'
    }),
    baseParams: {
        start: 0,
        limit: 20
    },
    reader: new Ext.data.JsonReader({
        root: 'results',
        totalProperty: 'total',
        id: 'id'
    }, [{
        name: 'fase_codigo',
        type: 'int'
    }, {
        name: 'fase_nombre',
        type: 'string'
    }, {
        name: 'fase_modelo',
        type: 'int'
    }, {
        name: 'fase_modelo_nombre',
        type: 'string'
    }, {
        name: 'fase_eliminado',
        type: 'string'
    }, {
        name: 'fase_fecha_registro_sistema',
        type: 'string'
    }, {
        name: 'fase_fecha_actualizacion',
        type: 'string'
    }, {
        name: 'fase_usu_crea_nombre',
        type: 'string'
    }, {
        name: 'fase_usu_actualiza_nombre',
        type: 'string'
    }, {
        name: 'fase_causa_eliminacion',
        type: 'string'
    }, {
        name: 'fase_causa_actualizacion',
        type: 'string'
    }, {
        name: 'fase_eliminado',
        type: 'string'
    }])
});
crud_fase_datastore.load();

var crud_modelo_datastore = new Ext.data.JsonStore({
        id: 'crud_modelo_datastore',
        url: getAbsoluteUrl('crud_faseligada', 'listarModelos'),
        root: 'results',
        totalProperty: 'total',
        fields: [
                {name: 'mod_codigo',type: 'int'    }, 
                {name: 'mod_nombre',type: 'string'}
        ],
        sortInfo: {
                field: 'mod_nombre',
                direction: 'ASC'
        }
});
crud_modelo_datastore.load();

var fase_eliminado = new Ext.form.NumberField({
    xtype: 'numberfield',
    labelStyle: 'text-align:right;',
    maxLength: 20,
    name: 'fase_eliminado',
    id: 'fase_eliminado',
    hideLabel: true,
    hidden: true
});

var fase_codigo = new Ext.form.NumberField({
    xtype: 'numberfield',
    labelStyle: 'text-align:right;',
    maxLength: 20,
    name: 'fase_codigo',
    id: 'fase_codigo',
    hideLabel: true,
    hidden: true,
    listeners: {
        'render': function(){
            ayuda('fase_codigo', ayuda_fase_codigo);
        }
    }
});

var fase_modelo = new Ext.form.ComboBox({
    xtype: 'combo',
    labelStyle: 'text-align:right;',
    fieldLabel: 'Modelo de la columna',
    store: crud_modelo_datastore,
    hiddenName: 'fase_modelo',
    name: 'fase_modelo',
    id: 'fase_modelo',
    mode: 'local',
    valueField: 'mod_codigo',
    forceSelection: true,
    displayField: 'mod_nombre',
    triggerAction: 'all',
    emptyText: 'Seleccione ...',
    selectOnFocus: true,
    listeners: {
            focus : function(){
                    crud_modelo_datastore.reload();
            } 
    }
});

var fase_nombre = new Ext.form.TextField({
    xtype: 'textfield',
    labelStyle: 'text-align:right;',
    name: 'fase_nombre',
    id: 'fase_nombre',
    fieldLabel: 'Fase Ligada',
    allowBlank: false,
    maxLength: 100,
    listeners: {
        'render': function(){
            ayuda('fase_nombre', ayuda_fase_nombre);
        }
    }
});

var fase_fecha_registro_sistema = new Ext.form.TextField({
    xtype: 'textfield',
    labelStyle: 'text-align:right;',
    name: 'fase_fecha_registro_sistema',
    id: 'fase_fecha_registro_sistema',
    fieldLabel: 'Fecha registro',
    maxLength: 100,
    readOnly: true
});

var crud_fase_formpanel = new Ext.FormPanel({
    id: 'crud_fase_formpanel',
    frame: true,
    region: 'east',
    split: true,
    collapsible: true,
    width: 400,
    border: true,
    title: 'Fase Ligada detalle',
    columnWidth: '0.6',
    height: 470,
    layout: 'form',
    bodyStyle: 'padding:10px;',
    labelWidth: 140,
    defaults: {
        anchor: '98%'
    },
    items: [fase_eliminado, fase_codigo, fase_modelo, fase_nombre, fase_fecha_registro_sistema],
    buttons: [{
        text: 'Guardar',
        iconCls: 'guardar',
        id: 'crud_fase_actualizar_boton',
        handler: function(formulario, accion){
        
            if (Ext.getCmp('crud_fase_actualizar_boton').getText() == 'Actualizar') {
                if (fase_eliminado.getValue() == 0) {
                    Ext.Msg.prompt('Fase Ligada', 'Digite la causa de la actualizaci&oacute;n de esta fase ligadada', function(btn, text, op){
                        if (btn == 'ok') {
                            crud_fase_actualizar(text);
                        }
                    });
                }
                else {
                    crud_fase_actualizar('');
                }
            }
            else {
                crud_fase_actualizar('');
            }
        }
    }]
});

function faseRenderComboColumn(value, meta, record){
    return ComboRenderer(value, fase_est_codigo);
}

var crud_fase_colmodel = new Ext.grid.ColumnModel({
    defaults: {
        sortable: true,
        locked: false,
        resizable: true
    },
    columns: [{
        id: 'fase_codigo',
        header: "Id",
        width: 30,
        dataIndex: 'fase_codigo'
    }, {
        header: "Fase Ligada",
        width: 150,
        dataIndex: 'fase_nombre'
    }, {
        header: "Nombre Modelo",
        width: 120,
        dataIndex: 'fase_modelo_nombre'
    }, {
        header: "Creado por",
        width: 120,
        dataIndex: 'fase_usu_crea_nombre'
    }, {
        header: "Fecha de creaci&oacute;n",
        width: 120,
        dataIndex: 'fase_fecha_registro_sistema'
    }, {
        header: "Actualizado por",
        width: 120,
        dataIndex: 'fase_usu_actualiza_nombre'
    }, {
        header: "Fecha de actualizaci&oacute;n",
        width: 120,
        dataIndex: 'fase_fecha_actualizacion'
    }, {
        header: "Causa actualizaci&oacute;n",
        width: 120,
        dataIndex: 'fase_causa_actualizacion'
    }, {
        header: "Causa eliminaci&oacute;n",
        width: 120,
        dataIndex: 'fase_causa_eliminacion'
    }]
});

var crud_fase_gridpanel = new Ext.grid.GridPanel({
    id: 'crud_fase_gridpanel',
    title: 'Fase Ligada de Columnas',
    columnWidth: '.4',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: crud_fase_datastore,
    cm: crud_fase_colmodel,
    selModel: new Ext.grid.RowSelectionModel({
        singleSelect: true,
        listeners: {
            rowselect: function(sm, row, record){
                Ext.getCmp('crud_fase_formpanel').getForm().loadRecord(record);
                Ext.getCmp('crud_fase_actualizar_boton').setText('Actualizar');
            }
        }
    }),    
    height: largo_panel,
    bbar: new Ext.PagingToolbar({
        pageSize: 15,
        store: crud_fase_datastore,
        displayInfo: true,
        displayMsg: 'Fase Ligada de Columnas {0} - {1} de {2}',
        emptyMsg: "No hay fases ligadas de columnas aun"
    }),
    tbar: [{
        id: 'crud_fase_agregar_boton',
        text: 'Agregar',
        tooltip: 'Agregar',
        iconCls: 'agregar',
        handler: crud_fase_agregar
    }, '-', {
        text: 'Eliminar',
        tooltip: 'Eliminar',
        iconCls: 'eliminar',
        handler: crud_fase_eliminar
    }, '-', {
        text: '',
        iconCls: 'activos',
        tooltip: 'Fases activas',
        handler: function(){
            crud_fase_datastore.baseParams.fase_eliminado = '0';
            crud_fase_datastore.load({
                params: {
                    start: 0,
                    limit: 20
                }
            });
        }
    }, {
        text: '',
        iconCls: 'eliminados',
        tooltip: 'Fases eliminadas',
        handler: function(){
            crud_fase_datastore.baseParams.fase_eliminado = '1';
            crud_fase_datastore.load({
                params: {
                    start: 0,
                    limit: 20
                }
            });
        }
    }, '-', {
        text: 'Restablecer',
        iconCls: 'restablece',
        tooltip: 'Restablecer una fase ligada eliminada',
        handler: function(){
            var cant_record = crud_fase_gridpanel.getSelectionModel().getCount();
            
            if (cant_record > 0) {
                var record = crud_fase_gridpanel.getSelectionModel().getSelected();
                if (record.get('fase_codigo') != '') {
                
                    Ext.Msg.prompt('Restablecer fase ligada', 'Digite la causa de restablecimiento', function(btn, text){
                        if (btn == 'ok') {
                            subirDatosAjax(getAbsoluteUrl('crud_faseligada', 'restablecerFaseLigada'), {
                                fase_codigo: record.get('fase_codigo'),
                                fase_causa_restablece: text
                            }, function(){
                                crud_fase_datastore.reload();
                            }, function(){
                            });
                        }
                    });
                }
            }
            else {
                mostrarMensajeConfirmacion('Error', "Seleccione una fase ligada eliminada");
            }
        }
    }
    ], plugins:[
        new Ext.ux.grid.Search({
                    mode:          'local',
                    position:      top,
                    searchText:    'Filtrar',
                    iconCls:       'filtrar',
                    selectAllText: 'Seleccionar todos',
                    searchTipText: 'Escriba el texto que desea buscar y presione la tecla enter',
                    width:         120
            })
    ]
});


/*INTEGRACION AL CONTENEDOR*/
var crud_fase_contenedor_panel = new Ext.Panel({
    id: 'crud_fase_contenedor_panel',
    height: largo_panel,
    autoWidth: true,
    //width:1000,
    border: false,
    tabTip: 'Aqui puede ver, agregar, eliminar y restablecer fases ligadas de columnas',
    monitorResize: true,
    layout: 'border',
    items: [crud_fase_gridpanel, crud_fase_formpanel],
    buttonAlign: 'left',
    renderTo: 'div_form_crud_faseligada'
});

function crud_fase_actualizar(text){

    if (crud_fase_formpanel.getForm().isValid()) {
        subirDatos(crud_fase_formpanel, getAbsoluteUrl('crud_faseligada', 'actualizarFaseLigada'), {
            fase_causa_actualizacion: text
        }, function(){
            crud_fase_formpanel.getForm().reset();
            crud_fase_datastore.reload();
        }, function(){
        });
    }
}

function crud_fase_eliminar(){
    var cant_record = crud_fase_gridpanel.getSelectionModel().getCount();
    
    if (cant_record > 0) {
        var record = crud_fase_gridpanel.getSelectionModel().getSelected();
        if (record.get('fase_codigo') != '') {
        
            Ext.Msg.confirm('Eliminar fase ligada', "Realmente desea eliminar esta fase ligada?", function(btn){
                if (btn == 'yes') {
                
                    Ext.Msg.prompt('Eliminar fase ligada', 'Digite la causa de la eliminaci&oacute;n de esta fase ligada', function(btn2, text){
                        if (btn2 == 'ok') {
                            subirDatosAjax(getAbsoluteUrl('crud_faseligada', 'eliminarFaseLigada'), {
                                fase_codigo: record.get('fase_codigo'),
                                fase_causa_eliminacion: text
                            }, function(){
                                crud_fase_datastore.reload();
                            });
                        }
                    });
                }
            });
        }
    }
    else {
        mostrarMensajeConfirmacion('Error', "Seleccione una fase ligada a eliminar");
    }
}

function crud_fase_agregar(btn, ev){
    crud_fase_formpanel.getForm().reset();
    Ext.getCmp('crud_fase_actualizar_boton').setText('Guardar');
    
}


