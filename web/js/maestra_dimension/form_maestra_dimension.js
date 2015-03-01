//ayudas
var ayuda_maestra_dim_codigo='C&oacute;digo identificador en el sistema';
var ayuda_maestra_dim_nombre='Dimensi&oacute;n';
	
	var maestra_dimension_datastore = new Ext.data.Store({
        id: 'maestra_dimension_datastore',
        proxy: new Ext.data.HttpProxy({
                url: getAbsoluteUrl('maestra_dimension','listarDimension'),
                method: 'POST'
        }),
        baseParams:{start:0, limit:20}, 
        reader: new Ext.data.JsonReader({
                root: 'results',
                totalProperty: 'total',
                id: 'id'
                },[ 
			{name: 'maestra_dim_codigo', type: 'int'},
			{name: 'maestra_dim_nombre', type: 'string'},
			{name: 'maestra_dim_fecha_registro_sistema', type: 'string'},
			{name: 'maestra_dim_fecha_actualizacion',type: 'string'},
			{name: 'maestra_dim_usu_crea_nombre',type: 'string'},
			{name: 'maestra_dim_usu_actualiza_nombre',type: 'string'},
			{name: 'maestra_dim_causa_eliminacion',type: 'string'},
			{name: 'maestra_dim_causa_actualizacion',type: 'string'}
			])
        });
    maestra_dimension_datastore.load();
	

	var maestra_dim_codigo=new Ext.form.NumberField({
	   xtype: 'numberfield',
	   maxLength : 100,
	   name: 'maestra_dim_codigo',
	   id: 'maestra_dim_codigo',
	   fieldLabel: 'C&ooacute;digo evento',
	   listeners:
	   {
			'render': function() {
					ayuda('maestra_dim_codigo', ayuda_maestra_dim_codigo);
					}
	   }
	});
	

	var maestra_dim_nombre=new Ext.form.TextField({
	   xtype: 'textfield',
	   maxLength : 100,
	   name: 'maestra_dim_nombre',
	   id: 'maestra_dim_nombre',
	   fieldLabel: 'Dimensión',
	   allowBlank: false,
	   listeners:
	   {
			'render': function() {
					ayuda('maestra_dim_nombre', ayuda_maestra_dim_nombre);
					}
	   }
	});

	var maestra_dimension_colmodel = new Ext.grid.ColumnModel({
		defaults:{sortable: true, locked: false, resizable: true},
		columns:[
			{id: 'maestra_dim_codigo_column', header: "Id", width: 30, dataIndex: 'maestra_dim_codigo'},
			{ id: 'maestra_dim_nombre_column', header: "Dimensi&oacute;n", width: 100, dataIndex: 'maestra_dim_nombre', editor:maestra_dim_nombre},
			{ header: "Creado por", width: 120, dataIndex: 'maestra_dim_usu_crea_nombre'},
			{ header: "Fecha de creaci&oacute;n", width: 120, dataIndex: 'maestra_dim_fecha_registro_sistema'},
			{ header: "Actualizado por", width: 120, dataIndex: 'maestra_dim_usu_actualiza_nombre'},
			{ header: "Fecha de actualizaci&oacute;n", width: 120, dataIndex: 'maestra_dim_fecha_actualizacion'},
			{ header: "Causa actualizaci&oacute;n", width: 120, dataIndex: 'maestra_dim_causa_actualizacion'},
			{ header: "Causa eliminaci&oacute;n", width: 120, dataIndex: 'maestra_dim_causa_eliminacion'}
		]
	});
	

	var maestra_dimension_roweditor = new Ext.ux.grid.RowEditor({
		saveText: 'Guardar',
		cancelText: 'Cancelar',
		showTooltip: function(msg){},
		listeners:
		{
			'afteredit': function(gr,obj,record,num){
				
				if(record.get('maestra_dim_codigo')!=''){
				
					Ext.Msg.prompt(
					'Dimensión',
					'Digite la causa de la actualizaci&oacute;n de esta dimensión',
					function(btn, text,op){
							if (btn == 'ok') {
							maestra_dimension_actualizar(record,text);
							}
						}
					);
				}
				else{
					maestra_dimension_actualizar(record,'');
				}
			},
			'canceledit': function(){}
		}
	});

                
        //CREACION DE LA GRILLA
	var maestra_dimension_gridpanel = new Ext.grid.GridPanel({
		id: 'maestra_dimension_gridpanel',
		title:'Dimensiones de Columna',
		stripeRows:true,
		frame: true,
		ds: maestra_dimension_datastore,
		cm: maestra_dimension_colmodel,
		selModel: new Ext.grid.RowSelectionModel({
			singleSelect:true,	
			moveEditorOnEnter :false
		}),
		autoExpandColumn: 'maestra_dim_nombre_column',
		height: largo_panel,
		bbar: new Ext.PagingToolbar({
			pageSize: 20,
			store: maestra_dimension_datastore,
			displayInfo: true,
			displayMsg: 'Dimensiones de Columna {0} - {1} de {2}',
			emptyMsg: "No hay dimensiones de columna aun"
		}),
		tbar:
		[
			{	
				id:'maestra_dimension_agregar_boton',
				text:'Agregar',
				tooltip:'Agregar',
				iconCls:'agregar',
				handler:maestra_dimension_agregar
			},'-',
			{
				text:'Eliminar',
				tooltip:'Eliminar',
				iconCls:'eliminar',
				handler:maestra_dimension_eliminar
			},'-',{
				text:'',
				iconCls:'activos',
				tooltip:'Dimensinoes activas',
				handler:function(){
					maestra_dimension_datastore.baseParams.dim_eliminado = '0';
					maestra_dimension_datastore.load({
						params: {
							start: 0,
							limit: 20
						}
					});
				}
			},{
				text:'',
				iconCls:'eliminados',
				tooltip:'Dimensiones eliminadas',
				handler:function(){
					maestra_dimension_datastore.baseParams.dim_eliminado = '1';
					maestra_dimension_datastore.load({
						params: {
							start: 0,
							limit: 20
						}
					});
				}
			},'-',{
				text:'Restablecer',
				iconCls:'restablece',
				tooltip:'Restablecer una dimensión eliminada',
				handler:function(){
					 var cant_record = maestra_dimension_gridpanel.getSelectionModel().getCount();
			
					if(cant_record > 0){
					var record = maestra_dimension_gridpanel.getSelectionModel().getSelected();
						if (record.get('maestra_dim_codigo') != '') {
					
							Ext.Msg.prompt('Restablecer dimensiones', 
								'Digite la causa de restablecimiento', 
								function(btn, text){
									if (btn == 'ok')  {
										subirDatosAjax( 
											getAbsoluteUrl('maestra_dimension', 'restablecerDimension'), 
											{
											maestra_dim_codigo:record.get('maestra_dim_codigo'),
											maestra_dim_causa_restablece:text
											}, 
											function(){
												maestra_dimension_datastore.reload();
											}, 
											function(){}
										);
									}
								}
							);
						}
					}
					else {
						mostrarMensajeConfirmacion('Error', "Seleccione una dimensi&oacute;n de columna eliminada");
					}
				}
			}
		],
		plugins:[maestra_dimension_roweditor,
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
	var maestra_dimension_contenedor_panel = new Ext.Panel({
		id: 'maestra_dimension_contenedor_panel',
		height: largo_panel,
		autoWidth: true,
		border: false,
		tabTip :'Aqu&iacute puede ver, agregar, eliminar y restablecer dimensiones de columnas',
		monitorResize:true,
		items: 
		[
			maestra_dimension_gridpanel
		],
		renderTo:'div_form_maestra_dimension'
	});
	

	function maestra_dimension_actualizar(record,text){
	//	var record = maestra_dimension_gridpanel.getSelectionModel().getSelected();

		subirDatosAjax(
			getAbsoluteUrl('maestra_dimension','actualizarDimension'),
			{
				maestra_dim_codigo: record.get('maestra_dim_codigo'),
				maestra_dim_nombre: record.get('maestra_dim_nombre'),
				maestra_dim_causa_actualizacion: text
			},
			function(){
				maestra_dimension_datastore.reload(); 
			}
		);
	}
        
	function maestra_dimension_eliminar()
	{
		var cant_record = maestra_dimension_gridpanel.getSelectionModel().getCount();
		
		if(cant_record > 0){
			var record = maestra_dimension_gridpanel.getSelectionModel().getSelected();
			if(record.get('maestra_dim_codigo')!='')
			{
				Ext.Msg.confirm('Eliminar dimensión', "Realmente desea eliminar esta dimensión?", function(btn){
					if (btn == 'yes') {
					
						Ext.Msg.prompt('Eliminar dimensión', 
							'Digite la causa de la eliminaci&oacute;n de esta dimensión', 
							function(btn2, text){
								if (btn2 == 'ok') {
									subirDatosAjax(
										getAbsoluteUrl('maestra_dimension','eliminarDimension'),
										{
										maestra_dim_codigo:record.get('maestra_dim_codigo'),
										maestra_dim_causa_eliminacion:text
										},
										function(){
										maestra_dimension_datastore.reload(); 
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
			mostrarMensajeConfirmacion('Error',"Seleccione una dimensi&oacute;n de columna a eliminar");
		}
	}

	function maestra_dimension_agregar(btn, ev) {
		var row = new maestra_dimension_gridpanel.store.recordType({
			maestra_dim_codigo : '',
			maestra_dim_nombre: ''
		});

		maestra_dimension_gridpanel.getSelectionModel().clearSelections();
		maestra_dimension_roweditor.stopEditing();
		maestra_dimension_gridpanel.store.insert(0, row);
		maestra_dimension_gridpanel.getSelectionModel().selectRow(0);
		maestra_dimension_roweditor.startEditing(0);
	}
	
