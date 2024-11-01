<template>
    <aside>
        <div class="route-links-wrapper">
            <div class="route_links" >
              <router-link :to="{ name: 'dashboard'}" class="link-container">
                
                <div class="menu-item-text">General</div>
              </router-link>
            </div>
            <div class="route_links" >
                <router-link :to="{ name: 'quiz'}"  class="link-container">
                    
                    <div class="menu-item-text">Quiz</div>
                </router-link>
            </div>
            
    
            <div class="route_links" >
                <router-link :to="{ name: 'image_quiz'}"  class="link-container">
                    
                    <div class="menu-item-text">Image Quiz</div>
                </router-link>
            </div>
            <div class="route_links" >
                <router-link :to="{ name: 'spin'}" class="link-container">
                    
                    <div class="menu-item-text">Spin n Win</div>
                </router-link>
            </div>
            <div class="route_links" >
                <router-link :to="{ name: 'drag'}"  class="link-container">
                    
                    <div class="menu-item-text">Drag n Match</div>
                </router-link>
            </div>
            <div class="route_links" >
                <router-link :to="{ name: 'scratch'}" class="link-container">
                    
                    <div class="menu-item-text">Scratch n Win</div>
                </router-link>
            </div>
            <div class="route_links" >
                <router-link :to="{ name: 'popup'}" class="link-container">
                    
                    <div class="menu-item-text">Popup</div>
                </router-link>
            </div>
            <div class="route_links" >
                <router-link :to="{ name: 'leaderboard' }" class="link-container">
                    
                    <div class="menu-item-text">Leaderboard</div>
                </router-link>
            </div>
            <div class="route_links" >
                <router-link :to="{ name: 'results' }" class="link-container">
                    
                    <div class="menu-item-text">Results</div>
                </router-link>
            </div>
            <div class="route_links" >
                <router-link :to="{ name: 'subscription' }" class="link-container">
                    
                    <div class="menu-item-text">Subscription</div>
                </router-link>
            </div>
            <div class="route_links" >
                <router-link :to="{ name: 'settings' }" class="link-container">
                    
                    <div class="menu-item-text">Settings</div>
                </router-link>
            </div>
            <div class="route_links" >
                <router-link :to="{ name: 'tools' }" class="link-container">
                    
                    <div class="menu-item-text">Tools</div>
                </router-link>
            </div>
            <div class="route_links" >
                <router-link :to="{ name: 'about' }" class="link-container">
                    
                    <div class="menu-item-text">About</div>
                </router-link>
            </div>
    
          </div>
    </aside>
    </template>
    
    <script>
    export default{
        data(){
            return{
                
            }
        },
        methods: {
            
        },
        created() {
            const lastRoute = localStorage.getItem('lastRoute');
            if (lastRoute) {
                this.$router.push({ name: lastRoute });
            }
        },
        
    }
    </script>
    
    <style scoped> 
    /* Style for the sidebar */
    aside {
        background-color: #FFFFFF;
        color: white;
        padding: 24px;
        width: 200px; /* Adjust the width as needed */
    }
    .link-container{
        display: flex;
        gap: 12px;
        align-items: center;
        padding: 12px 16px;
        text-decoration: none;
        border-radius: 6px;
        
    }
    .router-link-active{
        background-color: #706AEA;
    }
    
    .router-link-active .menu-item-text{
        color: #FFFFFF;
        
    }
    
    .router-link-active svg path{
        fill: #FFFFFF;
    }
    
    .wp-person a:focus .gravatar, a:focus, a:focus .media-icon img, a:focus .plugin-icon{
        box-shadow: none;
        outline: none;
        border-radius: 6px;
    }
    .router-link:focus{
        box-shadow: 0 !important;
        border-radius: 6px;
    }
    
    .route_links{
        border-bottom: 1px solid #E5ECFF; 
    }
    .route_links:last-child{
        border-bottom: none;
    }
    
    .menu-item-text{
        color: var(--color-text-colors-700-black-medium-emp, #2F2F2F);
        font-family: 'Inter';
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
        line-height: 130%; /* 18.2px */
    }
    
    </style>