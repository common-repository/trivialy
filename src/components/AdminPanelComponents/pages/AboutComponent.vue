<template>
    <div class="about-header">About</div>
    <AboutSlider />
</template>

<script>
import AboutSlider from './about/AboutSlider.vue';
export default{
    mounted(){
        
    },
    data(){
        return{

        }
    },
    components:{
        AboutSlider,
    },
   
}
</script>

<style scoped>
.about-header{
    margin-bottom: 32px;
    color: var(--color-text-colors-900-black-high-emp, #181A17);
    /* Text/H1-H6/H6 | Subtitle | Bold 700 */
    font-family: Inter;
    font-size: 24px;
    font-style: normal;
    font-weight: 700;
    line-height: 120%; /* 28.8px */
}
</style>