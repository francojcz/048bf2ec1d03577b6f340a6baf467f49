/*
Cambios: 24 de febrero de 2014
Interfaz para la eliminación de certificados de equipos registrados en la base de datos del sistema
*/
var largo_panel = 500;

var crud_certificado_datastore = new Ext.data.Store({
    id: 'crud_certificado_datastore',
    proxy: new Ext.data.HttpProxy({
        url: getAbsoluteUrl('crud_eliminarcertificado', 'listarCertificado'),
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
        name: 'com_nombre',
        type: 'string'
    }])
});
crud_certificado_datastore.load();

var crud_certificado_colmodel = new Ext.grid.ColumnModel({
    defaults: {
        sortable: true,
        locked: false,
        resizable: true
    },
    columns: [{
        header: "Nombre del Equipo",
        width: 1000,
        dataIndex: 'com_nombre'
    }]
});

var crud_certificado_gridpanel = new Ext.grid.GridPanel({
    id: 'crud_certificado_gridpanel',
    title: 'Computadores certificados registrados en el sistema',
    columnWidth: '.4',
    region: 'center',
    stripeRows: true,
    frame: true,
    ds: crud_certificado_datastore,
    cm: crud_certificado_colmodel,
    selModel: new Ext.grid.RowSelectionModel({
        singleSelect: true
    }),
    height: largo_panel,
    bbar: new Ext.PagingToolbar({
        pageSize: 15,
        store: crud_certificado_datastore,
        displayInfo: true,
        displayMsg: 'Computadores {0} - {1} de {2}',
        emptyMsg: "No hay computadores certificados aun"
    }),
    tbar: [{
        text: 'Eliminar computador',
        tooltip: 'Eliminar',
        iconCls: 'eliminar',
        handler: crud_certificado_eliminar
    }]
});

/*INTEGRACION AL CONTENEDOR*/
var crud_certificado_contenedor_panel = new Ext.Panel({
    id: 'crud_certificado_contenedor_panel',
    height: largo_panel,
    autoWidth: true,
    //width:1000,
    border: false,
    frame: true,
    tabTip: 'Aqui puedes eliminar certificados de computadores',
    monitorResize: true,
//    layout: 'border',
    items: [crud_certificado_gridpanel],
    buttonAlign: 'left',
    renderTo: 'div_form_crud_eliminarcertificado'
});

function crud_certificado_eliminar(){
    var cant_record = crud_certificado_gridpanel.getSelectionModel().getCount();
    
    if (cant_record > 0) {
        var record = crud_certificado_gridpanel.getSelectionModel().getSelected();
        if (record.get('com_nombre') != '') {        
            Ext.Msg.confirm('Eliminar computador', "Realmente desea eliminar este computador?", function(btn){
                if (btn == 'yes') {                
                    subirDatosAjax(getAbsoluteUrl('crud_eliminarcertificado', 'eliminarCertificado'), {
                        com_nombre: record.get('com_nombre')
                    }, function(){
                        crud_certificado_datastore.reload();
                    });
                }
            });
        }
    }
    else {
        mostrarMensajeConfirmacion('Error', "Seleccione el nombre del computador a eliminar");
    }
}