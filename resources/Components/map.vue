
<template>
  <div class="map-container" ref="mapContainer"></div>
  <div v-if="isModalOpen" class="modal-overlay" @click="closeModal">
    <div class="modal" @click.stop>
      <span class="close" @click="closeModal">&times;</span>
      <form @submit.prevent="addMarker">
        <div class="form-group">
          <label for="longitude">Longitud (x):</label>
          <input id="longitude" v-model="longitude" type="text" required>
        </div>
        <div class="form-group">
          <label for="latitude">Latitud (y):</label>
          <input id="latitude" v-model="latitude" type="text" required>
        </div>
        <div class="form-group">
          <label for="streetName">Calle:</label>
          <input id="streetName" v-model="streetName" type="text" required>
        </div>
        <button type="submit">Añadir Púa</button>
      </form>
    </div>
  </div>
</template>

<script>
import mapboxgl from 'mapbox-gl';
import { ref, onMounted } from 'vue';

export default {
  setup() {
    const mapContainer = ref(null);
    const isModalOpen = ref(false);
    const longitude = ref('');
    const latitude = ref('');
    const streetName = ref('');

    onMounted(() => {
      mapboxgl.accessToken = 'pk.eyJ1IjoiaXNhYWNydWlpaXoiLCJhIjoiY2xzdW94NjlkMDd5azJrcWttem82M3RsNSJ9.5DxmiuHnmt9-z0I-eds7RQ';
      const map = new mapboxgl.Map({
        container: mapContainer.value,
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [2.173296, 41.388002],
        zoom: 17,
      });

      map.on('click', async (e) => {
        longitude.value = e.lngLat.lng.toFixed(5);
        latitude.value = e.lngLat.lat.toFixed(5);

        const geocodingUrl = `https://api.mapbox.com/geocoding/v5/mapbox.places/${longitude.value},${latitude.value}.json?access_token=${mapboxgl.accessToken}`;
        try {
          const response = await fetch(geocodingUrl);
          const data = await response.json();
          streetName.value = data.features[0] ? data.features[0].place_name : 'Desconocido';
          isModalOpen.value = true;
        } catch (error) {
          console.error('Error al realizar reverse geocoding:', error);
        }
      });
    });

    function closeModal() {
      isModalOpen.value = false;
    }

    function addMarker(event) {
      new mapboxgl.Marker()
        .setLngLat([parseFloat(longitude.value), parseFloat(latitude.value)])
        .addTo(map);
      closeModal();
    }

    return { mapContainer, isModalOpen, closeModal, addMarker, longitude, latitude, streetName };
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
}

.close {
  float: right;
  font-size: 1.5rem;
  cursor: pointer;
}

.form-group {
  margin-bottom: 1rem;
}

label {
  display: block;
}

input[type="text"] {
  width: 100%;
  padding: 0.5rem;
}

button {
  cursor: pointer;
  padding: 0.5rem 1rem;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
}
</style>
