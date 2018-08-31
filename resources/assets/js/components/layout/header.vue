<template>
    <header class="admin">
        <div class="logo" :style="{backgroundImage:avatar}">
        </div>
        <div class="control">
            <ul>
                <li class="logout">
                    <i class="icon logout_icon" @click="showUserDropdownList" />
                    <transition name="bounce">
                        <user-dropdown-list v-show="userDropDownList" @logout="logout" />
                    </transition>
                </li>
            </ul>
        </div>
    </header>
</template>

<script>
    import UserDropdownList from './UserDropDownList.vue'
    import axios from 'axios'
    import transition from 'vue'
    export default {
        props: {
            'avatar': '',
        },
        components: {
            UserDropdownList
        },
        data() {
            return {
                userDropDownList: false
            }
        },
    
        methods: {
            showUserDropdownList() {
                this.userDropDownList = !this.userDropDownList
            },
    
            logout() {
                axios.get('/admin/logout').then(resp => {
                    location.href = "/admin"
                })
            }
        }
    }
</script>

<style lang="scss">
    @mixin clearfloat {
        content: '';
        display: block;
        clear: both;
    }
    
    $headerHeight: 72px;
    header.admin {
        width: 100%;
        height: $headerHeight;
        background: #651FFF;
        &::after {
            @include clearfloat();
        }
        .logo {
            float: left;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #fff;
            margin-top: ($headerHeight - 30) / 2;
            margin-left: 100px;
        }
        .control {
            float: right;
            height: 100%;
            margin-right: 50px;
            .bounce-enter-active {
                animation: bounce-in .2s;
            }
            .bounce-leave-active {
                animation: bounce-in .2s reverse;
            }
            @keyframes bounce-in {
                0% {
                    transform: scale(0);
                }
                100% {
                    transform: scale(1);
                }
            }
            >ul {
                height: 100%;
                padding: 0;
                margin: 0;
                &::after {
                    @include clearfloat();
                }
                >li {
                    float: left;
                    width: 100px;
                    height: 36px;
                    margin-top: ($headerHeight - 30) / 2;
                    position: relative;
                    list-style: none;
                    cursor: pointer;
                    .icon {
                        display: block;
                        width: 30px;
                        height: 30px;
                        background-size: cover;
                        margin: 0 auto;
                    }
                    .icon.logout_icon {
                        background-image: url('./user.png');
                    }
                }
            }
        }
    }
</style>

