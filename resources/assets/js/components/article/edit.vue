<template>
    <div class="edit_area">
        <div class="input_area">
            <label for="subject">
                <i class="pork-icon-alert"></i>
            </label>
            <input type="text" name="subject" placeholder="标题" v-model="articleName" @blur="blur('title',$event.target.value)">
            <span class="wrong" v-show="wrong.title">标题不能为空</span>
        </div>
        <catg-list 
            :catgValue="catgValue"
            :wrong="wrong.catg"
            @blurstr="blur"
            @addCategory="addCategory"
            @deleteCategory="deleteCategory">
        </catg-list>
        <span class="wrong" v-show="wrong.catg">分类不能为空</span>
        <div class="editor_area">
            <mavon-editor 
                v-model="editorValue"
                placeholder="文章内容">
            </mavon-editor>
        </div>
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
                catgValue: [],
                wrong: {
                    title: false,
                    catg: false,
                }
            }
        },

        methods: {
            addCategory(item) {
                this.catgValue.push(item)
            },

            deleteCategory() {
                this.catgValue.splice(this.catgValue.length - 1, 1)
            },

            blur(type,val) {
                if(val.trim() == '') {
                    this.wrong[type] = true
                } else {
                    this.wrong[type] = false
                }
            },

            save() {
                if(!this.wrong.title || !this.wrong.catg) return 
                axios.post('/admin/article/create',{
                    articleName: this.articleName,
                    articleContent: this.editorValue,
                    category: this.catgValue,
                    userId: this.userId
                }).then(resp => {
                    let result = resp.data
                    if(result.success) {
                        alert('添加成功')
                        location.reload()
                    } else {
                        alert('添加失败')
                    }
                })
            }
        }
    }
</script>

<style lang="scss">
    .edit_area {

        .wrong {
            font-size: 12px;
            color: #e4393c;
        }

        .catg_wrong {

        }
        
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

        .editor_area {

        }
    }
</style>

