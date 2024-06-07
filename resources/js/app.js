import { createApp, h } from 'vue'
import { createInertiaApp , Link } from '@inertiajs/vue3'
import Master from './Layouts/Master.vue';
import { ZiggyVue } from 'ziggy-js';
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import mitt from 'mitt'
import {resourceManager} from './resourceManager.js'

const vuetify = createVuetify({
    components,
    directives,
})


const emitter = mitt()

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        let page = pages[`./Pages/${name}.vue`]
        page.default.layout = page.default.layout || Master ;
        return page ;
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue )
            .use(vuetify )
            .component('Link' , Link);

        app.config.globalProperties.emitter = emitter
        app.config.globalProperties.resourceManager = new resourceManager(emitter)
        app.mount(el)
    },
})
