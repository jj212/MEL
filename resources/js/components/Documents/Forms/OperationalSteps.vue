<template>
    <div class="col-md-12">
        <form class="form-horizontal" @submit.prevent="operationalForm">

            <div class="form-group has-feedback has-feedback-left">
                <label for="operational_steps">How the operational components of the MERI framework fit together</label>
                <ckeditor name="operational_steps" :editor="editor" v-model="document.approach.operational_steps" :config="editorConfig" placeholder="Approach scope audience text here ..." id="operational_steps"></ckeditor>
                <span v-if="errors.has('operational_steps')" class="text-danger">{{ errors.first('operational_steps') }}</span>
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
        name: 'Limitations',
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
            operationalForm: function () {
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