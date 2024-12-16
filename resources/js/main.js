import { createApp } from 'vue';
// import App from './components/App.vue';
import App from './App.vue';
import router from './router';
import store from './store';
import nativeComponents from './components'
import "bootstrap/dist/js/bootstrap.js";
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'


const vuetify = createVuetify({
    components,
    directives
  })

const app = createApp(App).use(router).use(store).use(vuetify);

nativeComponents.forEach(component => {
    app.component(component.name, component);
});

console.log(app);
app.mount('#app');