<template>
    <!-- Page header -->
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h4>
                    <i class="icon-arrow-left52 position-left"></i>
                    <span class="text-semibold">Home</span> - Dashboard
                    <small class="display-block">Good morning,  <span v-if="$auth.ready()">{{ $auth.user().first_name+' '+$auth.user().last_name }}</span>!</small>
                </h4>
            </div>
        </div>
    </div>
    <!-- /page header -->
</template>
<script>

    export default {
        name: 'PageHeader',
        mounted() {
        console.log('PageHeader mounted.')
    }
    }
</script>