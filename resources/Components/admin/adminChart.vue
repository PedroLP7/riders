<template>
    <div>
        <canvas ref="chartCanvas" v-if="chartData"></canvas>
    </div>
</template>

<script>
import { Chart, Legend } from 'chart.js/auto';
import axios from 'axios';

export default {
    data() {
        return {
            chartData: []
        };
    },

        methods : {
            getChartData() {
                const me = this;
                axios.get('/admin/getStats1')
                    .then(response => {

                        me.chartData = response.data;
                        console.log(this.chartData);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        },
        created() {
            this.getChartData();
        },
    mounted() {
        // Datos para el gráfico
        const chartData = {
            labels: ['Knoweats', 'Wetaka', 'Koyo', 'Spacca', 'Hideout'],
            datasets: [{
                label: 'Packs donados ',
                data: [50, 24, 10, 30, 5], // Datos ficticios
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Opciones para el gráfico
        const options = {
            plugins: {
        legend: {
            labels: {
                color: 'white' // Cambiar el color del texto a blanco
            }
        }
    }

        };

        // Renderizamos el gráfico
        new Chart(this.$refs.chartCanvas.getContext('2d'), {
            type: 'doughnut',
            data: chartData,
            options: options
        });
    }
};
</script>


