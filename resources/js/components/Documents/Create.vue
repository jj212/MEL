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

                        <div class="col-lg-9">

                            <!-- Marketing campaigns -->
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Generate Documents</h4>
                                </div>
                                <div class="panel-body">
                                    <Approach v-if="currentTab == 1" :document="document" :currentTab="currentTab" @docChanged="handleDocument" @tabChanged="handleCurrentTab"></Approach>
                                    <Approach-Principles v-if="currentTab == 2" :document="document" :currentTab="currentTab" @docChanged="handleDocument" @tabChanged="handleCurrentTab"></Approach-Principles>
                                    <Scope-Audience v-if="currentTab == 3" :document="document" :currentTab="currentTab" @docChanged="handleDocument" @tabChanged="handleCurrentTab"></Scope-Audience>
                                    <Ethical-Consideration v-if="currentTab == 4" :document="document" :currentTab="currentTab" @docChanged="handleDocument" @tabChanged="handleCurrentTab"></Ethical-Consideration>
                                    <Limitations v-if="currentTab == 5" :document="document" :currentTab="currentTab" @docChanged="handleDocument" @tabChanged="handleCurrentTab"></Limitations>
                                    <Complete v-if="currentTab == 6 && generatedDoc" :document="generatedDoc"></Complete>
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
    import ScopeAudience from './Forms/ScopeAudience.vue'
    import EthicalConsideration from './Forms/EthicalConsideration.vue'
    import Limitations from './Forms/Limitations.vue'
    import Complete from './Forms/Complete.vue'

    export default {
        name: 'DocumentCreate',
        components: {
            ProgressBar,
            Approach,
            ApproachPrinciples,
            ScopeAudience,
            EthicalConsideration,
            Limitations,
            Complete
        },
        data () {
            return {
                document: {
                    approach: {
                        approach: '',
                        principles: '',
                        scope_audience: '',
                        scope_audience_tbl: [{
                            name: '',
                            data: [
                                {stakeholder:'', need:''}
                            ]
                        }],
                        ethical_considerations: ''
                    },
                },
                generatedDoc:{},
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
                this.currentTab = event;
                if(this.currentTab == 6) {
                    this.generateDocument();
                }
            },
            generateDocument() {
                this.axios.post('documents', this.document)
                        .then(res => {
                    console.log(res);
                    this.generatedDoc = res.data.document;
//                    this.$swal(res.data.msg);
                    this.document = {approach: {}};

                }).catch(err => {
                    this.showDismissibleAlert = true;
                    this.serverErrors = [];
                    this.serverErrors.push(err.response.data.msg);
                })
            }
        }
    }
</script>