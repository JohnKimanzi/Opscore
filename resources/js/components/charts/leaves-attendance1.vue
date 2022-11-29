<template>
<div class="chart-wrapper">
   <apexchart 
     width="500" 
     :options="options" 
     :series="series">
   </apexchart>  
  </div>
</template>
<script>
export default {
    name: "leaves-attendance",
    data: function() {
        return {
            options: {
                chart: {
                    width: '50%',
                    type:"line" 
                },
                xaxis: {
                    categories: ['Male', 'Female']
                },
                colors: ['#504C6A'],
                title : {
                    text: 'Leave utilization for the month of ...',
                    align: 'center',
                    style: {
                        fontSize: '25px'
                    }  
                },
            },
            series: [{
                name: 'gender',
                data: []
            }], 
            title: {
                text: 'Leaves on attendance utilization'
            },
        }
    },
    methods: {
        getData () {
            axios.get("/gen_chart")
            .then((response) => {
                  this.series = [{
                      data: response.data
                  }];
                //   console.log(response.data)
              })
        }
    },
    async mounted () {
        // this.series = [
        //     {
        //         name: 'Leaves on attendance',
        //         data: [30, 40, 45, 50, 49, 60, 70, 91]
        //     }
        // ];
        // this.options.xaxis = {
        //     categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998],
        // }
        this.getData()
    }
};
</script>
<style scoped>
div.chart-wrapper {
  display: flex;
  align-items: center;
  justify-content: center
}
</style>