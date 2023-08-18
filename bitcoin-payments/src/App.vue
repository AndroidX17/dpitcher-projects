<template>
    <div id="app">
        <ShopNavbar @change-page="changePage"></ShopNavbar>
        <component :is="activePage" :change-page="changePage"></component>
    </div>
</template>

<script>
import ShopPage from './components/ShopPage.vue';
import ToolsPage from './components/ToolsPage.vue';
import SettingsPage from './components/SettingsPage.vue';
import ContactPage from './components/ContactPage.vue';
import AboutPage from './components/AboutPage.vue';
import ShopNavbar from './components/ShopNavbar.vue';
import SignupPage from './components/SignupPage.vue';


export default {
  name: 'App',
  components: {
    ShopNavbar,
    ShopPage,
    ToolsPage,
    SettingsPage,
    ContactPage,
    AboutPage,
    SignupPage,
  },
  data() {
return {
      activePage: localStorage.getItem('activePage') || 'ShopPage' // get page from local storage or default to 'ShopPage'
    };
    },
        methods: {
       changePage(page) {
      this.activePage = page;
      localStorage.setItem('activePage', page); // save page to local storage
    }
    }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
