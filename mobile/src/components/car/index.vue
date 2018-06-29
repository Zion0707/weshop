<template>
    <div class="page">
		<div class="cp-nav">
	    	<yd-navbar title="购物车">
				<span slot="left" @click="back">
		            <yd-navbar-back-icon></yd-navbar-back-icon>
		        </span>
		        <router-link to="/search" slot="right">
		        	<yd-icon name="search" :class="'class-search'"></yd-icon>
		        </router-link>
		    </yd-navbar>
	    </div>
		<div class="cp-body cp3-body">
            
            

            <div class="order-list" v-if="orderData.code==0">
                <yd-checklist v-model="checkList" :label="false" :color="'#f55624'">
                    <yd-checklist-item v-for="item,key in orderData.orderList" :key="key" :val="item.id">
                        <yd-flexbox>
                            <img :src="item.colorCover">
                            <yd-flexbox-item align="top">
                                <div class="order-title mt10">{{ item.note }}</div>
                                <div class="order-price mt10">售价: {{ item.marketPrice }}</div>
                                <div class="order-tool mt30">
                                    <yd-spinner 
                                        width="85px" 
                                        height="30px" 
                                        :readonly="false" 
                                        v-model.trim="item.totalNum">        
                                    </yd-spinner>
                                </div>
                            </yd-flexbox-item>
                            <div class="order-del">
                                <i class="iconfont icon-shanchu" @click="delOrder(item, key)"></i>
                            </div>
                        </yd-flexbox>
                    </yd-checklist-item>
                </yd-checklist>
            </div>

            <div class="order-not-login" v-else>
                <yd-cell-group>
                    <yd-cell-item arrow href="/login" type="link">
                        <span slot="left">您还未登录，请先登录！</span>
                        <span slot="right">去登陆</span>
                    </yd-cell-item>
                </yd-cell-group>
            </div>


		</div>
    </div>
</template>

<script>

export default {
    data () {
        return {
            checkList: [],
            orderData: {},
        }
    },
    watch:{
        checkList(){
            console.log( this.checkList );
        }
    },

    methods:{
    	back(){
    		this.$router.back();
    	},
        delOrder(item, idx){
            var _self = this;
            this.http.post('/ShopCar.class.php',{
                type: 'delOrder',
                id: item.id
            },function(data){
                if ( data.code == 0 ) {
                    _self.orderData.orderList.splice(idx ,1);
                }else{
                    _self.$dialog.toast({ mes: data.msg });
                }
            });
        },

        getOrder(){
            var _self = this;
            this.http.post('/ShopCar.class.php',{
                type: 'getOrder'
            },function(data){
                if ( data.code == 0 || data.code == -1 ) {
                    _self.orderData = data;
                }else{
                    _self.$dialog.toast({ mes: data.msg });
                }
            });
        }
    },
    mounted(){
        this.getOrder();
    }
}
</script>

<style scoped lang="scss">
	@import '../../assets/sass/car.scss';
</style>