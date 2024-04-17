<template>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <div>
      <canvas v-if="monthly" ref="chartCanvas"></canvas>
    </div>
  </template>

<script>
import { Chart } from 'chart.js/auto';

export default {



   props: {
        monthly: {
            type: Object, // Ajusta el tipo de datos según lo que esperas recibir
            required: true // Si es necesario
        },isLoaded1: {
            type: Boolean, // Ajusta el tipo de datos según lo que esperas recibir
            required: true // Si es necesario
        }
    },
  mounted() {
    // Datos para el gráfico
    const chartData = {
      labels: ['E', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D'],
      datasets: [{
        data: this.monthly, // Datos ficticios para cada mes
        backgroundColor: [
          '#B4DAAA'

        ],
        borderRadius: 10,
        barThickness: 15
      }]
    };

    // Opciones para el gráfico
    const options = {
      plugins: {
        title: {
          display: false // Desactiva la visualización del título
        },
        legend: {
          display: false // Desactiva la visualización de la leyenda
        },

      },
      scales: {
        x :{
            ticks: {
            font: {
              family: 'Outfit', // Fuente de los meses
              weight: 'bold', // Peso de la fuente de los meses
              size: 15 // Tamaño de la fuente de los meses
            }
        }
    },
        y: {
          beginAtZero: true,
          ticks: {
            font: {
              family: 'Outfit',
              weight: 'bold',
              size: 15
            }
          },
        }
      },

      elements: {
        bar: {
          borderRadius: 10, // Radio de borde general
          borderSkipped: '' // Aplica el radio de borde solo en la parte inferior de las barras
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
