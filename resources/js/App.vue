<template>
    <div class="container">
        
        <Header/>

        <div id="dracoPanel">
            <div class="panelItem">
                <label for="draco"><img src="/public/images/draco.webp"></label>
                <input type="number" name="draco" value="1" @keyup="attDracoValues">
            </div>

            <img src="/public/images/exchange.png" class="exchange"/>

            <div  class="panelItem">
                <label for="dracoWemix"><img src="/public/images/wemix.webp"></label>
                <input type="number" name="dracoWemix" :value="dracoWemix" disabled>
            </div>

            <img src="/public/images/exchange.png" class="exchange"/>

            <div  class="panelItem">
                <label for="dracoUsd">
                    <div class="switch" @click="monetaryExchange" name="dracoInR">
                        <span class="switch-opt switch-opt-on">
                            USD
                        </span>
                        <span class="switch-opt">
                            R$
                        </span>
                    </div>
                </label>
                <input type="number" name="dracoUsd" :value="
                    dracoInR ?
                        (Math.floor((dracoUsd * usdToReal) * 100) / 100).toFixed(2)
                    :
                        dracoUsd"
                disabled>
            </div>
        </div>

        <div id="hydraPanel">
            <div class="panelItem">
                <label for="draco"><img src="/public/images/hydra.webp"></label>
                <input type="number" name="draco" value="1" @keyup="attHydraValues">
            </div>

            <img src="/public/images/exchange.png" class="exchange"/>
            
            <div  class="panelItem">
                <label for="hydraWemix"><img src="/public/images/wemix.webp"></label>
                <input type="number" name="hydraWemix" :value="hydraWemix" disabled>
            </div>

            <img src="/public/images/exchange.png" class="exchange"/>

            <div  class="panelItem">
                <label for="hydraUsd">
                    <div class="switch" @click="monetaryExchange" name="hydraInR">
                        <span class="switch-opt switch-opt-on">
                            USD
                        </span>
                        <span class="switch-opt">
                            R$
                        </span>
                    </div>
                </label>
                <input type="number" name="hydraUsd" :value="
                    hydraInR ?
                        (Math.floor((hydraUsd * usdToReal) * 100) / 100).toFixed(2)
                    :
                        hydraUsd"
                disabled>
            </div>
        </div>

        <div class="chart-container">
            <div class="chart">
                <div>
                    <img src="/public/images/draco.webp">
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

                <article>
                    <h3>O que é Draco?</h3>
                    DRACO é uma moeda virtual que apresenta um conceito inovador ao permitir que os ativos do jogo sejam negociados de forma livre e independente fora do ambiente do jogo. A moeda tem seu valor intrínseco garantido pelo valor dos recursos que são obtidos dentro do próprio jogo. Essa característica torna a moeda uma ferramenta importante para os jogadores que desejam comprar ou vender itens do jogo fora do ambiente virtual. Além disso, ela oferece uma nova forma de armazenamento de ativos e uma maneira de investir no universo do jogo.
                </article>
            </div>
            <div class="chart">
                <div>
                    <img src="/public/images/hydra.webp">
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

                <article>
                    <h3>O que é Hydra?</h3>
                    HYDRA (HYD) é uma versão refinada da moeda virtual DRACO, que pode ser produzida ao combinar DRACOs e Septarias, que são obtidos no Santuário de Hydra dentro do jogo MIR4. Há uma relação complexa de correlação entre os valores de DRACO e HYDRA, em que o valor de um afeta o valor do outro. Basicamente, HYDRA é uma opção de investimento de alto rendimento para jogadores que desejam usar DRACO para produzi-la.
                </article>
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
                hydraChartRoute: "api/getHydraDaily",
                dracoInR: false,
                hydraInR: false,
                usdToReal: 0
            }
        },
        async created (){

            //actual prices
            const responseDraco = await fetch('https://api.mir4global.com/wallet/prices/draco/lastest', { method: "POST" });
            const responseHydra = await fetch('https://api.mir4global.com/wallet/prices/hydra/lastest', { method: "POST" });
            const realToUsd = await fetch('https://economia.awesomeapi.com.br/last/USD-BRL');


            const dataDraco = await responseDraco.json();
            const dataHydra = await responseHydra.json();
            const dataRealToUsd = await realToUsd.json();

            this.usdToReal = dataRealToUsd.USDBRL.ask;
            
            this.dracoWemix = dataDraco.Data.DracoPriceWemix;
            this.hydraWemix = dataHydra.Data.HydraPriceWemix;

            this.baseDracoWemix = dataDraco.Data.DracoPriceWemix;
            this.baseHydraWemix = dataHydra.Data.HydraPriceWemix;

            this.usd = dataDraco.Data.USDWemixRate;

            this.dracoUsd = (Math.floor((this.usd * this.dracoWemix) * 100) / 100).toFixed(2);
            this.hydraUsd = (Math.floor((this.usd * this.hydraWemix) * 100) / 100).toFixed(2);
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
            },
            monetaryExchange(e){

                let selectedOpt;
                let unselectedOpt;

                for (const child of e.target.parentElement.children){
                    let isSelected = false;
                    for (const className of child.classList){
                        
                        if (className === "switch-opt-on"){
                            isSelected = true;
                        }
                    }

                    if(isSelected){
                        selectedOpt = child;
                    } else {
                        unselectedOpt = child;
                    }
                }

                selectedOpt.classList.remove("switch-opt-on");
                unselectedOpt.classList.add("switch-opt-on");

                switch (e.target.parentElement.getAttribute("name")){
                    case 'dracoInR':
                        this.dracoInR = !this.dracoInR;
                        break;

                    case 'hydraInR':
                        this.hydraInR = !this.hydraInR;
                        break;
                }
            },
            valueConversion(coin){
                console.log(coin)
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

    .container{
        background-image: linear-gradient(90deg, #000022, #060750, #000022);
        color: #ffffff;
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

    article{
        padding: 0.5rem 0 0.5rem 0;
        font-size: 0.8rem;
    }

    h3{
        font-weight: 900;
        font-size: 1rem;;
        padding: 0.5rem 0 0.5rem 0;
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

    .switch{
        background-color: rgb(255,255,255,0.5);
        font-size: 1.3rem;
        font-weight: 900;
        border-radius: 1rem;
        height: 2rem;
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .switch-opt{
        padding: 0rem 2rem 0rem 2rem;
        height: 100%;
        display: flex;
        align-items: center;
    }

    .switch-opt-on{
        background-color: rgb(0, 0, 0, 0.2);
    }

    @media (max-width: 993px){
        #dracoPanel, #hydraPanel{
            flex-direction: column;
        }

        #hydraPanel{
            margin-top: 2rem;
        }

        .panelItem{
            margin: 0.5rem 0rem 0.5rem 0rem;
            width: 100%;
        }

        .panelItem > input{
            width: 40vw;
        }

        .exchange{
            transform: rotate(90deg);
        }

        .chart-container{
        width: 100%;
    }
    }
</style>