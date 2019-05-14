<template>
    <div class="col-md-12">
        <form class="form-horizontal" @submit.prevent="scopeAudienceForm">

            <div class="form-group has-feedback has-feedback-left">
                <label for="scopeaudience">Scope Audience</label>
                <ckeditor name="scopeaudience" :editor="editor" v-model="document.approach.scope_audience" :config="editorConfig" v-validate="'required|min:10'" placeholder="Approach scope audience text here ..." id="scopeaudience"></ckeditor>
                <!--<textarea name="principles" v-model="document.approach.principles" class="form-control" v-validate="'required|min:10'" placeholder="Approach principles text here ..." id="principles"></textarea>-->
                <span v-if="errors.has('scopeaudience')" class="text-danger">{{ errors.first('scopeaudience') }}</span>
            </div>

            <fieldset>
                <legend>Table: Evaluation Audience and their Information Needs</legend>

                <div v-for="tbl in document.approach.scope_audience_tbl" style="padding: 10px 40px; border: 2px dashed lightcoral;">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" v-model="tbl.name" v-validate="'required'" placeholder="Ex. Program implementation partners ...">
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Stakeholder</th>
                                <th>Information needs</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in tbl.data">
                                <td>
                                    <input type="text" v-model="item.stakeholder" name="stakeholder" class="form-control">
                                </td>
                                <td>
                                    <ckeditor name="need" v-model="item.need" :editor="editor" :config="editorConfig" v-validate="'required|min:10'" placeholder="Information needs text here ..."></ckeditor>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-xs" @click="addMoreItem(tbl.data)">+ Add More</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                </div>
                    <button type="button" class="btn btn-primary btn-xs" @click="addMoreAudience(document.approach.scope_audience_tbl)">+ Add More</button>
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
            scopeAudienceForm: function () {
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
            addMoreItem(data) {
                data.push({stakeholder: '', need:''});
            },
            addMoreAudience(data) {
                data.push({
                    name: '',
                    data: [
                        {stakeholder:'', need:''}
                    ]
                })
            },
            deleteLevel(index) {
//                this.document.approach.levels.splice(index,1)
            }
        }
    }
</script>

<style>
    tbody .ck-editor__main .ck-content { height:85px !important; }
</style>