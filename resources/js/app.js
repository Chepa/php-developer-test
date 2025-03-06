import './bootstrap';

import {createApp} from 'vue'

import App from './App.vue'
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import {resolvePageComponent} from "laravel-vite-plugin/inertia-helpers";

const app = createApp(App, {
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue"),
        ),
})
app.use(ElementPlus);
app.mount('#app')
