<template>

  <h1 id="saved-puas-title">PUAs más recurrentes</h1>

  <div style="margin-top: 5%;">
    <div v-if="data != null">
      <div v-for="(user, index) in data.deliveries" :key="index">
        <div
          class="card customer-card"
          :style="{ backgroundColor: user.color }"
        >
          <div class="card-body" id="customer-card-body">
            <div id="card-body-text">
              <h5 id="customer-card-title">
                Usuario {{ user.id_customer_fk }} <br> en
              </h5>
              <div v-if="user.customer">
                <p id="customer-card-text" class="card-text">
                  {{ user.customer.location }}
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

  <div class="container-parte-inferior-puas">
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
        "#9747FF",
        "#E9A859",
        "#E9C159",
        "#617F7D",
        "#5B4A34",
        "#FF6B6B",
        "#FAA916",
        "#1ABC9C",
        "#3498DB",
        "#9B59B6",
        "#F39C12",
        "#27AE60",
        "#2980B9",
        "#8E44AD",
        "#E67E22",
        "#2C3E50",
        "#F1C40F",
        "#16A085",
        "#E74C3C",
        "#34495E",
        "#D35400",
        "#7F8C8D",
        "#8DB6A1",
        "#6D214F",
        "#F0E5CF",
        "#B2DBBF",
        "#BA5A31",
        "#A09ABE",
        "#E6B0AA",
        "#1E90FF",
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
#saved-puas-title {
    color: #8F8F8F;
    font-weight: bold;
    margin-top: 20%;
    margin-left: 2%;
}

.customer-card {
  width: 100%;
  height: 17%;
  border-radius: 22px;
  padding: 0;
  border: none;
  margin-bottom: 2%;
}

#customer-card-title {
  font-size: 42px;
  font-weight: bold;
  color: #FFFFFF;
  margin: 0;
  line-height: 1;
}

#customer-card-text {
  font-size: 18px;
  font-weight: 300;
  color: #FFFFFF;
  margin: 0;
}

#customer-card-body {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: center;
  padding: 0;
  padding-left: 5%;
}

#times-eaten-container {
  width: 35%;
  height: 100%;
  background-color: #ffffff3b;
  border-radius: 0 22px 22px 0;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

#times-eaten-heading {
  font-size: 96px;
  font-weight: bold;
  color: #FFFFFF;
  text-align: center;
  margin: 0;
  line-height: 0.8;
}

#times-eaten-text {
  font-size: 20px;
  font-weight: 400;
  color: #FFFFFF;
  text-align: center;
  margin: 0;
}

.container-parte-inferior-puas {
  height: 200px;
  display: flex; /* Added this line */
  justify-content: center; /* This centers the navbar horizontally */
  align-items: center; /* This centers the navbar vertically (optional) */
}
</style>
