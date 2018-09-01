<template>
    <el-menu default-active="1-4-1" class="el-menu-vertical-demo" @open="handleOpen" @close="handleClose" :collapse="isCollapse" >
        <a href="/admin">
            <el-menu-item index="1">
                <i class="el-icon-setting"></i>
                <span slot="title">网站统计</span>
            </el-menu-item>
        </a>
        <el-submenu index="2">
            <template slot="title">
                <i class="el-icon-location"></i>
                <span slot="title">文章功能</span>
            </template>
            <el-menu-item-group index="2-1">
                <a href="/admin/article/create" class="link_a">
                    <el-menu-item index="2-1-1">
                        <i class="pork-icon-plus-circle"></i>
                        <span slot="title">新建文章</span>
                    </el-menu-item>                
                </a>
                <a href="/admin/article/list" class="link_a">
                <el-menu-item index="2-1-2">
                    <i class="pork-icon-sync"></i>
                    <span slot="title">编辑文章</span>
                </el-menu-item>   
                </a>                
                <el-menu-item index="2-1-3">
                    <i class="pork-icon-close-circle"></i>
                    <span slot="title">删除文章</span>
                </el-menu-item>                   
            </el-menu-item-group>
        </el-submenu>
        <el-menu-item index="3">
            <i class="el-icon-menu"></i>
            <span slot="title">导航二</span>
        </el-menu-item>
        <el-menu-item index="4">
            <i class="el-icon-document"></i>
            <span slot="title">导航三</span>
        </el-menu-item>
    </el-menu>
</template>

<style>
  .el-menu-vertical-demo:not(.el-menu--collapse) {
    width: 200px;
    min-height: 400px;
  }
</style>

<script>
  export default {
    data() {
      return {
        isCollapse: true
      };
    },
    methods: {
      handleOpen(key, keyPath) {
        console.log(key, keyPath);
      },
      handleClose(key, keyPath) {
        console.log(key, keyPath);
      }
    }
  }
</script>