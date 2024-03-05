
<template>
  <div class="map-container" ref="mapContainer"></div>
  <div v-if="isModalOpen" class="modal-overlay" @click="closeModal">
    <div class="modal" @click.stop>
      <span class="close" @click="closeModal">&times;</span>
      <form @submit.prevent="confirmAddMarker">
        <div class="form-group">
          <label for="longitude">Longitud (x):</label>
          <input id="longitude" v-model="mendigo.Xcoord" value="markerLongitude" type="text" required>
        </div>
        <div class="form-group">
          <label for="latitude">Latitud (y):</label>
          <input id="latitude" v-model="mendigo.Ycoord" value="markerLatitude" type="text" required>
        </div>
        <div class="form-group">
          <label for="streetName">Calle:</label>
          <input id="streetName" v-model="mendigo.location" value="streetName" type="text" required>
        </div>
        <button type="button" @click="insertMendigo, confirmAddMarker()">Confirmar Ubicación</button>
      </form>
    </div>
  </div>
</template>

<script>
import mapboxgl from 'mapbox-gl';
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
  data(){   

    return{      
      mendigo:{},
      mendigos:{}
    }
  },
  methods: {
    
    insertMendigo(){
      const me = this;
      alert('Formulario enviado!');
      axios
      .post('customer', me.mendigo)
        .then(response => {
            console.log(response);
        })
        .catch(error => {
            me.isError = true;
                me.messageError = error.response.data.error;
                console.log(error.response.data.error);
        });

    },

    selectMendigos()
    {
      const me = this;
      alert('Formulario enviado!');
      axios
      .get('customer')
        .then(response => {
            console.log(response);
            me.mendigos = response.data;
        })
        .catch(error => {
            me.isError = true;
                me.messageError = error.response.data.error;
                console.log(error.response.data.error);
        });


    }
  },
  created()
  {
    this.selectMendigos();

  },
  setup() {
    const mapContainer = ref(null);
    const isModalOpen = ref(false);
    const mendigo=({
      Xcoord: '',
      Ycoord: '',
      location: '',
    });
    let map;
    


    onMounted(async () => {
      mapboxgl.accessToken = 'pk.eyJ1IjoiaXNhYWNydWlpaXoiLCJhIjoiY2xzdW94NjlkMDd5azJrcWttem82M3RsNSJ9.5DxmiuHnmt9-z0I-eds7RQ';
      map = new mapboxgl.Map({
        container: mapContainer.value,
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [2.17, 41.38],
        zoom: 15,
      });
      

      // Añadir control de geolocalización al mapa para centrarlo en la ubicación del usuario
      map.addControl(new mapboxgl.GeolocateControl({
        positionOptions: { enableHighAccuracy: true },
        trackUserLocation: true,
        showUserLocation: true,
        fitBoundsOptions: { maxZoom: 10 },
      }));

      map.on('click', (e) => {
        //document.getElementById("longitude").value = e.lngLat.lng.toFixed(5);
        mendigo.Xcoord = e.lngLat.lng.toFixed(5);
        mendigo.Ycoord = e.lngLat.lat.toFixed(5);
        fetchStreetName(e.lngLat.lng, e.lngLat.lat);
      });
    });

    async function fetchStreetName(longitude, latitude) {
      const geocodingUrl = `https://api.mapbox.com/geocoding/v5/mapbox.places/${longitude},${latitude}.json?access_token=${mapboxgl.accessToken}`;
      try {
        const response = await fetch(geocodingUrl);
        const data = await response.json();
        mendigo.location = data.features[0] ? data.features[0].place_name : 'Desconocido';
        isModalOpen.value = true;
      } catch (error) {
        console.error('Error al realizar reverse geocoding:', error);
      }
    }

    function closeModal() {
      isModalOpen.value = false;
    }

    function confirmAddMarker() {
      new mapboxgl.Marker()
        .setLngLat([parseFloat(mendigo.Xcoord), parseFloat(mendigo.Ycoord)])
        .addTo(map);
      closeModal();
    }

    return { mapContainer, isModalOpen, closeModal, confirmAddMarker, mendigo};
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
