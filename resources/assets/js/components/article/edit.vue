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
        <div class="editor_area">
            <mavon-editor 
                v-model="editorValue"
                @change="textChange"
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
            userId: "",
            articleId: {
                type: String || undefined
            }
        },

        data() {
            return {
                isEdit: this.articleId ? true : false,
                editorValue: '',
                articleName: '',
                catgValue: [],
                render: '',
                wrong: {
                    title: false,
                    catg: false,
                }
            }
        },

        mounted() {
            if(!this.isEdit) return 
            axios.post('/admin/article/edit',{
                id: this.articleId
            }).then(resp => {
                let {
                    title,
                    body,
                    categories,
                    render
                } = resp.data
                this.articleName = title
                this.editorValue = body
                this.catgValue = categories
                this.render = render
            })
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
            textChange(value, render) {
                this.render = render
            },

            save() {
                console.log(this.wrong.title)
                console.log(this.wrong.catg)
                if(this.wrong.title ||  this.wrong.catg) return 
                axios.post('/admin/article/save',{
                    userId: this.userId,
                    articleId: this.articleId,
                    isEdit: this.isEdit,
                    articleName: this.articleName,
                    articleContent: this.editorValue,
                    category: this.catgValue,
                    render: this.render
                }).then(resp => {
                    let result = resp.data
                    if(result.success) {
                        alert('添加成功')
                        location.href="/admin/article/list"
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

