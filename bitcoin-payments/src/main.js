import { createApp } from 'vue'
import App from './App.vue'
import { Buffer } from 'buffer';
window.Buffer = Buffer; // Note: `window` won't be defined if you're running in a Node context

createApp(App).mount('#app')
