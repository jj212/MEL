<template>
    <div class="col-md-12">
        <form class="form-horizontal" @submit.prevent="approachForm">
            <div class="form-group has-feedback has-feedback-left">
                <label for="title">Approach</label>

                <ckeditor name="approach" :editor="editor" v-model="document.approach.approach" :config="editorConfig" v-validate="'required|min:10'" placeholder="Approach text here ..." id="approach"></ckeditor>

                <!--<textarea name="title" v-model="document.approach.title" class="form-control" v-validate="'required|min:10'" placeholder="Approach title text here ..." id="title"></textarea>-->
                <span v-if="errors.has('title')" class="text-danger">{{ errors.first('title') }}</span>
            </div>

            <div class="form-group has-feedback has-feedback-left">
                <label for="principles">Approach Principles</label>
                <ckeditor name="principles" :editor="editor" v-model="document.approach.principles" :config="editorConfig" v-validate="'required|min:10'" placeholder="Approach principles text here ..." id="principles"></ckeditor>
                <span v-if="errors.has('principles')" class="text-danger">{{ errors.first('principles') }}</span>
            </div>


            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Next</button>
            </div>
        </form>
    </div>
</template>

<script>

    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
//    import ClassicEditor from '@ckeditor/ckeditor5-editor-classic/src/classiceditor';
//    import FontPlugin from '@ckeditor/ckeditor5-font/src/font';
//    import ParagraphPlugin from '@ckeditor/ckeditor5-paragraph/src/paragraph';


    export default {
        name: 'Approach',
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
                    /*plugins: [
                        FontPlugin
                    ],*/
            // The configuration of the editor.
//                    toolbar: [ 'bold', 'italic', '|', 'link', 'fontFamily' ]
//                    toolbar: [ 'ckfinder', 'imageUpload', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo' ],
                    ckfinder: {
                        uploadUrl: '/ckfinder/connector?command=QuickUpload&type=Files&responseType=json',
//                        uploadUrl: '/api/ckfinder/image/upload',
                    },

                },
                tabNo: this.currentTab,
            }
        },
        methods: {
            approachForm: function () {
                this.$validator.validateAll().
                        then((result) => {
                    if(result) {
                        this.tabNo = 2;
                        this.$emit('docChanged', this.document);
                        this.$emit('tabChanged', this.tabNo);
                    }
                });

            },
            addMoreLevel() {
                this.document.approach.levels.push({text: ''});
            },
            deleteLevel(index) {
                this.document.approach.levels.splice(index,1)
            },
            upload() {
                alert('hhhh');
            }
        }
    }
</script>

<style>
    .ck-editor__main .ck-content { height:220px; }
</style>