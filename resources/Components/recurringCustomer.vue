<template>
  <div>
    <div v-if="data != null">
      <div v-for="(user, index) in data.deliveries" :key="index">
        <div
          class="card customer-card"
          :style="{ backgroundColor: user.color }"
        >
          <div class="card-body" id="customer-card-body">
            <div id="card-body-text">
              <h5 id="customer-card-title">
                User {{ user.id_customer_fk }}
              </h5>
              <div v-if="user.customer">
                <p id="customer-card-text" class="card-text">
                  Adress: {{ user.customer.location }}
                </p>
              </div>
            </div>

            <div id="times-eaten-container" v-if="user.count">
              <h1 id="times-eaten-heading">{{ user.count }}</h1>
              <p id="times-eaten-text">Entregas</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-parte-inferior">
      <div class="container" id="navbar" v-if="!this.id">
          <navbar v-if="showComponente" />
      </div>
  </div>
</template>

<script>
import axios from "axios";
import navbar from "../Components/navbar.vue";

export default {
  components: {
    navbar,
  },
  data() {
    return {
      showComponente: true,
      data: null,
      usedColors: [], // Lista de colores utilizados
    };
  },

  created() {
    this.fetchRecurringCustomer();
  },

  methods: {
    fetchRecurringCustomer() {
      axios
        .get("/deliveriesByCustomer")
        .then((response) => {
          console.log(response);
          this.data = response.data;
          this.assignRandomColor(); // Asignar colores aleatorios al cargar los datos
        })
        .catch((error) => {
          console.error("Error fetching user data", error);
        });
    },
    assignRandomColor() {
      // Lista de colores predefinidos
      const colors = [
        "#ff5733",
        "#33ff57",
        "#5733ff",
        "#ff33a1",
        "#33a1ff",
      ];

      this.data.deliveries.forEach((user) => {
        let randomColor;
        // Seleccionar un color aleatorio que no se haya utilizado anteriormente
        do {
          randomColor = colors[Math.floor(Math.random() * colors.length)];
        } while (this.usedColors.includes(randomColor));

        user.color = randomColor; // Asignar el color al user
        this.usedColors.push(randomColor); // Registrar el color utilizado
      });
    },
  },
};
</script>

<style scoped>
.customer-card {
  width: 100%;
  height: 16%;
  border-radius: 22px;
  padding: 0;
  border: none;
}

#customer-card-img {
  position: absolute;
  width: 130px;
  left: 65%;
  bottom: 0;
  object-fit: contain;
}

#customer-card-body {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: center;
  padding: 0;
}

#times-eaten-container {
  width: 30%;
  height: 100%;
  background-color: white;
  opacity: 20%;
  border-radius: 0 0 22px 22px;
}
</style>
