<template>
    <div>
      <canvas ref="chartCanvas"></canvas>
    </div>
  </template>

<script>
import { Chart } from 'chart.js/auto';

export default {
  mounted() {
    // Datos para el gráfico
    const chartData = {
      labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      datasets: [{
        label: 'Pedidos por mes',
        data: [120, 150, 180, 200, 250, 280, 300, 280, 250, 220, 180, 150], // Datos ficticios para cada mes
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 2
      }]
    };

    // Opciones para el gráfico
    const options = {
      scales: {
        x :{
            ticks: {
            font: {
              size: 5 // Tamaño de la fuente de los meses
            }
        }
    },
        y: {
          beginAtZero: true
        }
      }
    };

    // Renderizamos el gráfico
    new Chart(this.$refs.chartCanvas.getContext('2d'), {
      type: 'bar', // Tipo de gráfico
      data: chartData,
      options: options
    });
  }
};
</script>
