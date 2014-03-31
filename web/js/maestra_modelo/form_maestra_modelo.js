//ayudas
var ayuda_maestra_mod_codigo='C&oacute;digo identificador en el sistema';
var ayuda_maestra_mod_nombre='Nombre modelo';
	
	var maestra_modelo_datastore = new Ext.data.Store({
        id: 'maestra_modelo_datastore',
        proxy: new Ext.data.HttpProxy({
                url: getAbsoluteUrl('maestra_modelo','listarModelo'),
                method: 'POST'
        }),
        baseParams:{start:0, limit:20}, 
        reader: new Ext.data.JsonReader({
                root: 'results',
                totalProperty: 'total',
                id: 'id'
                },[ 
			{name: 'maestra_mod_codigo', type: 'int'},
			{name: 'maestra_mod_nombre', type: 'string'},
			{name: 'maestra_mod_fecha_registro_sistema', type: 'string'},
			{name: 'maestra_mod_fecha_actualizacion',type: 'string'},
			{name: 'maestra_mod_usu_crea_nombre',type: 'string'},
			{name: 'maestra_mod_usu_actualiza_nombre',type: 'string'},
			{name: 'maestra_mod_causa_eliminacion',type: 'string'},
			{name: 'maestra_mod_causa_actualizacion',type: 'string'}
			])
        });
    maestra_modelo_datastore.load();
	

	var maestra_mod_codigo=new Ext.form.NumberField({
	   xtype: 'numberfield',
	   maxLength : 100,
	   name: 'maestra_mod_codigo',
	   id: 'maestra_mod_codigo',
	   fieldLabel: 'C&ooacute;digo evento',
	   listeners:
	   {
			'render': function() {
					ayuda('maestra_mod_codigo', ayuda_maestra_mod_codigo);
					}
	   }
	});
	

	var maestra_mod_nombre=new Ext.form.TextField({
	   xtype: 'textfield',
	   maxLength : 100,
	   name: 'maestra_mod_nombre',
	   id: 'maestra_mod_nombre',
	   fieldLabel: 'Nombre modelo',
	   allowBlank: false,
	   listeners:
	   {
			'render': function() {
					ayuda('maestra_mod_nombre', ayuda_maestra_mod_nombre);
					}
	   }
	});

	var maestra_modelo_colmodel = new Ext.grid.ColumnModel({
		defaults:{sortable: true, locked: false, resizable: true},
		columns:[
			{id: 'maestra_mod_codigo_column', header: "Id", width: 30, dataIndex: 'maestra_mod_codigo'},
			{ id: 'maestra_mod_nombre_column', header: "Nombre", width: 100, dataIndex: 'maestra_mod_nombre', editor:maestra_mod_nombre},
			{ header: "Creado por", width: 120, dataIndex: 'maestra_mod_usu_crea_nombre'},
			{ header: "Fecha de creaci&oacute;n", width: 120, dataIndex: 'maestra_mod_fecha_registro_sistema'},
			{ header: "Actualizado por", width: 120, dataIndex: 'maestra_mod_usu_actualiza_nombre'},
			{ header: "Fecha de actualizaci&oacute;n", width: 120, dataIndex: 'maestra_mod_fecha_actualizacion'},
			{ header: "Causa actualizaci&oacute;n", width: 120, dataIndex: 'maestra_mod_causa_actualizacion'},
			{ header: "Causa eliminaci&oacute;n", width: 120, dataIndex: 'maestra_mod_causa_eliminacion'}
		]
	});
	

	var maestra_modelo_roweditor = new Ext.ux.grid.RowEditor({
		saveText: 'Guardar',
		cancelText: 'Cancelar',
		showTooltip: function(msg){},
		listeners:
		{
			'afteredit': function(gr,obj,record,num){
				
				if(record.get('maestra_mod_codigo')!=''){
				
					Ext.Msg.prompt(
					'Modelo',
					'Digite la causa de la actualizaci&oacute;n de este modelo',
					function(btn, text,op){
							if (btn == 'ok') {
							maestra_modelo_actualizar(record,text);
							}
						}
					);
				}
				else{
					maestra_modelo_actualizar(record,'');
				}
			},
			'canceledit': function(){}
		}
	});

                
        //CREACION DE LA GRILLA
	var maestra_modelo_gridpanel = new Ext.grid.GridPanel({
		id: 'maestra_modelo_gridpanel',
		title:'Modelos de Columna',
		stripeRows:true,
		frame: true,
		ds: maestra_modelo_datastore,
		cm: maestra_modelo_colmodel,
		selModel: new Ext.grid.RowSelectionModel({
			singleSelect:true,	
			moveEditorOnEnter :false
		}),
		autoExpandColumn: 'maestra_mod_nombre_column',
		height: largo_panel,
		bbar: new Ext.PagingToolbar({
			pageSize: 20,
			store: maestra_modelo_datastore,
			displayInfo: true,
			displayMsg: 'Modelos de Columna {0} - {1} de {2}',
			emptyMsg: "No hay modelos de columna aun"
		}),
		tbar:
		[
			{	
				id:'maestra_modelo_agregar_boton',
				text:'Agregar',
				tooltip:'Agregar',
				iconCls:'agregar',
				handler:maestra_modelo_agregar
			},'-',
			{
				text:'Eliminar',
				tooltip:'Eliminar',
				iconCls:'eliminar',
				handler:maestra_modelo_eliminar
			},'-',{
				text:'',
				iconCls:'activos',
				tooltip:'Modelos activos',
				handler:function(){
					maestra_modelo_datastore.baseParams.mod_eliminado = '0';
					maestra_modelo_datastore.load({
						params: {
							start: 0,
							limit: 20
						}
					});
				}
			},{
				text:'',
				iconCls:'eliminados',
				tooltip:'Modelos eliminadas',
				handler:function(){
					maestra_modelo_datastore.baseParams.mod_eliminado = '1';
					maestra_modelo_datastore.load({
						params: {
							start: 0,
							limit: 20
						}
					});
				}
			},'-',{
				text:'Restablecer',
				iconCls:'restablece',
				tooltip:'Restablecer un modelo eliminado',
				handler:function(){
					 var cant_record = maestra_modelo_gridpanel.getSelectionModel().getCount();
			
					if(cant_record > 0){
					var record = maestra_modelo_gridpanel.getSelectionModel().getSelected();
						if (record.get('maestra_mod_codigo') != '') {
					
							Ext.Msg.prompt('Restablecer modelos', 
								'Digite la causa de restablecimiento', 
								function(btn, text){
									if (btn == 'ok')  {
										subirDatosAjax( 
											getAbsoluteUrl('maestra_modelo', 'restablecerModelo'), 
											{
											maestra_mod_codigo:record.get('maestra_mod_codigo'),
											maestra_mod_causa_restablece:text
											}, 
											function(){
												maestra_modelo_datastore.reload();
											}, 
											function(){}
										);
									}
								}
							);
						}
					}
					else {
						mostrarMensajeConfirmacion('Error', "Seleccione un modelo de columna eliminado");
					}
				}
			}
		],
		plugins:[maestra_modelo_roweditor,
		    new Ext.ux.grid.Search({
				mode:          'local',
				position:      top,
				searchText:    'Filtrar',
				iconCls:  'filtrar',
				selectAllText: 'Seleccionar todos',
				searchTipText: 'Escriba el texto que desea buscar y presione la tecla enter',
				width:         150
			})
		]
    });
	

	/*INTEGRACION AL CONTENEDOR*/
	var maestra_modelo_contenedor_panel = new Ext.Panel({
		id: 'maestra_modelo_contenedor_panel',
		height: largo_panel,
		autoWidth: true,
		border: false,
		tabTip :'Aqu&iacute puede ver, agregar, eliminar y restablecer modelos de columnas',
		monitorResize:true,
		items: 
		[
			maestra_modelo_gridpanel
		],
		renderTo:'div_form_maestra_modelo'
	});
	

	function maestra_modelo_actualizar(record,text){
	//	var record = maestra_modelo_gridpanel.getSelectionModel().getSelected();

		subirDatosAjax(
			getAbsoluteUrl('maestra_modelo','actualizarModelo'),
			{
				maestra_mod_codigo: record.get('maestra_mod_codigo'),
				maestra_mod_nombre: record.get('maestra_mod_nombre'),
				maestra_mod_causa_actualizacion: text
			},
			function(){
				maestra_modelo_datastore.reload(); 
			}
		);
	}
        
	function maestra_modelo_eliminar()
	{
		var cant_record = maestra_modelo_gridpanel.getSelectionModel().getCount();
		
		if(cant_record > 0){
			var record = maestra_modelo_gridpanel.getSelectionModel().getSelected();
			if(record.get('maestra_mod_codigo')!='')
			{
				Ext.Msg.confirm('Eliminar modelo', "Realmente desea eliminar este modelo?", function(btn){
					if (btn == 'yes') {
					
						Ext.Msg.prompt('Eliminar modelo', 
							'Digite la causa de la eliminaci&oacute;n de este modelo', 
							function(btn2, text){
								if (btn2 == 'ok') {
									subirDatosAjax(
										getAbsoluteUrl('maestra_modelo','eliminarModelo'),
										{
										maestra_mod_codigo:record.get('maestra_mod_codigo'),
										maestra_mod_causa_eliminacion:text
										},
										function(){
										maestra_modelo_datastore.reload(); 
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
			mostrarMensajeConfirmacion('Error',"Seleccione un modelo de columna a eliminar");
		}
	}

	function maestra_modelo_agregar(btn, ev) {
		var row = new maestra_modelo_gridpanel.store.recordType({
			maestra_mod_codigo : '',
			maestra_mod_nombre: ''
		});

		maestra_modelo_gridpanel.getSelectionModel().clearSelections();
		maestra_modelo_roweditor.stopEditing();
		maestra_modelo_gridpanel.store.insert(0, row);
		maestra_modelo_gridpanel.getSelectionModel().selectRow(0);
		maestra_modelo_roweditor.startEditing(0);
	}
	
