'use strict';

//APIS URL
var apiAll = 'http://localhost:1337/Ipasme/Estadisticas/';

//Cargar automaticamente
//window.addEventListener('DOMContentLoaded', getEstadistica, false);

//Elementos HTML
var estadisticas = document.getElementById('estadisticas');
var totales = document.getElementById('totales');
var genero = document.getElementById('genero');
var edades = document.getElementById('edades');
var tipospacientes = document.getElementById('tipospacientes');
var especialidad = document.getElementById('especialidad');
var btn_buscar = document.getElementById('btn_buscar');
var fecha_1 = document.getElementById('fecha_1');
var fecha_2 = document.getElementById('fecha_2');

//llamar evento click
btn_buscar.addEventListener('click', function(){
  porFecha(fecha_1.value, fecha_2.value);
  porGenero(fecha_1.value, fecha_2.value);
  porEdad(fecha_1.value, fecha_2.value);
  porTipo(fecha_1.value, fecha_2.value);
	porEstudio(fecha_1.value, fecha_2.value);
});

//Todos los elementos
const porFecha = (fecha_1, fecha_2) => {
	 fetch(apiAll+'getDates/'+fecha_1+'/'+fecha_2)
		.then(response => response.json())
		.then(response => {
          try{
			    response.forEach(e => {
				    drawHtmlTodos(e, response);
				    dibuja(response);
			    });
            }catch(err){
                console.log(err);
            }
		})
		.catch(e => console.log(e));
}
	const drawHtmlTodos = (e, r) => {     
		const hero = `
			<div class="alert alert-info" role="alert">
				<h3>Personas atendidas total: ${r.length}</h3>
			</div>
		`;
		if(r.length >= 1){
      totales.innerHTML = hero; 
    }
	};

//Generos
const porGenero = (fecha_1, fecha_2) => {
   fetch(apiAll+'getGender/'+fecha_1+'/'+fecha_2)
    .then(response => response.json())
    .then(response => {
          try{
          response.forEach(e => {
            drawHtmlGenero(e, response);
          });
            }catch(err){
                console.log(err);
            }
    })
    .catch(e => console.log(e));
}
  const drawHtmlGenero = (e, r) => {    
    const hero = `
      <div class="alert alert-info" role="alert">
        <h3>Femenino: ${e.Femenino} Masculino: ${e.Masculino}</h3>
      </div>
    `;
    if(r.length >= 1){
      genero.innerHTML = hero; 
    }
  };

//Edades
const porEdad = (fecha_1, fecha_2) => {
   fetch(apiAll+'getAge/'+fecha_1+'/'+fecha_2)
    .then(response => response.json())
    .then(response => {
          try{
          response.forEach(e => {
            drawHtmlEdad(e, response);
          });
            }catch(err){
                console.log(err);
            }
    })
    .catch(e => console.log(e));
}
  const drawHtmlEdad = (e, r) => {    
    const hero = `
      <div class="alert alert-info" role="alert">
        <h3>Niños: ${e.Niños} Adultos: ${e.Adultos} Adultos mayores: ${e.TerceraEdad}</h3>
      </div>
    `;
    if(r.length >= 1){
      edades.innerHTML = hero; 
    }
  };

//Tipos
const porTipo = (fecha_1, fecha_2) => {
   fetch(apiAll+'getType/'+fecha_1+'/'+fecha_2)
    .then(response => response.json())
    .then(response => {
          try{
          response.forEach(e => {
            drawHtmlTipo(e, response);
          });
            }catch(err){
                console.log(err);
            }
    })
    .catch(e => console.log(e));
}
  const drawHtmlTipo = (e, r) => {    
    const hero = `
      <div class="alert alert-info" role="alert">
        <h3>Afiliados: ${e.Afiliado} Beneficiados: ${e.Beneficiado} Comunitarios: ${e.Comunitario}</h3>
      </div>
    `;
    if(r.length >= 1){
      tipospacientes.innerHTML = hero; 
    }
  };

//Por estudios
const porEstudio = (fecha_1, fecha_2) => {
   fetch(apiAll+'getStudio/'+fecha_1+'/'+fecha_2)
    .then(response => response.json())
    .then(response => {
          try{
          response.forEach(e => {
            drawHtmlStudio(e, response);
          });
            }catch(err){
                console.log(err);
            }
    })
    .catch(e => console.log(e));
}
  const drawHtmlStudio = (e, r) => {
  console.log(e);   
    const hero = `
      <div class="alert alert-info" role="alert">
        <ul>
          <li><h3>Estudio: ${e.nombre} Total: ${e.idestudiopac}</h3></li>
        </ul>
        
      </div>
    `;
    if(r.length >= 1){
      //especialidad.innerHTML = hero; 
      especialidad.insertAdjacentHTML('beforeEnd', hero);
    }
  };

const dibuja = (data) => {
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
                name:'Pacientes',
                data: [
                    cedula[0],cedula[1],cedula[2],cedula[3],cedula[4],cedula[5],cedula[6],cedula[7],
                    cedula[8],cedula[9],cedula[10],cedula[11],cedula[12],cedula[13],cedula[14],cedula[15],
                    cedula[16],cedula[17],cedula[18],cedula[19],cedula[20],cedula[21],cedula[22],cedula[23],
                    cedula[24],cedula[25],cedula[26],cedula[27],cedula[28],cedula[29],cedula[30],cedula[31],
                ]
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
          text: "Estadísticas",
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
                    y: 40,
                    rotation: -90,
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