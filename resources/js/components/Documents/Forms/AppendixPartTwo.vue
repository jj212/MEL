<template>
    <div class="col-md-12">
        <form class="form-horizontal" @submit.prevent="monitoringForm">

            <div class="form-group has-feedback has-feedback-left">
                <label for="appendix_five">Appendix 5: Monitoring plan matrix</label>
                <ckeditor name="appendix_five" :editor="editor" v-model="document.approach.appendix_five" :config="editorConfig" placeholder="Monitoring and Continuous Improvement text here ..." id="appendix_five"></ckeditor>
                <span v-if="errors.has('appendix_five')" class="text-danger">{{ errors.first('appendix_five') }}</span>
            </div>

            <div class="form-group has-feedback has-feedback-left">
                <label for="appendix_six">Appendix 6: Monitoring data collection & analysis plan</label>
                <ckeditor name="appendix_six" :editor="editor" v-model="document.approach.appendix_six" :config="editorConfig" placeholder="Monitoring and Continuous Improvement text here ..." id="appendix_six"></ckeditor>
                <span v-if="errors.has('appendix_six')" class="text-danger">{{ errors.first('appendix_six') }}</span>
            </div>

            <div class="form-group has-feedback has-feedback-left">
                <label for="appendix_seven">Appendix 7: Evaluation plan matrix</label>
                <ckeditor name="appendix_seven" :editor="editor" v-model="document.approach.appendix_seven" :config="editorConfig" placeholder="Monitoring and Continuous Improvement text here ..." id="appendix_seven"></ckeditor>
                <span v-if="errors.has('appendix_seven')" class="text-danger">{{ errors.first('appendix_seven') }}</span>
            </div>

            <div class="form-group has-feedback has-feedback-left">
                <label for="appendix_eight">Appendix 8: Evaluation Data Collection Matrix</label>
                <ckeditor name="appendix_eight" :editor="editor" v-model="document.approach.appendix_eight" :config="editorConfig" placeholder="Monitoring and Continuous Improvement text here ..." id="appendix_eight"></ckeditor>
                <span v-if="errors.has('appendix_eight')" class="text-danger">{{ errors.first('appendix_eight') }}</span>
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
        name: 'AppendixPartTwo',
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