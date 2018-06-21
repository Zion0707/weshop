<template>
    <div class="page">
    	<div class="my-head clearfix">
    		<div class="myh-portrait fl">
                <i class="iconfont icon-my"></i>      
            </div>
            <div class="fl ml30">
                <div class="not-logged">
                    <router-link to="/login">登录</router-link>
                    <span>/</span>
                    <router-link to="/register">注册</router-link>
                </div>
            </div>
    	</div>

        <transition name="goleft">
            <router-view></router-view>
        </transition>
    </div>
</template>

<script>
export default {
    data () {
        return {

        }
    }
}
</script>

<style scoped lang="scss">
	@import '../../assets/sass/my.scss';
</style>