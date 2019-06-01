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
                                    <h6 class="panel-title">Latest Generated Documents</h6>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Document</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="document in documents">
                                            <td>{{ document.path }}</td>
                                            <td>{{ document.created_at }}</td>
                                            <td>
                                                <a :href="'/'+ document.path" download>Download</a>
                                            </td>
                                        </tr>
                                        <tr v-if="documents.length == 0">
                                            <td colspan="3">Documents not available</td>
                                        </tr>
                                        </tbody>
                                    </table>
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
        data () {
            return {
                documents: []
            }
        },
        methods: {
            getDocuments() {
                this.axios.get('documents')
                        .then(res => {
                   this.documents = res.data.documents;
                }).catch(err => {
                    console.log(err);
                })
            }
        },
        mounted() {
            console.log('Dashboard mounted.')
        },
        created() {
            this.getDocuments();
        }
    }
</script>