<template>
    <div class="setting-header-wrap">
        <div class="setting-header">Settings</div>
        <div class="right-content">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M17.6439 6.35C16.1939 4.9 14.2039 4 11.9939 4C7.57391 4 4.00391 7.58 4.00391 12C4.00391 16.42 7.57391 20 11.9939 20C15.7239 20 18.8339 17.45 19.7239 14H17.6439C16.8239 16.33 14.6039 18 11.9939 18C8.68391 18 5.99391 15.31 5.99391 12C5.99391 8.69 8.68391 6 11.9939 6C13.6539 6 15.1339 6.69 16.2139 7.78L12.9939 11H19.9939V4L17.6439 6.35Z" fill="black"/>
            </svg>
            <div class="reset-text">Reset to Default</div>
        </div>
    </div>
    <SettingSlider />
</template>

<script>
import SettingSlider from './settings/SettingSlider.vue';
export default{
    data(){
        return{

        };
    },
    components:{
        SettingSlider,
    }
}
</script>

<style scoped>

.right-content{
    display: flex;
    gap: 8px;
    cursor: pointer;
    
}
.reset-text{
    padding-top: 3px;
    display: flex;
    color: #3D4144;
    font-family: 'Inter';
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}
.setting-header{
    margin-bottom: 28px;
    color: var(--color-text-colors-900-black-high-emp, #181A17);
    /* Text/H1-H6/H6 | Subtitle | Bold 700 */
    font-family: Inter;
    font-size: 24px;
    font-style: normal;
    font-weight: 700;
    line-height: 120%; /* 28.8px */
}

.setting-header-wrap{
    display: flex;
    justify-content: space-between;
}
</style>