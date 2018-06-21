<template>
    <div class="page">
    	<div class="my-head clearfix">
    		<div class="myh-portrait fl">
                <router-link to="/login">
                    <i class="iconfont icon-my"></i>   
                </router-link>   
            </div>
            <div class="fl ml30">
                <div class="not-logged">
                    <router-link to="/login">登录</router-link>
                    <span>/</span>
                    <router-link to="/register">注册</router-link>
                </div>
            </div>
    	</div>
        <yd-cell-group class="mb-not">
            <yd-cell-item arrow>
                <span slot="left">我的订单</span>
                <span slot="right">全部订单</span>
            </yd-cell-item>
        </yd-cell-group>

        <ul class="my-tool clearfix">
           <li>
               <i class="iconfont icon-fukuanfangshi"></i>
               <span>代付款</span>
           </li> 
           <li>
               <i class="iconfont icon-daishouhuo"></i>
               <span>代收货</span>
           </li> 
           <li>
               <i class="iconfont icon-weixiu"></i>
               <span>退换修</span>
           </li> 
        </ul>

        <yd-cell-group class="mt20">
            <yd-cell-item arrow>
                <span slot="left">会员中心</span>
            </yd-cell-item>

            <yd-cell-item arrow>
                <span slot="left">我的优惠</span>
            </yd-cell-item>
        </yd-cell-group>

        <yd-cell-group>
            <yd-cell-item arrow>
                <span slot="left">设置</span>
            </yd-cell-item>
        </yd-cell-group>

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