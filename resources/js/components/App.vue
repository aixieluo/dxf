<template>
    <div>
        <el-container>
            <el-header>
                <nav style="background-color: #ccc;">
                    <el-row :gutter="10">
                        <el-col :span="2" :push="22"><el-link icon="el-icon-edit">登录</el-link></el-col>
                        <el-col :span="2" :offset="4"><el-link icon="el-icon-edit">编辑</el-link></el-col>
                    </el-row>
                </nav>
            </el-header>
        </el-container>
        <el-container>
            <el-aside></el-aside>
        </el-container>
        <el-container>
            <el-main></el-main>
        </el-container>
        <el-container>
            <el-footer></el-footer>
        </el-container>
    </div>
</template>

<style>
    * {
        padding: 0;
        margin: 0;
        border: 0;
    }
</style>

<script>
    export default {
        mounted() {
            console.log('success !');
        }
    }
</script>
