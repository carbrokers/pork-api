<template>
    <div class="article_list_container">
        <div class="alert_container">
            <div>
                <el-alert
                    v-show="alert"
                    title="删除成功"
                    :type="alert"
                    show-icon>
                </el-alert>
            </div>
        </div>
        <el-table
            :data="tableData"
            style="width: 100%">
            <el-table-column
            label="创建日期"
            width="360">
            <template slot-scope="scope">
                <i class="el-icon-time"></i>
                <span style="margin-left: 10px">{{ scope.row.date }}</span>
            </template>
            </el-table-column>
            <el-table-column
            label="标题"
            width="600">
            <template slot-scope="scope" class="title_area">
                <el-popover trigger="hover" placement="left">
                <p class="title_link">链接: 
                    <!-- {{ scope.row.name }} -->
                    <a v-bind:href="scope.row.url">点击跳转</a>
                </p>
                <p>点赞数: {{ scope.row.liked }}</p>
                <div slot="reference" class="name-wrapper">
                    <el-tag size="medium">{{ scope.row.name }}</el-tag>
                </div>
                </el-popover>
            </template>
            </el-table-column>
            <el-table-column label="操作" >
            <template slot-scope="scope">
                <el-button
                size="mini"
                @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
                <el-button
                size="mini"
                type="danger"
                @click="handleDelete(scope.$index, scope.row)">删除</el-button>
            </template>
            </el-table-column>
        </el-table>
    </div>
</template>

<script>
export default {
    props: {
        artList: {
            type: Array
        }
    },

    created() {
        this.tableData = this.artList.map((item) => {
            return {
                name: item.title,
                date: item.created_at.split(' ')[0],
                liked: item.favorites_count,
                url: 'www.baidu.com'
            }
        })
    },

    data() {
        return {
            alert:'',
            tableData: []
        }
    },
    methods: {
        handleEdit(index, row) {
            console.log(index, row)
        },
        handleDelete(index, row) {
            console.log(index, row)
        }
    }
}
</script>

<style lang="scss">
    .title_link {
        a {
            color: #409EFF;
            text-decoration: none;
        }
    }

    .article_list_container {
        position: relative;
        .alert_container {
            position: absolute;
            top: -20px;
            left: 0;
            right: 0;
            z-index: 1000;

            > div {
                width: 200px;
                margin: 0 auto;
            }
        }
    }
</style>
