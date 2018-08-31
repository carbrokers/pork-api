<template>
  <div class="summary">
      <el-tooltip content="文章数量" placement="top">
        <div class="article_count icons_container">
            <i class="pork-icon-edit-square"></i>
            <span>{{count.article}}</span>
        </div>
      </el-tooltip>
      <el-tooltip content="分类数量" placement="top">
        <div class="article_count icons_container">
            <i class="pork-icon-file-text"></i>
            <span>{{count.category}}</span>
        </div>
      </el-tooltip>
      <el-tooltip content="点赞数量" placement="top">
        <div class="article_count icons_container">
            <i class="pork-icon-like"></i>
            <span>0</span>
        </div>
      </el-tooltip>
  </div>
</template>

<script>
export default {
    props: {
        back_count: {
            type: String
        }
    },
    data() {
        return {
            count: JSON.parse(this.back_count)
        }
    },
}
</script>

<style lang="scss">
    @mixin clearfloat {
        clear: both;
        display: block;
        content: "";
    }
    .summary {
        padding-top: 20px;
        display: flex;
        justify-content: center;

        .icons_container {
            cursor: pointer;
            display: inline-block;
            box-sizing: border-box;
            width: 250px;
            height: 150px;
            box-shadow: 0 0 0 1px #8561c5;
            border-radius: 10px;
            text-align: center;
            padding: 15px;
            color: #8561c5;
            margin-right: 30px;

            i {
                font-size: 72px;
                
            }

            span {
                display: block;
                margin-top: 5px;
            }
        }
    }
</style>

