<template>
    <div class="col-md-12">
        <form class="form-horizontal" @submit.prevent="keyEvolutionForm">

            <div class="form-group has-feedback has-feedback-left">
                <label for="keyevolution">Key Evolution Questions</label>
                <ckeditor name="keyevolution" :editor="editor" v-model="document.approach.key_evolution_questions" :config="editorConfig" v-validate="'required|min:10'" placeholder="Key Evolution Questions text here ..." id="keyevolution"></ckeditor>
                <span v-if="errors.has('keyevolution')" class="text-danger">{{ errors.first('keyevolution') }}</span>
            </div>

            <fieldset>
                <legend>Table: Key Evaluation Questions</legend>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Criteria</th>
                            <th>Key Evaluation Question</th>
                            <th>Sub-question</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="tbl in document.approach.key_evolution_tbl">
                            <td>
                                {{ tbl.criteria }}
                            </td>
                            <td>
                                <ckeditor name="evolution_question" v-model="tbl.question" :editor="editor" :config="editorConfig" placeholder="Question text here ..."></ckeditor>
                            </td>
                            <td>
                                <ckeditor name="evolution_sub_question" v-model="tbl.subQuestion" :editor="editor" :config="editorConfig" placeholder="Sub-Question text here ..."></ckeditor>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </fieldset>


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
        name: 'ScopeAudience',
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
            keyEvolutionForm: function () {
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
            },
        }
    }
</script>

<style>
    tbody .ck-editor__main .ck-content { height:85px !important; }
</style>