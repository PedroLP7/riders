<template>
    <div class="quantity-toggle">
      <button id="minus-button" @click="decrement()">&mdash;</button>
      <input type="text" id="pack-quantity" :value="quantity" readonly>
      <button id="plus-button" @click="increment()">&#xff0b;</button>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        quantity: 1
      };
    },
    methods: {
      increment() {
        this.quantity++;
        this.emitQuantity();
      },
      decrement() {
        if (this.quantity === 1) {
          alert('Negative quantity not allowed');
        } else {
          this.quantity--;
          this.emitQuantity();
        }
      },
      emitQuantity() {
      this.$emit('quantity-updated', this.quantity);
    }
    }
  };
  </script>
<style scoped>
.quantity-toggle {
  display: flex;
  justify-content: center;
  align-items: center;
}

#pack-quantity {
    background-color: #1E1E1E;
    width: 45%;
    height: 65px;
    border: none;
    color: white;
    font-size: 32px;
    font-weight: 500;
    border-radius: 50px;
    text-align: center;
}

#minus-button, #plus-button {
  display: flex;
  background: #8BB481;
  border: none;
  border-radius: 50px;
  height: 60px;
  width: 60px;
  font-size: 42px;
  font-weight: bold;
  justify-content: center;
  align-items: center;
}

#minus-button {
  margin-right: 3%;
}

#plus-button {
  margin-left: 3%;
}

</style>  