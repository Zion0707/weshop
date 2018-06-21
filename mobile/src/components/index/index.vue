<template>
    <div class="page">
    	<div class="index-header">

    		<div class="ih-top clearfix">
    			<div class="ih-logo">
    				We
    			</div>
    			<div class="ih-search">
                    <i class="iconfont icon-index-search"></i>         
                    <input type="text" placeholder="搜索商品名称" disabled="true">         
                </div>
    			<div class="ih-my" @click="myPath()">
                    <i class="iconfont icon-index-wode"></i>    
                </div>
    		</div>
    		
    		<div class="ih-nav">
                <ul class="ihn-list clearfix">
                    <li class="current">推荐</li>
                    <li>手机</li>
                    <li>智能</li>
                    <li>电视</li>
                    <li>电脑</li>
                    <li>暑期大促</li>
                    <li>双摄</li>
                    <li>全面屏</li>
                    <li>生活周边</li>
                    <li>盒子</li>
                </ul>      
            </div>
    	</div>

		<div class="index-body">

            <router-view></router-view>

		</div>
    </div>
</template>

<script>

import { mapGetters } from 'vuex';

export default {
    data () {
        return {

        }
    },
    computed:{
        ...mapGetters(['menu'])
    },
    methods:{
        myPath(){
            this.menu.currentNum = 3;
            this.$router.push({'path':'/my'});
        }
    },
    mounted(){

    }
}
</script>

