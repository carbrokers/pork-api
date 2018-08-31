<template>
    <div class="login-form">
        <h3>LOGIN</h3>
        <div class="username-field">
            <div class="text" :class="{_animateTop:username._animateTop}" @click="inputFocus('username')">Username</div>
            <input type="text"
                @focus="inputFocus('username')"
                v-model="username.value" 
                @blur="blur('username',$event)" 
            />
            <span class="line"></span>
            <p class="wrong">{{username._tips}}</p>
        </div>
        <div class="password-field">
            <div class="text" :class="{_animateTop:password._animateTop}" @click="inputFocus('password')">Password</div>
            <input type="text" 
                @focus="inputFocus('password')"
                v-model="password.value" 
                @blur="blur('password',$event)" 
            />
            <span class="line"></span>
            <p class="wrong">{{password._tips}}</p>
        </div>
        <div class="submit" @click="submit">GO</div>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        data() {
            return {
               username: {
                   value: '',
                   _animateTop:false,
                   _tips: ''
               },
               password: {
                   value: '',
                   _animateTop:false,
                   _tips: ''
               }
            }
        },
        methods: {
            blur: function(type,ev){
               let value = ev.target.value
               let prefix = type == 'username' ? '用户名' : '密码'
               if(value.trim() == '') {
                   this[type]._tips = `${prefix}不能为空`
               } else {
                   this[type]._tips = ''
               }
            },

            inputFocus:function(type) {
                if(this[type].value == '') {
                    this[type]._animateTop = true
                    return 
                }
            },

            submit() {
                if(this.username.value == '') {
                    this.username._animateTop = true
                    this.username._tips = '用户名不能为空'
                    return 
                }
                if(this.password.value == '') {
                    this.password._animateTop = true
                    this.password._tips = '密码不能为空'
                    return 
                }

                axios({
                    url: '/admin/login',
                    method: 'post',
                    data: {
                        username:this.username.value,
                        password: this.username.value
                    }
                }).then(resp => {
                    location.href="/admin"
                })
            }
        }
    }
</script>

<style lang="scss">

    $paddingLeft: 40px;

    .login-form {
        box-sizing: border-box;
        padding: 40px $paddingLeft;
        position: absolute;
        height: 400px;
        width: 400px;
        top: 50%;
        left: 50%;
        margin-top: -200px;
        margin-left: -200px;
        background: #fff;
        border-radius: 20px;

        >h3 {
            color: #F44336;
            font-weight: 800;
            font-size: 30px;
            margin: 0;
        }

        .username-field,
        .password-field {
            position: relative;
            width: 400px - $paddingLeft * 2;
            margin: 0 auto;
            margin-bottom: 15px;
            padding-top: 40px;

            .text {
                font-size: 16px;
                position: absolute;
                z-index: 10;
                bottom: 8px;
                left: 0;
                color: #212121;
                transition: all 0.2s ease;
                width: 100%;
            }

            .text._animateTop {
                bottom: 32px;
                font-size: 12px;
                color: #9e9e9e;
            }

            input {
                position: relative;
                width: 100%;
                border: 0;
                outline: none;
                font-size: 18px;
                margin-bottom: 5px;
                color: #212121;
            }

            .line {
                display: block;
                width: 100%;
                height: 1px;
                background: #ccc;
            }

            .wrong {
                margin: 0;
                position: absolute;
                font-size: 12px;
                color: #e4393c;
                bottom: -21px;
            }
        }

        .submit {
            width: 60%;
            margin: 40px auto 0;
            height: 60px;
            box-sizing: border-box;
            // border: 2px solid rgb(228,1,66);
            border: 2px solid rgba(181, 175, 175, 0.45);
            color: #9e9e9e;
            cursor: pointer;
            line-height: 56px;
            text-align: center;
        }

        .submit:hover {
            color: rgb(228,1,66);
            border-color: rgb(228,1,66)
        }
    }
</style>
