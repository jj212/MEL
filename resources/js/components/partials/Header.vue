<template>
    <div>
    <!-- Main navbar -->
    <div class="navbar navbar-inverse bg-indigo">
        <div class="navbar-header">
            <!--<router-link to="/dashboard"  class="navbar-brand"><img src="/assets/images/logo_light.png" alt=""></router-link>-->
            <router-link to="/dashboard"  class="navbar-brand"><strong>M & E</strong></router-link>

            <ul class="nav navbar-nav pull-right visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            </ul>
        </div>

        <div class="navbar-collapse collapse" id="navbar-mobile">

            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <img src="/assets/images/placeholder.jpg" alt="">
                        <span v-if="$auth.ready()">{{ $auth.user().first_name }}</span>
                        <i class="caret"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="javascript:void(0)"><i class="icon-user-plus"></i> My profile</a></li>
                        <li><a href="javascript:void(0)"><i class="icon-coins"></i> My balance</a></li>
                        <li class="divider"></li>
                        <li><a href="javascript:void(0);" @click="$auth.logout()"><i class="icon-switch2"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- /main navbar -->


    <!-- Second navbar -->
    <div class="navbar navbar-default" id="navbar-second">
        <ul class="nav navbar-nav no-border visible-xs-block">
            <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
        </ul>

        <div class="navbar-collapse collapse" id="navbar-second-toggle">
            <ul class="nav navbar-nav navbar-nav-material">
                <router-link tag="li" to="/dashboard">
                    <a><i class="icon-display4 position-left"></i> Dashboard</a>
                </router-link>
                <router-link tag="li" to="/documents/create">
                    <a><i class="icon-display4 position-left"></i> Documents</a>
                </router-link>
            </ul>

            <ul class="nav navbar-nav navbar-nav-material navbar-right">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-cog3"></i>
                        <span class="visible-xs-inline-block position-right">Share</span>
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="javascript:void(0)"><i class="icon-user-lock"></i> Account security</a></li>
                        <li class="divider"></li>
                        <li><a href="javascript:void(0)"><i class="icon-gear"></i> All settings</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- /second navbar -->
    </div>
</template>

<script>

    export default {
        name: 'Header',
        mounted() {
            console.log('Header mounted.')
        }
    }
</script>