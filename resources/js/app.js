import { createApp, h } from 'vue'
import { createInertiaApp , Link } from '@inertiajs/vue3'
import Master from './Layouts/Master.vue';
import { ZiggyVue  } from '../../vendor/tightenco/ziggy';
import LeftPanel from "@/Components/LeftPanel.vue";
import RightPanel from "@/Components/RightPanel.vue";


createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        let page = pages[`./Pages/${name}.vue`]
        page.default.layout = page.default.layout || Master ;
        return page ;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue )
            .component('Link' , Link)
            .component('LeftPanel' , LeftPanel)
            .component('RightPanel' , RightPanel)
            .mount(el)
    },
})
