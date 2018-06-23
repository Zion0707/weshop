<template>
    <div class="page">
    	<div class="my-head clearfix">
    		<div class="myh-portrait fl">
                
                <div class="myh-avatar" v-if="userInfo.code==0">
                    <img :src="userInfo.avatarUrl" alt="用户头像">
                </div>
                <div v-else>
                    <router-link to="/login">
                        <i class="iconfont icon-my"></i>   
                    </router-link> 
                </div>  
            </div>
            <div class="fl ml30">
                <div class="not-logged">
                    
                    <div v-if="userInfo.code==0">
                        <span>{{ userInfo.username }}</span>
                    </div>
                    <div v-else>
                        <router-link to="/login">登录</router-link>
                        <span>/</span>
                        <router-link to="/register">注册</router-link>
                    </div>
                    
                </div>
            </div>
    	</div>
        <yd-cell-group class="mb-not">
            <yd-cell-item arrow @click.native="myJump(0)">
                <span slot="left">我的订单</span>
                <span slot="right">全部订单</span>
            </yd-cell-item>
        </yd-cell-group>

        <ul class="my-tool clearfix">
           <li @click="myJump(1)">
               <i class="iconfont icon-fukuanfangshi"></i>
               <span>待付款</span>
           </li> 
           <li @click="myJump(2)">
               <i class="iconfont icon-daishouhuo"></i>
               <span>待收货</span>
           </li> 
           <li @click="myJump(3)">
               <i class="iconfont icon-weixiu"></i>
               <span>退换修</span>
           </li> 
        </ul>

        <yd-cell-group class="mt20">
            <yd-cell-item arrow @click.native="myJump(4)">
                <span slot="left">会员中心</span>
            </yd-cell-item>

            <yd-cell-item arrow @click.native="myJump(5)">
                <span slot="left">我的优惠</span>
            </yd-cell-item>
        </yd-cell-group>

        <yd-cell-group>
            <yd-cell-item arrow @click.native="myJump(6)">
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
            userInfo:{}
        }
    },
    methods:{
        getUserInfo(){
            var _self = this;
            this.http.post('/UserInfo.class.php',{
                type:'get'
            },function(data){
                _self.userInfo = data;
            });
        },
        myJump(pageIndex){
            //如果未登录或其它情况，那么让它跳转到登录页
            if ( this.userInfo.code != 0 ) {
                this.$router.push({path:'/login'});
                return;
            }

            switch(pageIndex){
                case 0:

                break;
                case 1:

                break;
                case 2:

                break;
                case 3:

                break;
                case 4:

                break;
                case 5:

                break;
                case 6:
                    this.$router.push({path:'/settings'});
                break;
            }

        }
    },
    mounted(){
        this.getUserInfo();
    }
}
</script>

<style scoped lang="scss">
	@import '../../assets/sass/my.scss';
</style>