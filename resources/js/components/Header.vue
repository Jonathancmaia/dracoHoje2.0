<template>
    <section>
        <div id="title">
            <h1 id="titleText">
                Draco Hoje
            </h1>
            <small>
                Valores Draco e Hydra atualizados
            </small>
        </div>
    </section>
</template>

<script>
export default {
  name: 'Header'
}

window.addEventListener("scroll", function() {
  const distance = window.scrollY;
  const actualDistance = 50;
  document.querySelector("#title").style.backgroundPosition = `75% ${actualDistance + (distance*0.05)}%`;
})
</script>

<style scoped>
    section{
        display: flex;
        flex-direction: column;
        align-items: center;
        background-size: cover;
        background-position: center center;
        background-image: url('/public/images/banner.png');
        width: 100%;
        height: 70vh;
    }

    #title {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-image: url('/public/images/hydra&draco.webp');
        background-size: 30%;
        background-position: 75% 50%;
        background-repeat: no-repeat;
    }

    #title > h1{
        font-weight: 700;
        font-size: 10vw;
        letter-spacing: 1.5vw;
    }

    #title > small {
        font-size: 2vw;
        letter-spacing: 1.5vw;
    }

    #hydra-e-draco{
        
        width: auto;
        height: 65%;
        
    }
</style>