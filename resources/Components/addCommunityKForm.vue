<!-- src/components/HomePage.vue -->
<template>
    <div>
        <form>
            <div class="form-group">
                <label for="userName">User Name</label>
                <input
                    type="text"
                    class="form-control"
                    id="userName"
                    v-model="usuario.user_name"
                />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    class="form-control"
                    id="password"
                    v-model="usuario.password"
                />
            </div>
            <div class="form-group">
                <label for="dni">DNI</label>
                <input
                    type="text"
                    class="form-control"
                    id="dni"
                    v-model="usuario.dni_cif"
                />
            </div>
            <div class="form-group">
                <label for="realName">Real Name</label>
                <input
                    type="text"
                    class="form-control"
                    id="realName"
                    v-model="usuario.real_name"
                />
            </div>
            <div class="form-group">
                <label for="surname1">Apellido 1</label>
                <input
                    type="text"
                    class="form-control"
                    id="surname1"
                    v-model="usuario.surname1"
                />
            </div>
            <div class="form-group">
                <label for="surname2">Apellido 2</label>
                <input
                    type="text"
                    class="form-control"
                    id="surname2"
                    v-model="usuario.surname2"
                />
            </div>
            <div class="form-group">
                <label for="mail">Correo Electrónico</label>
                <input
                    type="email"
                    class="form-control"
                    id="mail"
                    v-model="usuario.mail"
                />
            </div>
            <div class="form-group">
                <label for="phoneNumber">Número de Teléfono</label>
                <input
                    type="tel"
                    class="form-control"
                    id="phoneNumber"
                    v-model="usuario.phone"
                />
            </div>
            <button @click="insertRider()" class="btn btn-primary">
                Registrar
            </button>
            <button
                type="button"
                class="btn btn-secondary"
                @click="showRiderForm = false"
            >
                Cancelar
            </button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "HomePage",
    };
</script>

<style scoped>
    /* Your component-specific styles here */
</style>
