var tiempoInyeccion = 0;

Ext.onReady(function()
{
    Ext.BLANK_IMAGE_URL = urlPrefix + '../css/extjs/resources/images/default/s.gif';
    fields = [
    {
        type : 'int',
        name : 'id_registro_uso_maquina'
    }, {
        type : 'string',
        name : 'id_metodo'
    }, {
        type : 'string',
        name : 'tiempo_entre_metodos'
    }, {
        type : 'string',
        name : 'cambio_metodo_ajuste'
    }, {
        type : 'string',
        name : 'tiempo_corrida_ss'
    }, {
        type : 'string',
        name : 'numero_inyecciones_ss'
    }, {
        type : 'string',
        name : 'tiempo_corrida_cc'
    }, {
        type : 'string',
        name : 'numero_inyecciones_estandar1'
    }, {
        type : 'string',
        name : 'numero_inyecciones_estandar2'
    }, {
        type : 'string',
        name : 'numero_inyecciones_estandar3'
    }, {
        type : 'string',
        name : 'numero_inyecciones_estandar4'
    }, {
        type : 'string',
        name : 'numero_inyecciones_estandar5'
    }, {
        type : 'string',
        name : 'numero_inyecciones_estandar6'
    }, {
        type : 'string',
        name : 'numero_inyecciones_estandar7'
    }, {
        type : 'string',
        name : 'numero_inyecciones_estandar8'
    }, {
        type : 'string',
        name : 'tiempo_corrida_producto'
    }, {
        type : 'string',
        name : 'tiempo_corrida_estabilidad'
    }, {
        type : 'string',
        name : 'tiempo_corrida_materia_prima'
    }, {
        type : 'string',
        name : 'tiempo_corrida_pureza'
    }, {
        type : 'string',
        name : 'tiempo_corrida_disolucion'
    }, {
        type : 'string',
        name : 'tiempo_corrida_uniformidad'
    }, {
        type : 'string',
        name : 'numero_muestras_producto'
    }, {
        type : 'string',
        name : 'numero_muestras_estabilidad'
    }, {
        type : 'string',
        name : 'numero_muestras_materia_prima'
    }, {
        type : 'string',
        name : 'numero_muestras_pureza'
    }, {
        type : 'string',
        name : 'numero_muestras_disolucion'
    }, {
        type : 'string',
        name : 'numero_muestras_uniformidad'
    }, {
        type : 'string',
        name : 'numero_inyecciones_x_muestra_producto'
    }, {
        type : 'string',
        name : 'numero_inyecciones_x_muestra_materia_prima'
    }, {
        type : 'string',
        name : 'numero_inyecciones_x_muestra_estabilidad'
    }, {
        type : 'string',
        name : 'numero_inyecciones_x_muestra_pureza'
    }, {
        type : 'string',
        name : 'numero_inyecciones_x_muestra_disolucion'
    }, {
        type : 'string',
        name : 'numero_inyecciones_x_muestra_uniformidad'
    }, {
        type : 'string',
        name : 'hora_inicio_corrida'
    }, {
        type : 'string',
        name : 'hora_fin_corrida'
    }, {
        type : 'string',
        name : 'fallas'
    }, {
        type : 'string',
        name : 'lote'
    }, {
        type : 'string',
        name : 'observaciones'
    }, {
        type : 'string',
        name : 'col_codigo_interno'
    }, {
        type : 'string',
        name : 'etapa_nombre'
    }, {
        type : 'string',
        name : 'platos_teoricos'
    }, {
        type : 'string',
        name : 'tiempo_retencion'
    }, {
        type : 'string',
        name : 'resolucion'
    }, {
        type : 'string',
        name : 'tailing'
    }, {
        type : 'string',
        name : 'presion'
    }, {
        type : 'string',
        name : 'observaciones_col'
    }];  
  
    var metodosinorden_datastore = new Ext.data.Store(
    {
        proxy : new Ext.data.HttpProxy(
        {
            url : getAbsoluteUrl('ingreso_datos', 'listarMetodosSinOrden'),
            method : 'POST'
        }),
        reader : new Ext.data.JsonReader(
        {
            root : 'data'
        }, [
        {
            name : 'codigo',
            type : 'integer'
        },
        {
            name : 'nombre',
            type : 'string'
        }])
    });
  
    var metodos_datastore = new Ext.data.Store(
    {
        proxy : new Ext.data.HttpProxy(
        {
            url : getAbsoluteUrl('ingreso_datos', 'listarMetodos'),
            method : 'POST'
        }),
        reader : new Ext.data.JsonReader(
        {
            root : 'data'
        }, [
        {
            name : 'codigo',
            type : 'integer'
        },
        {
            name : 'nombre',
            type : 'string'
        }])
    });
  
    //Cambios: 24 de febrero de 2014
    var columnas_datastore = new Ext.data.Store({
        id: 'columnas_datastore',
        proxy: new Ext.data.HttpProxy({
            url: getAbsoluteUrl('ingreso_datos', 'listarColumnas'),
            method: 'POST'
        }),
        baseParams: {},
        reader: new Ext.data.JsonReader({
            root: 'results',
            totalProperty: 'total',
            id: 'id'
        }, [{
            name: 'col_codigo'
        }, {
            name: 'col_cod_interno'
        }])
    });
    columnas_datastore.load();  

    //Cambios: 24 de febrero de 2014
    var etapas_datastore = new Ext.data.Store({
        id: 'etapas_datastore',
        proxy: new Ext.data.HttpProxy({
            url: getAbsoluteUrl('ingreso_datos', 'listarEtapas'),
            method: 'POST'
        }),
        baseParams: {},
        reader: new Ext.data.JsonReader({
            root: 'results',
            totalProperty: 'total',
            id: 'id'
        }, [{
            name: 'eta_codigo'
        }, {
            name: 'eta_nombre'
        }])
    });
    etapas_datastore.load();  

    var datastore = new Ext.data.Store(
    {
        proxy : new Ext.data.HttpProxy(
        {
            url : getAbsoluteUrl('ingreso_datos', 'listarRegistrosUsoMaquina'),
            method : 'POST'
        }),
        reader : new Ext.data.JsonReader(
        {
            root : 'data'
        }, fields)
    });

    var fechaField = new Ext.form.DateField(
    {
        xtype : 'datefield',
        fieldLabel : 'Fecha',
        allowBlank : false,
        value : new Date(),
        listeners :
        {
            select : function()
            {
                recargarDatosMetodos();
            },
            // blur: function(){
            // recargarDatosMetodos();
            // },
            specialkey : function(field, e)
            {
                if(e.getKey() == e.ENTER)
                {
                    recargarDatosMetodos();
                }
            }
        }
    });

    var codigo_maquina = new Ext.form.TextField(
    {
        fieldLabel : 'Código',
        readOnly : true
    });

    var maquinas_datastore = new Ext.data.Store(
    {
        proxy : new Ext.data.HttpProxy(
        {
            url : getAbsoluteUrl('ingreso_datos', 'listarEquiposPorComputador'),
            method : 'POST'
        }),
        reader : new Ext.data.JsonReader(
        {
            root : 'data'
        }, [
        {
            name : 'codigo',
            type : 'string'
        },
        {
            name : 'nombre',
            type : 'string'
        },
        {
            name : 'codigo_inventario',
            type : 'string'
        }])
    });

    maquinas_datastore.load();

    var maquina_combobox = new Ext.form.ComboBox(
    {
        fieldLabel : 'Equipo',
        store : maquinas_datastore,
        displayField : 'nombre',
        valueField : 'codigo',
        mode : 'local',
        triggerAction : 'all',
        forceSelection : true,
        allowBlank : false,
        width : 130,
        listeners :
        {
            select : function(combo, registro, indice)
            {
                codigo_maquina.setValue(registro.get('codigo_inventario'));
                recargarDatosMetodos(function()
                {
                    grid_tab1.enable();
                    grid_tab2.enable();
                    grid_tab3.enable();
                    metodo_para_agregar_combobox.setDisabled(false);
                });
            }
        }
    });

    var recargarDatosMetodos = function(callback)
    {
        redirigirSiSesionExpiro();
        if(maquina_combobox.isValid() && fechaField.isValid())
        {
            metodosinorden_datastore.load(
            {
                callback : function()
                {
                    if(maquina_combobox.getValue() != '')
                    {
                        var params =
                        {
                            'codigo_maquina' : maquina_combobox.getValue(),
                            'fecha' : fechaField.getValue()
                        };
                        if(esAdministrador && operario_field.getValue != '')
                        {
                            params['codigo_operario'] = operario_field.getValue();
                        }
                        datastore.load(
                        {
                            callback : callback,
                            params : params
                        });
                    }
                }
            });
      
            metodos_datastore.load(
            {
                callback : function()
                {
                    if(maquina_combobox.getValue() != '')
                    {
                        var params =
                        {
                            'codigo_maquina' : maquina_combobox.getValue(),
                            'fecha' : fechaField.getValue()
                        };
                        if(esAdministrador && operario_field.getValue != '')
                        {
                            params['codigo_operario'] = operario_field.getValue();
                        }
                        datastore.load(
                        {
                            callback : callback,
                            params : params
                        });
                    }
                }
            });
      
            var flashContent = document.getElementById("flashcontent");
            if(flashContent)
            {
                var so = new SWFObject(urlWeb + "flash/amcolumn/amcolumn.swf", "amcolumn", "100%", "160", "8", "#FFFFFF");
                so.addVariable("path", urlWeb + "flash/amcolumn/");
                so.addParam("wmode", "opaque");
                so.addVariable("settings_file", encodeURIComponent(getAbsoluteUrl('ingreso_datos', 'generarConfiguracionGraficoMinutos?codigo_maquina=' + maquina_combobox.getValue() + '&fecha=' + Ext.util.Format.date(fechaField.getValue(), 'Y-m-d'))));
                so.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('ingreso_datos', 'generarDatosGraficoMinutos?codigo_maquina=' + maquina_combobox.getValue() + '&fecha=' + Ext.util.Format.date(fechaField.getValue(), 'Y-m-d'))));
                so.addVariable("preloader_color", "#999999");
                so.write("flashcontent");
            }
      
            var flashContent1 = document.getElementById("flashcontent1");
            if(flashContent1)
            {
                var so1 = new SWFObject(urlWeb + "flash/amcolumn/amcolumn.swf", "amcolumn", "100%", "160", "8", "#FFFFFF");
                so1.addVariable("path", urlWeb + "flash/amcolumn/");
                so1.addParam("wmode", "opaque");
                so1.addVariable("settings_file", encodeURIComponent(getAbsoluteUrl('ingreso_datos', 'generarConfiguracionGraficoHoras?codigo_maquina=' + maquina_combobox.getValue() + '&fecha=' + Ext.util.Format.date(fechaField.getValue(), 'Y-m-d'))));
                so1.addVariable("data_file", encodeURIComponent(getAbsoluteUrl('ingreso_datos', 'generarDatosGraficoHoras?codigo_maquina=' + maquina_combobox.getValue() + '&fecha=' + Ext.util.Format.date(fechaField.getValue(), 'Y-m-d'))));
                so1.addVariable("preloader_color", "#999999");
                so1.write("flashcontent1");
            }
      
            Ext.Ajax.request(
            {
                url : getAbsoluteUrl('ingreso_datos', 'calcularTiempoDisponibleDia'),
                failure : function()
                {
                },
                success : function(result)
                {
                    var registro = datastore_calculadora1.getAt(0);
                    registro.set('tiempo_disponible_horas', result.responseText);
                    actualizarCalculadora();
                },
                params :
                {
                    'codigo_maquina' : maquina_combobox.getValue(),
                    'fecha' : fechaField.getValue()
                }
            });
            Ext.Ajax.request(
            {
                url : getAbsoluteUrl('ingreso_datos', 'consultarTiempoInyeccionMaquina'),
                failure : function()
                {
                },
                success : function(result)
                {
                    tiempoInyeccion = result.responseText;
                    actualizarCalculadora();
                },
                params :
                {
                    'codigo_maquina' : maquina_combobox.getValue()
                }
            });
        }
    }
    recargarDatosMetodos();

    var generarRenderer = function(colorFondoPar, colorFuentePar, colorFondoImpar, colorFuenteImpar)
    {
        return function(valor, metaData, record, rowIndex, colIndex, store)
        {
            if( typeof valor != 'undefined')
            {
                if(valor == '0.00')
                {
                    return valor;
                } else if((rowIndex % 2) == 0)
{
                    return '<div style="background-color: ' + colorFondoPar + '; color: ' + colorFuentePar + '">' + valor + '</div>';
                } else
{
                    return '<div style="background-color: ' + colorFondoImpar + '; color: ' + colorFuenteImpar + '">' + valor + '</div>';
                }
            } else
{
                return valor;
            }
        }
    }
    var registros_eventos_datastore = new Ext.data.Store(
    {
        proxy : new Ext.data.HttpProxy(
        {
            url : getAbsoluteUrl('ingreso_datos', 'listarRegistrosEventos'),
            method : 'POST'
        }),
        reader : new Ext.data.JsonReader(
        {
            root : 'data'
        }, [
        {
            name : 'codigo',
            type : 'integer'
        },
        {
            name : 'id_evento',
            type : 'string'
        },
        {
            name : 'hora_inicio',
            type : 'string'
        },
        {
            name : 'hora_fin',
            type : 'string'
        },
        {
            name : 'evrg_duracion',
            type : 'string'
        },
        {
            name : 'observaciones',
            type : 'string'
        },
        {
            name : 'hora_inicio_corregida',
            type : 'string'
        },
        {
            name : 'hora_fin_corregida',
            type : 'string'
        }])
    });

    var rowEditor = new Ext.ux.grid.RowEditor(
    {
        saveText : 'Guardar',
        cancelText : 'Cancelar',
        errorSummary : false,
        onKey : function(f, e)
        {
            if(e.getKey() === e.ENTER && this.isValid())
            {
                this.stopEditing(true);
                e.stopPropagation();
            }
        },
        listeners :
        {
            'afteredit' : function()
            {
                var record = grillaEventos.getSelectionModel().getSelected();
        
                //Guarda en sm la grilla seleccionada (Son tres grillas: Info. Método, Info. Muestras e Info. Columnas)        
                var activeTab = pestanas_grilla.getActiveTab();
                var sm;
                if (activeTab.id == 1) {
                    sm = grid_tab1.getSelectionModel();
                }
                if (activeTab.id == 2) {
                    sm = grid_tab2.getSelectionModel();
                }
                if (activeTab.id == 3) {
                    sm = grid_tab3.getSelectionModel();
                }
        
                var cell = sm.getSelectedCell();
                var index = cell[0];
                var registro = datastore.getAt(index);
                Ext.Ajax.request(
                {
                    url : getAbsoluteUrl('ingreso_datos', 'modificarRegistroEvento'),
                    failure : function()
                    {
                        recargarDatosEventos();
                    },
                    success : function(result)
                    {
                        recargarDatosEventos();
                        if(result.responseText != 'Ok')
                        {
                            alert(result.responseText);
                        }
                    },
                    params :
                    {
                        'codigo' : record.get('codigo'),
                        'id_evento' : record.get('id_evento'),
                        'hora_inicio' : record.get('hora_inicio'),
                        'hora_fin' : record.get('hora_fin'),
                        'observaciones' : record.get('observaciones'),
                        'evrg_duracion' : record.get('evrg_duracion'),
                        'codigo_rum' : registro.get('id_registro_uso_maquina')
                    }
                });
            },
            'canceledit' : function()
            {
                recargarDatosEventos();
            }
        }
    });

    var eventos_datastore = new Ext.data.Store(
    {
        proxy : new Ext.data.HttpProxy(
        {
            url : getAbsoluteUrl('ingreso_datos', 'listarEventos'),
            method : 'POST'
        }),
        reader : new Ext.data.JsonReader(
        {
            root : 'data'
        }, [
        {
            name : 'codigo',
            type : 'string'
        },
        {
            name : 'nombre',
            type : 'string'
        }])
    });

    var eventos_datastore_combo = new Ext.data.Store(
    {
        proxy : new Ext.data.HttpProxy(
        {
            url : getAbsoluteUrl('ingreso_datos', 'listarEventos'),
            method : 'POST'
        }),
        reader : new Ext.data.JsonReader(
        {
            root : 'data'
        }, [
        {
            name : 'codigo',
            type : 'string'
        },
        {
            name : 'nombre',
            type : 'string'
        }])
    });

    var eventos_datastore_renderer = new Ext.data.Store(
    {
        proxy : new Ext.data.HttpProxy(
        {
            url : getAbsoluteUrl('ingreso_datos', 'listarEventos'),
            method : 'POST'
        }),
        reader : new Ext.data.JsonReader(
        {
            root : 'data'
        }, [
        {
            name : 'codigo',
            type : 'string'
        },
        {
            name : 'nombre',
            type : 'string'
        }])
    });

    var eventos_por_categoria_datastore = new Ext.data.Store(
    {
        proxy : new Ext.data.HttpProxy(
        {
            url : getAbsoluteUrl('ingreso_datos', 'listarEventosPorCategoria'),
            method : 'POST'
        }),
        reader : new Ext.data.JsonReader(
        {
            root : 'data'
        }, [
        {
            name : 'codigo',
            type : 'string'
        },
        {
            name : 'nombre',
            type : 'string'
        }])
    });

    var categorias_datastore = new Ext.data.Store(
    {
        proxy : new Ext.data.HttpProxy(
        {
            url : getAbsoluteUrl('ingreso_datos', 'listarCategoriasEventos'),
            method : 'POST'
        }),
        reader : new Ext.data.JsonReader(
        {
            root : 'data'
        }, [
        {
            name : 'codigo',
            type : 'string'
        },
        {
            name : 'nombre',
            type : 'string'
        }])
    });

    var recargarDatosEventos = function(callback)
    {
        eventos_datastore_combo.load();
        categorias_datastore.load();
        eventos_datastore_renderer.load(
        {
            callback : function()
            {
                //Guarda en sm la grilla seleccionada (Son tres grillas: Info. Método, Info. Muestras e Info. Columnas)        
                var activeTab = pestanas_grilla.getActiveTab();
                var sm;
                if (activeTab.id == 1) {
                    sm = grid_tab1.getSelectionModel();
                }
                if (activeTab.id == 2) {
                    sm = grid_tab2.getSelectionModel();
                }
                if (activeTab.id == 3) {
                    sm = grid_tab3.getSelectionModel();
                }
        
                var cell = sm.getSelectedCell();
                var index = cell[0];
                var registro = datastore.getAt(index);
                registros_eventos_datastore.load(
                {
                    params :
                    {
                        'codigo_rum' : registro.get('id_registro_uso_maquina')
                    }
                });
            }
        });
    }
    var categoria_evento_combobox = new Ext.form.ComboBox(
    {
        store : categorias_datastore,
        displayField : 'nombre',
        valueField : 'codigo',
        mode : 'local',
        triggerAction : 'all',
        forceSelection : true,
        allowBlank : false,
        emptyText : 'Seleccione una categoría',
        listeners :
        {
            select : function()
            {
                var myMask = new Ext.LoadMask(Ext.get('ventana_flotante'),
                {
                    msg : "Por favor, espere..."
                });
                eventos_por_categoria_datastore.load(
                {
                    params :
                    {
                        'codigo_categoria' : categoria_evento_combobox.getValue()
                    },
                    callback : function()
                    {
                        myMask.hide();
                    }
                });
                myMask.show();
            }
        }
    });

    var evento_para_agregar_combobox = new Ext.form.ComboBox(
    {
        store : eventos_por_categoria_datastore,
        displayField : 'nombre',
        valueField : 'codigo',
        mode : 'local',
        triggerAction : 'all',
        forceSelection : true,
        allowBlank : false,
        emptyText : 'Seleccione un evento'
    });

    var grillaEventos = new Ext.grid.GridPanel(
    {
        autoWidth : true,
        height : 400,
        //autoHeight: true,
        store : registros_eventos_datastore,
        stripeRows : true,
        clicksToEdit : 1,
        loadMask :
        {
            msg : 'Cargando...'
        },
        sm : new Ext.grid.RowSelectionModel(
        {
            singleSelect : true
        }),
        plugins : [rowEditor],
        tbar : [categoria_evento_combobox, '-', evento_para_agregar_combobox,
        {
            text : 'Agregar evento',
            iconCls : 'agregar',
            handler : function()
            {
                var id_evento = evento_para_agregar_combobox.getValue();
                if(id_evento == '')
                {
                    alert('Primero debe seleccionar un evento');
                    evento_para_agregar_combobox.focus();
                } else
{
                    var row = new grillaEventos.store.recordType(
                    {
                        'id_evento' : id_evento
                    });
                    grillaEventos.getSelectionModel().clearSelections();
                    rowEditor.stopEditing();
                    grillaEventos.store.insert(0, row);
                    grillaEventos.getSelectionModel().selectRow(0);
                    rowEditor.startEditing(0);
                }
            }
        }, '-',
        {
            text : 'Eliminar evento',
            iconCls : 'eliminar',
            handler : function()
            {
                var record = grillaEventos.getSelectionModel().getSelected();
                Ext.Ajax.request(
                {
                    url : getAbsoluteUrl('ingreso_datos', 'eliminarRegistroEvento'),
                    failure : function()
                    {
                        recargarDatosEventos();
                    },
                    success : function(result)
                    {
                        recargarDatosEventos();
                        if(result.responseText != 'Ok')
                        {
                            alert(result.responseText);
                        }
                    },
                    params :
                    {
                        'codigo' : record.get('codigo')
                    }
                });
            }
        }],
        columns : [
        {
            dataIndex : 'id_evento',
            header : 'Nombre del evento',
            tooltip : 'Nombre del evento',
            width : 270,
            align : 'center',
            editor : new Ext.form.ComboBox(
            {
                store : eventos_datastore_combo,
                displayField : 'nombre',
                valueField : 'codigo',
                mode : 'local',
                triggerAction : 'all',
                forceSelection : true,
                allowBlank : false
            }),
            renderer : function(valor)
            {
                var index = eventos_datastore_renderer.find('codigo', valor);
                if(index != -1)
                {
                    var record = eventos_datastore_renderer.getAt(index);
                    return record.get('nombre');
                } else
{
                    return '';
                }
            }
        },
        {
            dataIndex : 'hora_inicio',
            header : 'Hora inicio',
            tooltip : 'Hora en la cual inició el evento',
            width : 70,
            align : 'center',
            editor : new Ext.form.TimeField(
            {        
                format : 'H:i',
                minValue : '00:00',
                maxValue : '23:59',
                increment : 30
            })
        },
        {
            dataIndex : 'hora_fin',
            header : 'Hora fin',
            tooltip : 'Hora en la cual finalizó el evento',
            width : 70,
            align : 'center',
            editor : new Ext.form.TimeField(
            {
                format : 'H:i',
                minValue : '00:00',
                maxValue : '23:59',
                increment : 30
            })
        },
        {
            dataIndex : 'hora_inicio_corregida',
            header : 'Hora inicio<br>corregida',
            tooltip : 'Hora inicio corregida (min.)',
            width : 70,
            align : 'center'
        },
        {
            dataIndex : 'hora_fin_corregida',
            header : 'Hora fin<br>corregida',
            tooltip : 'Hora fin corregida (min.)',
            width : 70,
            align : 'center'
        },
        {
            dataIndex : 'evrg_duracion',
            header : 'Duración<br>(min.)',
            tooltip : 'Duración del evento (min.)',
            width : 70,
            align : 'center'
        },
        {
            dataIndex : 'observaciones',
            header : 'Observaciones',
            tooltip : 'Cualquier detalle adicional',
            width : 250,
            align : 'center',
            editor : new Ext.form.TextField()
        }]
    });

    var win = new Ext.Window(
    {
        applyTo : 'ventana_flotante',
        layout : 'fit',
        width : 900,
        height : 300,
        closeAction : 'hide',
        plain : true,
        title : 'Editar eventos',
        items : grillaEventos,
        buttons : [
        {
            text : 'Aceptar',
            handler : function()
            {
                win.hide();
                recargarDatosMetodos();
            }
        }],
        listeners :
        {
            hide : function()
            {
                Ext.getBody().unmask();
            }
        }
    });

    var datastore_calculadora1 = new Ext.data.Store(
    {
        reader : new Ext.data.JsonReader(
        {
            root : 'data'
        }, [
        {
            name : 'tiempo_disponible_horas',
            type : 'float'
        },
        {
            name : 'tiempo_disponible_minutos',
            type : 'float'
        }])
    });

    datastore_calculadora1.loadData(
    {
        data : [
        {
            'tiempo_disponible_horas' : '',
            'tiempo_disponible_minutos' : ''
        }]
    });

    var grid_calculadora1 = new Ext.grid.EditorGridPanel(
    {
        store : datastore_calculadora1,
        stripeRows : true,
        border : true,
        frame : true,
        autoScroll : true,
        columnLines : true,
        height : 100,
        width : 200,
        columns : [
        {
            dataIndex : 'tiempo_disponible_horas',
            header : 'Tiempo<br>disponible<br>(Hrs)',
            tooltip : 'Tiempo disponible en horas',
            width : 80,
            align : 'center'
        },
        {
            dataIndex : 'tiempo_disponible_minutos',
            header : 'Tiempo<br>disponible<br>(Min)',
            tooltip : 'Tiempo disponible en minutos',
            width : 80,
            align : 'center'
        }]
    });

    var datastore_calculadora2 = new Ext.data.Store(
    {
        reader : new Ext.data.JsonReader(
        {
            root : 'data'
        }, [
        {
            name : 'tiempo_corrida',
            type : 'float'
        },
        {
            name : 'numero_inyecciones_muestra',
            type : 'float'
        }])
    });

    datastore_calculadora2.loadData(
    {
        data : [
        {
            'tiempo_corrida' : '',
            'numero_inyecciones_muestra' : ''
        }]
    });

    var grid_calculadora2 = new Ext.grid.EditorGridPanel(
    {
        store : datastore_calculadora2,
        stripeRows : true,
        border : true,
        frame : true,
        autoScroll : true,
        columnLines : true,
        height : 100,
        width : 200,
        columns : [
        {
            dataIndex : 'tiempo_corrida',
            header : 'Tiempo<br>de corrida<br>(Min)',
            tooltip : 'Tiempo de corrida',
            width : 80,
            align : 'center',
            editor :
            {
                xtype : 'numberfield',
                allowNegative : false,
                maxValue : 100000
            }
        },
        {
            dataIndex : 'numero_inyecciones_muestra',
            header : 'No.<br>inyecc./<br>Muestra',
            tooltip : 'N�mero inyecciones por muestra',
            width : 80,
            align : 'center',
            editor :
            {
                xtype : 'numberfield',
                allowNegative : false,
                allowDecimals : false,
                maxValue : 100000
            }
        }],
        listeners :
        {
            afteredit : function(e)
            {
                actualizarCalculadora();
            }
        }
    });

    var datastore_calculadora3 = new Ext.data.Store(
    {
        reader : new Ext.data.JsonReader(
        {
            root : 'data'
        }, [
        {
            name : 'numero_muestras_dia1',
            type : 'float'
        }])
    });

    datastore_calculadora3.loadData(
    {
        data : [
        {
            'numero_muestras_dia1' : ''
        }]
    });

    var grid_calculadora3 = new Ext.grid.EditorGridPanel(
    {
        store : datastore_calculadora3,
        stripeRows : true,
        border : true,
        frame : true,
        autoScroll : true,
        columnLines : true,
        height : 100,
        width : 200,
        columns : [
        {
            dataIndex : 'numero_muestras_dia1',
            header : 'No. muestras<br>a ingresar<br>dia 1',
            width : 80,
            align : 'center'
        }]
    });

    var datastore_calculadora4 = new Ext.data.Store(
    {
        reader : new Ext.data.JsonReader(
        {
            root : 'data'
        }, [
        {
            name : 'fraccion_muestra_dia1',
            type : 'float'
        },
        {
            name : 'fraccion_muestra_dia2',
            type : 'float'
        }])
    });

    datastore_calculadora4.loadData(
    {
        data : [
        {
            'fraccion_muestra_dia1' : '',
            'fraccion_muestra_dia2' : ''
        }]
    });

    var grid_calculadora4 = new Ext.grid.EditorGridPanel(
    {
        store : datastore_calculadora4,
        stripeRows : true,
        border : true,
        frame : true,
        autoScroll : true,
        columnLines : true,
        height : 100,
        width : 200,
        columns : [
        {
            dataIndex : 'fraccion_muestra_dia1',
            header : 'Fracci&oacute;n<br>muestra a<br>ingresar dia 1',
            width : 80,
            align : 'center'
        },
        {
            dataIndex : 'fraccion_muestra_dia2',
            header : 'Fracci&oacute;n<br>muestra a<br>ingresar dia 2',
            width : 80,
            align : 'center'
        }]
    });

    var win_calculadora = new Ext.Window(
    {
        applyTo : 'ventana_calculadora',
        layout : 'form',
        width : 200,
        height : 480,
        closeAction : 'hide',
        plain : true,
        title : 'Tiempo disponible',
        items : [grid_calculadora1, grid_calculadora2, grid_calculadora3, grid_calculadora4],
        buttons : [
        {
            text : 'Ocultar',
            handler : function()
            {
                win_calculadora.hide();
            }
        }]
    });

    function clipFloat(num, dec)
    {
        var t = num + "";
        var index = t.indexOf(".");
        if(index != -1)
        {
            num = parseFloat(t.substring(0, (index + dec + 1)));
        } else
{
            num = parseFloat(num);
        }
        return (num)
    }

    function actualizarCalculadora()
    {
        var registro1 = datastore_calculadora1.getAt(0);
        registro1.set('tiempo_disponible_minutos', registro1.get('tiempo_disponible_horas') * 60);
        var registro2 = datastore_calculadora2.getAt(0);
        var registro3 = datastore_calculadora3.getAt(0);
        var tiempo_disponible_minutos = registro1.get('tiempo_disponible_minutos');
        var denominador = (parseFloat(registro2.get('tiempo_corrida')) + parseFloat(tiempoInyeccion)) * registro2.get('numero_inyecciones_muestra');
        var numero_muestras_dia1 = 0;
        if(denominador != 0)
        {
            numero_muestras_dia1 = tiempo_disponible_minutos / denominador;
        }
        numero_muestras_dia1 = clipFloat(numero_muestras_dia1, 3);
        registro3.set('numero_muestras_dia1', numero_muestras_dia1);
        var registro4 = datastore_calculadora4.getAt(0);
        var fraccion_muestra_dia1 = clipFloat(numero_muestras_dia1 - clipFloat(numero_muestras_dia1, 0), 3);
        registro4.set('fraccion_muestra_dia1', fraccion_muestra_dia1);
        registro4.set('fraccion_muestra_dia2', clipFloat(1 - fraccion_muestra_dia1, 3));
    };
  
    var columnHeaderGroup_tab1 = new Ext.ux.grid.ColumnHeaderGroup(
    {
        rows : [[
        {
            header : '<h3>Informaci&oacute;n<br>cambio de m&eacute;todo</h3>',
            colspan : 3,
            align : 'center'
        },
        {
            header : '<h3>Informaci&oacute;n<br>system suitability</h3>',
            colspan : 2,
            align : 'center'
        },
        {
            header : '<h3>Informaci&oacute;n<br>estándares de calibraci&oacute;n</h3>',
            colspan : (inyeccionesEstandarPromedio + 1),
            align : 'center'
        },
        {
            header : '<h3>Inicio y fin<br>de an&aacute;lisis</h3>',
            colspan : 2,
            align : 'center'
        },
        {
            header : '',
            colspan : 1,
            align : 'center'
        },
        {
            header : '',
            colspan : 1,
            align : 'center'
        }
        ]]
    });

    var columns_tab1 = [
    {
        dataIndex : 'id_metodo',
        header : 'Método ',
        tooltip : 'Método ',
        width : 150,
        align : 'center',
        renderer : function(value)
        {
            var index = metodosinorden_datastore.find('codigo', value);
            if(index != -1)
            {
                var record = metodosinorden_datastore.getAt(index);
                var renderer = generarRenderer('#bfbfbf', '#000000', '#bfbfbf', '#000000');
                return renderer(record.get('nombre'));
            } else
{
                return '';
            }
        }
    },
    {
        dataIndex : 'tiempo_entre_metodos',
        header : 'Tiempo entre<br>métodos<br>(Hrs)',
        tooltip : 'Tiempo entre métodos (Horas)',
        width : 80,
        align : 'center',
        editor : new Ext.form.TimeField(
        {
            format : 'H:i:s',
            minValue : '00:00',
            maxValue : '23:59',
            increment : 30
        }),
        renderer : generarRenderer('#ffdc44', '#000000', '#ffdc44', '#000000')
    },
    {
        dataIndex : 'cambio_metodo_ajuste',
        header : 'Cambio método<br>(alistamiento)<br>(Min)',
        tooltip : 'Cambio de método y ajustes',
        width : 90,
        align : 'center',
        editor :
        {
            xtype : 'numberfield',
            allowNegative : false,
            maxValue : 100000
        },
        renderer : generarRenderer('#47d552', '#000000', '#ff5454', '#000000')
    },
    {
        dataIndex : 'tiempo_corrida_ss',
        header : 'T. C.<br>(Min)',
        tooltip : 'Tiempo de corrida',
        width : 55,
        align : 'center',
        editor :
        {
            xtype : 'numberfield',
            allowNegative : false,
            maxValue : 100000
        },
        renderer : generarRenderer('#72a8cd', '#000000', '#ff5454', '#000000')
    },
    {
        dataIndex : 'numero_inyecciones_ss',
        header : 'No.<br>inyec.',
        tooltip : 'N&uacute;mero de inyecciones',
        width : 55,
        align : 'center',
        editor :
        {
            xtype : 'numberfield',
            allowNegative : false,
            maxValue : 100000
        },
        renderer : generarRenderer('#72a8cd', '#000000', '#ff5454', '#000000')
    },
    {
        dataIndex : 'tiempo_corrida_cc',
        header : 'T. C.<br>(Min)',
        tooltip : 'Tiempo de corrida',
        width : 50,
        align : 'center',
        editor :
        {
            xtype : 'numberfield',
            allowNegative : false,
            maxValue : 100000
        },
        renderer : generarRenderer('#72a8cd', '#000000', '#ff5454', '#000000')
    }];

    for(var i = 1; i <= inyeccionesEstandarPromedio; i++)
    {
        columns_tab1.push(
        {
            dataIndex : 'numero_inyecciones_estandar' + i,
            header : 'No.<br>inyec.<br>Std. ' + i,
            tooltip : 'N&uacute;mero de inyecciones del estándar No. ' + i,
            width : 50,
            align : 'center',
            editor :
            {
                xtype : 'numberfield',
                allowNegative : false,
                maxValue : 100000
            },
            renderer : function(valor, metaData, record, rowIndex, colIndex, store)
            {
                if(valor == '0')
                {
                    return '';
                } else
{
                    var renderer = generarRenderer('#72a8cd', '#000000', '#ff5454', '#000000');
                    return renderer(valor, metaData, record, rowIndex, colIndex, store);
                }
            }
        });
    }
  
    columns_tab1.push(
    {
        dataIndex : 'hora_inicio_corrida',
        header : 'Hora<br>inicio corrida',
        tooltip : 'Hora de inicio de corrida',
        width : 75,
        align : 'center',
        editor : new Ext.form.TimeField(
        {
            format : 'H:i:s',
            minValue : '00:00',
            maxValue : '23:59',
            increment : 30
        }),
        renderer : generarRenderer('#f0a05f', '#000000', '#f0a05f', '#000000')
    },
    {
        dataIndex : 'hora_fin_corrida',
        header : 'Hora<br>fin corrida',
        tooltip : 'Hora de inicio de corrida',
        width : 75,
        align : 'center',
        editor : new Ext.form.TimeField(
        {
            format : 'H:i:s',
            minValue : '00:00',
            maxValue : '23:59:59',
            increment : 30
        }),
        renderer : generarRenderer('#f0a05f', '#000000', '#f0a05f', '#000000')
    },
    {
        dataIndex : 'lote',
        header : 'Lote de Muestra',
        tooltip : 'Lote',
        width : 120,
        align : 'center',
        editor :
        {
            xtype : 'textfield'
        },
        renderer : generarRenderer('#d2b48c', '#000000', '#d2b48c', '#000000')
    },
    {
        dataIndex : 'observaciones',
        header : 'Observaciones Muestra',
        tooltip : 'Observaciones',
        width : 180,
        align : 'center',
        editor :
        {
            xtype : 'textfield'
        },
        renderer : generarRenderer('#d2b48c', '#000000', '#d2b48c', '#000000')
    });

    var columnHeaderGroup_tab2 = new Ext.ux.grid.ColumnHeaderGroup(
    {
        rows : [[
        {
            header : '<h3>Nombre de<br>M&eacute;todo</h3>',
            colspan : 1,
            align : 'center'
        },
        {
            header : '<h3>Informaci&oacute;n de muestras</h3>',
            colspan : 18,
            align : 'center'
        }
        ]]
    });


    var columns_tab2 = [];
    columns_tab2.push(
    {
        dataIndex : 'id_metodo',
        header : 'Método ',
        tooltip : 'Método ',
        width : 150,
        align : 'center',
        renderer : function(value)
        {
            var index = metodosinorden_datastore.find('codigo', value);
            if(index != -1)
            {
                var record = metodosinorden_datastore.getAt(index);
                var renderer = generarRenderer('#bfbfbf', '#000000', '#bfbfbf', '#000000');
                return renderer(record.get('nombre'));
            } else
{
                return '';
            }
        }
    },
    {
        dataIndex : 'tiempo_corrida_producto',
        header : '<a style="color:#B80000;">T. C.<br>Producto<br>(Min)</a>',
        tooltip : 'Tiempo de corrida',    
        width : 53,
        align : 'center',
        editor :
        {    
            xtype : 'numberfield',
            allowNegative : false,
            maxValue : 100000
        },
        renderer : generarRenderer('#72a8cd', '#000000', '#ff5454', '#000000')
    },
    {
        dataIndex : 'numero_muestras_producto',
        header : '<a style="color:#B80000;">No. lotes<br>Producto</a>',
        tooltip : 'N&uacute;mero de muestras del producto',
        width : 54,
        align : 'center',
        editor :
        {
            xtype : 'numberfield',
            allowNegative : false,
            maxValue : 100000
        },
        renderer : generarRenderer('#72a8cd', '#000000', '#ff5454', '#000000')
    },
    {
        dataIndex : 'numero_inyecciones_x_muestra_producto',
        header : '<a style="color:#B80000;">No.<br>inyec.<br>x<br>lotes</a>',
        tooltip : 'N&uacute;mero de muestras del producto',
        width : 53,
        align : 'center',
        editor :
        {
            xtype : 'numberfield',
            allowNegative : false,
            maxValue : 100000
        },
        renderer : generarRenderer('#72a8cd', '#000000', '#ff5454', '#000000')
    },
    {
        dataIndex : 'tiempo_corrida_estabilidad',
        header : '<a style="color:#0033CC;">T. C.<br>Estabilidad<br>(Min)</a>',
        tooltip : 'Tiempo de corrida',
        width : 61,
        align : 'center',
        editor :
        {
            xtype : 'numberfield',
            allowNegative : false,
            maxValue : 100000
        },
        renderer : generarRenderer('#72a8cd', '#000000', '#ff5454', '#000000')
    },
    {
        dataIndex : 'numero_muestras_estabilidad',
        header : '<a style="color:#0033CC;">No. lotes<br>Estabilidad</a>',
        tooltip : 'N&uacute;mero de muestras de estabilidad',
        width : 61,
        align : 'center',
        editor :
        {
            xtype : 'numberfield',
            allowNegative : false,
            maxValue : 100000
        },
        renderer : generarRenderer('#72a8cd', '#000000', '#ff5454', '#000000')
    },
    {
        dataIndex : 'numero_inyecciones_x_muestra_estabilidad',
        header : '<a style="color:#0033CC;">No.<br>inyec.<br>x<br>lotes</a>',
        tooltip : 'N&uacute;mero de muestras de estabilidad',
        width : 53,
        align : 'center',
        editor :
        {
            xtype : 'numberfield',
            allowNegative : false,
            maxValue : 100000
        },
        renderer : generarRenderer('#72a8cd', '#000000', '#ff5454', '#000000')
    },
    {
        dataIndex : 'tiempo_corrida_materia_prima',
        header : '<a style="color:#004C00;">T. C.<br>Materia<br>Prima<br>(Min)</a>',
        tooltip : 'Tiempo de corrida',
        width : 48,
        align : 'center',
        editor :
        {
            xtype : 'numberfield',
            allowNegative : false,
            maxValue : 100000
        },
        renderer : generarRenderer('#72a8cd', '#000000', '#ff5454', '#000000')
    },
    {
        dataIndex : 'numero_muestras_materia_prima',
        header : '<a style="color:#004C00;">No. lotes<br>Materia<br>Prima</a>',
        tooltip : 'N&uacute;mero de muestras de materia prima',
        width : 52,
        align : 'center',
        editor :
        {
            xtype : 'numberfield',
            allowNegative : false,
            maxValue : 100000
        },
        renderer : generarRenderer('#72a8cd', '#000000', '#ff5454', '#000000')
    },
    {
        dataIndex : 'numero_inyecciones_x_muestra_materia_prima',
        header : '<a style="color:#004C00;">No.<br>inyec.<br>x<br>lotes</a>',
        tooltip : 'N&uacute;mero de muestras de materia prima',
        width : 53,
        align : 'center',
        editor :
        {
            xtype : 'numberfield',
            allowNegative : false,
            maxValue : 100000
        },
        renderer : generarRenderer('#72a8cd', '#000000', '#ff5454', '#000000')
    },
    {
        dataIndex : 'tiempo_corrida_pureza',
        header : '<a style="color:#8B4513;">T. C.<br>Pureza<br>Cromatográfica<br>(Min)</a>',
        tooltip : 'Tiempo de corrida',
        width : 84,
        align : 'center',
        editor :
        {
            xtype : 'numberfield',
            allowNegative : false,
            maxValue : 100000
        },
        renderer : generarRenderer('#72a8cd', '#000000', '#ff5454', '#000000')
    },
    {
        dataIndex : 'numero_muestras_pureza',
        header : '<a style="color:#8B4513;">No. lotes<br>Pureza<br>Cromatográfica</a>',
        tooltip : 'N&uacute;mero de muestras pureza',
        width : 84,
        align : 'center',
        editor :
        {
            xtype : 'numberfield',
            allowNegative : false,
            maxValue : 100000
        },
        renderer : generarRenderer('#72a8cd', '#000000', '#ff5454', '#000000')
    },
    {
        dataIndex : 'numero_inyecciones_x_muestra_pureza',
        header : '<a style="color:#8B4513;">No.<br>inyec.<br>x<br>lotes</a>',
        tooltip : 'N&uacute;mero de muestras de pureza',
        width : 53,
        align : 'center',
        editor :
        {
            xtype : 'numberfield',
            allowNegative : false,
            maxValue : 100000
        },
        renderer : generarRenderer('#72a8cd', '#000000', '#ff5454', '#000000')
    },
    {
        dataIndex : 'tiempo_corrida_disolucion',
        header : '<a style="color:#006666;">T. C.<br>Disolución<br>(Min)</a>',
        tooltip : 'Tiempo de corrida',
        width : 60,
        align : 'center',
        editor :
        {
            xtype : 'numberfield',
            allowNegative : false,
            maxValue : 100000
        },
        renderer : generarRenderer('#72a8cd', '#000000', '#ff5454', '#000000')
    },
    {
        dataIndex : 'numero_muestras_disolucion',
        header : '<a style="color:#006666;">No. lotes<br>Disolución</a>',
        tooltip : 'N&uacute;mero de muestras disolucion',
        width : 60,
        align : 'center',
        editor :
        {
            xtype : 'numberfield',
            allowNegative : false,
            maxValue : 100000
        },
        renderer : generarRenderer('#72a8cd', '#000000', '#ff5454', '#000000')
    },
    {
        dataIndex : 'numero_inyecciones_x_muestra_disolucion',
        header : '<a style="color:#006666;">No.<br>inyec.<br>x<br>lotes</a>',
        tooltip : 'N&uacute;mero de muestras de disolucion',
        width : 53,
        align : 'center',
        editor :
        {
            xtype : 'numberfield',
            allowNegative : false,
            maxValue : 100000
        },
        renderer : generarRenderer('#72a8cd', '#000000', '#ff5454', '#000000')
    },
    {
        dataIndex : 'tiempo_corrida_uniformidad',
        header : '<a style="color:#E63E00;">T. C.<br>Uniformidad<br>Contenido<br>(Min)</a>',
        tooltip : 'Tiempo de corrida',
        width : 68,
        align : 'center',
        editor :
        {
            xtype : 'numberfield',
            allowNegative : false,
            maxValue : 100000
        },
        renderer : generarRenderer('#72a8cd', '#000000', '#ff5454', '#000000')
    },
    {
        dataIndex : 'numero_muestras_uniformidad',
        header : '<a style="color:#E63E00;">No. lotes<br>Uniformidad<br>Contenido</a>',
        tooltip : 'N&uacute;mero de muestras uniformidad',
        width : 68,
        align : 'center',
        editor :
        {
            xtype : 'numberfield',
            allowNegative : false,
            maxValue : 100000
        },
        renderer : generarRenderer('#72a8cd', '#000000', '#ff5454', '#000000')
    },
    {
        dataIndex : 'numero_inyecciones_x_muestra_uniformidad',
        header : '<a style="color:#E63E00;">No.<br>inyec.<br>x<br>lotes</a>',
        tooltip : 'N&uacute;mero de muestras de uniformidad',
        width : 53,
        align : 'center',
        editor :
        {
            xtype : 'numberfield',
            allowNegative : false,
            maxValue : 100000
        },
        renderer : generarRenderer('#72a8cd', '#000000', '#ff5454', '#000000')
    });
  
  
  
    var columnHeaderGroup_tab3 = new Ext.ux.grid.ColumnHeaderGroup(
    {
        rows : [[
        {
            header : '<h3>Nombre de<br>m&eacute;todo</h3>',
            colspan : 1,
            align : 'center'
        },
        {
            header : '<h3>Informaci&oacute;n de columnas</h3>',
            colspan : 8,
            align : 'center'
        }
        ]]
    });
  
    var columns_tab3 = [];
    columns_tab3.push(
    {
        dataIndex : 'id_metodo',
        header : 'Método ',
        tooltip : 'Método ',
        width : 150,
        align : 'center',
        renderer : function(value)
        {
            var index = metodosinorden_datastore.find('codigo', value);
            if(index != -1)
            {
                var record = metodosinorden_datastore.getAt(index);
                var renderer = generarRenderer('#bfbfbf', '#000000', '#bfbfbf', '#000000');
                return renderer(record.get('nombre'));
            } else
{
                return '';
            }
        }
    },
    {
        dataIndex : 'col_codigo_interno',
        header : 'C&oacute;digo Interno',
        tooltip : 'C&oacute;digo Interno',
        width : 130,
        align : 'center',
        editor : new Ext.form.ComboBox(
        {
            store : columnas_datastore,
            displayField : 'col_cod_interno',
            valueField : 'col_codigo',
            mode : 'local',
            triggerAction : 'all',
            forceSelection : false,
            allowBlank : true,
            focus: function(){
                columnas_datastore.reload();
            }
        }),
        renderer : generarRenderer('#add8e6', '#000000', '#add8e6', '#000000')
    },
    {
        dataIndex : 'etapa_nombre',
        header : 'Etapa',
        tooltip : 'Etapa',
        width : 130,
        align : 'center',
        editor : new Ext.form.ComboBox(
        {
            store : etapas_datastore,
            displayField : 'eta_nombre',
            valueField : 'eta_codigo',
            mode : 'local',
            triggerAction : 'all',
            forceSelection : false,
            allowBlank : true,
            focus: function(){
                etapas_datastore.reload();
            }
        }),
        renderer : generarRenderer('#add8e6', '#000000', '#add8e6', '#000000')
    },
    {
        dataIndex : 'tiempo_retencion',
        header : 'Tiempo Retenci&oacute;n (tr)',
        tooltip : 'Tiempo de Retenci&oacute;n (tr)',
        width : 130,
        align : 'center',
        editor :
        {
            xtype : 'numberfield',
            allowNegative : false,
            maxValue : 100000
        },
        renderer : generarRenderer('#add8e6', '#000000', '#add8e6', '#000000')
    },
    {
        dataIndex : 'platos_teoricos',
        header : 'Platos Te&oacute;ricos (N)',
        tooltip : 'Platos Te&oacute;ricos',
        width : 130,
        align : 'center',
        editor :
        {
            xtype : 'numberfield',
            allowNegative : false,
            maxValue : 10000000
        },
        renderer : generarRenderer('#add8e6', '#000000', '#add8e6', '#000000')
    },
    {
        dataIndex : 'tailing',
        header : 'Factor de Cola (T)',
        tooltip : 'Factor de Cola (T)',
        width : 130,
        align : 'center',
        editor :
        {
            xtype : 'numberfield',
            allowNegative : false,
            maxValue : 10000000
        },
        renderer : generarRenderer('#add8e6', '#000000', '#add8e6', '#000000')
    },
    {
        dataIndex : 'resolucion',
        header : 'Resoluci&oacute;n (R)',
        tooltip : 'Resoluci&oacute;n (R)',
        width : 130,
        align : 'center',
        editor :
        {
            xtype : 'numberfield',
            allowNegative : false,
            maxValue : 10000000
        },
        renderer : generarRenderer('#add8e6', '#000000', '#add8e6', '#000000')
    },
    {
        dataIndex : 'presion',
        header : 'Presi&oacute;n de Sistema (psi)',
        tooltip : 'Presi&oacute;n de Sistema (psi)',
        width : 130,
        align : 'center',
        editor :
        {
            xtype : 'numberfield',
            allowNegative : false,
            maxValue : 10000000
        },
        renderer : generarRenderer('#add8e6', '#000000', '#add8e6', '#000000')
    },
    {
        dataIndex : 'observaciones_col',
        header : 'Observaciones Columna',
        tooltip : 'Observaciones',
        width : 170,
        align : 'center',
        editor :
        {
            xtype : 'textfield'
        },
        renderer : generarRenderer('#add8e6', '#000000', '#add8e6', '#000000')
    });

    var metodo_para_agregar_combobox = new Ext.form.ComboBox({
        store : metodos_datastore,
        emptyText : 'Seleccione un método',
        displayField : 'nombre',
        valueField : 'codigo',
        mode : 'local',
        triggerAction : 'all',
        forceSelection : true,
        allowBlank : false,
        width : 150,
        allQuery: 'nombre',
        disabled: true,
        listeners: {
            'keyup': function() {
                this.store.filter('nombre', this.getRawValue(), true, false);
            },
            'beforequery': function(queryEvent) {
                queryEvent.combo.onLoad();
                return false; 
            }
        }
    });

    var crearRegistroUsoMaquina = function(params)
    {
        Ext.Ajax.request(
        {
            url : getAbsoluteUrl('ingreso_datos', 'crearRegistroUsoMaquina'),
            failure : function()
            {
                recargarDatosMetodos();
            },
            success : function(result)
            {
                recargarDatosMetodos();
                var mensaje = null;
                switch(result.responseText)
                {
                    case 'Ok':
                        break;
                    case '1':
                        mensaje = 'Debe digitar toda la información del método actual para poder adicionar nuevos registros';
                        break;
                    case '2':
                        mensaje = 'No es posible realizar un registro con una fecha pasada';
                        break;
                    case '3':
                        mensaje = 'Su perfil de usuario no está autorizado para crear registros';
                        break;
                }
                if(mensaje != null)
                {
                    Ext.Msg.show(
                    {
                        title : 'Información',
                        msg : mensaje,
                        buttons : Ext.Msg.OK,
                        icon : Ext.MessageBox.INFO
                    });
                }
            },
            params : params
        });
    }
    var historial_datastore = new Ext.data.Store(
    {
        proxy : new Ext.data.HttpProxy(
        {
            url : getAbsoluteUrl('ingreso_datos', 'listarRegistrosHistorial'),
            method : 'POST'
        }),
        reader : new Ext.data.JsonReader(
        {
            root : 'data'
        }, [
        {
            name : 'username',
            type : 'string'
        },
        {
            name : 'nombre_campo',
            type : 'string'
        },
        {
            name : 'valor_antiguo',
            type : 'string'
        },
        {
            name : 'valor_nuevo',
            type : 'string'
        },
        {
            name : 'causa',
            type : 'string'
        },
        {
            name : 'fecha',
            type : 'string'
        },
        {
            name : 'hora',
            type : 'string'
        }])
    });

    var recargarDatosHistorial = function()
    {
        //Guarda en sm la grilla seleccionada (Son tres grillas: Info. Método, Info. Muestras e Info. Columnas)        
        var activeTab = pestanas_grilla.getActiveTab();
        var sm;
        if (activeTab.id == 1) {
            sm = grid_tab1.getSelectionModel();
        }
        if (activeTab.id == 2) {
            sm = grid_tab2.getSelectionModel();
        }
        if (activeTab.id == 3) {
            sm = grid_tab3.getSelectionModel();
        }
        
        var cell = sm.getSelectedCell();
        var index = cell[0];
        var registro = datastore.getAt(index);    
        historial_datastore.load(
        {
            params :
            {
                'codigo_rum' : registro.get('id_registro_uso_maquina')
            }
        });
    }
  
    var grillaHistorial = new Ext.grid.GridPanel(
    {
        autoWidth : true,
        height : 400,
        //autoHeight: true,
        store : historial_datastore,
        stripeRows : true,
        loadMask :
        {
            msg : 'Cargando...'
        },
        sm : new Ext.grid.RowSelectionModel(
        {
            singleSelect : true
        }),
        columns : [
        {
            dataIndex : 'username',
            header : 'Nombre de usuario',
            tooltip : 'Nombre de usuario',
            width : 150,
            align : 'center'
        },
        {
            dataIndex : 'nombre_campo',
            header : 'Nombre del campo',
            tooltip : 'Nombre del campo',
            width : 140,
            align : 'center'
        },
        {
            dataIndex : 'valor_antiguo',
            header : 'Valor anterior',
            tooltip : 'Valor anterior',
            width : 80,
            align : 'center'
        },
        {
            dataIndex : 'valor_nuevo',
            header : 'Valor nuevo',
            tooltip : 'Valor nuevo',
            width : 80,
            align : 'center'
        },
        {
            dataIndex : 'fecha',
            header : 'Fecha',
            tooltip : 'Fecha',
            width : 80,
            align : 'center'
        },
        {
            dataIndex : 'hora',
            header : 'Hora',
            tooltip : 'Hora',
            width : 80,
            align : 'center'
        },
        {
            dataIndex : 'causa',
            header : 'Causa',
            tooltip : 'Causa',
            width : 140,
            align : 'center'
        }]
    });

    var winHistorial = new Ext.Window(
    {
        applyTo : 'ventana_flotante_historial',
        layout : 'fit',
        width : 800,
        height : 300,
        closeAction : 'hide',
        plain : true,
        title : 'Historial de cambios',
        items : grillaHistorial,
        buttons : [
        {
            text : 'Aceptar',
            handler : function()
            {
                winHistorial.hide();
            }
        }],
        listeners :
        {
            hide : function()
            {
                Ext.getBody().unmask();
            }
        }
    });

    var mostrarMensajeModificarRegistro = function(respuesta)
    {
        var mensaje = null;
        switch(respuesta)
        {
            case 'Ok':
                break;
            case '1':
                mensaje = 'Su perfil no está autorizado para modificar registros con antigüedad superior a un (1) día';
                break;
            case 'Ahorro_TF':
                mensaje = 'Verifique que la hora de finalización ingresada sea correcta';
                break;
        }
        if(mensaje != null)
        {
            Ext.Msg.show(
            {
                title : 'Información',
                msg : mensaje,
                buttons : Ext.Msg.OK,
                icon : Ext.MessageBox.INFO
            });
        }
    }
    var modificarRegistroUsoMaquina = function(idRegistro, nombreCampo, valorCampo, par, params, callback)
    {
        if(par)
        {
            params['id_registro_uso_maquina'] = idRegistro;
            params[nombreCampo] = valorCampo;
            Ext.Ajax.request(
            {
                url : getAbsoluteUrl('ingreso_datos', 'modificarRegistroUsoMaquina'),
                failure : function()
                {
                    recargarDatosMetodos(callback);
                },
                success : function(result)
                {
                    recargarDatosMetodos(callback);
                    mostrarMensajeModificarRegistro(result.responseText);
                },
                params : params
            });
        } else
{
            params['id_registro_uso_maquina'] = idRegistro;
            params[nombreCampo + '_perdida'] = valorCampo;
            Ext.Ajax.request(
            {
                url : getAbsoluteUrl('ingreso_datos', 'modificarRegistroUsoMaquina'),
                failure : function()
                {
                    recargarDatosMetodos(callback);
                },                
                success : function(result)
                {
                    recargarDatosMetodos(callback);
                    mostrarMensajeModificarRegistro(result.responseText);
                },
                params : params
            });
        }
    }
  
  
    var grid_tab1 = new Ext.grid.EditorGridPanel(
    {
        //    autoWidth : true,
        region : 'center',
        height: 305,
        //    autoHeight: true,
        store : datastore,
        stripeRows : true,
        frame : true,
        border : true,
        autoScroll : true,
        columnLines : true,
        disabled : true,
        loadMask :
        {
            msg : 'Cargando...'
        },
        plugins : columnHeaderGroup_tab1,
        columns : columns_tab1,
        listeners :
        {
            afteredit : function(e)
            {
                var row = null;
                var column = null;
                var sm = grid_tab1.getSelectionModel();
                if(sm.hasSelection())
                {
                    var cell = sm.getSelectedCell();
                    var row = cell[0];
                    var column = cell[1];
                    var cm = grid_tab1.getColumnModel();
                    if(column == (cm.getColumnCount() - 1))
                    {
                        if(row == (datastore.getCount() - 1))
                        {
                            column = 0;
                            row = 0;
                        } else
                        {
                            column = 0;
                            row++;
                        }
                    } else
                    {
                        column++;
                    }
                }
                var callback = function()
                {
                    sm.select(row, column);
                }
                var par = (e.row % 2) == 0;
                var params =
                {
                };

                if(esAdministrador)
                {
                    Ext.Msg.prompt('Modificando...', 'Digite la causa de la modificación', function(btn, text, op)
                    {
                        if(btn == 'ok')
                        {
                            params['causa'] = text;
                            modificarRegistroUsoMaquina(e.record.get('id_registro_uso_maquina'), e.field, e.value, par, params, callback);
                        } else
                        {
                            recargarDatosMetodos(function()
                            {
                                });
                        }
                    });          
                } else
                {
                    modificarRegistroUsoMaquina(e.record.get('id_registro_uso_maquina'), e.field, e.value, par, params, callback);
                }        
            }
        }
    });
  
  
    var grid_tab2 = new Ext.grid.EditorGridPanel(
    {
        //    autoWidth : true,
        region : 'center',
        height: 305,
        //    autoHeight: true,
        store : datastore,
        stripeRows : true,
        frame : true,
        border : true,
        autoScroll : true,
        columnLines : true,
        disabled : true,
        loadMask :
        {
            msg : 'Cargando...'
        },
        plugins : columnHeaderGroup_tab2,    
        columns : columns_tab2,
        listeners :
        {
            afteredit : function(e)
            {
                var sm = grid_tab2.getSelectionModel();
                if(sm.hasSelection())
                {                    
                    var cell = sm.getSelectedCell();
                    var row = cell[0];
                    var column = cell[1];
                    var cm = grid_tab2.getColumnModel();
          
                    if(column == (cm.getColumnCount() - 1))
                    {
                        if(row == (datastore.getCount() - 1))
                        {
                            column = 0;
                            row = 0;
                        } else
                        {
                            column = 0;
                            row++;
                        }
                    } else
                    {
                        column++;
                    }
                    
                    //Cambios: 24 de febrero de 2014
                    //Cuando se modifica el número de lotes de una reinyección se abre la interfaz para la edición de eventos
                    //Número de la columna (El número de columnas inicia desde uno)
                    var number_col = grid_tab2.getColumnModel().getColumnId(column);
                    //Se verifica si la fila es par o impar (El número de filas inicia desde cero)
                    var par_impar = (e.row % 2);
                    if((par_impar == 1) && ((number_col==3)||(number_col==6)||(number_col==9)||(number_col==12)||(number_col==15)||(number_col==18))) {
                        //Se abre la interfaz para el ingreso del evento de Reinyección
                        recargarDatosEventos();
                        Ext.getBody().mask();
                        win.show();
                    }
                }
                
                var callback = function() {
                    sm.select(row, column);
                }
                var par = (e.row % 2) == 0;
                var params = { };

                if(esAdministrador)
                {
                    Ext.Msg.prompt('Modificando...', 'Digite la causa de la modificación', function(btn, text, op)
                    {            
                        if(btn == 'ok')
                        {
                            params['causa'] = text;
                            modificarRegistroUsoMaquina(e.record.get('id_registro_uso_maquina'), e.field, e.value, par, params, callback);
                        } else
                        {
                            recargarDatosMetodos(function() { });
                        }            
                    });
                } else
                {          
                    modificarRegistroUsoMaquina(e.record.get('id_registro_uso_maquina'), e.field, e.value, par, params, callback);
                }
                
                
                
                
            }
        }
    });
  
    var grid_tab3 = new Ext.grid.EditorGridPanel(
    {
        //    autoWidth : true,
        region : 'center',
        height: 305,
        //    autoHeight: true,
        store : datastore,
        stripeRows : true,
        frame : true,
        border : true,
        autoScroll : true,
        columnLines : true,
        disabled : true,
        loadMask :
        {
            msg : 'Cargando...'
        },
        plugins : columnHeaderGroup_tab3,    
        columns : columns_tab3,
        listeners :
        {
            afteredit : function(e)
            {
                var row = null;
                var column = null;
                var sm = grid_tab3.getSelectionModel();
                if(sm.hasSelection())
                {
                    var cell = sm.getSelectedCell();
                    var row = cell[0];
                    var column = cell[1];
                    var cm = grid_tab3.getColumnModel();
                    if(column == (cm.getColumnCount() - 1))
                    {
                        if(row == (datastore.getCount() - 1))
                        {
                            column = 0;
                            row = 0;
                        } else
{
                            column = 0;
                            row++;
                        }
                    } else
{
                        column++;
                    }
                }
                var callback = function()
                {
                    sm.select(row, column);
                }
                var par = (e.row % 2) == 0;
                var params =
                {
                };

                if(esAdministrador)
                {
                    Ext.Msg.prompt('Modificando...', 'Digite la causa de la modificación', function(btn, text, op)
                    {
                        if(btn == 'ok')
                        {
                            params['causa'] = text;
                            modificarRegistroUsoMaquina(e.record.get('id_registro_uso_maquina'), e.field, e.value, par, params, callback);
                        } else
{
                            recargarDatosMetodos(function()
                            {
                                });
                        }
                    });
                } else
{
                    modificarRegistroUsoMaquina(e.record.get('id_registro_uso_maquina'), e.field, e.value, par, params, callback);
                }
            }
        }
    });  
  
  

    var horaField = new Ext.form.TextField(
    {
        xtype : 'textfield',
        fieldLabel : 'Hora',
        width : 97,
        // value: horas + ':' + minutos,
        readOnly : true
    });

    var actualizarHora = function()
    {
        var fechaActual = new Date();

        var segundos = '' + fechaActual.getSeconds();
        if(segundos.length == 1)
        {
            segundos = '0' + segundos;
        }
        var minutos = '' + fechaActual.getMinutes();
        if(minutos.length == 1)
        {
            minutos = '0' + minutos;
        }
        var horas = '' + fechaActual.getHours();
        if(horas.length == 1)
        {
            horas = '0' + horas;
        }

        horaField.setValue(horas + ':' + minutos + ':' + segundos);
    }
    var operario_field = null;

    var identificacion_field = new Ext.form.TextField(
    {
        name : 'identificacion',
        fieldLabel : 'Identificación',
        readOnly : true
    });

    if(esAdministrador)
    {
        var operarios_datastore = new Ext.data.Store(
        {
            proxy : new Ext.data.HttpProxy(
            {
                url : getAbsoluteUrl('ingreso_datos', 'listarOperarios'),
                method : 'POST'
            }),
            reader : new Ext.data.JsonReader(
            {
                root : 'data'
            }, [
            {
                name : 'codigo',
                type : 'string'
            },
            {
                name : 'nombre',
                type : 'string'
            },
            {
                name : 'identificacion',
                type : 'string'
            }])
        });
    
        operario_field = new Ext.form.ComboBox(
        {
            fieldLabel : 'Analista',
            store : operarios_datastore,
            displayField : 'nombre',
            valueField : 'codigo',
            mode : 'local',
            triggerAction : 'all',
            forceSelection : true,
            allowBlank : false,
            width : 130,
            listeners :
            {
                select : function(combo, registro, indice)
                {
                    identificacion_field.setValue(registro.get('identificacion'));
                    recargarDatosMetodos();
                }
            }
        });

        operarios_datastore.load(
        {
            callback : function()
            {
                operarios_datastore.loadData(
                {
                    data : [
                    {
                        'codigo' : '-1',
                        'nombre' : 'TODOS',
                        'identificacion' : ''
                    }]
                }, true);
                operario_field.setValue('-1');
            }
        });
    } else
{
        operario_field =
        {
            xtype : 'textfield',
            name : 'nombre',
            fieldLabel : 'Analista',
            readOnly : true
        };
    }
  
    var pestanas_grilla = new Ext.TabPanel({
        xtype: 'tabpanel',
        autoHeight: true,
        activeTab: 0,
        items: [{
            id: 1,
            title: 'Información de Método',
            border: false,
            width: '1400',
            items: [grid_tab1]
        }, {
            id: 2,
            title: 'Información de Muestras',
            border: false,
            items: [grid_tab2]
        }, {
            id: 3,
            title: 'Información de Columnas',
            border: false,
            items: [grid_tab3]
        }],
        listeners: {
            tabchange: function(){
                redirigirSiSesionExpiro();
            }
        }
    });

    var panelPrincipal = new Ext.FormPanel(
    {
        border : false,
        frame : false,
        layout : 'border',
        region : 'center',
        items : [
        {
            border : true,
            frame : true,
            height : 99,
            region : 'north',
            items : [
            {
                height : 60,
                layout : 'column',
                items : [
                {
                    width : '240',
                    layout : 'form',
                    labelWidth : 70,
                    footer : false,
                    items : [operario_field, maquina_combobox]
                },
                {
                    width : '265',
                    footer : false,
                    layout : 'form',
                    labelWidth : 85,
                    items : [identificacion_field, codigo_maquina]
                },
                {
                    width : '200',
                    layout : 'form',
                    labelWidth : 50,
                    items : [fechaField, horaField]
                },
                {
                    width : '160',
                    layout : 'form',
                    items : [
                    {
                        xtype : 'panel',
                        padding : '0px 0px 4px 0px',
                        items : [genral_tema_combobox]
                    },
                    {
                        xtype : 'panel',
                        columnWidth : '.5',
                        items : [
                        {
                            xtype : 'button',
                            text : 'Reportes',
                            tooltip : 'Pulse este botón para ver los reportes',
                            width : 70,
                            iconCls : 'reportes',
                            handler : function()
                            {
                                redirigirSiSesionExpiro();
                                window.open(getAbsoluteUrl('interfaz_reporte', 'index'));
                            }
                        }]
                    }]
                },
                {
                    width : '150',
                    layout : 'form',
                    padding : '0px 0px 0px 10px',
                    hideLabel : true,
                    items : [
                    {
                        padding : '0px 0px 4px 0px',
                        items : [            
                        {
                            xtype : 'button',
                            text : 'Salir',
                            tooltip : 'Pulse este botón para salir del sistema',
                            width : 60,
                            iconCls : 'salir',
                            handler : function()
                            {
                                cerrarSesion();
                            }
                        }
                        ]
                    },
                    {
                        columnWidth : '.5',
                        xtype : 'panel',
                        items : [
                        {
                            xtype : 'button',
                            text : 'Manual',
                            iconCls : 'abrir_manual',
                            tooltip : 'Pulse este botón para ver el manual',
                            width : 60,
                            handler : function()
                            {
                                window.open(urlWeb + 'manual-tpm/main.html');
                            }
                        }
                        ]
                    }]
                }]
            }, 
            {
                //Barra con los botones para el registro y eliminación de un método y para gestión de eventos
                border : true,
                frame : false,
                tbar : [metodo_para_agregar_combobox,
                {
                    text : 'Agregar registro',
                    iconCls : 'agregar',          
                    handler : function()
                    {
                        var codigo_equipo = maquina_combobox.getValue();
                        if(codigo_equipo == '') {                
                            Ext.Msg.show(
                            {
                                title : 'Información',
                                msg : 'Primero debe seleccionar un equipo',
                                buttons : Ext.Msg.OK,
                                icon : Ext.MessageBox.INFO
                            });
                            maquina_combobox.focus();
                        }
            
                        var codigo_metodo = metodo_para_agregar_combobox.getValue();            
                        if(codigo_metodo == '' && codigo_equipo != '') {                
                            metodo_para_agregar_combobox.focus();
                            Ext.Msg.show(
                            {
                                title : 'Información',
                                msg : 'Primero debe seleccionar un método',
                                buttons : Ext.Msg.OK,
                                icon : Ext.MessageBox.INFO
                            });
                            metodo_para_agregar_combobox.focus();
                        } else
{
                            var params =
                            {
                                'id_metodo' : codigo_metodo,
                                'codigo_maquina' : maquina_combobox.getValue(),
                                'fecha' : fechaField.getValue()
                            };
                            crearRegistroUsoMaquina(params);
                        }
                    }
                }, '-',
                {
                    text : 'Eliminar registro',
                    iconCls : 'eliminar',
                    handler : function()
                    {
                        var activeTab = pestanas_grilla.getActiveTab();
                        var sm;
                        if (activeTab.id == 1) {
                            sm = grid_tab1.getSelectionModel();
                        }
                        if (activeTab.id == 2) {
                            sm = grid_tab2.getSelectionModel();
                        }
                        if (activeTab.id == 3) {
                            sm = grid_tab3.getSelectionModel();
                        }
                        if(sm.hasSelection())
                        {
                            Ext.Msg.confirm('Eliminar método', "Esta operación es irreversible. ¿Está seguro(a) de querer eliminar este método?", function(idButton)
                            {
                                if(idButton == 'yes')
                                {
                                    var cell = sm.getSelectedCell();
                                    var index = cell[0];
                                    var registro = datastore.getAt(index);
                                    Ext.Msg.prompt('Eliminar método', 'Digite la causa de la eliminación de este método', function(idButton, text)
                                    {
                                        if(idButton == 'ok')
                                        {
                                            Ext.Ajax.request(
                                            {
                                                url : getAbsoluteUrl('ingreso_datos', 'eliminarRegistroUsoMaquina'),
                                                failure : function()
                                                {
                                                    recargarDatosMetodos();
                                                },
                                                success : function(result)
                                                {
                                                    recargarDatosMetodos();
                                                    if(result.responseText != 'Ok')
                                                    {
                                                        alert(result.responseText);
                                                    }
                                                },
                                                params :
                                                {
                                                    'id_registro_uso_maquina' : registro.get('id_registro_uso_maquina'),
                                                    'causa' : text
                                                }
                                            });
                                        }
                                    });
                                }
                            });
                        } else
{
                            Ext.Msg.show(
                            {
                                title : 'Información',
                                msg : 'Primero debe seleccionar un método',
                                buttons : Ext.Msg.OK,
                                icon : Ext.MessageBox.INFO
                            });
                        }
                    }
                }, '-',
                {
                    text : 'Editar eventos',
                    iconCls : 'evento',
                    handler : function()
                    {
                        var sm1 = grid_tab1.getSelectionModel();
                        var sm2 = grid_tab2.getSelectionModel();
                        var sm3 = grid_tab3.getSelectionModel();            
                        if(sm1.hasSelection() || sm2.hasSelection() || sm3.hasSelection())
                        {
                            recargarDatosEventos();
                            Ext.getBody().mask();
                            win.show();
                        } else
{
                            Ext.Msg.show(
                            {
                                title : 'Información',
                                msg : 'Primero debe seleccionar un método',
                                buttons : Ext.Msg.OK,
                                icon : Ext.MessageBox.INFO
                            });
                        }
                    }
                }, '-',
                {
                    text : 'Historial',
                    iconCls : 'historial',
                    handler : function()
                    {
                        var sm1 = grid_tab1.getSelectionModel();
                        var sm2 = grid_tab2.getSelectionModel();
                        var sm3 = grid_tab3.getSelectionModel();            
                        if(sm1.hasSelection() || sm2.hasSelection() || sm3.hasSelection())
                        {
                            recargarDatosHistorial();
                            Ext.getBody().mask();
                            winHistorial.show();
                        } else
{
                            Ext.Msg.show(
                            {
                                title : 'Información',
                                msg : 'Primero debe seleccionar un método',
                                buttons : Ext.Msg.OK,
                                icon : Ext.MessageBox.INFO
                            });
                        }
                    }
                },'-',
                {
                    xtype : 'button',
                    text : 'Dividir registro',
                    iconCls : 'calcular',
                    tooltip : 'Pulse este botón para dividir el último registro del día',
                    width : 70,
                    handler : function()
                    {
                        if(maquina_combobox.isValid() && fechaField.isValid() && maquina_combobox.getValue() != '')
                        {
                            Ext.Ajax.request(
                            {
                                url : getAbsoluteUrl('ingreso_datos', 'dividirRegistro'),
                                failure : function()
                                {
                                },
                                success : function(result)
                                {
                                    var mensaje = '';
                                    switch(result.responseText)
                                    {
                                        case 'Ok':
                                            mensaje = 'El último registro del día fue divido exitosamente';
                                            break;
                                        case '1':
                                            mensaje = 'No es necesario ejecutar el proceso de división debido a que ningún registro ha excedido el tiempo diario';
                                            break;
                                        default:
                                            mensaje = result.responseText;
                                            break;                          
                                    }
                                    recargarDatosMetodos(function()
                                    {
                                        });
                                    alert(mensaje);
                                },
                                params :
                                {
                                    'codigo_maquina' : maquina_combobox.getValue(),
                                    'fecha' : fechaField.getValue()
                                }
                            });
                        }
                    }
                }]
            }]
        }, {
            border : true,
            frame : true,
            region : 'center',      
            items : [
            pestanas_grilla
            ]
        }]
    });

    if(esAdministrador)
    {

    } else
{
        var datos_operario_datastore = new Ext.data.Store(
        {
            proxy : new Ext.data.HttpProxy(
            {
                url : getAbsoluteUrl('ingreso_datos', 'consultarDatosOperario'),
                method : 'POST'
            }),
            reader : new Ext.data.JsonReader(
            {
                root : 'data'
            }, [
            {
                name : 'codigo',
                type : 'string'
            },
            {
                name : 'nombre',
                type : 'string'
            },
            {
                name : 'identificacion',
                type : 'string'
            }])
        });

        datos_operario_datastore.load(
        {
            callback : function()
            {
                panelPrincipal.getForm().loadRecord(datos_operario_datastore.getAt(0));
            }
        });
    }

    actualizarHora();

    window.setInterval(actualizarHora, 1000);

    var interfaz_ingreso_datos = new Ext.Viewport(
    {
        layout : 'border',
        items : [
        {
            height : 48,
            split : true,
            region : 'north',
            xtype : 'box',
            el : 'titulo_ingreso_datos',
            border : false,
            margins : '0 0 0 0'
        }, panelPrincipal,
        {
            region : 'east',
            title : 'Ayudas',
            width : 300,
            border : true,
            collapsible : true,
            collapsed : true,
            split : true,
            layout : 'accordion',
            items : [
            {
                title : 'Conceptos B&aacute;sicos',
                frame : true,
                autoScroll : true,
                autoLoad :
                {
                    url : urlWeb + 'ayudas/Ayuda-Conceptual.html',
                    scripts : true,
                    scope : this
                }
            },
            {
                title : 'Perdidas',
                frame : true,
                autoScroll : true,
                autoLoad :
                {
                    url : urlWeb + 'ayudas/Ayuda-Perdidas.html',
                    scripts : true,
                    scope : this
                }
            },
            {
                title : 'Indicadores',
                frame : true,
                autoScroll : true,
                autoLoad :
                {
                    url : urlWeb + 'ayudas/Ayuda-Indicadores.html',
                    scripts : true,
                    scope : this
                }
            }]
        },
        {
            region : 'south',
            height : 200,
            frame : true,
            collapsible : true,
            collapsed : false,
            split : true,
            layout: 'column',
            items: [{
                columnWidth: '.5',
                id: 'flashcontent'
            },
            {
                columnWidth: '.5',
                id: 'flashcontent1'
            }]
        }]
    });
});