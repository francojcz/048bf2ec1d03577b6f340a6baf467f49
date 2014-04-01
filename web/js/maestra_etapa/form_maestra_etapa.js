//ayudas
var ayuda_maestra_eta_codigo='C&oacute;digo identificador en el sistema';
var ayuda_maestra_eta_nombre='Nombre etapa';
	
	var maestra_etapa_datastore = new Ext.data.Store({
        id: 'maestra_etapa_datastore',
        proxy: new Ext.data.HttpProxy({
                url: getAbsoluteUrl('maestra_etapa','listarEtapa'),
                method: 'POST'
        }),
        baseParams:{start:0, limit:20}, 
        reader: new Ext.data.JsonReader({
                root: 'results',
                totalProperty: 'total',
                id: 'id'
                },[ 
			{name: 'maestra_eta_codigo', type: 'int'},
			{name: 'maestra_eta_nombre', type: 'string'},
			{name: 'maestra_eta_fecha_registro_sistema', type: 'string'},
			{name: 'maestra_eta_fecha_actualizacion',type: 'string'},
			{name: 'maestra_eta_usu_crea_nombre',type: 'string'},
			{name: 'maestra_eta_usu_actualiza_nombre',type: 'string'},
			{name: 'maestra_eta_causa_eliminacion',type: 'string'},
			{name: 'maestra_eta_causa_actualizacion',type: 'string'}
			])
        });
    maestra_etapa_datastore.load();
	

	var maestra_eta_codigo=new Ext.form.NumberField({
	   xtype: 'numberfield',
	   maxLength : 100,
	   name: 'maestra_eta_codigo',
	   id: 'maestra_eta_codigo',
	   fieldLabel: 'C&ooacute;digo evento',
	   listeners:
	   {
			'render': function() {
					ayuda('maestra_eta_codigo', ayuda_maestra_eta_codigo);
					}
	   }
	});
	

	var maestra_eta_nombre=new Ext.form.TextField({
	   xtype: 'textfield',
	   maxLength : 100,
	   name: 'maestra_eta_nombre',
	   id: 'maestra_eta_nombre',
	   fieldLabel: 'Nombre etapa',
	   allowBlank: false,
	   listeners:
	   {
			'render': function() {
					ayuda('maestra_eta_nombre', ayuda_maestra_eta_nombre);
					}
	   }
	});

	var maestra_etapa_colmodel = new Ext.grid.ColumnModel({
		defaults:{sortable: true, locked: false, resizable: true},
		columns:[
			{id: 'maestra_eta_codigo_column', header: "Id", width: 30, dataIndex: 'maestra_eta_codigo'},
			{ id: 'maestra_eta_nombre_column', header: "Nombre", width: 100, dataIndex: 'maestra_eta_nombre', editor:maestra_eta_nombre},
			{ header: "Creado por", width: 120, dataIndex: 'maestra_eta_usu_crea_nombre'},
			{ header: "Fecha de creaci&oacute;n", width: 120, dataIndex: 'maestra_eta_fecha_registro_sistema'},
			{ header: "Actualizado por", width: 120, dataIndex: 'maestra_eta_usu_actualiza_nombre'},
			{ header: "Fecha de actualizaci&oacute;n", width: 120, dataIndex: 'maestra_eta_fecha_actualizacion'},
			{ header: "Causa actualizaci&oacute;n", width: 120, dataIndex: 'maestra_eta_causa_actualizacion'},
			{ header: "Causa eliminaci&oacute;n", width: 120, dataIndex: 'maestra_eta_causa_eliminacion'}
		]
	});
	

	var maestra_etapa_roweditor = new Ext.ux.grid.RowEditor({
		saveText: 'Guardar',
		cancelText: 'Cancelar',
		showTooltip: function(msg){},
		listeners:
		{
			'afteredit': function(gr,obj,record,num){
				
				if(record.get('maestra_eta_codigo')!=''){
				
					Ext.Msg.prompt(
					'Etapa',
					'Digite la causa de la actualizaci&oacute;n de esta etapa',
					function(btn, text,op){
							if (btn == 'ok') {
							maestra_etapa_actualizar(record,text);
							}
						}
					);
				}
				else{
					maestra_etapa_actualizar(record,'');
				}
			},
			'canceledit': function(){}
		}
	});

                
        //CREACION DE LA GRILLA
	var maestra_etapa_gridpanel = new Ext.grid.GridPanel({
		id: 'maestra_etapa_gridpanel',
		title:'Etapas de Columna',
		stripeRows:true,
		frame: true,
		ds: maestra_etapa_datastore,
		cm: maestra_etapa_colmodel,
		selModel: new Ext.grid.RowSelectionModel({
			singleSelect:true,	
			moveEditorOnEnter :false
		}),
		autoExpandColumn: 'maestra_eta_nombre_column',
		height: largo_panel,
		bbar: new Ext.PagingToolbar({
			pageSize: 20,
			store: maestra_etapa_datastore,
			displayInfo: true,
			displayMsg: 'Etapas de Columna {0} - {1} de {2}',
			emptyMsg: "No hay etapas de columna aun"
		}),
		tbar:
		[
			{	
				id:'maestra_etapa_agregar_boton',
				text:'Agregar',
				tooltip:'Agregar',
				iconCls:'agregar',
				handler:maestra_etapa_agregar
			},'-',
			{
				text:'Eliminar',
				tooltip:'Eliminar',
				iconCls:'eliminar',
				handler:maestra_etapa_eliminar
			},'-',{
				text:'',
				iconCls:'activos',
				tooltip:'Etapas activas',
				handler:function(){
					maestra_etapa_datastore.baseParams.eta_eliminado = '0';
					maestra_etapa_datastore.load({
						params: {
							start: 0,
							limit: 20
						}
					});
				}
			},{
				text:'',
				iconCls:'eliminados',
				tooltip:'Etapas eliminadas',
				handler:function(){
					maestra_etapa_datastore.baseParams.eta_eliminado = '1';
					maestra_etapa_datastore.load({
						params: {
							start: 0,
							limit: 20
						}
					});
				}
			},'-',{
				text:'Restablecer',
				iconCls:'restablece',
				tooltip:'Restablecer una etapa eliminada',
				handler:function(){
					 var cant_record = maestra_etapa_gridpanel.getSelectionModel().getCount();
			
					if(cant_record > 0){
					var record = maestra_etapa_gridpanel.getSelectionModel().getSelected();
						if (record.get('maestra_eta_codigo') != '') {
					
							Ext.Msg.prompt('Restablecer etapas', 
								'Digite la causa de restablecimiento', 
								function(btn, text){
									if (btn == 'ok')  {
										subirDatosAjax( 
											getAbsoluteUrl('maestra_etapa', 'restablecerEtapa'), 
											{
											maestra_eta_codigo:record.get('maestra_eta_codigo'),
											maestra_eta_causa_restablece:text
											}, 
											function(){
												maestra_etapa_datastore.reload();
											}, 
											function(){}
										);
									}
								}
							);
						}
					}
					else {
						mostrarMensajeConfirmacion('Error', "Seleccione una etapa de columna eliminada");
					}
				}
			}
		],
		plugins:[maestra_etapa_roweditor,
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
	var maestra_etapa_contenedor_panel = new Ext.Panel({
		id: 'maestra_etapa_contenedor_panel',
		height: largo_panel,
		autoWidth: true,
		border: false,
		tabTip :'Aqu&iacute puede ver, agregar, eliminar y restablecer etapas de columnas',
		monitorResize:true,
		items: 
		[
			maestra_etapa_gridpanel
		],
		renderTo:'div_form_maestra_etapa'
	});
	

	function maestra_etapa_actualizar(record,text){
	//	var record = maestra_etapa_gridpanel.getSelectionModel().getSelected();

		subirDatosAjax(
			getAbsoluteUrl('maestra_etapa','actualizarEtapa'),
			{
				maestra_eta_codigo: record.get('maestra_eta_codigo'),
				maestra_eta_nombre: record.get('maestra_eta_nombre'),
				maestra_eta_causa_actualizacion: text
			},
			function(){
				maestra_etapa_datastore.reload(); 
			}
		);
	}
        
	function maestra_etapa_eliminar()
	{
		var cant_record = maestra_etapa_gridpanel.getSelectionModel().getCount();
		
		if(cant_record > 0){
			var record = maestra_etapa_gridpanel.getSelectionModel().getSelected();
			if(record.get('maestra_eta_codigo')!='')
			{
				Ext.Msg.confirm('Eliminar etapa', "Realmente desea eliminar esta etapa?", function(btn){
					if (btn == 'yes') {
					
						Ext.Msg.prompt('Eliminar etapa', 
							'Digite la causa de la eliminaci&oacute;n de esta etapa', 
							function(btn2, text){
								if (btn2 == 'ok') {
									subirDatosAjax(
										getAbsoluteUrl('maestra_etapa','eliminarEtapa'),
										{
										maestra_eta_codigo:record.get('maestra_eta_codigo'),
										maestra_eta_causa_eliminacion:text
										},
										function(){
										maestra_etapa_datastore.reload(); 
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
			mostrarMensajeConfirmacion('Error',"Seleccione una etapa de columna a eliminar");
		}
	}

	function maestra_etapa_agregar(btn, ev) {
		var row = new maestra_etapa_gridpanel.store.recordType({
			maestra_eta_codigo : '',
			maestra_eta_nombre: ''
		});

		maestra_etapa_gridpanel.getSelectionModel().clearSelections();
		maestra_etapa_roweditor.stopEditing();
		maestra_etapa_gridpanel.store.insert(0, row);
		maestra_etapa_gridpanel.getSelectionModel().selectRow(0);
		maestra_etapa_roweditor.startEditing(0);
	}
	
