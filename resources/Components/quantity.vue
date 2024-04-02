<template>
    <div class="quantity-toggle">
      <button @click="decrement()">&mdash;</button>
      <input type="text" :value="quantity" readonly>
      <button @click="increment()">&#xff0b;</button>
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



</style>  