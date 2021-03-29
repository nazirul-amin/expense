<template>
    <app-layout>
        <template #header>
            <ol class="list-reset flex text-grey-dark">
                <inertia-link class="" href="">Home</inertia-link>
            </ol>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="height: 100%;">
                    <!-- <ul v-for="activity in activities">
                        <li>Account with name: {{activity.properties.attributes.name}} and balance: {{activity.properties.attributes.balance}} has been {{activity.description}} (created at {{activity.properties.attributes.created_at}} updated at {{activity.properties.attributes.updated_at}})</li>
                    </ul> -->
                    <!-- <section style="height: 70vh; background: #f1f1f1; "> -->
                        <!-- <div style="position: relative;display: flex;flex-direction: column;justify-content: flex-end;height: 100%;padding: 0 10px 10px 15px;overflow: hidden;">
                            <div v-for="activity in activities" style="padding-top: 10px;padding-left: 10px;display: flex;flex-direction: column;">
                                <p style="padding: 10px;background: #ffff;font-size: 16px;border: none;margin-right: 8px;font-family: inherit;width: 75%;">
                                    Account with name: {{activity.properties.attributes.name}} and balance: {{activity.properties.attributes.balance}} has been {{activity.description}} (created at {{activity.properties.attributes.created_at}} updated at {{activity.properties.attributes.updated_at}})
                                </p>
                            </div>
                        </div> -->

                        <ul style="display: -ms-grid;display: grid;
                                grid-auto-columns: 1fr;
                                grid-auto-rows: -webkit-max-content;
                                grid-auto-rows: max-content;
                                list-style-type: none;
                                overflow: auto;" aria-label="List of to do tasks">
                            <li v-for="activity in activities" style="display: -ms-grid;
                                display: grid;
                                -ms-grid-columns: 5% 85% 10%;
                                grid-template-columns: 5% 93% 2%;
                                border-bottom: 1px solid #ededed;
                                -webkit-box-align: center;
                                -ms-flex-align: center;
                                align-items: center;
                                overflow-wrap: break-word;">
                                <i class="las la-exclamation text-yellow-500 text-2xl" style="margin: auto;"></i>
                                <label style="padding: 15px;">
                                    Account with name: {{activity.properties.attributes.name}} and balance: {{activity.properties.attributes.balance}} has been {{activity.description}}
                                    <span class="text-xs pt-2" style="float: right;">(created at {{activity.properties.attributes.created_at}} updated at {{activity.properties.attributes.updated_at}})</span>
                                </label>
                            </li>
                        </ul>
                    <!-- </section> -->
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout_admin'
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
            activities: Object,
        },
        mounted () {
            console.log(this.charts);
        }
    }
</script>
