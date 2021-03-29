<template>
    <app-layout>
        <template #header>
            <ol class="list-reset flex text-grey-dark">
                <inertia-link class="" href="">Home</inertia-link>
            </ol>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <LineChart v-bind:chartData="this.charts" v-bind:chartOptions="chartOptions" />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    import LineChart from '@/Components/LineChart.vue'

    export default {
        components: {
            AppLayout,
            Welcome,
            LineChart,
        },
        data () {
            return {
                // chartData: {
                    // labels: ['Expenses', 'Incomes'],
                    /* datasets: [
                        {
                            label: 'Human 1',
                            data: [20]
                        },
                        {
                            label: 'Human 2',
                            data: [10]
                        }
                    ] */
                    /* datasets: [
                        {
                            'label': 'Data One',
                            'backgroundColor': '#f87979',
                            'data': [{x: moment("3/3/2021", "DD/MM/YYYY"), y: 100}]
                        },
                        {
                            'label': 'Data two',
                            'backgroundColor': '#f87999',
                            'data': [{x: moment("4/4/2021", "DD/MM/YYYY"), y: 500}]
                        },
                    ] */
                // },
                chartOptions: {
                    responsive: true,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: 10000
                            },
                            gridLines: {
                                display: true
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'MYR'
                            }
                        }],
                        xAxes: [{
                            type: 'time',
                            time: {
                                unit: "month"
                            },
                            gridLines: {
                                display: false
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Month'
                            }
                        }]
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: true,
                    },
                }
            }
        },
        props: {
            charts: Object,
        },
        mounted () {
            console.log(this.charts);
        }
    }
</script>
