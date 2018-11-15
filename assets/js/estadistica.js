'use strict';

//APIS URL
var apiAll = 'http://localhost:1337/Ipasme/Estadisticas/';

//Cargar automaticamente
//window.addEventListener('DOMContentLoaded', getEstadistica, false);

//Elementos HTML
var estadisticas = document.getElementById('estadisticas');
var totales = document.getElementById('totales');
var btn_buscar = document.getElementById('btn_buscar');
var fecha_1 = document.getElementById('fecha_1');
var fecha_2 = document.getElementById('fecha_2');

//llamar evento click
btn_buscar.addEventListener('click', function(){
	getEstadistica(fecha_1.value, fecha_2.value);
});

//Todos los elementos
function getEstadistica(fecha_1, fecha_2){
	 fetch(apiAll+'getDates/'+fecha_1+'/'+fecha_2)
		.then(response => response.json())
		.then(response => {
			response.forEach(e => {
				drawHtml(e, response);
				dibuja(response);
				//console.log(e);
			});
		})
		.catch(e => console.log(e));
}

	const drawHtml = function(e, r){
		//console.log(Object.keys(e.idestudiopac).length);
		console.log(r.length);
		const hero = `
			<div class="alert alert-info" role="alert">
				<h1>${r.length} Personas atendidas</h1>
			</div>
		`;
		totales.innerHTML = hero;
		//graphic_element.insertAdjacentHTML('beforeEnd', hero);
	};

function dibuja(data){
		var cedula = [];
        var nombres = [];
        var apellidos = [];
        var fecha = [];
        
            for(var i=0; i<data.length; i++){
              cedula.push(data[i].cedula);
              nombres.push(data[i].nombres);

              apellidos.push(data[i].apellidos);
              fecha.push(data[i].fecha);
            }
            var series = [{
	          name: nombres[0],
	          data: cedula
	        },
	        {
	          name: nombres[0],
	          data: nombres
	        },
	        {
	          name: nombres[0],
	          data: apellidos
	        },
	        {
	          name: nombres[0],
	          data: fecha
	        }];        	
      
            //Funcion Highcharts
    Highcharts.setOptions({
            lang: {
              thousandsSep: ','
            },
            global: {
              useUTC: true
          }
          });
      Highcharts.chart(estadisticas, {
      chart:{
        type: 'column', //column, spline, areaspline, line, area, arearange, Combination chart, variablepie
        animation: Highcharts.svg,
        marginRight: 0,
            plotShadow: false,
            options3d: {
                enabled: true,
                alpha: 13,
                beta: 0,
                viewDistance: 25
            }
      },

      title :{
          text: "Estadisticas",
          style: {
              fontSize: '14px',
              color : 'black'
          }
      }, 
      legend : { 
          floating: false,
          padding: 0, 
          margin: 5,
          shadow:true
      },
      credits: { 
          enabled: false 
      },
        xAxis: {
            categories: fecha,
            type: 'datetime',
            tickInterval: 1,
               crosshair: true,
               reversed: false,
               maxPadding: 0.05,
               startOnTick: true,
               showFirstLabel: true,
               endOnTick: true,
               showLastLabel: true
        },
        yAxis: {
          type: 'datetime',
              title: {
                  text: 'Datos'
              },
              dateTimeLabelFormats : {
                  second: '%H:%M:%S',
                  minute: '%H:%M',
                  hour: '%H:%M',
                  day: '%e. %b',
                  week: '%e. %b',
                  month: '%b \'%y',
                  year: '%Y'
              },
              tooltipValueFormat: '{value:%H:%M:%S}',
               labels: {
                 allowOverlap: true,
                 overflow: 'justify',
                 formatter: function () {
                      //return this.value + ' ';
                      return Highcharts.numberFormat(this.value, 0, '', ',');
                      //return Highcharts.dateFormat('%H:%M:%S', this.value);
                  }
              },
              min :0,
              reserved:true
          },
          plotOptions: {
            series:{ //line, column, area, pie y el mejor series
            stacking:null,
            allowPointSelect: true,
            depth: 35,
            cursor: 'pointer',
            pointPadding: 0.2,
            borderWidth: 0,
            dataLabels:{
              enabled: true,
                    color: '#000000',
                    backgroundColor: '#FFFFFF',
                    borderWidth: '1',
                    align: 'center',
                    x: 0,
                    y: 0,
                    rotation: 0,
              format: '{point.name}'+ ' ' +'{point.y:,.0f}' , //{point.y:,.0f} o {point.y:.2f},
              //format: '{point.y}'+simbolo[0],
              //format: {point.y:,.0f} o {point.y:.2f},
              style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    },
                formatter:function () {
                    return ''+ Highcharts.dateFormat('%H:%M:%S', this.y);
                }
            },
            showInLegend:true,
            enableMouseTracking:true
            },
            minPointLength: 0,
            stacking: 'normal'
          },
          tooltip:{
            shared: true,
            enabled: true
      },
      series:series,
          formatter:function () {
              return ''+ Highcharts.dateFormat('%H:%M:%S', this.y);
          },
        responsive:{
          rules:[{
            condition:{
              maxWidth: 500
            },
            chartOptions:{
              legend:{
                align: 'center',
                verticalAlign: 'bottom',
                layout: 'horizontal',
                borderWidth:0
              }
            }
          }]
        }
    });
}