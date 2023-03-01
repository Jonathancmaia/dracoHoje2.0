<template>
    <div class="container">
        
        <Header/>

        <div id="dracoPanel">
            <div class="panelItem">
                <label for="draco"><img src="/images/draco.webp"></label>
                <input type="number" name="draco" value="1" @keyup="attDracoValues">
            </div>

            <img src="/images/exchange.png" class="exchange"/>

            <div  class="panelItem">
                <label for="dracoWemix"><img src="/images/wemix.webp"></label>
                <input type="number" name="dracoWemix" :value="dracoWemix" disabled>
            </div>

            <img src="/images/exchange.png" class="exchange"/>

            <div  class="panelItem">
                <label for="dracoUsd">
                    <h3>
                        USD
                    </h3>
                </label>
                <input type="number" name="dracoUsd" :value="dracoUsd" disabled>
            </div>
        </div>

        <div id="hydraPanel">
            <div class="panelItem">
                <label for="draco"><img src="/images/hydra.webp"></label>
                <input type="number" name="draco" value="1" @keyup="attHydraValues">
            </div>

            <img src="/images/exchange.png" class="exchange"/>
            
            <div  class="panelItem">
                <label for="hydraWemix"><img src="/images/wemix.webp"></label>
                <input type="number" name="hydraWemix" :value="hydraWemix" disabled>
            </div>

            <img src="/images/exchange.png" class="exchange"/>

            <div  class="panelItem">
                <label for="hydraUsd">
                    <h3>
                        USD
                    </h3>
                </label>
                <input type="number" name="hydraUsd" :value="hydraUsd" disabled>
            </div>
        </div>

        <div class="chart-container">
            <div class="chart">
                <div>
                    <img src="/images/draco.webp">
                    <div>
                    <select name="dracoTime" @change="attDracoChartRoute">
                        <option value="Daily" selected>Diário</option>
                        <option value="Weekly">Semanal</option>
                        <option value="Monthly">Mensal</option>
                        <option value="All">Completo</option>
                    </select>
                </div>
                </div>
                
                <div>
                    <Chart :route=dracoChartRoute label="Draco" />
                </div>
            </div>
            <div class="chart">
                <div>
                    <img src="/images/hydra.webp">
                    <div>
                        <select name="hydraTime" @change="attHydraChartRoute">
                            <option value="Daily" selected>Diário</option>
                            <option value="Weekly">Semanal</option>
                            <option value="Monthly">Mensal</option>
                            <option value="All">Completo</option>
                        </select>
                    </div>
                </div>
                <div>
                    <Chart v-bind:route=hydraChartRoute label="Hydra"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Chart from './components/Chart.vue';
    import Header from './components/Header.vue';

    export default {
        name: 'App',
        components: {
            Chart,
            Header
        },
        data() {
            return {
                baseDracoWemix: 0,
                baseHydraWemix: 0,
                dracoWemix: 0,
                hydraWemix: 0,
                usd: 0,
                dracoUsd: 0,
                hydraUsd: 0,
                dracoChartRoute: "api/getDracoDaily",
                hydraChartRoute: "api/getHydraDaily"
            }
        },
        async created (){

            //actual prices
            const responseDraco = await fetch('https://api.mir4global.com/wallet/prices/draco/lastest', { method: "POST" });
            const responseHydra = await fetch('https://api.mir4global.com/wallet/prices/hydra/lastest', { method: "POST" });

            const dataDraco = await responseDraco.json();
            const dataHydra = await responseHydra.json();
            
            this.dracoWemix = dataDraco.Data.DracoPriceWemix;
            this.hydraWemix = dataHydra.Data.HydraPriceWemix;

            this.baseDracoWemix = dataDraco.Data.DracoPriceWemix;
            this.baseHydraWemix = dataHydra.Data.HydraPriceWemix;

            this.usd = dataDraco.Data.USDWemixRate;

            this.dracoUsd = (Math.floor((this.usd * this.dracoWemix) * 100) /100).toFixed(2);
            this.hydraUsd = (Math.floor((this.usd * this.hydraWemix) * 100) /100).toFixed(2);
            console.log(this.usd * this.hydraWemix)
        },
        methods: {
            attDracoValues(e){
                this.dracoWemix = this.baseDracoWemix * e.target.value;
                this.dracoUsd = (Math.floor((this.usd * this.dracoWemix) * 100) /100).toFixed(2);
            },
            attHydraValues(e){
                this.hydraWemix = this.baseHydraWemix * e.target.value;
                this.hydraUsd = (Math.floor((this.usd * this.hydraWemix) * 100) /100).toFixed(2);
            },
            attDracoChartRoute(e){
                this.dracoChartRoute = "api/getDraco" + e.target.value;
            },
            attHydraChartRoute(e){
                this.hydraChartRoute =  "api/getHydra" + e.target.value;
            }
        }
    }
</script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;700&display=swap');

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }

    h3{
        font-size: 1.3rem;
        font-weight: 900;
        height: 1.5rem;
    }

    .container{
        background-image: linear-gradient(90deg, #000022, #060750, #000022);
        color: #ffffff;
        min-height: 100vh;
        font-family: 'Montserrat', sans-serif;
        display: flex;
        align-items: center;
        flex-direction: column;
    }

    #dracoPanel, #hydraPanel{
        display:flex;
        width: 100%;
        justify-content: space-around;
        align-items: center;
        margin: 1rem 0rem 1rem 0rem;
    }

    .panelItem{
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    input{
        background-color: rgb(255,255,255,0.15);
        color: #ffffff;
        border-radius: 0.25rem;
        height: 1rem;
        padding: 0.5rem;
        border-style: solid;
        font-weight: 900;
        font-size: 1rem;
        margin-top: 0.5rem;
    }

    input:disabled{
        background-color: rgb(0,0,0,0);
        color: #ffffff;
    }

    label > img{
        height: 1.5rem;
    }

    .exchange{
        width: 5%;
        -webkit-filter: grayscale(1) invert(1);
        filter: grayscale(1) invert(1);
        height: auto;
    }

    .chart-container{
        width: 70%;
    }

    .chart {
        margin: 5rem;
    }

    .chart > div {
        display: flex;
        flex-direction: column;
    }

    .chart > div{
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-around;
    }

    .chart > div > div > select {
        align-self: center;
        background-color: rgb(0,0,0,0);
        color: #ffffff;
        font-size: 1rem;
        font-weight: 900;
        border-radius: 0.25rem;
        border-style: solid;
    }

    .chart > div > div > select > option{
        color: #000000;
    }
</style>