var ayuda_col_codigo = '';
var ayuda_col_codigo_interno = 'Escriba el c&oacute;digo interno de la columna';
var ayuda_col_lote = 'Escriba el lote de la columna';
var ayuda_col_mar_nombre = 'Seleccione la marca de la columna';
var ayuda_col_mod_nombre = 'Seleccione el modelo de la columna';

var largo_panel = 500;

var crud_columna_datastore = new Ext.data.Store({
    id: 'crud_columna_datastore',
    proxy: new Ext.data.HttpProxy({
        url: getAbsoluteUrl('crud_columna', 'listarColumna'),
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
        name: 'col_codigo',
        type: 'int'
    }, {
        name: 'col_codigo_interno',
        type: 'string'
    }, {
        name: 'col_lote',
        type: 'string'
    }, {
        name: 'col_fecha_registro_sistema',
        type: 'string'
    }, {
        name: 'col_fecha_actualizacion',
        type: 'string'
    }, {
        name: 'col_usu_crea_nombre',
        type: 'string'
    }, {
        name: 'col_usu_actualiza_nombre',
        type: 'string'
    }, {
        name: 'col_causa_eliminacion',
        type: 'string'
    }, {
        name: 'col_causa_actualizacion',
        type: 'string'
    }, {
        name: 'col_eliminado',
        type: 'string'
    }, {
        name: 'col_mar_codigo',
        type: 'int'
    }, {
        name: 'col_mar_nombre',
        type: 'string'
    }, {
        name: 'col_mod_codigo',
        type: 'int'
    }, {
        name: 'col_mod_nombre',
        type: 'string'
    }])
});
crud_columna_datastore.load();

var crud_columna_marca_datastore = new Ext.data.Store({
    id: 'crud_columna_marca_datastore',
    proxy: new Ext.data.HttpProxy({
        url: getAbsoluteUrl('crud_columna', 'listarMarcas'),
        method: 'POST'
    }),
    baseParams: {},
    reader: new Ext.data.JsonReader({
        root: 'results',
        totalProperty: 'total',
        id: 'id'
    }, [{
        name: 'mar_codigo'
    }, {
        name: 'mar_nombre'
    }])
});
crud_columna_marca_datastore.load();

var crud_columna_modelo_datastore = new Ext.data.Store({
    id: 'crud_columna_modelo_datastore',
    proxy: new Ext.data.HttpProxy({
        url: getAbsoluteUrl('crud_columna', 'listarModelos'),
        method: 'POST'
    }),
    baseParams: {},
    reader: new Ext.data.JsonReader({
        root: 'results',
        totalProperty: 'total',
        id: 'id'
    }, [{
        name: 'mod_codigo'
    }, {
        name: 'mod_nombre'
    }])
});
crud_columna_modelo_datastore.load();

var col_eliminado = new Ext.form.NumberField({
    xtype: 'numberfield',
    labelStyle: 'text-align:right;',
    maxLength: 20,
    name: 'col_eliminado',
    id: 'col_eliminado',
    hideLabel: true,
    hidden: true
});

var col_codigo = new Ext.form.NumberField({
    xtype: 'numberfield',
    labelStyle: 'text-align:right;',
    maxLength: 20,
    name: 'col_codigo',
    id: 'col_codigo',
    hideLabel: true,
    hidden: true,
    listeners: {
        'render': function(){
            ayuda('col_codigo', ayuda_col_codigo);
        }
    }
});

var col_codigo_interno = new Ext.form.TextField({
    xtype: 'textfield',
    labelStyle: 'text-align:right;',
    name: 'col_codigo_interno',
    id: 'col_codigo_interno',
    fieldLabel: 'C&oacute;digo Interno',
    allowBlank: false,
    maxLength: 100,
    listeners: {
        'render': function(){
            ayuda('col_codigo_interno', ayuda_col_codigo_interno);
        }
    }
});

var col_lote = new Ext.form.TextField({
    xtype: 'textfield',
    labelStyle: 'text-align:right;',
    name: 'col_lote',
    id: 'col_lote',
    fieldLabel: 'Lote',
    allowBlank: false,
    maxLength: 100,
    listeners: {
        'render': function(){
            ayuda('col_lote', ayuda_col_lote);
        }
    }
});

var col_mar_codigo = new Ext.form.ComboBox({
    xtype: 'combobox',
    labelStyle: 'text-align:right;',
    id: 'col_mar_nombre',
    hiddenName: 'col_mar_codigo',
    name: 'col_mar_codigo',
    fieldLabel: 'Marca de Columna',
    store: crud_columna_marca_datastore,
    mode: 'local',
    emptyText: 'Seleccione ...',
    displayField: 'mar_nombre',
    valueField: 'mar_codigo',
    triggerAction: 'all',
    forceSelection: true,
    allowBlank: false,
    listeners: {
        'render': function(){
            ayuda('col_mar_nombre', ayuda_col_mar_nombre);
        },
        focus: function(){
            crud_columna_marca_datastore.reload();
        }
    }
});

var col_mod_codigo = new Ext.form.ComboBox({
    xtype: 'combobox',
    labelStyle: 'text-align:right;',
    id: 'col_mod_nombre',
    hiddenName: 'col_mod_codigo',
    name: 'col_mod_codigo',
    fieldLabel: 'Modelo de Columna',
    store: crud_columna_modelo_datastore,
    mode: 'local',
    emptyText: 'Seleccione ...',
    displayField: 'mod_nombre',
    valueField: 'mod_codigo',
    triggerAction: 'all',
    forceSelection: true,
    allowBlank: false,
    listeners: {
        'render': function(){
            ayuda('col_mod_nombre', ayuda_col_mod_nombre);
        },
        focus: function(){
            crud_columna_modelo_datastore.reload();
        }
    }
});

var col_fecha_registro_sistema = new Ext.form.TextField({
    xtype: 'textfield',
    labelStyle: 'text-align:right;',
    name: 'col_fecha_registro_sistema',
    id: 'col_fecha_registro_sistema',
    fieldLabel: 'Fecha registro',
    maxLength: 100,
    readOnly: true
});

var crud_columna_formpanel = new Ext.FormPanel({
    id: 'crud_columna_formpanel',
    frame: true,
    region: 'east',
    split: true,
    collapsible: true,
    width: 400,
    border: true,
    title: 'Columna detalle',
    columnWidth: '0.6',
    height: 470,
    layout: 'form',
    bodyStyle: 'padding:10px;',
    labelWidth: 120,
    defaults: {
        anchor: '98%'
    },
    items: [col_eliminado, col_codigo, col_codigo_interno, col_lote, col_mar_codigo, col_mod_codigo, col_fecha_registro_sistema],
    buttons: [{
        text: 'Guardar',
        iconCls: 'guardar',
        id: 'crud_columna_actualizar_boton',
        handler: function(formulario, accion){
        
            if (Ext.getCmp('crud_columna_actualizar_boton').getText() == 'Actualizar') {
                if (col_eliminado.getValue() == 0) {
                    Ext.Msg.prompt('Columna', 'Digite la causa de la actualizaci&oacute;n de esta columna', function(btn, text, op){
                        if (btn == 'ok') {
                            crud_columna_actualizar(text);
                        }
                    });
                }
                else {
                    crud_columna_actualizar('');
                }
            }
            else {
                crud_columna_actualizar('');
            }
        }
    }]
});

function columnaRenderComboColumn(value, meta, record){
    return ComboRenderer(value, col_est_codigo);
}

var crud_columna_colmodel = new Ext.grid.ColumnModel({
    defaults: {
        sortable: true,
        locked: false,
        resizable: true
    },
    columns: [{
        id: 'col_codigo',
        header: "Id",
        width: 30,
        dataIndex: 'col_codigo'
    }, {
        header: "C&oacute;digo Interno",
        width: 100,
        dataIndex: 'col_codigo_interno'
    }, {
        header: "Lote",
        width: 100,
        dataIndex: 'col_lote'
    }, {
        header: "Marca",
        width: 120,
        dataIndex: 'col_mar_nombre'        
    }, {
        header: "Modelo",
        width: 120,
        dataIndex: 'col_mod_nombre'        
    }, {
        header: "Creado por",
        width: 120,
        dataIndex: 'col_usu_crea_nombre'
    }, {
        header: "Fecha de creaci&oacute;n",
        width: 120,
        dataIndex: 'col_fecha_registro_sistema'
    }, {
        header: "Actualizado por",
        width: 120,
        dataIndex: 'col_usu_actualiza_nombre'
    }, {
        header: "Fecha de actualizaci&oacute;n",
        width: 120,
        dataIndex: 'col_fecha_actualizacion'
    }, {
        header: "Causa actualizaci&oacute;n",
        width: 120,
        dataIndex: 'col_causa_actualizacion'
    }, {
        header: "Causa eliminaci&oacute;n",
        width: 120,
        dataIndex: 'col_causa_eliminacion'
    }]
});

var crud_columna_gridpanel = new Ext.grid.GridPanel({
    id: 'crud_columna_gridpanel',
    title: 'Columnas en el sistema',
    columnWidth: '.4',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: crud_columna_datastore,
    cm: crud_columna_colmodel,
    selModel: new Ext.grid.RowSelectionModel({
        singleSelect: true,
        listeners: {
            rowselect: function(sm, row, record){
                Ext.getCmp('crud_columna_formpanel').getForm().loadRecord(record);
                Ext.getCmp('crud_columna_actualizar_boton').setText('Actualizar');
            }
        }
    }),    
    height: largo_panel,
    bbar: new Ext.PagingToolbar({
        pageSize: 15,
        store: crud_columna_datastore,
        displayInfo: true,
        displayMsg: 'Columnas {0} - {1} de {2}',
        emptyMsg: "No hay columnas aun"
    }),
    tbar: [{
        id: 'crud_columna_agregar_boton',
        text: 'Agregar',
        tooltip: 'Agregar',
        iconCls: 'agregar',
        handler: crud_columna_agregar
    }, '-', {
        text: 'Eliminar',
        tooltip: 'Eliminar',
        iconCls: 'eliminar',
        handler: crud_columna_eliminar
    }, '-', {
        text: '',
        iconCls: 'activos',
        tooltip: 'Columnas activas',
        handler: function(){
            crud_columna_datastore.baseParams.col_eliminado = '0';
            crud_columna_datastore.load({
                params: {
                    start: 0,
                    limit: 20
                }
            });
        }
    }, {
        text: '',
        iconCls: 'eliminados',
        tooltip: 'Columnas eliminadas',
        handler: function(){
            crud_columna_datastore.baseParams.col_eliminado = '1';
            crud_columna_datastore.load({
                params: {
                    start: 0,
                    limit: 20
                }
            });
        }
    }, '-', {
        text: 'Restablecer',
        iconCls: 'restablece',
        tooltip: 'Restablecer una columna eliminada',
        handler: function(){
            var cant_record = crud_columna_gridpanel.getSelectionModel().getCount();
            
            if (cant_record > 0) {
                var record = crud_columna_gridpanel.getSelectionModel().getSelected();
                if (record.get('col_codigo') != '') {
                
                    Ext.Msg.prompt('Restablecer columna', 'Digite la causa de restablecimiento', function(btn, text){
                        if (btn == 'ok') {
                            subirDatosAjax(getAbsoluteUrl('crud_columna', 'restablecerColumna'), {
                                col_codigo: record.get('col_codigo'),
                                col_causa_restablece: text
                            }, function(){
                                crud_columna_datastore.reload();
                            }, function(){
                            });
                        }
                    });
                }
            }
            else {
                mostrarMensajeConfirmacion('Error', "Seleccione una columna eliminada");
            }
        }
    }
    ]
});


/*INTEGRACION AL CONTENEDOR*/
var crud_columna_contenedor_panel = new Ext.Panel({
    id: 'crud_columna_contenedor_panel',
    height: largo_panel,
    autoWidth: true,
    //width:1000,
    border: false,
    tabTip: 'Aqui puedes ver, agregar, eliminar columnas',
    monitorResize: true,
    layout: 'border',
    items: [crud_columna_gridpanel, crud_columna_formpanel],
    buttonAlign: 'left',
    renderTo: 'div_form_crud_columna'
});

function crud_columna_actualizar(text){

    if (crud_columna_formpanel.getForm().isValid()) {
        subirDatos(crud_columna_formpanel, getAbsoluteUrl('crud_columna', 'actualizarColumna'), {
            col_causa_actualizacion: text
        }, function(){
            crud_columna_formpanel.getForm().reset();
            crud_columna_datastore.reload();
        }, function(){
        });
    }
}

function crud_columna_eliminar(){
    var cant_record = crud_columna_gridpanel.getSelectionModel().getCount();
    
    if (cant_record > 0) {
        var record = crud_columna_gridpanel.getSelectionModel().getSelected();
        if (record.get('col_codigo') != '') {
        
            Ext.Msg.confirm('Eliminar columna', "Realmente desea eliminar esta columna?", function(btn){
                if (btn == 'yes') {
                
                    Ext.Msg.prompt('Eliminar columna', 'Digite la causa de la eliminaci&oacute;n de esta columna', function(btn2, text){
                        if (btn2 == 'ok') {
                            subirDatosAjax(getAbsoluteUrl('crud_columna', 'eliminarColumna'), {
                                col_codigo: record.get('col_codigo'),
                                col_causa_eliminacion: text
                            }, function(){
                                crud_columna_datastore.reload();
                            });
                        }
                    });
                }
            });
        }
    }
    else {
        mostrarMensajeConfirmacion('Error', "Seleccione una columna a eliminar");
    }
}

function crud_columna_agregar(btn, ev){
    crud_columna_formpanel.getForm().reset();
    Ext.getCmp('crud_columna_actualizar_boton').setText('Guardar');
    
}


