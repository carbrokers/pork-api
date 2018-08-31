<template>
    <div class="user_dropdown_list">
        <ul>
            <li @click="logout">logout</li>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {

            }
        },

        methods: {
            logout() {
                this.$emit('logout')
            }
        }
    }
</script>

<style lang="scss">
    .user_dropdown_list {
        position: absolute;
        width: 100%;
        background: #36465d;
        box-sizing: border-box;
        padding: 10px 5px;

        li {
            width: 100%;
            margin-top: 0 !important;
            margin: 0;
            height: 20px !important;
            font-size: 14px;
            color: #fff;
            text-align: center;
            line-height: 20px;
        }
    }
</style>
