import './bootstrap';
import * as bootstrap from 'bootstrap';
import { createApp } from 'vue'
import landing from '../Components/landing.vue'
import map from '../Components/map.vue'
import navbar from '../Components/navbar.vue'
import provider from '../Components/provider/provider.vue'
import createMenu from '../Components/provider/createMenu.vue';
import bookings from '../Components/provider/bookings.vue';




import viewProvider from '../Components/showAvailableProviders.vue'



createApp(landing).mount("#landing")
createApp(map).mount("#mapbox")
createApp(navbar).mount("#navbar")
createApp(provider).mount("#provider")

 createApp(bookings).mount("#updateBookingComponent")
createApp(createMenu).mount("#createMenu")
createApp(booking).mount("#updateBookingComponent")
createApp(viewProvider).mount("#viewProvider")



