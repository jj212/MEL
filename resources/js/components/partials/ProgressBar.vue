<template>
    <div class="col-md-12 page ab-test">
        <div class="section-progress-block">
            <div class="container">
                <div class="progress-block">
                    <div class="progress-indicator">
                        <div style="width:692px;" class="progress-bar">
                            <div style="width:0%;" class="progress-bar-value"></div>
                        </div>
                        <div class="progress-indicator-tag-wrapper" style="left: -10px; top: -9px;">
                            <div v-bind:class="(currentTab > 1)?'progress-indicator-tag-complete':'progress-indicator-tag'" class="progress-indicator-tag">
                                <div class="progress-indicator-tag-circle"></div>
                                <div class="progress-indicator-tag-name progress-active" v-bind:class="{'progress-active': currentTab == 1}">Approach</div>
                            </div>
                        </div>
                        <div class="progress-indicator-tag-wrapper" style="left: 356px; top: -9px;">
                            <div v-bind:class="(currentTab > 2)?'progress-indicator-tag-complete':'progress-indicator-tag'" class="progress-indicator-tag">
                                <div class="progress-indicator-tag-circle"></div>
                                <div class="progress-indicator-tag-name" v-bind:class="{'progress-active': currentTab == 2}">Approach Principles</div>
                            </div>
                        </div>
                        <!--<div class="progress-indicator-tag-wrapper" style="left: 340px; top: -9px;">
                            <div v-bind:class="(currentTab > 3)?'progress-indicator-tag-complete':'progress-indicator-tag'" class="progress-indicator-tag">
                                <div class="progress-indicator-tag-circle"></div>
                                <div class="progress-indicator-tag-name" v-bind:class="{'progress-active': currentTab == 3}">Document Category</div>
                            </div>
                        </div>
                        <div class="progress-indicator-tag-wrapper" style="left: 515px; top: -9px;">
                            <div v-bind:class="(currentTab > 4)?'progress-indicator-tag-complete':'progress-indicator-tag'" class="progress-indicator-tag">
                                <div class="progress-indicator-tag-circle"></div>
                                <div class="progress-indicator-tag-name" v-bind:class="{'progress-active': currentTab == 4}">Loan Info</div>
                            </div>
                        </div>-->
                        <div class="progress-indicator-tag-wrapper" style="left: 690px; top: -9px;">
                            <div v-bind:class="(currentTab > 3)?'progress-indicator-tag-complete':'progress-indicator-tag'" class="progress-indicator-tag">
                                <div class="progress-indicator-tag-circle"></div>
                                <div class="progress-indicator-tag-name" v-bind:class="{'progress-active': currentTab == 3}">Complete</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'ProgressBar',
        props: {
            currentTab: {
                type: Number,
                default () {
                    return 1
                }
            }
        },
    }
</script>

<style scoped>
    /*=============Progress===============*/

    .page.ab-test .section-progress-block {
        height: 55px;
        margin-top: 25px;
    }
    .page.ab-test div {
        display: block !important;
    }
    .page.ab-test .section-progress-block>.container {
        margin: 0 auto;
        max-width: 100%;
        box-sizing: border-box;
        height: 100%;
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
    }
    .page.ab-test .section-progress-block>.container .progress-block {
        width: 80%;
        height: inherit;
        position: relative;
        left: 50%;
        -webkit-transform: translateX(-50%);
        -ms-transform: translateX(-50%);
        transform: translateX(-50%);
    }
    .page.ab-test .section-progress-block>.container .progress-block .progress-indicator {
        position: absolute;
        left: 50%;
        top: 54%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }
    .page.ab-test .progress-bar {
        position: relative;
        height: 3px;
        z-index: 0;
    }
    .page.ab-test .progress-bar .progress-bar-value {
        height: 100%;
        background: #2996CC;
        -webkit-transition: all 0.4s ease-in-out;
        transition: all 0.4s ease-in-out;
    }
    .page.ab-test .progress-indicator .progress-indicator-tag-wrapper {
        position: absolute;
        width: 20px;
        height: 20px;
    }
    .page.ab-test .progress-indicator-tag-current {
        position: relative;
        display: -webkit-inline-box;
        display: -webkit-inline-flex;
        display: -ms-inline-flexbox;
        display: inline-flex;
        -webkit-flex-flow: column-reverse;
        -ms-flex-flow: column-reverse;
        flex-flow: column-reverse;
        width: 20px;
        height: 20px;
    }
    .page.ab-test .progress-indicator-tag-current .progress-indicator-tag-circle {
        width: 18px;
        height: 18px;
        border: 1px solid silver;
        border-radius: 50% !important;
        margin: 0 auto;
        /*cursor: pointer;*/
        background: white;
    }
    .page.ab-test .progress-indicator-tag-current .progress-indicator-tag-circle {
        width: 16px;
        height: 16px;
        border: 2px solid #f69768;
    }
    .page.ab-test .progress-indicator-tag .progress-indicator-tag-name {
        position: absolute;
        font-family: "Open Sans","Helvetica Neue",Arial,Helvetica,Verdana,sans-serif;
        font-weight: normal;
        font-size: 14px;
        color: #C0C0C0;
        top: -20px;
        white-space: nowrap;
        left: 50%;
        -webkit-transform: translateX(-50%);
        -ms-transform: translateX(-50%);
        transform: translateX(-50%);
        letter-spacing: 0.5px;
    }
    .page.ab-test .progress-indicator-tag-current .progress-indicator-tag-name {
        font-weight: bold;
        color: #F69768;
    }
    .page.ab-test .progress-indicator-tag .progress-indicator-tag-circle {
        width: 18px;
        height: 18px;
        border: 1px solid silver;
        border-radius: 50% !important;
        margin: 0 auto;
        /*cursor: pointer;*/
        background: white;
    }
    .page.ab-test .progress-indicator-tag {
        position: relative;
        display: -webkit-inline-box;
        display: -webkit-inline-flex;
        display: -ms-inline-flexbox;
        display: inline-flex;
        -webkit-flex-flow: column-reverse;
        -ms-flex-flow: column-reverse;
        flex-flow: column-reverse;
        width: 20px;
        height: 20px;
    }
    .page.ab-test .progress-indicator-tag-complete {
        position: relative;
        display: -webkit-inline-box;
        display: -webkit-inline-flex;
        display: -ms-inline-flexbox;
        display: inline-flex;
        -webkit-flex-flow: column-reverse;
        -ms-flex-flow: column-reverse;
        flex-flow: column-reverse;
        width: 20px;
        height: 20px;
    }
    .page.ab-test .progress-indicator-tag-complete .progress-indicator-tag-circle {
        width: 20px;
        height: 20px;
        border: 0px solid transparent;
        border-radius: 50% !important;
        background-color: #2996CC;
        background-image: url(https://app.legaltemplates.net/assets/icon_progress_bar_checked-1fb8d38d25c32ee9c61fe566ebd77868.png);
        background-repeat: no-repeat;
        background-position: center;
        margin: 0 auto;
    }

    .page.ab-test .progress-indicator-tag-complete .progress-indicator-tag-name {
        position: absolute;
        font-family: "Open Sans","Helvetica Neue",Arial,Helvetica,Verdana,sans-serif;
        font-size: 14px;
        top: -20px;
        white-space: nowrap;
        left: 50%;
        -webkit-transform: translateX(-50%);
        -ms-transform: translateX(-50%);
        transform: translateX(-50%);
        letter-spacing: 0.5px;
        font-weight: bold;
        color: #2996CC;
    }
    .page.ab-test .progress-bar::before {
        position: absolute;
        display: block;
        content: " ";
        background: #C0C0C0;
        top: 1px;
        height: 1px;
        width: 100%;
        z-index: -1;
    }

    .progress-active {
        color: green !important;
        font-weight: 600 !important;
    }
</style>