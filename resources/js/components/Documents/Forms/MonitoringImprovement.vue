<template>
    <div class="col-md-12">
        <form class="form-horizontal" @submit.prevent="monitoringForm">

            <div class="form-group has-feedback has-feedback-left">
                <label for="m_improvement">Monitoring and Continuous Improvement</label>
                <ckeditor name="m_improvement" :editor="editor" v-model="document.approach.monitoring_improvement" :config="editorConfig" v-validate="'required|min:10'" placeholder="Monitoring and Continuous Improvement text here ..." id="m_improvement"></ckeditor>
                <span v-if="errors.has('m_improvement')" class="text-danger">{{ errors.first('m_improvement') }}</span>
            </div>

            <div class="form-group has-feedback has-feedback-left">
                <label for="evaluation_plan">Evaluation Plan</label>
                <ckeditor name="evaluation_plan" :editor="editor" v-model="document.approach.evaluation_plan" :config="editorConfig" v-validate="'required|min:10'" placeholder="Evaluation Plan text here ..." id="evaluation_plan"></ckeditor>
                <span v-if="errors.has('evaluation_plan')" class="text-danger">{{ errors.first('evaluation_plan') }}</span>
            </div>

            <div class="form-group has-feedback has-feedback-left">
                <label for="reporting">Reporting</label>
                <ckeditor name="reporting" :editor="editor" v-model="document.approach.reporting" :config="editorConfig" v-validate="'required|min:10'" placeholder="Reporting text here ..." id="reporting"></ckeditor>
                <span v-if="errors.has('reporting')" class="text-danger">{{ errors.first('reporting') }}</span>
            </div>

            <div class="form-group text-center">
                <button type="button" class="btn btn-info" @click="back">Back</button>
                <button type="submit" class="btn btn-primary">Next</button>
            </div>
        </form>
    </div>
</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
        name: 'MonitoringImprovement',
        props: {
            document: {
                type: Object,
            },
            currentTab: {
                type: Number,
                default () {
                    return 1
                }
            }
        },
        data () {
            return {
                editor: ClassicEditor,
                //  editorData: '<p>Content of the editor.</p>',
                editorConfig: {
                    // The configuration of the editor.
                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'ckfinder', 'imageUpload', 'blockQuote', 'insertTable', 'fontFamily', 'undo', 'redo' ],
                    ckfinder: {
                        uploadUrl: '/ckfinder/connector?command=QuickUpload&type=Files&responseType=json',
//                        uploadUrl: '/api/ckfinder/image/upload',
                    },
                },
                tabNo: this.currentTab,
            }
        },
        methods: {
            monitoringForm: function () {
                this.$validator.validateAll().
                        then((result) => {
                    if(result) {
                        this.tabNo +=1;
                        this.$emit('tabChanged', this.tabNo);
                        this.$emit('docChanged', this.document);
                    }
                });
            },

            back: function () {
                this.tabNo -=1;
                this.$emit('tabChanged', this.tabNo);
            }
        }
    }
</script>