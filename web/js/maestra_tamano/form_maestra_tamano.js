//ayudas
var ayuda_maestra_tam_codigo='C&oacute;digo identificador en el sistema';
var ayuda_maestra_tam_nombre='Tama&ntilde;o de Part&iacute;cula';
	
	var maestra_tamano_datastore = new Ext.data.Store({
        id: 'maestra_tamano_datastore',
        proxy: new Ext.data.HttpProxy({
                url: getAbsoluteUrl('maestra_tamano','listarTamano'),
                method: 'POST'
        }),
        baseParams:{start:0, limit:20}, 
        reader: new Ext.data.JsonReader({
                root: 'results',
                totalProperty: 'total',
                id: 'id'
                },[ 
			{name: 'maestra_tam_codigo', type: 'int'},
			{name: 'maestra_tam_nombre', type: 'string'},
			{name: 'maestra_tam_fecha_registro_sistema', type: 'string'},
			{name: 'maestra_tam_fecha_actualizacion',type: 'string'},
			{name: 'maestra_tam_usu_crea_nombre',type: 'string'},
			{name: 'maestra_tam_usu_actualiza_nombre',type: 'string'},
			{name: 'maestra_tam_causa_eliminacion',type: 'string'},
			{name: 'maestra_tam_causa_actualizacion',type: 'string'}
			])
        });
    maestra_tamano_datastore.load();
	

	var maestra_tam_codigo=new Ext.form.NumberField({
	   xtype: 'numberfield',
	   maxLength : 100,
	   name: 'maestra_tam_codigo',
	   id: 'maestra_tam_codigo',
	   fieldLabel: 'C&ooacute;digo evento',
	   listeners:
	   {
			'render': function() {
					ayuda('maestra_tam_codigo', ayuda_maestra_tam_codigo);
					}
	   }
	});
	

	var maestra_tam_nombre=new Ext.form.TextField({
	   xtype: 'textfield',
	   maxLength : 100,
	   name: 'maestra_tam_nombre',
	   id: 'maestra_tam_nombre',
	   fieldLabel: 'Tama&ntilde;o de Part&iacute;cula (μm)',
	   allowBlank: false,
	   listeners:
	   {
			'render': function() {
					ayuda('maestra_tam_nombre', ayuda_maestra_tam_nombre);
					}
	   }
	});

	var maestra_tamano_colmodel = new Ext.grid.ColumnModel({
		defaults:{sortable: true, locked: false, resizable: true},
		columns:[
			{id: 'maestra_tam_codigo_column', header: "Id", width: 30, dataIndex: 'maestra_tam_codigo'},
			{ id: 'maestra_tam_nombre_column', header: "Tama&ntilde;o de Part&iacute;cula (μm)", width: 100, dataIndex: 'maestra_tam_nombre', editor:maestra_tam_nombre},
			{ header: "Creado por", width: 120, dataIndex: 'maestra_tam_usu_crea_nombre'},
			{ header: "Fecha de creaci&oacute;n", width: 120, dataIndex: 'maestra_tam_fecha_registro_sistema'},
			{ header: "Actualizado por", width: 120, dataIndex: 'maestra_tam_usu_actualiza_nombre'},
			{ header: "Fecha de actualizaci&oacute;n", width: 120, dataIndex: 'maestra_tam_fecha_actualizacion'},
			{ header: "Causa actualizaci&oacute;n", width: 120, dataIndex: 'maestra_tam_causa_actualizacion'},
			{ header: "Causa eliminaci&oacute;n", width: 120, dataIndex: 'maestra_tam_causa_eliminacion'}
		]
	});
	

	var maestra_tamano_roweditor = new Ext.ux.grid.RowEditor({
		saveText: 'Guardar',
		cancelText: 'Cancelar',
		showTooltip: function(msg){},
		listeners:
		{
			'afteredit': function(gr,obj,record,num){
				
				if(record.get('maestra_tam_codigo')!=''){
				
					Ext.Msg.prompt(
					'Tama&ntilde;o de Part&iacute;cula',
					'Digite la causa de la actualizaci&oacute;n de este tama&ntilde;o',
					function(btn, text,op){
							if (btn == 'ok') {
							maestra_tamano_actualizar(record,text);
							}
						}
					);
				}
				else{
					maestra_tamano_actualizar(record,'');
				}
			},
			'canceledit': function(){}
		}
	});

                
        //CREACION DE LA GRILLA
	var maestra_tamano_gridpanel = new Ext.grid.GridPanel({
		id: 'maestra_tamano_gridpanel',
		title:'Tama&ntilde;os de Part&iacute;cula',
		stripeRows:true,
		frame: true,
		ds: maestra_tamano_datastore,
		cm: maestra_tamano_colmodel,
		selModel: new Ext.grid.RowSelectionModel({
			singleSelect:true,	
			moveEditorOnEnter :false
		}),
		autoExpandColumn: 'maestra_tam_nombre_column',
		height: largo_panel,
		bbar: new Ext.PagingToolbar({
			pageSize: 20,
			store: maestra_tamano_datastore,
			displayInfo: true,
			displayMsg: 'Tama&ntilde;o de Part&iacute;cula {0} - {1} de {2}',
			emptyMsg: "No hay tama&ntilde;os de part&iacute;cula aun"
		}),
		tbar:
		[
			{	
				id:'maestra_tamano_agregar_boton',
				text:'Agregar',
				tooltip:'Agregar',
				iconCls:'agregar',
				handler:maestra_tamano_agregar
			},'-',
			{
				text:'Eliminar',
				tooltip:'Eliminar',
				iconCls:'eliminar',
				handler:maestra_tamano_eliminar
			},'-',{
				text:'',
				iconCls:'activos',
				tooltip:'Tama&ntilde;os activos',
				handler:function(){
					maestra_tamano_datastore.baseParams.tam_eliminado = '0';
					maestra_tamano_datastore.load({
						params: {
							start: 0,
							limit: 20
						}
					});
				}
			},{
				text:'',
				iconCls:'eliminados',
				tooltip:'Tama&ntilde;os eliminados',
				handler:function(){
					maestra_tamano_datastore.baseParams.tam_eliminado = '1';
					maestra_tamano_datastore.load({
						params: {
							start: 0,
							limit: 20
						}
					});
				}
			},'-',{
				text:'Restablecer',
				iconCls:'restablece',
				tooltip:'Restablecer un tama&ntilde;o eliminado',
				handler:function(){
					 var cant_record = maestra_tamano_gridpanel.getSelectionModel().getCount();
			
					if(cant_record > 0){
					var record = maestra_tamano_gridpanel.getSelectionModel().getSelected();
						if (record.get('maestra_tam_codigo') != '') {
					
							Ext.Msg.prompt('Restablecer tama&ntilde;os', 
								'Digite la causa de restablecimiento', 
								function(btn, text){
									if (btn == 'ok')  {
										subirDatosAjax( 
											getAbsoluteUrl('maestra_tamano', 'restablecerTamano'), 
											{
											maestra_tam_codigo:record.get('maestra_tam_codigo'),
											maestra_tam_causa_restablece:text
											}, 
											function(){
												maestra_tamano_datastore.reload();
											}, 
											function(){}
										);
									}
								}
							);
						}
					}
					else {
						mostrarMensajeConfirmacion('Error', "Seleccione un tama&ntilde;o de part&iacute;cula eliminada");
					}
				}
			}
		],
		plugins:[maestra_tamano_roweditor,
		    new Ext.ux.grid.Search({
				mode:          'local',
				position:      top,
				searchText:    'Filtrar',
				iconCls:  'filtrar',
				selectAllText: 'Seleccionar todos',
				searchTipText: 'Escriba el texto que desea buscar y presione la tecla enter',
				width:         300
			})
		]
    });
	

	/*INTEGRACION AL CONTENEDOR*/
	var maestra_tamano_contenedor_panel = new Ext.Panel({
		id: 'maestra_tamano_contenedor_panel',
		height: largo_panel,
		autoWidth: true,
		border: false,
		tabTip :'Aqu&iacute puede ver, agregar, eliminar y restablecer tama&ntilde;os de part&iacute;culas',
		monitorResize:true,
		items: 
		[
			maestra_tamano_gridpanel
		],
		renderTo:'div_form_maestra_tamano'
	});
	

	function maestra_tamano_actualizar(record,text){
	//	var record = maestra_tamano_gridpanel.getSelectionModel().getSelected();

		subirDatosAjax(
			getAbsoluteUrl('maestra_tamano','actualizarTamano'),
			{
				maestra_tam_codigo: record.get('maestra_tam_codigo'),
				maestra_tam_nombre: record.get('maestra_tam_nombre'),
				maestra_tam_causa_actualizacion: text
			},
			function(){
				maestra_tamano_datastore.reload(); 
			}
		);
	}
        
	function maestra_tamano_eliminar()
	{
		var cant_record = maestra_tamano_gridpanel.getSelectionModel().getCount();
		
		if(cant_record > 0){
			var record = maestra_tamano_gridpanel.getSelectionModel().getSelected();
			if(record.get('maestra_tam_codigo')!='')
			{
				Ext.Msg.confirm('Eliminar tama&ntilde;o', "Realmente desea eliminar este tama&ntilde;o?", function(btn){
					if (btn == 'yes') {
					
						Ext.Msg.prompt('Eliminar tama&ntilde;o', 
							'Digite la causa de la eliminaci&oacute;n de este tama&ntilde;o', 
							function(btn2, text){
								if (btn2 == 'ok') {
									subirDatosAjax(
										getAbsoluteUrl('maestra_tamano','eliminarTamano'),
										{
										maestra_tam_codigo:record.get('maestra_tam_codigo'),
										maestra_tam_causa_eliminacion:text
										},
										function(){
										maestra_tamano_datastore.reload(); 
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
			mostrarMensajeConfirmacion('Error',"Seleccione un tama&ntilde;o de part&iacute;cula a eliminar");
		}
	}

	function maestra_tamano_agregar(btn, ev) {
		var row = new maestra_tamano_gridpanel.store.recordType({
			maestra_tam_codigo : '',
			maestra_tam_nombre: ''
		});

		maestra_tamano_gridpanel.getSelectionModel().clearSelections();
		maestra_tamano_roweditor.stopEditing();
		maestra_tamano_gridpanel.store.insert(0, row);
		maestra_tamano_gridpanel.getSelectionModel().selectRow(0);
		maestra_tamano_roweditor.startEditing(0);
	}
	
