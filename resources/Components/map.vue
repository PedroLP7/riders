<template>
 

  <div v-if="loading" class="loading-overlay">
    <div id="manzanita">
      <div class="image" style="background-image: url('../../resources/images/animacion/ManzanaAni1.png');"></div>
      <div class="image" style="background-image: url('../../resources/images/animacion/ManzanaAni2.png');"></div>
      <div class="image" style="background-image: url('../../resources/images/animacion/ManzanaAni3.png');"></div>
      <div class="image" style="background-image: url('../../resources/images/animacion/ManzanaAni4.png');"></div>
      <div class="image" style="background-image: url('../../resources/images/animacion/ManzanaAni5.png');"></div>
      <div class="image" style="background-image: url('../../resources/images/animacion/ManzanaAni6.png');"></div>
      <div class="image" style="background-image: url('../../resources/images/animacion/ManzanaAni7.png');"></div>
      <div class="image" style="background-image: url('../../resources/images/animacion/ManzanaAni8.png');"></div>
    </div>
  </div>
  <div style="text-align: center; z-index: 9909999;" class="alerts-container">

    <div v-if="this.messageType == 'i'"  id="alert-success-booking" role="alert">
      Su reserva ha sido tramitada correctamente
    </div>

    <div v-if="this.messageType == 'e'" id="alert-danger-booking" role="alert">
      Su reserva no ha podido ser tramitada, vuelva a probar mas tarde.

    </div>
    <div v-if="this.messageType == 'eb'" id="alert-danger-booking" role="alert">
      No se pueden reservar más paquetes de los disponibles.

    </div>
    <div v-if="this.messageType == 'ds'" id="alert-success-booking" role="alert">
      La entrega se realizó con exito

    </div>
    <div v-if="this.messageType == 'df'" id="alert-danger-booking" role="alert">
      La entrega no pudo ser registrada

    </div>
    <div v-if="this.messageType == 'rd'" id="alert-danger-booking" role="alert">
     Registro duplicado, este paquete ya ha sido reservado en las ultimas 24h

    </div>
  </div>
  <a id="hey" @click="goToProfile()" style="z-index: 10;">
    <h1 id="cipoton"><b>Hey, </b>{{ user.user_name }}</h1>
  </a>
  <div class="map-container" ref="mapContainer" @click="handleMapClick"></div>
  <div v-if="isModalOpen" class="modal-overlay" @click="closeModal">
    <div class="modal" @click.stop>
      <span class="close" @click="closeModal">&times;</span>
      <form @submit.prevent="confirmAddMarker">
        <div class="form-group">
        </div>
        <div class="form-group">
        </div>
        <div class="form-group">
          <label for="streetName">Calle:</label>
          <div id="streetName" class="street-name">{{ mendigo.location }}</div>
        </div>
        <button type="button" @click="confirmAddMarker">Guardar</button>
      </form>
    </div>
  </div>


  <div v-if="isMarkerOptionsModalOpen" class="modal-overlay" @click="closeMarkerOptionsModal">
    <div class="modal-small" @click.stop>

      <div class="toggle-modal-size">
        <span class="close" @click="closeMarkerOptionsModal">&times;</span>
      </div>
      <div class="modal-content">

        <booking :screen="1" :customer="mendigo.id_customer" @successfull-delivery="handleDelivery"></booking>

      </div>
    </div>
  </div>
  <div v-if="isProviderModalOpen" id="providerModal" class="modal-overlay">
    <div class="modal-scrollable" @click.stop>

      <div class="toggle-modal-size">
        <span class="close" @click="closeMarkerOptionsModal">&times;</span>
      </div>
      <div class="modal-content">



        <reservation ref="modal" :selectedProvider="provider.id_customer"
          @change-message-type="handleMessageTypeChange"> </reservation>
      </div>
    </div>
  </div>
  <div v-if="isInitialModalOpen" class="modal-overlay">
    <div class="modal-small-initial">
      <div class="toggle-modal-size">

        <button v-if="isMaximized && !isMinimized" @click="minimizeModal()" id="minimize-modal-button">
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
              <g fill="none" fill-rule="evenodd">
                <path
                  d="M24 0v24H0V0zM12.594 23.258l-.012.002l-.071.035l-.02.004l-.014-.004l-.071-.036c-.01-.003-.019 0-.024.006l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.016-.018m.264-.113l-.014.002l-.184.093l-.01.01l-.003.011l.018.43l.005.012l.008.008l.201.092c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.003-.011l.018-.43l-.003-.012l-.01-.01z" />
                <path fill="white"
                  d="M6.293 6.293a1 1 0 0 1 1.414 0L12 10.586l4.293-4.293a1 1 0 1 1 1.414 1.414l-5 5a1 1 0 0 1-1.414 0l-5-5a1 1 0 0 1 0-1.414m0 6a1 1 0 0 1 1.414 0L12 16.586l4.293-4.293a1 1 0 0 1 1.414 1.414l-5 5a1 1 0 0 1-1.414 0l-5-5a1 1 0 0 1 0-1.414" />
              </g>
            </svg>
          </span>
        </button>

        <button v-if="isMinimized" @click="maximizeModal()" id="maximize-modal-button">
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
              <g fill="none" fill-rule="evenodd">
                <path
                  d="M24 0v24H0V0zM12.594 23.258l-.012.002l-.071.035l-.02.004l-.014-.004l-.071-.036c-.01-.003-.019 0-.024.006l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.016-.018m.264-.113l-.014.002l-.184.093l-.01.01l-.003.011l.018.43l.005.012l.008.008l.201.092c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.003-.011l.018-.43l-.003-.012l-.01-.01z" />
                <path fill="white"
                  d="M12 5a1 1 0 0 1 .707.293l5 5a1 1 0 0 1-1.414 1.414L12 7.414l-4.293 4.293a1 1 0 0 1-1.414-1.414l5-5A1 1 0 0 1 12 5m0 6a1 1 0 0 1 .707.293l5 5a1 1 0 0 1-1.414 1.414L12 13.414l-4.293 4.293a1 1 0 0 1-1.414-1.414l5-5A1 1 0 0 1 12 11" />
              </g>
            </svg>
          </span>
        </button>

      </div>
      <div class="modal-content">
        <booking :screen="2"></booking>
      </div>
      <p v-if="isMinimized" id="click-to-open-text">Despliega para mostrar <br> la informacion</p>
    </div>
  </div>
  <div class="container" id="navbar">
    <navbar v-if="showComponente" />
  </div>
</template>

<script>
import mapboxgl from 'mapbox-gl';
import { ref, onMounted } from 'vue';
import axios from 'axios';
import navbar from '../Components/navbar.vue';
import booking from '../Components/provider/bookings.vue';
import reservation from '../Components/showAvailableProviders.vue';

export default {
  name: 'Map',
  components: {
    navbar,
    booking,
    reservation
  },

  data() {
    return {
      showComponente: true,
      hasBookingsPending: false,
      isInitialModalOpen: true,
      isMinimized: false,
      isMaximized: true,
      user: {},
      loading: true,
      isProviderModalOpen: false,
      isMarkerOptionsModalOpen: false,
      messageType: null,
      isAlertsContainerVisible: false,
    }
  },
  methods: {
    handleMessageTypeChange(message) {
      this.messageType = message;
      console.log("prop response" + message);
      this.isProviderModalOpen = false;
      if (!this.isMinimized) {
        this.minimizeModal();
      }
      setTimeout(() => {
        this.messageType = null;
          }, 4500);

    },
    handleDelivery(delivery) {
      console.log("recieved emit delivery " +delivery);
      if (delivery == 's') {
        this.messageType = "ds";
        setTimeout(() => {
        this.messageType = null;
          }, 4500);

      } else if (delivery == 'e') {
        this.messageType = "df";
      }
      this.isMarkerOptionsModalOpen = false;
    },

    handleMapClick() {
      this.isProviderModalOpen = false;
      this.isMarkerOptionsModalOpen = false;
      if (!this.isMinimized) {
        this.minimizeModal();
      }
      console.log("map click");
    },
    handleBookin(data) {
      if (data) {
        this.loading = false;
      }
    },
    goToProfile() {
      window.location.href = '/riders/public/rider/profile';
    },
    getProvider() {
      const me = this;
      const idUser = me.userp.id_user
      axios.get('rider/' + idUser)
        .then(response => {
          me.user = response.data
          console.log(response.data)
          me.loading = false;

        })
        .catch(error => {
          console.log(error)
        })
    },
    getidUser() {
      const me = this;

      axios.get('usuario/getUsuario')
        .then(response => {
          me.userp = response.data
          console.log(response.data)
          console.log(me.userp.id_user);

          me.getProvider()

        })
        .catch(error => {
          console.log(error)
        })
    },

    closeInitialModal() {

      this.isInitialModalOpen = false;
    },
    minimizeModal() {
      this.isMinimized = true;
      this.isMaximized = false;
      document.querySelector('.modal-content').style.display = 'none';
      document.querySelector('.modal-small-initial').style.minHeight = '10%';
      document.querySelector('.modal-small-initial').style.top = '84%';
      console.log('Minimizado');

    },
    maximizeModal() {
      this.isMinimized = false;
      this.isMaximized = true;
      document.querySelector('.modal-content').style.display = 'flex';
      if (window.matchMedia("(max-width: 1024px)")) {
        document.querySelector('.modal-small-initial').style.minHeight = '33%';
        document.querySelector('.modal-small-initial').style.top = '72%';
        document.querySelector('.modal-small-initial').style.transition = '0.5s';
        console.log('Maximizado');
      } else {
        document.querySelector('.modal-small-initial').style.minHeight = '50%';
        document.querySelector('.modal-small-initial').style.top = '72%';
        document.querySelector('.modal-small-initial').style.transition = '0.5s';
        console.log('Maximizado');
      }
      console.log('Maximizado');

    }

  },
  applyMarkerStyles(element) {
    element.style.backgroundColor = 'red';
    element.style.width = '30px';
    element.style.height = '30px';
    element.style.borderRadius = '50%';
    element.style.backgroundImage = "url('../images/puaM.png')";
    element.style.backgroundSize = 'cover';
    element.style.backgroundPosition = 'center';
  },
  addMarker(m) {
    const lng = parseFloat(m.Xcoord);
    const lat = parseFloat(m.Ycoord);
    if (!isNaN(lng) && !isNaN(lat)) {
      const el = document.createElement('div');
      el.className = 'custom-marker';
      this.applyMarkerStyles(el);  // Aplicar estilos definidos en la función

      const marker = new mapboxgl.Marker(el)
        .setLngLat([lng, lat])
        .setPopup(new mapboxgl.Popup({ offset: 25 }).setText(`Calle: ${m.location}`))
        .addTo(this.map);

      marker.getElement().addEventListener('click', (e) => {
        e.stopPropagation();
        this.selectedMarker = { marker, data: m };
        this.mendigo.id_customer = this.selectedMarker.data.id_customer;
        isProviderModalOpen.value = false;
        isMarkerOptionsModalOpen.value = false;
        isMarkerOptionsModalOpen.value = true;
      });
    } else {
      console.error('Coordenadas no válidas:', m.Xcoord, m.Ycoord);
    }
  },
  created() {
    this.getidUser()
  },
  setup() {
    const mapContainer = ref(null);
    const isModalOpen = ref(false);
    const isMarkerOptionsModalOpen = ref(false);
    const isProviderModalOpen = ref(false);
    const mendigo = ref({
      id_customer: '',
      Xcoord: '',
      Ycoord: '',
      location: '',
    });
    const provider = ref({
      id_customer: '',
    });
    const selectedMarker = ref(null);
    let map;
    const userName = ref('Rider');
    const userp = ref({ id_user: '' });
    const userLocation = ref(null);




    onMounted(async () => {
      mapboxgl.accessToken = 'pk.eyJ1IjoiaXNhYWNydWlpaXoiLCJhIjoiY2xzdW94NjlkMDd5azJrcWttem82M3RsNSJ9.5DxmiuHnmt9-z0I-eds7RQ';
      map = new mapboxgl.Map({
        container: mapContainer.value,
        style: 'mapbox://styles/mapbox/dark-v10',
        center: [2.1540, 41.3902],
        zoom: 12
      });

      const geolocateControl = new mapboxgl.GeolocateControl({
        positionOptions: {
          enableHighAccuracy: true
        },
        trackUserLocation: true,
        showUserLocation: true,
        fitBoundsOptions: {
          maxZoom: 20
        }
      });

      const getRider = async () => {
        if (userp.value.id_user) {
          try {
            const response = await axios.get(`usuario/getUsuario${userp.value.id_user}`);
            userName.value = response.data.name;
            console.log("Rider's name fetched:", userName.value);
          } catch (error) {
            console.error('Failed to fetch rider details:', error);
          }
        } else {
          console.error('User ID is not set in userp');
        }
      };

      map.addControl(geolocateControl);

      geolocateControl.on('geolocate', (e) => {
        userLocation.value = { longitude: e.coords.longitude, latitude: e.coords.latitude };
        map.easeTo({
          pitch: 45,
          center: [e.coords.longitude, e.coords.latitude],
          zoom: 13
        });
        setTimeout(() => {
          const userLocationDot = document.querySelector('.mapboxgl-user-location-dot');
          if (userLocationDot) {
            userLocationDot.style.backgroundColor = '#8BB481';

          }

          const userLocationPulse = document.querySelector('.mapboxgl-user-location-dot::before');
          if (userLocationPulse) {
            userLocationPulse.style.backgroundColor = 'none';
          }

          const userLocationAccuracyCircle = document.querySelector('.mapboxgl-user-location-accuracy-circle');
          if (userLocationAccuracyCircle) {
            userLocationAccuracyCircle.style.display = 'none';
          }
        }, 100);
      });

      map.on('load', () => {
        geolocateControl.trigger();
        selectMendigos();
        getRider();

      });

      map.on('click', (e) => {
        mendigo.value.Xcoord = e.lngLat.lng.toFixed(5);
        mendigo.value.Ycoord = e.lngLat.lat.toFixed(5);
        fetchStreetName(e.lngLat.lng, e.lngLat.lat);
      });
    });

    const selectMendigos = async () => {
      try {
        const response = await axios.get('customer');
        response.data.forEach((m) => {

          addMarker(m);
        });
      } catch (error) {
        console.error('Error al obtener los mendigos:', error);
      }
      try {
        const response2 = await axios.get('provider');
        response2.data.forEach((p) => {

          console.log(p.provider.adress)
          addMarkerWithAddress(p)
        });

      } catch (error) {
        console.error('Error al obtener los mendigos:', error);
      }

    };

    const getCoordinatesFromAddress = async (address) => {
      const bbox = "2.0695,41.3200,2.2280,41.4696"; // Bounding box para Barcelona
      const geocodingUrl = `https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(address)}.json?access_token=${mapboxgl.accessToken}&bbox=${bbox}`;
      try {
        const response = await axios.get(geocodingUrl);
        if (response.data.features.length > 0) {
          const coords = response.data.features[0].center;
          console.log(coords[0], coords[1]); // Log the coordinates
          return { lng: coords[0], lat: coords[1] };
        } else {
          console.log("No se encontraron resultados en el área especificada.");
          return null;
        }
      } catch (error) {
        console.error('Error al obtener coordenadas:', error);
        return null;
      }
    };

    const applyMarkerStyles = (element) => {
      //element.style.backgroundColor = 'red';
      element.style.width = '60px';
      element.style.height = '60px';
      element.style.borderRadius = '50%';
      element.style.backgroundImage = "url('../../resources/images/puaM2.png')";
      element.style.backgroundSize = 'cover';
      element.style.backgroundPosition = 'center';
    };

    const calculateAndDisplayRoute = async (start, end) => {
  if (!start || !end || !start.lng || !start.lat || !end.lng || !end.lat) {
    console.error('Invalid start or end coordinates', {start, end});
    return; // Termina la función si las coordenadas no son válidas
  }

  try {
    const url = `https://api.mapbox.com/directions/v5/mapbox/driving/${start.lng},${start.lat};${end.lng},${end.lat}?geometries=geojson&access_token=${mapboxgl.accessToken}`;
    const response = await axios.get(url);
    const data = response.data.routes[0];
    const route = data.geometry.coordinates;
    const geojson = {
      type: 'Feature',
      properties: {},
      geometry: {
        type: 'LineString',
        coordinates: route
      }
    };

    // Agrega o actualiza la capa de la ruta en el mapa
    if (map.getSource('route')) {
      map.getSource('route').setData(geojson);
    } else {
      map.addLayer({
        id: 'route',
        type: 'line',
        source: {
          type: 'geojson',
          data: geojson
        },
        layout: {
          'line-join': 'round',
          'line-cap': 'round'
        },
        paint: {
          'line-color': '#8BB481',
          'line-width': 7,
          'line-opacity': 1
        }
      });
    }
  } catch (err) {
    console.error('Error fetching the route:', err);
  }
};


    const applyMarkerStylesPro = (element) => {
      element.style.width = '60px';
      element.style.height = '60px';
      element.style.borderRadius = '50%';
      element.style.backgroundImage = "url('../../resources/images/puaPro.png')";
      element.style.backgroundSize = 'cover';
      element.style.backgroundPosition = 'center';
    };

    const addMarker = (m) => {
      const lng = parseFloat(m.Xcoord);
      const lat = parseFloat(m.Ycoord);
      if (!isNaN(lng) && !isNaN(lat)) {
        const el = document.createElement('div');
        applyMarkerStyles(el)


        const marker = new mapboxgl.Marker(el)
          .setLngLat([lng, lat])
          .setPopup(new mapboxgl.Popup({ offset: 25 }).setText(`Calle: ${m.location}`))
          .addTo(map);

        marker.getElement().addEventListener('click', (e) => {
          if (!userLocation.value) {
          alert('Waiting for user location...');
          return;
          }
          e.stopPropagation();
          selectedMarker.value = { marker, data: m };
          const start = {
          lng: userLocation.value.longitude,
          lat: userLocation.value.latitude                    
          };          
          console.log(userLocation.value.longitude);
          console.log(userLocation.value.latitude); 
          console.log("hola");  
          const end = marker.getLngLat(); 
          calculateAndDisplayRoute(start, end);
          mendigo.value.id_customer = selectedMarker.value.data.id_customer;
          isProviderModalOpen.value = false;
          isMarkerOptionsModalOpen.value = false;
         
          setTimeout(() => {
            isMarkerOptionsModalOpen.value = true;
          }, 500);
          console.log("apple")
        });
      } else {
        console.error('Coordenadas no válidas:', m.Xcoord, m.Ycoord);
      }
    };

    const addProviderMarker = (m) => {
      const lng = parseFloat(m.Xcoord);
      const lat = parseFloat(m.Ycoord);
      if (!isNaN(lng) && !isNaN(lat)) {
        const lo = document.createElement('div');
        applyMarkerStylesPro(lo)
        const marker = new mapboxgl.Marker(lo)
          .setLngLat([lng, lat])
          .setPopup(new mapboxgl.Popup({ offset: 25 }).setText(`Dirección: ${m.location}`))
          .addTo(map);

        marker.getElement().addEventListener('click', (e) => {
          e.stopPropagation();
          selectedMarker.value = { marker, data: m };
          provider.value.id_customer = selectedMarker.value.data.id;
          console.log("clicked")
          console.log("My prop:" + provider.value.id)
          isProviderModalOpen.value = false;
          isMarkerOptionsModalOpen.value = false;

          setTimeout(() => {
            isProviderModalOpen.value = true;
          }, 500);
        });
      } else {
        console.error('Coordenadas no válidas:', m.Xcoord, m.Ycoord);
      }
    };

    const addMarkerWithAddress = async (p) => {
      const coords = await getCoordinatesFromAddress(p.provider.adress);
      if (coords) {

        addProviderMarker({ ...p, id: p.provider.id_provider, Xcoord: coords.lng, Ycoord: coords.lat, location: p.provider.adress });
      }
    };

    const deleteUser = async () => {
      const me = this;

      axios.delete('customer/' + selectedMarker.value.data.id_customer)
        .then(response => {
          me.idUser = response.data

          console.log(response.data)
        })
        .catch(error => {
          console.log(error)
        })
    }


    const removeMarker = async () => {
      try {
        deleteUser();
        console.log(selectedMarker.value.data.id_customer)
        isMarkerOptionsModalOpen.value = false;
        selectedMarker.value.marker.remove();
      } catch (error) {
        console.error('Error al desactivar mendigo:', error);
        alert("Error al desactivar el mendigo.");
      }
    };

    const fetchStreetName = async (longitude, latitude) => {
      const geocodingUrl = `https://api.mapbox.com/geocoding/v5/mapbox.places/${longitude},${latitude}.json?access_token=${mapboxgl.accessToken}&types=address`;
      try {
        const response = await fetch(geocodingUrl);
        const data = await response.json();
        let streetName = 'Desconocido';
        if (data.features && data.features.length > 0) {

          const streetFeature = data.features.find(feature => feature.place_type.includes('address'));
          if (streetFeature) {

            streetName = streetFeature.text;
          } else {

            streetName = data.features[0].text;
          }
        }
        mendigo.value.location = streetName;
        console.log(data);
        isModalOpen.value = true;
      } catch (error) {
        console.error('Error al realizar reverse geocoding:', error);
      }
    }
      ;
    const confirmAddMarker = () => {
      addMarker(mendigo.value);
      isModalOpen.value = false;


      insertMendigo();
    };

    const insertMendigo = async () => {
      try {
        await axios.post('customer', mendigo.value);
      } catch (error) {
        console.error('Error al insertar mendigo:', error);
      }
    };

    const closeModal = () => {
      isModalOpen.value = false;
    };

    const closeMarkerOptionsModal = () => {
      isMarkerOptionsModalOpen.value = false;
    };


    return {
      mapContainer,
      isModalOpen,
      closeModal,
      confirmAddMarker,
      userp,
      userName,
      mendigo,
      provider,
      isMarkerOptionsModalOpen,
      closeMarkerOptionsModal,
      removeMarker,
      isProviderModalOpen,
    };
  },
};
</script>

<style scoped>
.modal-small-initial {
  display: flex;
  flex-direction: column;
  position: fixed;
  z-index: 2;
  left: 50%;
  top: 72%;
  transform: translate(-50%, -50%);
  width: 95%;
  min-height: 2%;
  background-color: #1e1e1edb;
  backdrop-filter: blur(9px);
  border-radius: 33px;
  padding: 2%;
  overflow: hidden;
  align-items: center;
  max-height: 33%;
  min-height: 33%;
}

.modal-scrollable {
  display: flex;
  flex-direction: column;
  position: fixed;
  z-index: 1050;
  left: 50%;
  top: 72%;
  transform: translate(-50%, -50%);
  width: 95%;
  min-height: 2%;
  background-color: #1e1e1edb;
  backdrop-filter: blur(9px);
  border-radius: 33px;
  padding: 2%;
  overflow-y: auto;
  overflow-x: hidden;
  align-items: center;
  max-height: 33%;
  min-height: 33%;
}

#hey:hover {
  background-position: right center;
  /* change the direction of the change here */
  cursor: pointer;
  scale: 1.02;
  transition: 0.5s;
}

#hey:focus {
  background-position: right center;
  /* change the direction of the change here */
  cursor: pointer;
  scale: 1.02;
  transition: 0.5s;
}

#hey {
  position: fixed;
  top: 5%;
  left: 2%;
  color: white;
  min-width: 45%;
  height: 7%;
  background-image: linear-gradient(to right, #8e8e8e99 0%, #5c5c5ca1 51%, #acacac9c 100%);
  background-size: 200% auto;
  backdrop-filter: blur(6px);
  z-index: 2;
  border-radius: 50px;
  display: flex;
  justify-content: center;
  align-items: center;
  justify-items: center;
  padding: 3%;
  transition: 0.5s;
}

@media (min-width: 500px) {
  #hey {
    min-width: 10%;
    padding: 2%;
  }

}

#cipoton {
  margin: 0px;
  color: #393939;
  font-size: 30px;
  font-weight: 500;
}

.map-container {
  height: 100vh;
  width: 100vw;
}

body {
  font-family: 'Outfit', sans-serif;
}

button {
  cursor: pointer;
  padding: 0.5rem 1rem;
  background-color: #8BB481;
  ;
  color: black;
  border: none;
  border-radius: 20px;
  align-items: center;
}

button:hover {
  background-color: #0056b3;
}

.modal {
  display: flex;
  flex-direction: row;
  position: fixed;
  z-index: 1050;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  width: 46%;
  max-width: 58%;
  height: 15%;
  background-color: #1E1E1E;
  color: white;
  border-radius: 19px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
  padding: 20px;
  overflow: hidden;
}

.modal-content {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  width: 100%;
  color: #8BB481;
}

.toggle-modal-size {
  display: flex;
  justify-content: space-between;
  margin-bottom: 10px;
}


#modalButton {
  margin-top: 20px;
  align-self: center;
}


.close {
  position: absolute;
  right: 1rem;
  top: 1rem;
  color: #6c757d;
  font-size: 1.5rem;
  background-color: transparent;
  border: 0;
}

.close:hover,
.close:focus {
  color: #343a40;
  cursor: pointer;
  text-decoration: none;
}

.modal-small {
  display: flex;
  flex-direction: column;
  position: fixed;
  z-index: 1050;
  left: 50%;
  top: 72%;
  transform: translate(-50%, -50%);
  width: 95%;
  min-height: 2%;
  background-color: #1e1e1edb;
  backdrop-filter: blur(9px);
  border-radius: 33px;
  padding: 2%;
  overflow: hidden;
  align-items: center;
  max-height: 33%;
  min-height: 33%;
}

.modal-small-button {
  cursor: pointer;
  padding: 0.5rem 1rem;
  background-color: #8BB481;
  color: white;
  border: none;
  border-radius: 32px;
  font-size: 16px;
  margin: 10px 0;
  width: 80%;
  text-align: center;
}

.modal-small-button:hover {
  background-color: #8BB481;
}

#navbar {
  width: 100%;
  left: 0%;
  right: 0%;
}

.custom-marker {
  background-color: red !important;
  width: 30px !important;
  height: 30px !important;
  border-radius: 50% !important;
  background-image: url("../images/puaM.png");
}

.mapboxgl-user-location-dot {
  background-color: green !important;
  /* Cambia el color a verde */
  border: 2px solid white;
  /* Opcional: añade un borde blanco para mayor visibilidad */
}

#minimize-modal-button {
  background: transparent;
  height: 50px;
  width: 50px;
  left: 85%;
  position: absolute;
  z-index: 999;
}

#maximize-modal-button {
  background: transparent;
  height: 50px;
  width: 50px;
  left: 85%;
  position: absolute;
  z-index: 999;
}

#click-to-open-text {
  color: #8F8F8F;
  text-align: center;
}

#save-pua-button {
  cursor: pointer;
  padding: 0.5rem 1rem;
  background-color: #8BB481;
  color: black;
  border: none;
  border-radius: 50px;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  font-weight: 600;
  height: 50%;
  margin-top: 10px;
}

#streetName {
  font-weight: 500;
  font-size: 20px;
  margin-right: 5%;
}

.alerts-container {
  top: 30%;
  position: absolute;
  background: transparent;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-left: 5%;
  margin-right: 5%;
  height: 18%;
  line-height: 1.2;
}

#alert-success-booking {
  background-color: #1e1e1eb5;
  backdrop-filter: blur(9px);
  border-radius: 26px;
  color: white;
  padding: 10px;
  height: 20%;
  width: 40%;
  font-weight: 500;
  color: #8BB481;
  font-size: 32px;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 100%;
  margin-left: 0;
  margin-left: 0;
}

#alert-danger-booking {
  background-color: #1e1e1eb5;
  backdrop-filter: blur(9px);
  border-radius: 26px;
  color: white;
  padding: 10px;
  height: 20%;
  width: 40%;
  font-weight: 500;
  color: #E46962;
  font-size: 32px;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 100%;
  margin-left: 0;
  margin-left: 0;
}

@media (min-width: 1024px) {
  #navbar {
    width: 38%;
    left: 0%;
    right: 0%;
  }

  .modal {
    display: flex;
    flex-direction: row;
    position: fixed;
    z-index: 1050;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    width: 15%;
    max-width: 58%;
    height: 20%;
    background-color: #1E1E1E;
    color: white;
    border-radius: 19px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
    padding: 20px;
    overflow: hidden;
  }

  .modal-small {
    display: flex;
    flex-direction: column;
    position: fixed;
    z-index: 2;
    left: 84%;
    top: 72%;
    transform: translate(-50%, -50%);
    width: 30%;
    min-height: 2%;
    background-color: #1e1e1edb;
    backdrop-filter: blur(9px);
    border-radius: 33px;
    padding: 1%;
    padding-top: 0;
    overflow: hidden;
    align-items: center;
    max-height: 50%;
    min-height: 50%;
    z-index: 1050;
  }

  #minimize-modal-button {
    background: transparent;
    height: 50px;
    width: 50px;
    margin-top: 0.5rem;
    left: 88%;
    position: absolute;
    z-index: 999;
    padding-left: 5px;
  }

  #maximize-modal-button {
    background: transparent;
    height: 50px;
    width: 50px;
    margin-top: 0.5rem;
    left: 88%;
    position: absolute;
    z-index: 999;
    padding-left: 5px;
  }

  .modal-small-initial {
    display: flex;
    flex-direction: column;
    position: fixed;
    z-index: 2;
    left: 84%;
    top: 72%;
    transform: translate(-50%, -50%);
    width: 30%;
    min-height: 2%;
    background-color: #1e1e1edb;
    backdrop-filter: blur(9px);
    border-radius: 33px;
    padding: 1%;
    padding-top: 0;
    overflow: hidden;
    align-items: center;
    max-height: 50%;
    min-height: 50%;
  }

  @media (min-width: 1700px) {
    #booking-card {
      background-color: #393939;
      border: none;
      width: 95%;
      /* margin-top: 10px; */
      --bs-card-bg: none;
      border-radius: 26px;
    }
  }

}

.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(30, 30, 30, 0.8); 
    backdrop-filter: blur(9px);
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 2em;
    z-index: 5000;
   }
   

#manzanita {
  position: fixed;
  top: 50%;
  left: 50%;
  width: 250px;
  height: 250px;
  transform: translate(-50%, -50%);
  overflow: hidden;
}

.image {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-size: cover;
  opacity: 0;
  animation: slideshow 1s infinite steps(1);
}


@keyframes slideshow {
  0% {
    opacity: 1;
  }

  12.5% {
    opacity: 0;
  }

  100% {
    opacity: 0;
  }
}

.image:nth-child(1) {
  animation-delay: 0s;
}

.image:nth-child(2) {
  animation-delay: 0.125s;
}

.image:nth-child(3) {
  animation-delay: 0.25s;
}

.image:nth-child(4) {
  animation-delay: 0.375s;
}

.image:nth-child(5) {
  animation-delay: 0.5s;
}

.image:nth-child(6) {
  animation-delay: 0.625s;
}

.image:nth-child(7) {
  animation-delay: 0.75s;
}

.image:nth-child(8) {
  animation-delay: 0.875s;
}
</style>
