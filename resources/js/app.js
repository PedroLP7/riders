import './bootstrap';
import * as bootstrap from 'bootstrap';
import { createApp } from 'vue'
import landing from '../Components/landing.vue'
import map from '../Components/map.vue'
import navbar from '../Components/navbar.vue'
import provider from '../Components/provider/provider.vue'
import createMenu from '../Components/provider/createMenu.vue';
import bookings from '../Components/provider/bookings.vue';
import profile from '../Components/provider/profile.vue';

import recurringCustomer from '../Components/recurringCustomer.vue';

import editProfile from '../Components/provider/editProfile.vue';
import editMenu from '../Components/provider/editMenu.vue';
import formRider from '../Components/formRider.vue';
import formProvider from '../Components/formProvider.vue';
import formKitchen from '../Components/formKitchen.vue';





import createCommunityKitchen from '../Components/addCommunityKForm.vue'
import viewProvider from '../Components/showAvailableProviders.vue'
import viewAllBookings from '../Components/provider/viewAllBookingsPendingToBeCollected.vue'


createApp(landing).mount("#landing")
createApp(formRider).mount("#raiderForm")
createApp(formProvider).mount("#providerForm")
createApp(formKitchen).mount("#kitchenForm")
createApp(map).mount("#mapbox")
createApp(navbar).mount("#navbar")
createApp(provider).mount("#provider")
createApp(viewAllBookings).mount("#viewAllBookings")


//  createApp(bookings).mount("#updateBookingComponent")
createApp(bookings).mount("#bookings")
createApp(createMenu).mount("#createMenu")
createApp(viewProvider).mount("#viewProvider")

createApp(createCommunityKitchen).mount("#createCommunityK")
createApp(profile).mount("#profile")

createApp(recurringCustomer).mount("#recurringCustomer")

createApp(editProfile).mount("#editProfile")
createApp(editMenu).mount("#editMenu")




import chart1 from '../Components/provider/chart1.vue'
createApp(chart1).mount("#chart")

