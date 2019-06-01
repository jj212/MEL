<template>
    <div class="col-md-12">
        <form class="form-horizontal" @submit.prevent="ethicalConsiderationForm">

            <div class="form-group has-feedback has-feedback-left">
                <label for="ethicalconsideration">Ethical Considerations</label>
                <ckeditor name="ethicalconsideration" :editor="editor" v-model="document.approach.ethical_considerations" :config="editorConfig" placeholder="Approach scope audience text here ..." id="ethicalconsideration"></ckeditor>
                <span v-if="errors.has('ethicalconsideration')" class="text-danger">{{ errors.first('ethicalconsideration') }}</span>
            </div>

            <div class="form-group has-feedback has-feedback-left">
                <label for="limitation">Limitations</label>
                <ckeditor name="limitation" :editor="editor" v-model="document.approach.limitation" :config="editorConfig" placeholder="Approach limitation text here ..." id="limitation"></ckeditor>
                <span v-if="errors.has('limitation')" class="text-danger">{{ errors.first('limitation') }}</span>
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
        name: 'EthicalConsideration',
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
                },
                tabNo: this.currentTab,
            }
        },
        methods: {
            ethicalConsiderationForm: function () {
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