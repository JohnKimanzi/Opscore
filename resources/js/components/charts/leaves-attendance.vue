<template>
    <div class="chart-wrapper">
        <apexchart width="500" :options="options" :series="series"> </apexchart>
    </div>
</template>
<script>
export default {
    name: "leaves-attendance",
    data: function () {
        return {
            options: {
                chart: {
                    id: "leave-on-attendance",
                    width: "50%",
                    type: "bar",
                },
                xaxis: {
                    categories: []
                },
                colors: ["#504C6A"],
                title: {
                    text: "Leave utilization for the month of ...",
                    align: "center",
                    style: {
                        fontSize: "25px",
                    },
                },
            },
            series: [
                {
                    name: "annual leave spread",
                    data: [],
                },
            ],
            title: {
                text: "Leaves on attendance utilization",
            },
        };
    },
    methods: {
        getData() {
            axios.get("chart_attendance_on_leaves").then((response) => {
                ApexCharts.exec("leave-on-attendance", "updateSeries", {
                            data: response.data,
                 });
                // ApexCharts.exec("leave-on-attendance", "updateOptions", {
                //     xaxis: {
                //         labels: {
                //             format: "dd MMM",
                //         },
                //         data: response.data[1],
                //     },
                // });
            });
        },
    },
    async mounted() {
        this.getData();
    },
};
</script>
<style scoped>
div.chart-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
