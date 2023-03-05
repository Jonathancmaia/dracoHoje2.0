<template>
  <img class="loading" src="/public/images/loading.gif" v-if="!loaded"/>
  <Line v-if="loaded" :data="data" :options="options" />
</template>

<style>
  .loading{
    width: 5rem;
    height: 5rem;
  }
</style>

<script>
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
} from 'chart.js';
import { Line } from 'vue-chartjs';

ChartJS.register(
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
)

export default {
  name: 'Chart',
  components: {
    Line
  },
  props: {
    route: String,
    label: String
  },
  watch: {
    route: function () {
      this.mountChart()
    }
  },
  data() {
    return {
      loaded: false,
      data: {
        labels: [],
        datasets: [{
          label: this.label,
          backgroundColor: '#D1B000',
          borderColor: '#ffffff',
          color: '#ffffff',
          data: []
        }
      ]},
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
        legend: {
            display: false
        }
    }
      }
    }
  },
  methods: {
    async mountChart(){
      this.loaded = false;

      try{

        //charts prices
        let actualLoc = window.location.href;

        const response = await fetch(actualLoc+this.route);
        const data = await response.json();

        this.data.datasets[0].data = [];
        this.data.labels = [];

        data.forEach((data)=>{

          let date = data.created_at.substring(0, 10).split('-');
          let time = data.created_at.substring(11, 16);
          let dateNtime = date[2] + "/" + date[1] + "/" + date[0] + " às " + time;

          this.data.datasets[0].data = [...this.data.datasets[0].data, data.value];
          this.data.labels = [...this.data.labels, dateNtime];
        });

        this.loaded = true;
      } catch (e) {
        alert(e)
      }
    }
  },
  async mounted () {
    this.mountChart()
  }
}
</script>