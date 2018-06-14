
function cambiar_fecha_grafica(){

    var anio_sel=$("#anio_sel").val();
    var mes_sel=$("#mes_sel").val();

    cargar_grafica_barras(anio_sel,mes_sel);
    cargar_grafica_lineas(anio_sel,mes_sel);
    cargar_grafica_barras_modules(anio_sel,mes_sel);
}



function cargar_grafica_barras(anio,mes){

    var options={
        chart: {
            renderTo: 'div_grafica_barras',
            type: 'column'
        },
        title: {
            text: 'Estado de las Incidencias'
        },
        xAxis: {
            categories: [],
            title: {
                text: 'PROYECTOS O EMPRESAS'
            },
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'NUMERO DE INCIDENCIAS'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Incidencias registradas',
            data: []
        },{
            name: 'Incidencias resueltas',
            data: []
        },{
            name: 'Incidencias pendientes',
            data: []
        },{
            name: 'Severidad menor',
            data: []
        },{
            name: 'Severidad normal',
            data: []
        },{
            name: 'Severidad alta',
            data: []
        },{
            name: 'Numero de Niveles asignados',
            data: []
        },{
            name: 'Numero de Modulos donde se reporto',
            data: []
        }]
    }

    $("#div_grafica_barras").html( $("#cargador_empresa").html() );

    var url = "estadisticas/incidencias/"+anio+"/"+mes+"";

    $.get(url,function(resul){
        var datos= jQuery.parseJSON(resul);
        var numproyectos=datos.numproyectos;
        var proyectosinc=datos.proyectosinc;
        var resueltas=datos.resueltas;
        var pendientes=datos.pendientes;
        var menor=datos.menor;
        var normal=datos.normal;
        var alta=datos.alta;
        var niveles=datos.niveles;
        var categorias=datos.categorias;
        //var nombres=datos.nombres;
        //var i=0;
        for(i=1;i<=numproyectos;i++){    
            options.series[0].data.push( proyectosinc[i] );        
            options.series[1].data.push( resueltas[i] );
            options.series[2].data.push( pendientes[i] );
            options.series[3].data.push( menor[i] );
            options.series[4].data.push( normal[i] );
            options.series[5].data.push( alta[i] );
            options.series[6].data.push( niveles[i] );
            options.series[7].data.push( categorias[i] );
            
                    
            options.xAxis.categories.push(i);
        }
        //options.title.text="aqui e podria cambiar el titulo dinamicamente";
        chart = new Highcharts.Chart(options);
    })
}

function cargar_grafica_barras_modules(anio,mes){

    var options={
     chart: {
        renderTo: 'div_grafica_barras_modules',
        type: 'column'
    },
    title: {
        text: 'Incidencias por Modulo'
    },
    xAxis: {
        categories: [],
        title: {
            text: 'MODULOS'
        },
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'NUMERO DE INCIDENCIAS'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
        '<td style="padding:0"><b>{point.y} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Incidencias registradas',
        data: []
    }]
}

$("#cargar_grafica_barras_modules").html( $("#cargador_empresa").html() );

var url = "estadisticas/modulos/"+anio+"/"+mes+"";

$.get(url,function(resul){
    
    var datos= jQuery.parseJSON(resul);
    var nummodulos=datos.nummodulos;
    var modulosinc=datos.modulosinc;
    
    //var i=0;
    for(i=1;i<=nummodulos;i++){    
        options.series[0].data.push( modulosinc[i] );
        options.xAxis.categories.push(i);
    }
    //options.title.text="aqui e podria cambiar el titulo dinamicamente";
    
    chart = new Highcharts.Chart(options);

})
}



function cargar_grafica_lineas(anio,mes){
    var options={
         chart: {
                renderTo: 'div_grafica_lineas',
               
            },
              title: {
                text: 'Numero de Registros en el Mes',
                x: -20 //center
            },
            xAxis: {
                categories: [],
                title: {
                    text: 'DIAS DEL MES'
                },
                crosshair: true
            },
            yAxis: {
                title: {
                    text: 'REGISTROS POR DIA'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: ' registros'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'Incidencias registradas',
                data: []
            },{
                name: 'Usuarios Registrados',
                data: []
            },{
                name: 'Nuevos Clientes',
                data: []
            },{
                name: 'Proyectos Creados',
                data: []
            }]
    }

    $("#div_grafica_lineas").html( $("#cargador_empresa").html() );
    var url = "estadisticas/"+anio+"/"+mes+"";
    $.get(url,function(resul){
        var datos= jQuery.parseJSON(resul);
        var totaldias=datos.totaldias;
        var incidenciasdia=datos.incidenciasdia;
        var usuariosdia=datos.usuariosdia;
        var clientesdia=datos.clientesdia;
        var proyectosdia=datos.proyectosdia;
        var i=0;
        for(i=1;i<=totaldias;i++){    
            options.series[0].data.push( incidenciasdia[i] );
            options.series[1].data.push( usuariosdia[i] );    
            options.series[2].data.push( clientesdia[i] );    
            options.series[3].data.push( proyectosdia[i] );    
            options.xAxis.categories.push(i);
        }
        //options.title.text="aqui e podria cambiar el titulo dinamicamente";
        chart = new Highcharts.Chart(options);

    })
}



