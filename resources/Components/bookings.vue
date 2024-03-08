<template>
    <div>
        <H1>PACKS EN CAMINO</H1>

        <div class="card mt-3" style="width: 18rem;" v-for="menu in user.provider.menus">

            <div class="card-body">
                <h5 class="card-title">Menu {{ menu.id_menu }} </h5>
                <img src="../images/menu.png" class="card-img-top" alt="imgmenu" id="imgmenu">
                <p class="card-text"> item1 :{{ menu.item1 }}
                    <br>
                    item 2 :{{ menu.item2 }}
                    <br>
                    item 3 :{{ menu.item3 }}
                    <br>
                    cantidad : {{ menu.pivot.quantity }}
                </p>


            </div>
        </div>

    </div>
</template>
<script>
export default {

}
</script>
<style></style>
