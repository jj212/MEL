<template>
    <div class="col-md-12">
        <form class="form-horizontal" @submit.prevent="approachPrinciplesForm">

            <div class="form-group has-feedback has-feedback-left">
                <label for="principles">Approach Principles</label>
                <textarea name="principles" v-model="document.approach.principles" class="form-control" v-validate="'required|min:10'" placeholder="Approach principles text here ..." id="principles"></textarea>
                <span v-if="errors.has('principles')" class="text-danger">{{ errors.first('principles') }}</span>
            </div>

            <div class="form-group text-center">
                <button type="button" class="btn btn-info" @click="back">Back</button>
                <button type="submit" class="btn btn-primary">Next</button>
            </div>
        </form>
    </div>
</template>

<script>

    export default {
        name: 'ApproachPrinciples',
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
            approachPrinciplesForm: function () {
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