var ayuda_mod_codigo = '';
var ayuda_mod_nombre = 'Escriba el nombre del modelo de la columna';
var largo_panel = 500;

var crud_modelo_datastore = new Ext.data.Store({
    id: 'crud_modelo_datastore',
    proxy: new Ext.data.HttpProxy({
        url: getAbsoluteUrl('crud_modelo', 'listarModelo'),
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
        name: 'mod_codigo',
        type: 'int'
    }, {
        name: 'mod_nombre',
        type: 'string'
    }, {
        name: 'mod_marca',
        type: 'int'
    }, {
        name: 'mod_marca_nombre',
        type: 'string'
    }, {
        name: 'mod_eliminado',
        type: 'string'
    }, {
        name: 'mod_fecha_registro_sistema',
        type: 'string'
    }, {
        name: 'mod_fecha_actualizacion',
        type: 'string'
    }, {
        name: 'mod_usu_crea_nombre',
        type: 'string'
    }, {
        name: 'mod_usu_actualiza_nombre',
        type: 'string'
    }, {
        name: 'mod_causa_eliminacion',
        type: 'string'
    }, {
        name: 'mod_causa_actualizacion',
        type: 'string'
    }, {
        name: 'mod_eliminado',
        type: 'string'
    }])
});
crud_modelo_datastore.load();

var crud_marca_datastore = new Ext.data.JsonStore({
        id: 'crud_marca_datastore',
        url: getAbsoluteUrl('crud_modelo', 'listarMarcas'),
        root: 'results',
        totalProperty: 'total',
        fields: [
                {name: 'mar_codigo',type: 'int'    }, 
                {name: 'mar_nombre',type: 'string'}
        ],
        sortInfo: {
                field: 'mar_nombre',
                direction: 'ASC'
        }
});
crud_marca_datastore.load();

var mod_eliminado = new Ext.form.NumberField({
    xtype: 'numberfield',
    labelStyle: 'text-align:right;',
    maxLength: 20,
    name: 'mod_eliminado',
    id: 'mod_eliminado',
    hideLabel: true,
    hidden: true
});

var mod_codigo = new Ext.form.NumberField({
    xtype: 'numberfield',
    labelStyle: 'text-align:right;',
    maxLength: 20,
    name: 'mod_codigo',
    id: 'mod_codigo',
    hideLabel: true,
    hidden: true,
    listeners: {
        'render': function(){
            ayuda('mod_codigo', ayuda_mod_codigo);
        }
    }
});

var mod_marca = new Ext.form.ComboBox({
    xtype: 'combo',
    labelStyle: 'text-align:right;',
    fieldLabel: 'Marca de la columna',
    store: crud_marca_datastore,
    hiddenName: 'mod_marca',
    name: 'mod_marca',
    id: 'mod_marca',
    mode: 'local',
    valueField: 'mar_codigo',
    forceSelection: true,
    displayField: 'mar_nombre',
    triggerAction: 'all',
    emptyText: 'Seleccione ...',
    selectOnFocus: true,
    listeners: {
            focus : function(){
                    crud_marca_datastore.reload();
            } 
    }
});

var mod_nombre = new Ext.form.TextField({
    xtype: 'textfield',
    labelStyle: 'text-align:right;',
    name: 'mod_nombre',
    id: 'mod_nombre',
    fieldLabel: 'Nombre del modelo',
    allowBlank: false,
    maxLength: 100,
    listeners: {
        'render': function(){
            ayuda('mod_nombre', ayuda_mod_nombre);
        }
    }
});

var mod_fecha_registro_sistema = new Ext.form.TextField({
    xtype: 'textfield',
    labelStyle: 'text-align:right;',
    name: 'mod_fecha_registro_sistema',
    id: 'mod_fecha_registro_sistema',
    fieldLabel: 'Fecha registro',
    maxLength: 100,
    readOnly: true
});

var crud_modelo_formpanel = new Ext.FormPanel({
    id: 'crud_modelo_formpanel',
    frame: true,
    region: 'east',
    split: true,
    collapsible: true,
    width: 400,
    border: true,
    title: 'Modelo detalle',
    columnWidth: '0.6',
    height: 470,
    layout: 'form',
    bodyStyle: 'padding:10px;',
    labelWidth: 140,
    defaults: {
        anchor: '98%'
    },
    items: [mod_eliminado, mod_codigo, mod_marca, mod_nombre, mod_fecha_registro_sistema],
    buttons: [{
        text: 'Guardar',
        iconCls: 'guardar',
        id: 'crud_modelo_actualizar_boton',
        handler: function(formulario, accion){
        
            if (Ext.getCmp('crud_modelo_actualizar_boton').getText() == 'Actualizar') {
                if (mod_eliminado.getValue() == 0) {
                    Ext.Msg.prompt('Modelo', 'Digite la causa de la actualizaci&oacute;n de este modelo', function(btn, text, op){
                        if (btn == 'ok') {
                            crud_modelo_actualizar(text);
                        }
                    });
                }
                else {
                    crud_modelo_actualizar('');
                }
            }
            else {
                crud_modelo_actualizar('');
            }
        }
    }]
});

function modeloRenderComboColumn(value, meta, record){
    return ComboRenderer(value, mod_est_codigo);
}

var crud_modelo_colmodel = new Ext.grid.ColumnModel({
    defaults: {
        sortable: true,
        locked: false,
        resizable: true
    },
    columns: [{
        id: 'mod_codigo',
        header: "Id",
        width: 30,
        dataIndex: 'mod_codigo'
    }, {
        header: "Nombre Modelo",
        width: 150,
        dataIndex: 'mod_nombre'
    }, {
        header: "Nombre Marca",
        width: 120,
        dataIndex: 'mod_marca_nombre'
    }, {
        header: "Creado por",
        width: 120,
        dataIndex: 'mod_usu_crea_nombre'
    }, {
        header: "Fecha de creaci&oacute;n",
        width: 120,
        dataIndex: 'mod_fecha_registro_sistema'
    }, {
        header: "Actualizado por",
        width: 120,
        dataIndex: 'mod_usu_actualiza_nombre'
    }, {
        header: "Fecha de actualizaci&oacute;n",
        width: 120,
        dataIndex: 'mod_fecha_actualizacion'
    }, {
        header: "Causa actualizaci&oacute;n",
        width: 120,
        dataIndex: 'mod_causa_actualizacion'
    }, {
        header: "Causa eliminaci&oacute;n",
        width: 120,
        dataIndex: 'mod_causa_eliminacion'
    }]
});

var crud_modelo_gridpanel = new Ext.grid.GridPanel({
    id: 'crud_modelo_gridpanel',
    title: 'Modelo de Columnas',
    columnWidth: '.4',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: crud_modelo_datastore,
    cm: crud_modelo_colmodel,
    selModel: new Ext.grid.RowSelectionModel({
        singleSelect: true,
        listeners: {
            rowselect: function(sm, row, record){
                Ext.getCmp('crud_modelo_formpanel').getForm().loadRecord(record);
                Ext.getCmp('crud_modelo_actualizar_boton').setText('Actualizar');
            }
        }
    }),    
    height: largo_panel,
    bbar: new Ext.PagingToolbar({
        pageSize: 15,
        store: crud_modelo_datastore,
        displayInfo: true,
        displayMsg: 'Modelos de Columnas {0} - {1} de {2}',
        emptyMsg: "No hay modelos de columnas aun"
    }),
    tbar: [{
        id: 'crud_modelo_agregar_boton',
        text: 'Agregar',
        tooltip: 'Agregar',
        iconCls: 'agregar',
        handler: crud_modelo_agregar
    }, '-', {
        text: 'Eliminar',
        tooltip: 'Eliminar',
        iconCls: 'eliminar',
        handler: crud_modelo_eliminar
    }, '-', {
        text: '',
        iconCls: 'activos',
        tooltip: 'Modelos activos',
        handler: function(){
            crud_modelo_datastore.baseParams.mod_eliminado = '0';
            crud_modelo_datastore.load({
                params: {
                    start: 0,
                    limit: 20
                }
            });
        }
    }, {
        text: '',
        iconCls: 'eliminados',
        tooltip: 'Modelos eliminados',
        handler: function(){
            crud_modelo_datastore.baseParams.mod_eliminado = '1';
            crud_modelo_datastore.load({
                params: {
                    start: 0,
                    limit: 20
                }
            });
        }
    }, '-', {
        text: 'Restablecer',
        iconCls: 'restablece',
        tooltip: 'Restablecer un modelo eliminada',
        handler: function(){
            var cant_record = crud_modelo_gridpanel.getSelectionModel().getCount();
            
            if (cant_record > 0) {
                var record = crud_modelo_gridpanel.getSelectionModel().getSelected();
                if (record.get('mod_codigo') != '') {
                
                    Ext.Msg.prompt('Restablecer modelo', 'Digite la causa de restablecimiento', function(btn, text){
                        if (btn == 'ok') {
                            subirDatosAjax(getAbsoluteUrl('crud_modelo', 'restablecerModelo'), {
                                mod_codigo: record.get('mod_codigo'),
                                mod_causa_restablece: text
                            }, function(){
                                crud_modelo_datastore.reload();
                            }, function(){
                            });
                        }
                    });
                }
            }
            else {
                mostrarMensajeConfirmacion('Error', "Seleccione un modelo eliminado");
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
var crud_modelo_contenedor_panel = new Ext.Panel({
    id: 'crud_modelo_contenedor_panel',
    height: largo_panel,
    autoWidth: true,
    //width:1000,
    border: false,
    tabTip: 'Aqui puede ver, agregar, eliminar y restablecer modelos de columnas',
    monitorResize: true,
    layout: 'border',
    items: [crud_modelo_gridpanel, crud_modelo_formpanel],
    buttonAlign: 'left',
    renderTo: 'div_form_crud_modelo'
});

function crud_modelo_actualizar(text){

    if (crud_modelo_formpanel.getForm().isValid()) {
        subirDatos(crud_modelo_formpanel, getAbsoluteUrl('crud_modelo', 'actualizarModelo'), {
            mod_causa_actualizacion: text
        }, function(){
            crud_modelo_formpanel.getForm().reset();
            crud_modelo_datastore.reload();
        }, function(){
        });
    }
}

function crud_modelo_eliminar(){
    var cant_record = crud_modelo_gridpanel.getSelectionModel().getCount();
    
    if (cant_record > 0) {
        var record = crud_modelo_gridpanel.getSelectionModel().getSelected();
        if (record.get('mod_codigo') != '') {
        
            Ext.Msg.confirm('Eliminar modelo', "Realmente desea eliminar este modelo?", function(btn){
                if (btn == 'yes') {
                
                    Ext.Msg.prompt('Eliminar modelo', 'Digite la causa de la eliminaci&oacute;n de este modelo', function(btn2, text){
                        if (btn2 == 'ok') {
                            subirDatosAjax(getAbsoluteUrl('crud_modelo', 'eliminarModelo'), {
                                mod_codigo: record.get('mod_codigo'),
                                mod_causa_eliminacion: text
                            }, function(){
                                crud_modelo_datastore.reload();
                            });
                        }
                    });
                }
            });
        }
    }
    else {
        mostrarMensajeConfirmacion('Error', "Seleccione un modelo a eliminar");
    }
}

function crud_modelo_agregar(btn, ev){
    crud_modelo_formpanel.getForm().reset();
    Ext.getCmp('crud_modelo_actualizar_boton').setText('Guardar');
}


