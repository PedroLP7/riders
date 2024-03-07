import './bootstrap';
import * as bootstrap from 'bootstrap';
import { createApp } from 'vue'
import landing from '../Components/landing.vue'
import map from '../Components/map.vue'
import provider from '../Components/provider.vue'

createApp(landing).mount("#landing")
createApp(map).mount("#mapbox")
createApp(provider).mount("#provider")


