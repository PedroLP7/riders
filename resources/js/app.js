import './bootstrap';
import * as bootstrap from 'bootstrap';
import { createApp } from 'vue'
import landing from '../Components/landing.vue'



import map from '../Components/map.vue'
import navbar from '../Components/navbar.vue'

import provider from '../Components/provider/provider.vue'

// import booking from '../Components/bookings.vue'



createApp(landing).mount("#landing")
createApp(map).mount("#mapbox")
createApp(navbar).mount("#navbar")
createApp(provider).mount("#provider")
createApp(booking).mount("#updateBookingComponent")



