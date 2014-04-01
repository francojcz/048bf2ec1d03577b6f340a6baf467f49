//ayudas
var ayuda_maestra_mar_codigo='C&oacute;digo identificador en el sistema';
var ayuda_maestra_mar_nombre='Nombre marca';
	
	var maestra_marca_datastore = new Ext.data.Store({
        id: 'maestra_marca_datastore',
        proxy: new Ext.data.HttpProxy({
                url: getAbsoluteUrl('maestra_marca','listarMarca'),
                method: 'POST'
        }),
        baseParams:{start:0, limit:20}, 
        reader: new Ext.data.JsonReader({
                root: 'results',
                totalProperty: 'total',
                id: 'id'
                },[ 
			{name: 'maestra_mar_codigo', type: 'int'},
			{name: 'maestra_mar_nombre', type: 'string'},
			{name: 'maestra_mar_fecha_registro_sistema', type: 'string'},
			{name: 'maestra_mar_fecha_actualizacion',type: 'string'},
			{name: 'maestra_mar_usu_crea_nombre',type: 'string'},
			{name: 'maestra_mar_usu_actualiza_nombre',type: 'string'},
			{name: 'maestra_mar_causa_eliminacion',type: 'string'},
			{name: 'maestra_mar_causa_actualizacion',type: 'string'}
			])
        });
    maestra_marca_datastore.load();
	

	var maestra_mar_codigo=new Ext.form.NumberField({
	   xtype: 'numberfield',
	   maxLength : 100,
	   name: 'maestra_mar_codigo',
	   id: 'maestra_mar_codigo',
	   fieldLabel: 'C&ooacute;digo evento',
	   listeners:
	   {
			'render': function() {
					ayuda('maestra_mar_codigo', ayuda_maestra_mar_codigo);
					}
	   }
	});
	

	var maestra_mar_nombre=new Ext.form.TextField({
	   xtype: 'textfield',
	   maxLength : 100,
	   name: 'maestra_mar_nombre',
	   id: 'maestra_mar_nombre',
	   fieldLabel: 'Nombre marca',
	   allowBlank: false,
	   listeners:
	   {
			'render': function() {
					ayuda('maestra_mar_nombre', ayuda_maestra_mar_nombre);
					}
	   }
	});

	var maestra_marca_colmodel = new Ext.grid.ColumnModel({
		defaults:{sortable: true, locked: false, resizable: true},
		columns:[
			{id: 'maestra_mar_codigo_column', header: "Id", width: 30, dataIndex: 'maestra_mar_codigo'},
			{ id: 'maestra_mar_nombre_column', header: "Nombre", width: 100, dataIndex: 'maestra_mar_nombre', editor:maestra_mar_nombre},
			{ header: "Creado por", width: 120, dataIndex: 'maestra_mar_usu_crea_nombre'},
			{ header: "Fecha de creaci&oacute;n", width: 120, dataIndex: 'maestra_mar_fecha_registro_sistema'},
			{ header: "Actualizado por", width: 120, dataIndex: 'maestra_mar_usu_actualiza_nombre'},
			{ header: "Fecha de actualizaci&oacute;n", width: 120, dataIndex: 'maestra_mar_fecha_actualizacion'},
			{ header: "Causa actualizaci&oacute;n", width: 120, dataIndex: 'maestra_mar_causa_actualizacion'},
			{ header: "Causa eliminaci&oacute;n", width: 120, dataIndex: 'maestra_mar_causa_eliminacion'}
		]
	});
	

	var maestra_marca_roweditor = new Ext.ux.grid.RowEditor({
		saveText: 'Guardar',
		cancelText: 'Cancelar',
		showTooltip: function(msg){},
		listeners:
		{
			'afteredit': function(gr,obj,record,num){
				
				if(record.get('maestra_mar_codigo')!=''){
				
					Ext.Msg.prompt(
					'Marca',
					'Digite la causa de la actualizaci&oacute;n de esta marca',
					function(btn, text,op){
							if (btn == 'ok') {
							maestra_marca_actualizar(record,text);
							}
						}
					);
				}
				else{
					maestra_marca_actualizar(record,'');
				}
			},
			'canceledit': function(){}
		}
	});

                
        //CREACION DE LA GRILLA
	var maestra_marca_gridpanel = new Ext.grid.GridPanel({
		id: 'maestra_marca_gridpanel',
		title:'Marcas de Columna',
		stripeRows:true,
		frame: true,
		ds: maestra_marca_datastore,
		cm: maestra_marca_colmodel,
		selModel: new Ext.grid.RowSelectionModel({
			singleSelect:true,	
			moveEditorOnEnter :false
		}),
		autoExpandColumn: 'maestra_mar_nombre_column',
		height: largo_panel,
		bbar: new Ext.PagingToolbar({
			pageSize: 20,
			store: maestra_marca_datastore,
			displayInfo: true,
			displayMsg: 'Marcas de Columna {0} - {1} de {2}',
			emptyMsg: "No hay marcas de columna aun"
		}),
		tbar:
		[
			{	
				id:'maestra_marca_agregar_boton',
				text:'Agregar',
				tooltip:'Agregar',
				iconCls:'agregar',
				handler:maestra_marca_agregar
			},'-',
			{
				text:'Eliminar',
				tooltip:'Eliminar',
				iconCls:'eliminar',
				handler:maestra_marca_eliminar
			},'-',{
				text:'',
				iconCls:'activos',
				tooltip:'Marcas activas',
				handler:function(){
					maestra_marca_datastore.baseParams.mar_eliminado = '0';
					maestra_marca_datastore.load({
						params: {
							start: 0,
							limit: 20
						}
					});
				}
			},{
				text:'',
				iconCls:'eliminados',
				tooltip:'Marcas eliminadas',
				handler:function(){
					maestra_marca_datastore.baseParams.mar_eliminado = '1';
					maestra_marca_datastore.load({
						params: {
							start: 0,
							limit: 20
						}
					});
				}
			},'-',{
				text:'Restablecer',
				iconCls:'restablece',
				tooltip:'Restablecer una marca eliminada',
				handler:function(){
					 var cant_record = maestra_marca_gridpanel.getSelectionModel().getCount();
			
					if(cant_record > 0){
					var record = maestra_marca_gridpanel.getSelectionModel().getSelected();
						if (record.get('maestra_mar_codigo') != '') {
					
							Ext.Msg.prompt('Restablecer marcas', 
								'Digite la causa de restablecimiento', 
								function(btn, text){
									if (btn == 'ok')  {
										subirDatosAjax( 
											getAbsoluteUrl('maestra_marca', 'restablecerMarca'), 
											{
											maestra_mar_codigo:record.get('maestra_mar_codigo'),
											maestra_mar_causa_restablece:text
											}, 
											function(){
												maestra_marca_datastore.reload();
											}, 
											function(){}
										);
									}
								}
							);
						}
					}
					else {
						mostrarMensajeConfirmacion('Error', "Seleccione una marca de columna eliminada");
					}
				}
			}
		],
		plugins:[maestra_marca_roweditor,
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
	var maestra_marca_contenedor_panel = new Ext.Panel({
		id: 'maestra_marca_contenedor_panel',
		height: largo_panel,
		autoWidth: true,
		border: false,
		tabTip :'Aqu&iacute puede ver, agregar, eliminar y restablecer marcas de columnas',
		monitorResize:true,
		items: 
		[
			maestra_marca_gridpanel
		],
		renderTo:'div_form_maestra_marca'
	});
	

	function maestra_marca_actualizar(record,text){
	//	var record = maestra_marca_gridpanel.getSelectionModel().getSelected();

		subirDatosAjax(
			getAbsoluteUrl('maestra_marca','actualizarMarca'),
			{
				maestra_mar_codigo: record.get('maestra_mar_codigo'),
				maestra_mar_nombre: record.get('maestra_mar_nombre'),
				maestra_mar_causa_actualizacion: text
			},
			function(){
				maestra_marca_datastore.reload(); 
			}
		);
	}
        
	function maestra_marca_eliminar()
	{
		var cant_record = maestra_marca_gridpanel.getSelectionModel().getCount();
		
		if(cant_record > 0){
			var record = maestra_marca_gridpanel.getSelectionModel().getSelected();
			if(record.get('maestra_mar_codigo')!='')
			{
				Ext.Msg.confirm('Eliminar marca', "Realmente desea eliminar esta marca?", function(btn){
					if (btn == 'yes') {
					
						Ext.Msg.prompt('Eliminar marca', 
							'Digite la causa de la eliminaci&oacute;n de esta marca', 
							function(btn2, text){
								if (btn2 == 'ok') {
									subirDatosAjax(
										getAbsoluteUrl('maestra_marca','eliminarMarca'),
										{
										maestra_mar_codigo:record.get('maestra_mar_codigo'),
										maestra_mar_causa_eliminacion:text
										},
										function(){
										maestra_marca_datastore.reload(); 
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
			mostrarMensajeConfirmacion('Error',"Seleccione una marca de columna a eliminar");
		}
	}

	function maestra_marca_agregar(btn, ev) {
		var row = new maestra_marca_gridpanel.store.recordType({
			maestra_mar_codigo : '',
			maestra_mar_nombre: ''
		});

		maestra_marca_gridpanel.getSelectionModel().clearSelections();
		maestra_marca_roweditor.stopEditing();
		maestra_marca_gridpanel.store.insert(0, row);
		maestra_marca_gridpanel.getSelectionModel().selectRow(0);
		maestra_marca_roweditor.startEditing(0);
	}
	
