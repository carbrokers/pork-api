<template>
    <div class="input_area">
        <label for="subject">
            <i class="pork-icon-yingyongpingtai"></i>
        </label>
        <div class="select_input">           
            <input type="text" name="subject"
                placeholder="分类"
                ref="input"
                v-model="value"
                @keyup.enter="createCategory"
                @keyup.delete="deleteCategry"
                @blur="onblur"
                :style="{'text-indent':textIndent}"

            />
            <div class="selected_area" ref="_select">
                <span v-for="(selected) in catgValue" :key="selected.id">
                    {{selected.name}}
                </span>
            </div>
        </div>
        <ul class="search_list" v-show="searchList.length > 0">
            <li v-for="(item) in searchList" :key="item.id" @click="selectCatg(item)">
                {{item.name}}
            </li>
        </ul>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {

        props: {
            catgValue: {
                type: Array
            }
        },

        data() {
            return {
                value: '',
                searchList: [],
                textIndent: '10px'
            }
        },

        methods: {
            createCategory() {
                if(this.value == '') return 
                let createData = {
                    id: Date.now(),
                    name: this.value,
                    isCreate: true
                }
                this.value = ''
                this.$emit('addCategory',createData)
                this.calcTextIndent()
            },

            deleteCategry() {
                if(this.value != '') return
                if(this.catgValue.length == 0) return 
                this.$emit('deleteCategory')
                this.calcTextIndent()
            },

            fetchCategoryList(newcatg) {
                axios.get('/admin/category',{
                    params: {
                        contain: newcatg
                    }
                }).then(resp => {
                    let data = resp.data
                    this.searchList = data
                })
            },

            selectCatg(selected) {
                let flag = this.catgValue.some(item => item.id == selected.id)
                if(!flag) {
                    this.value = ''
                    this.$emit('addCategory',selected)
                    this.calcTextIndent()
                } else {
                    this.value = ''
                }
            },

            calcTextIndent() {
                if(this.catgValue.length == 0) {
                   this.textIndent = '10px'
                   return 
                }
                this.textIndent = `${51 * this.catgValue.length + 5}px`
            },

            onblur() {
                let str = ''
                if(this.catgValue.length > 0) {
                    str = '111'
                }
                this.$emit('blurstr','catg',str)
            }

        },

        watch: {
            value: function(newcatg,oldcatg) {
                this.fetchCategoryList(newcatg)
            }
        }
    }
</script>

<style lang="scss" scoped>
    .input_area {
        position: relative;
        z-index: 1501;

        .search_list {
            position: absolute;
            margin: 0;
            left: 35px;
            width: 300px;
            top: 46px;
            font-size: 16px;
            min-height: 150px;
            border: 1px solid #ccc;
            background: #fff;
            box-sizing: border-box;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,.2);

            li {
                margin: 0;
                border-bottom: 1px solid rgb(227,226,227);
                box-sizing: border-box;
                cursor: pointer;
                padding: 10px;
            }

            li:hover {
                background: rgb(227,226,227);
            }

        }

        .select_input {
            position: relative;

            
            .selected_area {
                position: absolute;
                left: 36px;
                top: 8px;
                display: flex;
                align-items: center;
                font-size: 12px;

                span {
                    box-sizing: border-box;
                    margin-left: 3px;
                    display: inline-block;
                    padding: 5px;
                    border-radius: 5px;
                    line-height: 20px;
                    background-color: #009688;
                    color: #fff;
                    cursor: pointer;
                    width: 48px;
                    overflow: hidden;
                    text-overflow:ellipsis;
                    white-space: nowrap;
                    text-align: center;
                }
            }
        }

    }
</style>
