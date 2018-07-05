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
		<div class="cp3-body">
        
            <div class="order-list" v-if="orderData.code==0">
                <div v-if="orderList.length">
                    <yd-checklist v-model="checkList" :label="false" :color="'#f55624'" :callback="checkListCallback">
                        <yd-checklist-item v-for="item,key in orderList" :key="key" :val="item.id" :data-id="item.id">
                            <yd-flexbox>
                                <img :src="item.colorCover" @click="goodsDetail(item)">
                                <yd-flexbox-item align="top">
                                    <div class="order-title mt10">{{ item.note }} {{ item.color }}</div>
                                    <div class="order-price mt10">售价: {{ item.marketPrice }}</div>
                                    <div class="order-tool mt30">

                                        <span class="yd-spinner" style="height: 30px; width: 85px;">
                                            <a href="javascript:;" @click="lessNum(item.id, item.totalNum)"></a> 
                                            <input type="number" pattern="[0-9]*" v-model.trim="item.totalNum" readonly="true" class="yd-spinner-input"> 
                                            <a href="javascript:;" @click="plusNum(item.id, item.totalNum)"></a>
                                        </span>

                                    </div>
                                </yd-flexbox-item>
                                <div class="order-del">
                                    <i class="iconfont icon-shanchu" @click="delOrder(item, key)"></i>
                                </div>
                            </yd-flexbox>
                        </yd-checklist-item>
                    </yd-checklist>
                </div>
                <div v-else class="not-order">
                    <i class="iconfont icon-gouwuche"></i>
                    <span>购物车还是空的</span>
                    <router-link to="/">去逛逛</router-link>
                </div>
            </div><!--order-list-->

            <div class="order-not-login" v-else>
                <yd-cell-group>
                    <yd-cell-item arrow href="/login" type="link">
                        <span slot="left">您还未登录，请先登录！</span>
                        <span slot="right">去登陆</span>
                    </yd-cell-item>
                </yd-cell-group>
            </div><!--order-not-login-->

		</div>
    

        <div class="bottom-order-tool" :class="{ 'has-order-tool': orderListLen > 0 }">
            <div class="ot-item ot-i1">
                <div class="ot-total">共{{ orderData.allTotalNum }}件 金额：</div>
                <div class="ot-money price"><span>{{ orderData.allMarketPrice }}</span>元</div>
            </div>
            <div class="ot-item ot-i2">
                <router-link to="/">继续购物</router-link> 
            </div>
            <div class="ot-item ot-i3" @click="settlementFun">去结算</div>
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
            orderData: {},
            checkList: [],
            orderList: [],
            orderListLen: 0
        }
    },
    
    // watch:{
    //     checkList(){
    //         console.log( this.checkList );
    //     }
    // },

    methods:{
        back(){
            this.$router.back();
        },
        
        checkListCallback(data){
            // console.log(data);
        },
        // 去结算
        settlementFun(){
            //如果没有选中商品那么则要提示
            if ( this.checkList.length==0 ) {
                this.$dialog.alert({
                    mes:'请勾选要结算的商品！'
                });
                return;
            }

            this.$router.push({path:'/car/settlement'});
        },

        //跳转到详情
        goodsDetail(item){
            // console.log(item);
            this.$router.push({ 
                'path':'/goods_detail', 
                'query':{ 
                    'gid': item.gid ,
                    'gIndex': item.gIndex
                }
            });
        },

        //删除单条订单
        delOrder(item, idx){
            var _self = this;
            this.http.post('/ShopCar.class.php',{
                type: 'delOrder',
                id: item.id
            },function(data){
                if ( data.code == 0 ) {
                    // _self.orderList.splice(idx ,1);
                    _self.getOrder();
                }else{
                    _self.$dialog.toast({ mes: data.msg });
                }
            });
        },

        //获取订单列表
        getOrder(){
            var _self = this;
            this.http.post('/ShopCar.class.php',{
                type: 'getOrder'
            },function(data){
                if ( data.code == 0 || data.code == -1 ) {
                    _self.orderData = data;
                    _self.orderList = data.orderList;
                    _self.orderListLen = data.orderList.length;

                    //判断是否选中，如果选中那么就push到数组里
                    for( var i in data.orderList ){
                        if ( data.orderList[i].isCheck == '0' ) {
                            _self.checkList.push(data.orderList[i].id);
                        }
                    }

                    var timer = setTimeout(function(){
                        _self.checkboxFun();
                        clearTimeout(timer);
                    });
                }else{
                    _self.$dialog.toast({ mes: data.msg });
                }
            });
        },
        //check选中事件
        checkboxFun(){
            var _self = this;
            $('.yd-checklist input[type="checkbox"]').unbind('change');
            $('.yd-checklist input[type="checkbox"]').on('change',function(){
                let status = $(this).is(':checked') ? 0 : 1;
                let id = $(this).parents('.yd-checklist-item').attr('data-id');
                _self.setCheckStatus(status, id);
            });
        },

        /*
        * 设置 checkbox 状态
        * @param status 选中状态 1表示选中，0表示不选
        * @param id 被操作的id
        */
        setCheckStatus(status, id){
            var _self = this;
            this.http.post('/ShopCar.class.php',{
                type:'setOrderCheck',
                status:status,
                id:id
            },function(data){
                if ( data.code == 0 ) {
                    _self.orderData.allTotalNum = data.allTotalNum;
                    _self.orderData.allMarketPrice = data.allMarketPrice;
                }else{
                    _self.$dialog.toast({ mes: data.msg });
                }
            });
        },

        /*
        * 更新单条订单数量
        * @param totalNum 当前单条订单总数
        * @param id 被操作的id
        */
        updateOnlyOrderNum(totalNum, id){
            var _self = this;
            this.http.post('/ShopCar.class.php',{
                type:'updateOnlyOrderNum',
                totalNum:totalNum,
                id:id
            },function(data){
                if ( data.code == 0 ) {
                    _self.orderData.allTotalNum = data.allTotalNum;
                    _self.orderData.allMarketPrice = data.allMarketPrice;
                }else{
                    _self.$dialog.toast({ mes: data.msg });
                }
            });
        },

        /*
        * 减数
        * @param id 订单id
        * @param oldNum 输入框里面的当前值
        */ 
        lessNum(id,oldNum){
            for(var i in this.orderList){
                if ( this.orderList[i].id == id ) {
                    if ( this.orderList[i].totalNum <= 1 ) return; 
                    this.orderList[i].totalNum = parseInt( this.orderList[i].totalNum ) - 1;
                    this.updateOnlyOrderNum( this.orderList[i].totalNum , id );
                    return;
                }
            }
        },
        /*
        * 加数
        * @param id 订单id
        * @param oldNum 输入框里面的当前值
        */ 
        plusNum(id,oldNum){
            for(var i in this.orderList){
                if ( this.orderList[i].id == id ) {
                    this.orderList[i].totalNum = parseInt( this.orderList[i].totalNum ) + 1;
                    this.updateOnlyOrderNum( this.orderList[i].totalNum , id );
                    return;
                }
            }
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