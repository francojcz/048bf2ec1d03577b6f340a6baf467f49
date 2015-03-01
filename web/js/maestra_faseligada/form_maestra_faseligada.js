//ayudas
var ayuda_maestra_fase_codigo='C&oacute;digo identificador en el sistema';
var ayuda_maestra_fase_nombre='Nombre fase ligada';
	
	var maestra_fase_datastore = new Ext.data.Store({
        id: 'maestra_fase_datastore',
        proxy: new Ext.data.HttpProxy({
                url: getAbsoluteUrl('maestra_faseligada','listarFaseLigada'),
                method: 'POST'
        }),
        baseParams:{start:0, limit:20}, 
        reader: new Ext.data.JsonReader({
                root: 'results',
                totalProperty: 'total',
                id: 'id'
                },[ 
			{name: 'maestra_fase_codigo', type: 'int'},
			{name: 'maestra_fase_nombre', type: 'string'},
			{name: 'maestra_fase_fecha_registro_sistema', type: 'string'},
			{name: 'maestra_fase_fecha_actualizacion',type: 'string'},
			{name: 'maestra_fase_usu_crea_nombre',type: 'string'},
			{name: 'maestra_fase_usu_actualiza_nombre',type: 'string'},
			{name: 'maestra_fase_causa_eliminacion',type: 'string'},
			{name: 'maestra_fase_causa_actualizacion',type: 'string'}
			])
        });
    maestra_fase_datastore.load();
	

	var maestra_fase_codigo=new Ext.form.NumberField({
	   xtype: 'numberfield',
	   maxLength : 100,
	   name: 'maestra_fase_codigo',
	   id: 'maestra_fase_codigo',
	   fieldLabel: 'C&ooacute;digo evento',
	   listeners:
	   {
			'render': function() {
					ayuda('maestra_fase_codigo', ayuda_maestra_fase_codigo);
					}
	   }
	});
	

	var maestra_fase_nombre=new Ext.form.TextField({
	   xtype: 'textfield',
	   maxLength : 100,
	   name: 'maestra_fase_nombre',
	   id: 'maestra_fase_nombre',
	   fieldLabel: 'Nombre Fase Ligada',
	   allowBlank: false,
	   listeners:
	   {
			'render': function() {
					ayuda('maestra_fase_nombre', ayuda_maestra_fase_nombre);
					}
	   }
	});

	var maestra_fase_colmodel = new Ext.grid.ColumnModel({
		defaults:{sortable: true, locked: false, resizable: true},
		columns:[
			{id: 'maestra_fase_codigo_column', header: "Id", width: 30, dataIndex: 'maestra_fase_codigo'},
			{ id: 'maestra_fase_nombre_column', header: "Nombre", width: 100, dataIndex: 'maestra_fase_nombre', editor:maestra_fase_nombre},
			{ header: "Creado por", width: 120, dataIndex: 'maestra_fase_usu_crea_nombre'},
			{ header: "Fecha de creaci&oacute;n", width: 120, dataIndex: 'maestra_fase_fecha_registro_sistema'},
			{ header: "Actualizado por", width: 120, dataIndex: 'maestra_fase_usu_actualiza_nombre'},
			{ header: "Fecha de actualizaci&oacute;n", width: 120, dataIndex: 'maestra_fase_fecha_actualizacion'},
			{ header: "Causa actualizaci&oacute;n", width: 120, dataIndex: 'maestra_fase_causa_actualizacion'},
			{ header: "Causa eliminaci&oacute;n", width: 120, dataIndex: 'maestra_fase_causa_eliminacion'}
		]
	});
	

	var maestra_fase_roweditor = new Ext.ux.grid.RowEditor({
		saveText: 'Guardar',
		cancelText: 'Cancelar',
		showTooltip: function(msg){},
		listeners:
		{
			'afteredit': function(gr,obj,record,num){
				
				if(record.get('maestra_fase_codigo')!=''){
				
					Ext.Msg.prompt(
					'Fase Ligada',
					'Digite la causa de la actualizaci&oacute;n de esta fase',
					function(btn, text,op){
							if (btn == 'ok') {
							maestra_fase_actualizar(record,text);
							}
						}
					);
				}
				else{
					maestra_fase_actualizar(record,'');
				}
			},
			'canceledit': function(){}
		}
	});

                
        //CREACION DE LA GRILLA
	var maestra_fase_gridpanel = new Ext.grid.GridPanel({
		id: 'maestra_fase_gridpanel',
		title:'Fases Ligadas de Columna',
		stripeRows:true,
		frame: true,
		ds: maestra_fase_datastore,
		cm: maestra_fase_colmodel,
		selModel: new Ext.grid.RowSelectionModel({
			singleSelect:true,	
			moveEditorOnEnter :false
		}),
		autoExpandColumn: 'maestra_fase_nombre_column',
		height: largo_panel,
		bbar: new Ext.PagingToolbar({
			pageSize: 20,
			store: maestra_fase_datastore,
			displayInfo: true,
			displayMsg: 'Fases Ligadas de Columna {0} - {1} de {2}',
			emptyMsg: "No hay fases ligadas de columna aun"
		}),
		tbar:
		[
			{	
				id:'maestra_fase_agregar_boton',
				text:'Agregar',
				tooltip:'Agregar',
				iconCls:'agregar',
				handler:maestra_fase_agregar
			},'-',
			{
				text:'Eliminar',
				tooltip:'Eliminar',
				iconCls:'eliminar',
				handler:maestra_fase_eliminar
			},'-',{
				text:'',
				iconCls:'activos',
				tooltip:'Fases Ligadas activas',
				handler:function(){
					maestra_fase_datastore.baseParams.fase_eliminado = '0';
					maestra_fase_datastore.load({
						params: {
							start: 0,
							limit: 20
						}
					});
				}
			},{
				text:'',
				iconCls:'eliminados',
				tooltip:'Fases Ligadas eliminadas',
				handler:function(){
					maestra_fase_datastore.baseParams.fase_eliminado = '1';
					maestra_fase_datastore.load({
						params: {
							start: 0,
							limit: 20
						}
					});
				}
			},'-',{
				text:'Restablecer',
				iconCls:'restablece',
				tooltip:'Restablecer una fase eliminada',
				handler:function(){
					 var cant_record = maestra_fase_gridpanel.getSelectionModel().getCount();
			
					if(cant_record > 0){
					var record = maestra_fase_gridpanel.getSelectionModel().getSelected();
						if (record.get('maestra_fase_codigo') != '') {
					
							Ext.Msg.prompt('Restablecer fases', 
								'Digite la causa de restablecimiento', 
								function(btn, text){
									if (btn == 'ok')  {
										subirDatosAjax( 
											getAbsoluteUrl('maestra_faseligada', 'restablecerFaseLigada'), 
											{
											maestra_fase_codigo:record.get('maestra_fase_codigo'),
											maestra_fase_causa_restablece:text
											}, 
											function(){
												maestra_fase_datastore.reload();
											}, 
											function(){}
										);
									}
								}
							);
						}
					}
					else {
						mostrarMensajeConfirmacion('Error', "Seleccione una fase ligada de columna eliminada");
					}
				}
			}
		],
		plugins:[maestra_fase_roweditor,
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
	var maestra_fase_contenedor_panel = new Ext.Panel({
		id: 'maestra_fase_contenedor_panel',
		height: largo_panel,
		autoWidth: true,
		border: false,
		tabTip :'Aqu&iacute puede ver, agregar, eliminar y restablecer fases ligadas de columnas',
		monitorResize:true,
		items: 
		[
			maestra_fase_gridpanel
		],
		renderTo:'div_form_maestra_faseligada'
	});
	

	function maestra_fase_actualizar(record,text){
	//	var record = maestra_fase_gridpanel.getSelectionModel().getSelected();

		subirDatosAjax(
			getAbsoluteUrl('maestra_faseligada','actualizarFaseLigada'),
			{
				maestra_fase_codigo: record.get('maestra_fase_codigo'),
				maestra_fase_nombre: record.get('maestra_fase_nombre'),
				maestra_fase_causa_actualizacion: text
			},
			function(){
				maestra_fase_datastore.reload(); 
			}
		);
	}
        
	function maestra_fase_eliminar()
	{
		var cant_record = maestra_fase_gridpanel.getSelectionModel().getCount();
		
		if(cant_record > 0){
			var record = maestra_fase_gridpanel.getSelectionModel().getSelected();
			if(record.get('maestra_fase_codigo')!='')
			{
				Ext.Msg.confirm('Eliminar fase', "Realmente desea eliminar esta fase?", function(btn){
					if (btn == 'yes') {
					
						Ext.Msg.prompt('Eliminar fase', 
							'Digite la causa de la eliminaci&oacute;n de esta fase', 
							function(btn2, text){
								if (btn2 == 'ok') {
									subirDatosAjax(
										getAbsoluteUrl('maestra_faseligada','eliminarFaseLigada'),
										{
										maestra_fase_codigo:record.get('maestra_fase_codigo'),
										maestra_fase_causa_eliminacion:text
										},
										function(){
										maestra_fase_datastore.reload(); 
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
			mostrarMensajeConfirmacion('Error',"Seleccione una fase ligada de columna a eliminar");
		}
	}

	function maestra_fase_agregar(btn, ev) {
		var row = new maestra_fase_gridpanel.store.recordType({
			maestra_fase_codigo : '',
			maestra_fase_nombre: ''
		});

		maestra_fase_gridpanel.getSelectionModel().clearSelections();
		maestra_fase_roweditor.stopEditing();
		maestra_fase_gridpanel.store.insert(0, row);
		maestra_fase_gridpanel.getSelectionModel().selectRow(0);
		maestra_fase_roweditor.startEditing(0);
	}
	
