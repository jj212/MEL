<template>
    <div class="col-md-12">
        <form class="form-horizontal" @submit.prevent="approachForm">
            <div class="form-group has-feedback has-feedback-left">
                <label for="approach">Approach</label>

                <ckeditor name="approach" :editor="editor" v-model="document.approach.approach" :config="editorConfig" v-validate="'required|min:10'" placeholder="Approach text here ..." id="approach"></ckeditor>

                <!--<textarea name="approach" v-model="document.approach.approach" class="form-control" v-validate="'required|min:10'" placeholder="Approach text here ..." id="approach"></textarea>-->
                <span v-if="errors.has('approach')" class="text-danger">{{ errors.first('approach') }}</span>
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Next</button>
            </div>
        </form>
    </div>
</template>

<script>

    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

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
//                editorData: '<p>Content of the editor.</p>',
                editorConfig: {
                    // The configuration of the editor.
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

            }
        }
    }
</script>