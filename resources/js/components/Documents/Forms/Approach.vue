<template>
    <div class="col-md-12">
        <form class="form-horizontal" @submit.prevent="approachForm">
            <div class="form-group has-feedback has-feedback-left">
                <label for="title">Title</label>

                <!--<ckeditor name="approach" :editor="editor" v-model="document.approach.approach" :config="editorConfig" v-validate="'required|min:10'" placeholder="Approach text here ..." id="approach"></ckeditor>-->

                <textarea name="title" v-model="document.approach.title" class="form-control" v-validate="'required|min:10'" placeholder="Approach title text here ..." id="title"></textarea>
                <span v-if="errors.has('title')" class="text-danger">{{ errors.first('title') }}</span>
            </div>

            <div class="form-group">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Level</th>
                            <th style="width: 15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(level, index) in document.approach.levels">
                            <td>
                                <textarea name="title" v-model="level.text" class="form-control"  placeholder="Approach level text here ..."></textarea>
                            </td>
                            <td><button v-if="index > 0" type="button" class="btn btn-danger btn-xs" @click="deleteLevel(index)">Delete</button></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><button type="button" class="btn btn-success btn-xs" @click="addMoreLevel">+ Add More</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group has-feedback has-feedback-left">
                <label for="description">Description</label>
                <textarea name="description" v-model="document.approach.description" class="form-control" v-validate="'required|min:10'" placeholder="Approach description text here ..." id="description"></textarea>
                <span v-if="errors.has('description')" class="text-danger">{{ errors.first('description') }}</span>
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Next</button>
            </div>
        </form>
    </div>
</template>

<script>

//    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

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
            }
        }
    }
</script>