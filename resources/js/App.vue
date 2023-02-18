<script>
    let dracoResponse = fetch('https://api.mir4global.com/wallet/prices/draco/lastest', { method: "POST" })
    .then(response => response.json());

    export default {
        data() {
            return {
                baseDracoWemix: 0,
                baseHydraWemix: 0,
                
                dracoWemix: 0,
                hydraWemix: 0,

                usd: 0,

                dracoUsd: 0,
                hydraUsd: 0
            }
        },
        async created (){

            const responseDraco = await fetch('https://api.mir4global.com/wallet/prices/draco/lastest', { method: "POST" });
            const responseHydra = await fetch('https://api.mir4global.com/wallet/prices/hydra/lastest', { method: "POST" });

            const dataDraco = await responseDraco.json();
            const dataHydra = await responseHydra.json();
            
            this.dracoWemix = dataDraco.Data.DracoPriceWemix;
            this.hydraWemix = dataHydra.Data.HydraPriceWemix;

            this.baseDracoWemix = dataDraco.Data.DracoPriceWemix;
            this.baseHydraWemix = dataHydra.Data.HydraPriceWemix;

            this.usd = dataDraco.Data.USDWemixRate;

            this.dracoUsd = this.usd * this.dracoWemix;
            this.hydraUsd = this.usd * this.hydraWemix;
        },
        methods: {
            attDracoValues(e){

                this.dracoWemix = this.baseDracoWemix * e.target.value;
                this.dracoUsd = this.usd * this.dracoWemix;
            },
            attHydraValues(e){
                this.hydraWemix = this.baseHydraWemix * e.target.value;
                this.hydraUsd = this.usd * this.hydraWemix;
            }
        }
    }
</script>

<template>
    <div class="container">
        <h1 class="title">
            Draco Hoje
        </h1>
        <h2>
            O que é Draco?
        </h2>
        <article>
            Mir4 é um jogo online que possui sua própria criptomoeda chamada Draco. Essa moeda digital é usada dentro do jogo para comprar itens, pagar taxas e serviços. O Draco é uma criptomoeda baseada na tecnologia blockchain, o que significa que as transações são seguras e registradas de forma descentralizada.
        </article>
        
        <div id="dracoPanel">
            <div class="panelItem">
                <label for="draco">DRACO</label>
                <input type="number" name="draco" value="1" @keyup="attDracoValues">
            </div>

            <div  class="panelItem">
                <label for="dracoWemix">WEMIX</label>
                <input type="number" name="dracoWemix" :value="dracoWemix" disabled>
            </div>

            <div  class="panelItem">
                <label for="dracoUsd">USD</label>
                <input type="number" name="dracoUsd" :value="dracoUsd" disabled>
            </div>
        </div>

        <div id="hydraPanel">
            <div class="panelItem">
                <label for="draco">Hydra</label>
                <input type="number" name="draco" value="1" @keyup="attHydraValues">
            </div>

            <div  class="panelItem">
                <label for="hydraWemix">WEMIX</label>
                <input type="number" name="hydraWemix" :value="hydraWemix" disabled>
            </div>

            <div  class="panelItem">
                <label for="hydraUsd">USD</label>
                <input type="number" name="hydraUsd" :value="hydraUsd" disabled>
            </div>
        </div>
    </div>
</template>

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
        background-color: #541560;
        color: #ffffff;
        min-height: 100vh;
        font-family: 'Montserrat', sans-serif;
        display: flex;
        align-items: center;
        flex-direction: column;
    }

    h1 {
        font-weight: 700;
        font-size: 4rem;
    }

    h2 {
        font-weight: 400;
        font-size: 1.5rem;
    }

    article {
        padding: 3rem;
    }

    .title{
        margin:6rem 0rem 6rem 0rem;
    }

    #dracoPanel, #hydraPanel{
        display:flex;
        width: 100%;
        justify-content: space-around;
        margin: 1rem 0rem 1rem 0rem;
    }

    .panelItem{
        display: flex;
        flex-direction: column;
        align-items: center;
    }
</style>