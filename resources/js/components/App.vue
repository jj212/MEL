<template>
    <div>
        <Header v-if="$auth.check()"></Header>
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

</style>
