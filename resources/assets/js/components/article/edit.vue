<template>
    <div class="edit_area">
        <div class="input_area">
            <label for="subject">
                <i class="pork-icon-alert"></i>
            </label>
            <input type="text" name="subject" placeholder="标题" v-model="articleName">
        </div>
        <catg-list 
            :catgValue="catgValue"
            @addCategory="addCategory"
            @deleteCategory="deleteCategory"
        />
        <mavon-editor 
            v-model="editorValue"
            placeholder="文章内容"
        />
        <div class="save" @click="save">
            save
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import CatgList from './catgComp.vue'
    export default {

        components: {
            CatgList
        },

        props: {
            selectedCatgs: {
                type: Array
            },
            userId: ""
        },

        data() {
            return {
                editorValue: '',
                articleName: '',
                catgValue: []
            }
        },
        
        methods: {
            addCategory(item) {
                this.catgValue.push(item)
            },

            deleteCategory() {
                this.catgValue.splice(this.catgValue.length - 1, 1)
            },

            save() {
                axios.post('/admin/article/create',{
                    articleName: this.articleName,
                    articleContent: this.editorValue,
                    category: this.catgValue,
                    userId: this.userId
                }).then(resp => {
                    console.log('success')
                })
            }
        }
    }
</script>

<style lang="scss">
    .edit_area {
        
        .input_area {
            font-size: 24px;
            margin-bottom: 15px;
            &::after {
                content: '';
                clear: both;
                display: block;
            }

            label {
                float: left;
                margin-top: 6px;
                margin-right: 10px;
                i {
                    font-size: 25px;
                }
            }

            input {
                box-sizing: border-box;
                outline: none;
                border-radius: 2px;
                border: 0;
                width: 300px;
                height: 45px;
                text-indent: 10px;
                border: 1px solid rgb(227,226,227);
                color: rgb(74, 74, 74)
            }
        }

        .save {
            margin-top: 20px;
            width: 80px;
            background: #651FFF;
            line-height: 40px;
            color: #fff;
            text-align: center;
            letter-spacing: 1px;
            border-radius: 5px;
            box-shadow: 1px 1px 4px rgba(0,0,0,0.15);
            cursor: pointer;
        }
    }
</style>

