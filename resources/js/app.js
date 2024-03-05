import './bootstrap';
import * as bootstrap from 'bootstrap';
import { createApp } from 'vue'
import landing from '../Components/landing.vue'
import updateBooking from '../Components/updateBooking.vue';

createApp(landing).mount("#landing")
createApp(updateBooking).mount("#updateBookingComponent")