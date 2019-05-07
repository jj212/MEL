<template>
    <div>
        <!--<Header></Header>-->
        <main>
            <router-view></router-view>
        </main>
        <Footer></Footer>
    </div>
</template>

<script>
    import Header from './partials/Header.vue'
    import Footer from './partials/Footer.vue'

    export default {
        name: 'app',
        components: {
            Header,
            Footer
        },
        mounted() {
            console.log('App mounted.')
        }
    }
</script>

<style>
    @import '/assets/css/icons/icomoon/styles.css';
    @import '/assets/css/bootstrap.css';
    @import '/assets/css/core.css';
    @import '/assets/css/components.css';
    @import '/assets/css/colors.css';
</style>
