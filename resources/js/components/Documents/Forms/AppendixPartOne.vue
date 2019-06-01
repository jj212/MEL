<template>
    <div class="col-md-12">
        <form class="form-horizontal" @submit.prevent="monitoringForm">

            <div class="form-group has-feedback has-feedback-left">
                <label for="appendix_one">Appendix 1: Program logic</label>
                <ckeditor name="appendix_one" :editor="editor" v-model="document.approach.appendix_one" :config="editorConfig" placeholder="Monitoring and Continuous Improvement text here ..." id="appendix_one"></ckeditor>
                <span v-if="errors.has('appendix_one')" class="text-danger">{{ errors.first('appendix_one') }}</span>
            </div>

            <div class="form-group has-feedback has-feedback-left">
                <label for="appendix_two">Appendix 2: Theory of change</label>
                <ckeditor name="appendix_two" :editor="editor" v-model="document.approach.appendix_two" :config="editorConfig" placeholder="Monitoring and Continuous Improvement text here ..." id="appendix_two"></ckeditor>
                <span v-if="errors.has('appendix_two')" class="text-danger">{{ errors.first('appendix_two') }}</span>
            </div>

            <div class="form-group has-feedback has-feedback-left">
                <label for="appendix_three">Appendix 3: Rubric for Business Resilience</label>
                <ckeditor name="appendix_three" :editor="editor" v-model="document.approach.appendix_three" :config="editorConfig" placeholder="Monitoring and Continuous Improvement text here ..." id="appendix_three"></ckeditor>
                <span v-if="errors.has('appendix_three')" class="text-danger">{{ errors.first('appendix_three') }}</span>
            </div>

            <div class="form-group has-feedback has-feedback-left">
                <label for="appendix_four">Appendix 4: Prospective timeline</label>
                <ckeditor name="appendix_four" :editor="editor" v-model="document.approach.appendix_four" :config="editorConfig" placeholder="Monitoring and Continuous Improvement text here ..." id="appendix_four"></ckeditor>
                <span v-if="errors.has('appendix_four')" class="text-danger">{{ errors.first('appendix_four') }}</span>
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
        name: 'AppendixPartOne',
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