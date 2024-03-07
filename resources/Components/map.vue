<template>
  <div class="map-container" ref="mapContainer"></div>
  <div v-if="isModalOpen" class="modal-overlay" @click="closeModal">
    <div class="modal" @click.stop>
      <span class="close" @click="closeModal">&times;</span>
      <form @submit.prevent="confirmAddMarker">
        <div class="form-group">
          <label for="longitude">Longitud (x):</label>
          <input id="longitude" v-model="mendigo.Xcoord" type="text" required>
        </div>
        <div class="form-group">
          <label for="latitude">Latitud (y):</label>
          <input id="latitude" v-model="mendigo.Ycoord" type="text" required>
        </div>
        <div class="form-group">
          <label for="streetName">Calle:</label>
          <input id="streetName" v-model="mendigo.location" type="text" required>
        </div>
        <button type="button" @click="confirmAddMarker">Confirmar Ubicación</button>
      </form>
    </div>
  </div>
</template>


<script>
import mapboxgl from 'mapbox-gl';
import { ref, onMounted } from 'vue';
import axios from 'axios';


export default {
  setup() {
    const mapContainer = ref(null);
    const isModalOpen = ref(false);
    const mendigo = ref({
      Xcoord: '',
      Ycoord: '',
      location: '',
    });
    const mendigos = ref([]);

    let map;

    const selectMendigos = async () => {
      try {
        const response = await axios.get('customer'); 
        mendigos.value = response.data;
        mendigos.value.forEach((m) => {
          addMarker(m);
        });
      } catch (error) {
        console.error('Error al obtener los mendigos:', error);
      }
    };

    const addMarker = (m) => {
      const lng = parseFloat(m.Xcoord);
      const lat = parseFloat(m.Ycoord);
      if (!isNaN(lng) && !isNaN(lat)) {
        new mapboxgl.Marker()
          .setLngLat([lng, lat])
          .setPopup(new mapboxgl.Popup({ offset: 25 })
          .setText(`Calle: ${m.location}`))
          .addTo(map);        
      } else {
        console.error('Coordenadas no válidas:', m.Xcoord, m.Ycoord);
      }
    };

    const insertMendigo = async () => {
      try {       
        await axios.post('customer', mendigo.value);           
      } catch (error) {
        console.error('Error al insertar mendigo:', error);
      }
    };

    onMounted(async () => {
      mapboxgl.accessToken = 'pk.eyJ1IjoiaXNhYWNydWlpaXoiLCJhIjoiY2xzdW94NjlkMDd5azJrcWttem82M3RsNSJ9.5DxmiuHnmt9-z0I-eds7RQ';
      map = new mapboxgl.Map({
        container: mapContainer.value,
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [2.17, 41.38],
        zoom: 15,
    });

      const geolocateControl = new mapboxgl.GeolocateControl({
            positionOptions: {
              enableHighAccuracy: true
            },
            trackUserLocation: true,
            showUserLocation: true,
            fitBoundsOptions: {
              maxZoom: 15
            }
      });

      map.addControl(geolocateControl);

      map.on('load', () => {
    
        geolocateControl.trigger();
      });

      map.on('click', (e) => {
        mendigo.value.Xcoord = e.lngLat.lng.toFixed(5);
        mendigo.value.Ycoord = e.lngLat.lat.toFixed(5);
        fetchStreetName(e.lngLat.lng, e.lngLat.lat);
      });

      await selectMendigos();
    });

    async function fetchStreetName(longitude, latitude) {
      const geocodingUrl = `https://api.mapbox.com/geocoding/v5/mapbox.places/${longitude},${latitude}.json?access_token=${mapboxgl.accessToken}`;
      try {
        const response = await fetch(geocodingUrl);
        const data = await response.json();
        mendigo.value.location = data.features[0] ? data.features[0].place_name : 'Desconocido';
        isModalOpen.value = true;
      } catch (error) {
        console.error('Error al realizar reverse geocoding:', error);
      }
    }

    function closeModal() {
      isModalOpen.value = false;
    }

    function confirmAddMarker() {
      addMarker(mendigo.value);      
      closeModal();
        insertMendigo();
    }

    return { mapContainer, isModalOpen, closeModal, confirmAddMarker, mendigo };
  },
};
</script>










<style scoped>
.map-container {
  height: 100vh;
  width: 100vw;
}

.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal {
  background-color: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.close {
  float: right;
  font-size: 1.5rem;
  cursor: pointer;
}

.form-group {
  margin-bottom: 1rem;
}

.form-group label {
  display: block;
  margin-bottom: .5rem;
}

.form-group input[type="text"] {
  width: 100%;
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 4px;
}

button {
  cursor: pointer;
  padding: 0.5rem 1rem;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
}

button:hover {
  background-color: #0056b3;
}
</style>
