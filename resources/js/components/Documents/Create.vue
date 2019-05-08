<template>
    <div>
        <!--<Page-Header></Page-Header>-->
        <div class="container-fluid">
            <div class="row">
                <Progress-Bar :currentTab="currentTab"></Progress-Bar>
            </div>
        </div>
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
                                    <h4 class="panel-title">Generate Documents</h4>
                                </div>
                                <div class="panel-body">
                                    <Approach v-if="currentTab == 1" :document="document" :currentTab="currentTab" @docChanged="handleDocument" @tabChanged="handleCurrentTab"></Approach>
                                    <Approach-Principles v-if="currentTab == 2" :document="document" :currentTab="currentTab" @docChanged="handleDocument" @tabChanged="handleCurrentTab"></Approach-Principles>
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
    import ProgressBar from '../partials/ProgressBar.vue'
    import Approach from './Forms/Approach.vue'
    import ApproachPrinciples from './Forms/ApproachPrinciples.vue'

    export default {
        name: 'DocumentCreate',
        components: {
            ProgressBar,
            Approach,
            ApproachPrinciples
        },
        data () {
            return {
                document: {
                    approach: {
                        approach: '',
                        principles: ''
                    },
                },
                currentTab:1,
                serverErrors: [],
                showDismissibleAlert: false,
            }
        },
        methods: {
            handleDocument (event) {
                this.document = event;
            },
            handleCurrentTab (event) {
                console.log(event);
                this.currentTab = event;
            }
        }
    }
</script>