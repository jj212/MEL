<template>
    <div>
        <Page-Header></Page-Header>
        <!-- Page container -->
        <div class="page-container">

            <!-- Page content -->
            <div class="page-content">

                <!-- Main content -->
                <div class="content-wrapper">


                    <!-- Dashboard content -->
                    <div class="row">
                        <div class="col-lg-12">

                            <!-- Marketing campaigns -->
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Marketing campaigns</h6>
                                </div>
                                <div class="panel-body">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                </div>
                            </div>
                            <!-- /marketing campaigns -->

                        </div>


                    </div>
                    <!-- /dashboard content -->

                </div>
                <!-- /main content -->

            </div>
            <!-- /page content -->

        </div>
        <!-- /page container -->
    </div>
</template>
<script>
    import PageHeader from './partials/PageHeader.vue'
    export default {
        name: 'Dashboard',
        components: {
            PageHeader
        },
        mounted() {
        console.log('Dashboard mounted.')
    }
    }
</script>