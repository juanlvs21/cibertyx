// -- Loading var
var enero = document.getElementById('enero').value;
var febrero = document.getElementById('febrero').value;
var marzo = document.getElementById('marzo').value;
var abril = document.getElementById('abril').value;
var mayo = document.getElementById('mayo').value;
var junio = document.getElementById('junio').value;
var julio = document.getElementById('julio').value;
var agosto = document.getElementById('agosto').value;
var septiembre = document.getElementById('septiembre').value;
var octubre = document.getElementById('octubre').value;
var noviembre = document.getElementById('noviembre').value;
var diciembre = document.getElementById('diciembre').value;

// -- Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
    datasets: [{
      label: "Solicitudes recibidas",
      backgroundColor: "rgba(2,117,216,1)",
      borderColor: "rgba(2,117,216,1)",
      data: [enero, febrero, marzo, abril, mayo, junio, julio, agosto, septiembre, octubre, noviembre, diciembre],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 12
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 20, /*Limite maximo de la grafica*/
          maxTicksLimit: 5
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
});