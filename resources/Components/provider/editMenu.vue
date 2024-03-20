<template lang="">
    <div>

        aqui se edita el menu clickado






    </div>
</template>
<script>
export default {
    data() {
        return {
            prueba: {},
        };
    },
    methods: {

        prueba2() {
            const prueba = document.getElementById('editMenu').getAttribute('data-id');
            console.log(prueba);
        }
    },
     created() {
        this.prueba2();
    }

}
</script>
<style lang="">

</style>
