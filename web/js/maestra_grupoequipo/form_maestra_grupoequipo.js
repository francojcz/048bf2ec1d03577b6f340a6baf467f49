var ayuda_maestra_gru_codigo='C&oacute;digo identificador en el sistema';
var ayuda_maestra_gru_nombre='Nombre grupo equipos';
var largo_panel = 500;

var maestra_grupo_datastore = new Ext.data.Store({
id: 'maestra_grupo_datastore',
proxy: new Ext.data.HttpProxy({
        url: getAbsoluteUrl('maestra_grupoequipo','listarGrupo'),
        method: 'POST'
}),
baseParams:{start:0, limit:20}, 
reader: new Ext.data.JsonReader({
        root: 'results',
        totalProperty: 'total',
        id: 'id'
        },[ 
                {name: 'maestra_gru_codigo', type: 'int'},
                {name: 'maestra_gru_nombre', type: 'string'},
                {name: 'maestra_gru_fecha_registro_sistema', type: 'string'},
                {name: 'maestra_gru_fecha_actualizacion',type: 'string'},
                {name: 'maestra_gru_usu_crea_nombre',type: 'string'},
                {name: 'maestra_gru_usu_actualiza_nombre',type: 'string'},
                {name: 'maestra_gru_causa_eliminacion',type: 'string'},
                {name: 'maestra_gru_causa_actualizacion',type: 'string'}
                ])
});
maestra_grupo_datastore.load();


var maestra_gru_codigo=new Ext.form.NumberField({
   xtype: 'numberfield',
   maxLength : 100,
   name: 'maestra_gru_codigo',
   id: 'maestra_gru_codigo',
   fieldLabel: 'C&ooacute;digo grupo',
   listeners:
   {
    'render': function() {
            ayuda('maestra_gru_codigo', ayuda_maestra_gru_codigo);
    }
   }
});


var maestra_gru_nombre=new Ext.form.TextField({
   xtype: 'textfield',
   maxLength : 100,
   name: 'maestra_gru_nombre',
   id: 'maestra_gru_nombre',
   fieldLabel: 'Nombre grupo',
   allowBlank: false,
   listeners:
   {
    'render': function() {
            ayuda('maestra_gru_nombre', ayuda_maestra_gru_nombre);
    }
   }
});

var maestra_grupo_colmodel = new Ext.grid.ColumnModel({
        defaults:{sortable: true, locked: false, resizable: true},
        columns:[
                { id: 'maestra_gru_codigo_column', header: "Id", width: 30, dataIndex: 'maestra_gru_codigo'},
                { id: 'maestra_gru_nombre_column', header: "Nombre", width: 100, dataIndex: 'maestra_gru_nombre', editor:maestra_gru_nombre},
                { header: "Creado por", width: 120, dataIndex: 'maestra_gru_usu_crea_nombre'},
                { header: "Fecha de creaci&oacute;n", width: 120, dataIndex: 'maestra_gru_fecha_registro_sistema'},
                { header: "Actualizado por", width: 120, dataIndex: 'maestra_gru_usu_actualiza_nombre'},
                { header: "Fecha de actualizaci&oacute;n", width: 120, dataIndex: 'maestra_gru_fecha_actualizacion'},
                { header: "Causa actualizaci&oacute;n", width: 120, dataIndex: 'maestra_gru_causa_actualizacion'},
                { header: "Causa eliminaci&oacute;n", width: 120, dataIndex: 'maestra_gru_causa_eliminacion'}
        ]
});


var maestra_grupo_roweditor = new Ext.ux.grid.RowEditor({
        saveText: 'Guardar',
        cancelText: 'Cancelar',
        showTooltip: function(msg){},
        listeners:
        {
                'afteredit': function(gr,obj,record,num){

                        if(record.get('maestra_gru_codigo')!=''){

                                Ext.Msg.prompt(
                                'Grupo',
                                'Digite la causa de la actualizaci&oacute;n de este grupo',
                                function(btn, text,op){
                                                if (btn == 'ok') {
                                                maestra_grupo_actualizar(record,text);
                                                }
                                        }
                                );
                        }
                        else{
                                maestra_grupo_actualizar(record,'');
                        }
                },
                'canceledit': function(){}
        }
});

//CREACION DE LA GRILLA

var maestra_grupo_gridpanel = new Ext.grid.GridPanel({
        id: 'maestra_grupo_gridpanel',
        title:'Grupos de Equipos',
        stripeRows:true,
        region:'center',
        frame: true,
        ds: maestra_grupo_datastore,
        cm: maestra_grupo_colmodel,
        selModel: new Ext.grid.RowSelectionModel({
                singleSelect: true,
                moveEditorOnEnter :false,
                listeners: {
                        rowselect: function(sm, row, rec){
                                maestra_grupo_codigo.setValue(rec.data.maestra_gru_codigo);
                                maestra_grupo_nombre.setValue(rec.data.maestra_gru_nombre);
                                maestra_grupoporequipo_datastore.load({params:{maestra_gru_codigo:rec.data.maestra_gru_codigo}});
                        }
                }
        }),
        autoExpandColumn: 'maestra_gru_nombre_column',
        autoExpandMin :180,
        height: largo_panel,
        bbar: new Ext.PagingToolbar({
                pageSize: 20,
                store: maestra_grupo_datastore,
                displayInfo: true,
                displayMsg: 'Grupos {0} - {1} de {2}',
                emptyMsg: "No hay grupos aun"
        }),
        tbar:
        [
                {	
                        id:'maestra_grupo_agregar_boton',
                        text:'Agregar',
                        tooltip:'Agregar',
                        iconCls:'agregar',
                        handler:maestra_grupo_agregar
                },'-',
                {
                        text:'Eliminar',
                        tooltip:'Eliminar',
                        iconCls:'eliminar',
                        handler:maestra_grupo_eliminar
                },'-',{
                        text:'',
                        iconCls:'activos',
                        tooltip:'Grupos activos',
                        handler:function(){
                                maestra_grupo_datastore.baseParams.gru_eliminado = '0';
                                maestra_grupo_datastore.load({
                                        params: {
                                                start: 0,
                                                limit: 20
                                        }
                                });
                        }
                },{
                        text:'',
                        iconCls:'eliminados',
                        tooltip:'Grupos eliminados',
                        handler:function(){
                                maestra_grupo_datastore.baseParams.gru_eliminado = '1';
                                maestra_grupo_datastore.load({
                                        params: {
                                                start: 0,
                                                limit: 20
                                        }
                                });
                        }
                },'-',{
                        text:'Restablecer',
                        iconCls:'restablece',
                        tooltip:'Restablecer un grupo eliminado',
                        handler:function(){
                                 var cant_record = maestra_grupo_gridpanel.getSelectionModel().getCount();

                                if(cant_record > 0){
                                var record = maestra_grupo_gridpanel.getSelectionModel().getSelected();
                                        if (record.get('maestra_gru_codigo') != '') {

                                                Ext.Msg.prompt('Restablecer grupo', 
                                                        'Digite la causa de restablecimiento', 
                                                        function(btn, text){
                                                                if (btn == 'ok')  {
                                                                        subirDatosAjax( 
                                                                                getAbsoluteUrl('maestra_grupoequipo', 'restablecerGrupo'), 
                                                                                {
                                                                                maestra_gru_codigo:record.get('maestra_gru_codigo'),
                                                                                maestra_gru_causa_restablece:text
                                                                                }, 
                                                                                function(){
                                                                                        maestra_grupo_datastore.reload();
                                                                                }, 
                                                                                function(){}
                                                                        );
                                                                }
                                                        }
                                                );
                                        }
                                }
                                else {
                                        mostrarMensajeConfirmacion('Error', "Seleccione un grupo eliminado");
                                }
                        }
                }
        ],
        plugins:[maestra_grupo_roweditor,
            new Ext.ux.grid.Search({
                        mode:          'local',
                        position:      top,
                        searchText:    'Filtrar',
                        iconCls:  'filtrar',
                        selectAllText: 'Seleccionar todos',
                        searchTipText: 'Escriba el texto que desea buscar y presione la tecla enter',
                        width:         100
                })
        ]
});


var maestra_grupoporequipo_datastore = new Ext.data.Store({
id: 'maestra_grupoporequipo_datastore',
proxy: new Ext.data.HttpProxy({
        url: getAbsoluteUrl('maestra_grupoequipo','listarEquiposporgrupo'),
        method: 'POST'
}),
reader: new Ext.data.JsonReader({
        root: 'results',
        totalProperty: 'total',
        id: 'id'
        },[ 
            {name: 'maestra_greq_maq_codigo', type: 'int'},
            {name: 'maestra_greq_maq_nombre', type: 'string'},
            {name: 'maestra_greq_maq_pertenece', type: 'bool'}
        ])
});

var maestra_grupoporequipo_pertenece_selmodel = new Ext.grid.CheckboxSelectionModel({
        singleSelect:true,	
        listeners: {
                rowselect: function(sm, row, rec) {
                }
        }
});

var maestra_grupoporequipo_colmodel = new Ext.grid.ColumnModel({
        defaults:{sortable: true, locked: false, resizable: true},
        columns:[
                maestra_grupoporequipo_pertenece_selmodel,
                { header: "Id", width: 30, dataIndex: 'maestra_greq_maq_codigo',hidden:true},
                { header: "Nombre", width: 300, dataIndex: 'maestra_greq_maq_nombre'}
        ]
});

//CREACION DE LA GRILLA DE EQUIPOS
var maestra_grupoporequipo_maq_datastore = new Ext.data.JsonStore({
        id: 'maestra_grupoporequipo_maq_datastore',
        url: getAbsoluteUrl('maestra_grupoequipo', 'listarMaquinas'),
        root: 'results',
        totalProperty: 'total',
        fields: [
                {name: 'maq_codigo', type: 'int'}, 
                {name: 'maq_nombre', type: 'string'}
        ],
        sortInfo: {
                field: 'maq_nombre',
                direction: 'ASC'
        }
});
maestra_grupoporequipo_maq_datastore.load();


var maestra_grupoporequipo_maq_codigo = new Ext.form.ComboBox({
        xtype: 'combo',
        store: maestra_grupoporequipo_maq_datastore,
        hiddenName: 'maq_codigo',
        name: 'greq_maq_codigo',
        mode: 'local',
        valueField: 'maq_codigo',
        forceSelection: true,
        displayField: 'maq_nombre',
        triggerAction: 'all',
        emptyText: 'Seleccione un equipo',
        selectOnFocus: true,
        fieldLabel: 'Equipo',
        listeners: {
                focus : function(){
                        maestra_grupoporequipo_maq_datastore.reload();
                } 
        }
});

var maestra_grupoporequipo_gridpanel = new Ext.grid.GridPanel({
        id: 'maestra_grupoporequipo_gridpanel',
        title:'Equipos',
        stripeRows:true,
        frame: true,
        ds: maestra_grupoporequipo_datastore,
        cm: maestra_grupoporequipo_colmodel,
        sm: maestra_grupoporequipo_pertenece_selmodel,
        height: 395,
        tbar:[maestra_grupoporequipo_maq_codigo,                
            {text:'Agregar equipo',iconCls:'agregar',
                    handler:function(){

                            if(maestra_grupoporequipo_maq_codigo.getValue()!='' && maestra_grupo_codigo.getValue()!='' ){
                                    subirDatosAjax(
                                            getAbsoluteUrl('maestra_grupoequipo', 'guardarGrupoPorEquipo'),
                                            {
                                                    maq_codigo: maestra_grupoporequipo_maq_codigo.getValue(),
                                                    gru_codigo: maestra_grupo_codigo.getValue() 
                                            }, 
                                            function(){
                                                    maestra_grupoporequipo_datastore.reload();
                                            },
                                            function(){}
                                    );
                            }
                    }
            }
        ],
        bbar:[
                {text:'Quitar equipo',iconCls:'eliminar',
                        handler:function(){
                                var equiposSelecionados = maestra_grupoporequipo_gridpanel.selModel.getSelections();
                                var equiposEliminar = [];
                                for(i = 0; i< maestra_grupoporequipo_gridpanel.selModel.getCount(); i++){
                                        equiposEliminar.push(equiposSelecionados[i].json.maestra_greq_maq_codigo);
                                }
                                var encoded_array_equipos = Ext.encode(equiposEliminar);

                                if(maestra_grupo_codigo.getValue()!='' ){
                                        subirDatosAjax(
                                                getAbsoluteUrl('maestra_grupoequipo', 'eliminarGrupoPorEquipo'),
                                                {
                                                        maqs_codigos: encoded_array_equipos,
                                                        gru_codigo: maestra_grupo_codigo.getValue() 
                                                }, 
                                                function(){
                                                        maestra_grupoporequipo_datastore.reload();
                                                },
                                                function(){}
                                        );
                                }				
                        }
                }
        ]
});


var maestra_grupo_codigo=new Ext.form.NumberField({
   xtype: 'numberfield',
   readOnly:true,
   anchor:'100%',
   name: 'maestra_grupo_codigo',
   id: 'maestra_grupo_codigo',
   fieldLabel: 'C&oacute;digo grupo'
});


var maestra_grupo_nombre=new Ext.form.TextField({
   xtype: 'textfield',
   readOnly:true,
   anchor:'100%',
   name: 'maestra_grupo_nombre',
   id: 'maestra_grupo_nombre',
   fieldLabel: 'Nombre grupo'
});

var maestra_grupo_panel=new Ext.FormPanel({
        title:'Grupo detalle',
        region:'east',
        frame:true,
        padding:10,
        width:400,
        split:true,
        collapsible:true,
        items:[
                maestra_grupo_codigo,
                maestra_grupo_nombre,
                maestra_grupoporequipo_gridpanel
        ]
});

/*INTEGRACION AL CONTENEDOR*/
var maestra_grupo_contenedor_panel = new Ext.Panel({
        id: 'maestra_grupo_contenedor_panel',
        height: largo_panel,
        autoWidth: true,
        border: false,
        tabTip :'Aqu&iacute; puede ver, agregar y eliminar grupo de equipos',
        monitorResize:true,
        layout:'border',
        items: 
        [
                maestra_grupo_gridpanel,
                maestra_grupo_panel
        ],
        renderTo:'div_form_maestra_grupo'
});


function maestra_grupo_actualizar(record,text){
        subirDatosAjax(
                getAbsoluteUrl('maestra_grupoequipo','actualizarGrupo'),
                {
                        maestra_gru_codigo: record.get('maestra_gru_codigo'),
                        maestra_gru_nombre: record.get('maestra_gru_nombre'),
                        maestra_gru_causa_actualizacion: text
                },
                function(){
                        maestra_grupo_datastore.reload(); 
                }
        );
}

function maestra_grupo_eliminar()
{
        var cant_record = maestra_grupo_gridpanel.getSelectionModel().getCount();

        if(cant_record > 0){
                var record = maestra_grupo_gridpanel.getSelectionModel().getSelected();
                if(record.get('maestra_gru_codigo')!='')
                {

                Ext.Msg.confirm('Eliminar grupo', "Realmente desea eliminar este grupo?", function(btn){
                                if (btn == 'yes') {

                                        Ext.Msg.prompt('Eliminar grupo', 
                                                'Digite la causa de la eliminaci&oacute;n de este grupo', 
                                                function(btn2, text){
                                                        if (btn2 == 'ok') {
                                                                subirDatosAjax(
                                                                        getAbsoluteUrl('maestra_grupoequipo','eliminarGrupo'),
                                                                        {
                                                                        maestra_gru_codigo:record.get('maestra_gru_codigo'),
                                                                        maestra_gru_causa_eliminacion:text
                                                                        },
                                                                        function(){
                                                                        maestra_grupo_datastore.reload(); 
                                                                        }
                                                                );
                                                        }
                                                }
                                        );
                                }
                        });
                }
        }
        else{
                mostrarMensajeConfirmacion('Error',"Seleccione un grupo a eliminar");
        }
}

function maestra_grupo_agregar(btn, ev) {
        var row = new maestra_grupo_gridpanel.store.recordType({
                maestra_gru_codigo : '',
                maestra_gru_nombre: ''
        });

        maestra_grupo_gridpanel.getSelectionModel().clearSelections();
        maestra_grupo_roweditor.stopEditing();
        maestra_grupo_gridpanel.store.insert(0, row);
        maestra_grupo_gridpanel.getSelectionModel().selectRow(0);
        maestra_grupo_roweditor.startEditing(0);
}

