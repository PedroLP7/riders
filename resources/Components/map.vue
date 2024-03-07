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
  <div v-if="isMarkerOptionsModalOpen" class="modal-overlay" @click="closeMarkerOptionsModal">
    <div class="modal" @click.stop>
      <span class="close" @click="closeMarkerOptionsModal">&times;</span>
      <button type="button" @click="removeMarker">Remover PUA</button>
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
    const isMarkerOptionsModalOpen = ref(false);
    const mendigo = ref({
      Xcoord: '',
      Ycoord: '',
      location: '',
    });
    const selectedMarker = ref(null);
    let map;

    onMounted(async () => {
      mapboxgl.accessToken = 'pk.eyJ1IjoiaXNhYWNydWlpaXoiLCJhIjoiY2xzdW94NjlkMDd5azJrcWttem82M3RsNSJ9.5DxmiuHnmt9-z0I-eds7RQ';
      map = new mapboxgl.Map({
        container: mapContainer.value,
        style: 'mapbox://styles/mapbox/dark-v10',
        zoom: 20
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

      map.addControl(geolocateControl);

      geolocateControl.on('geolocate', (e) => {
        map.easeTo({
          pitch: 45,
          center: [e.coords.longitude, e.coords.latitude],
          zoom: 13
        });
      });

      map.on('load', () => {
        geolocateControl.trigger();
        selectMendigos();
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
    };

    const addMarker = (m) => {
      const lng = parseFloat(m.Xcoord);
      const lat = parseFloat(m.Ycoord);
      if (!isNaN(lng) && !isNaN(lat)) {
        const marker = new mapboxgl.Marker()
          .setLngLat([lng, lat])
          .setPopup(new mapboxgl.Popup({ offset: 25 }).setText(`Calle: ${m.location}`))
          .addTo(map);
        
        marker.getElement().addEventListener('click', (e) => {
          e.stopPropagation();
          selectedMarker.value = { marker, data: m };
          isMarkerOptionsModalOpen.value = true;
        });
      } else {
        console.error('Coordenadas no válidas:', m.Xcoord, m.Ycoord);
      }
    };

    const removeMarker = () => {
      if (selectedMarker.value) {
        selectedMarker.value.marker.remove();
        // LLamar delete
        isMarkerOptionsModalOpen.value = false;
      }
    };

    const fetchStreetName = async (longitude, latitude) => {
      const geocodingUrl = `https://api.mapbox.com/geocoding/v5/mapbox.places/${longitude},${latitude}.json?access_token=${mapboxgl.accessToken}`;
      try {
        const response = await fetch(geocodingUrl);
        const data = await response.json();
        mendigo.value.location = data.features[0] ? data.features[0].place_name : 'Desconocido';
        isModalOpen.value = true;
      } catch (error) {
        console.error('Error al realizar reverse geocoding:', error);
      }
    };

    const confirmAddMarker = () => {
      addMarker(mendigo.value);
      isModalOpen.value = false;
      insertMendigo();
    };

    const insertMendigo = async () => {
      try {
        await axios.post('customer', mendigo.value);
        selectMendigos(); // Refrescar los marcadores
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
      mendigo,
      isMarkerOptionsModalOpen,
      closeMarkerOptionsModal,
      removeMarker
    };
  },
};
</script>

<style scoped>
.map-container {
  height: 100vh;
  width: 100vw;
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
