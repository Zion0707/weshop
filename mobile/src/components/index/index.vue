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
                    <li>电视</li>
                    <li>电脑</li>
                    <li>智能</li>
                    <li>双摄</li>
                    <li>生活周边</li>
                    <li>盒子</li>
                </ul>      
            </div>
    	</div>

		<div class="index-body">
            
            <div class="clearfix">
                <swiper :options="swiperOption" ref="mySwiper" :class="'index-swiper'">
                    <!-- slides -->
                    <swiper-slide>
                        <a href="javascript:;">
                            <img src="//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/1edb36d7033f83953b132b5a4fd11f05.jpg?thumb=1&w=720&h=360">
                        </a>
                    </swiper-slide>
                    <swiper-slide>
                        <a href="javascript:;">
                            <img src="//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/2ac0a79904813dbf63e1a50ba004f9bc.jpg?thumb=1&w=720&h=360">
                        </a>
                    </swiper-slide>
                    <swiper-slide>
                        <a href="javascript:;">
                            <img src="//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/4d8254479f085cde04386422acff2a19.jpg?thumb=1&w=720&h=360">
                        </a>
                    </swiper-slide>
                    <!-- Optional controls -->
                    <div class="swiper-pagination" slot="pagination"></div>
                </swiper>
            </div>
            
            <div class="clearfix">

                <div class="rd-item mt10">
                    <h3 class="rd-item-head">
                        <span>每日精选</span>
                    </h3>

                    <yd-list theme="3">
                        <yd-list-item v-for="item, key in homeGoods.dailyList" :key="key" @click.native="goodsDetail(item)">
                            <img slot="img" :src="item.cover">
                            <span slot="title">{{ item.name }}</span>
                            <yd-list-other slot="other">
                                <div class="rdl-01">
                                    <span class="list-price price"> {{ item.marketPrice }}</span>
                                </div>
                                <div class="rdl-02">{{ item.shortDesc }}</div>
                            </yd-list-other>
                        </yd-list-item>
                    </yd-list>
                </div>


                <div class="rd-item mt15">
                    <h3 class="rd-item-head">
                        <span>优惠精品</span>
                    </h3>
                    
                    <yd-list theme="3">
                        <yd-list-item v-for="item, key in homeGoods.preferentialList" :key="key" @click.native="goodsDetail(item)">
                            <img slot="img" :src="item.cover">
                            <span slot="title">{{ item.name }}</span>
                            <yd-list-other slot="other">
                                <div class="rdl-01">
                                    <span class="list-price price"> {{ item.marketPrice }}</span>
                                </div>
                                <div class="rdl-02">{{ item.shortDesc }}</div>
                            </yd-list-other>
                        </yd-list-item>
                    </yd-list>
                </div>


                <div class="rd-item mt15 mb10">
                    <h3 class="rd-item-head">
                        <span>新品上市</span>
                    </h3>
                    
                    <yd-list theme="3">
                        <yd-list-item v-for="item, key in homeGoods.newProductsList" :key="key" @click.native="goodsDetail(item)">
                            <img slot="img" :src="item.cover">
                            <span slot="title">{{ item.name }}</span>
                            <yd-list-other slot="other">
                                <div class="rdl-01">
                                    <span class="list-price price"> {{ item.marketPrice }}</span>
                                </div>
                                <div class="rdl-02">{{ item.shortDesc }}</div>
                            </yd-list-other>
                        </yd-list-item>
                    </yd-list>
                </div>
            </div>

		</div><!--index-body-->

        
        
        <transition name="goleft">
            <router-view></router-view>
        </transition>
        
    </div>
</template>

<script>

import { mapGetters } from 'vuex';

export default {
    data () {
        return {
            // some swiper options/callbacks
            // 所有的参数同 swiper 官方 api 参数
            swiperOption: {
                loop : true,
                autoplay:true,
                pagination: {
                    el: '.swiper-pagination',
                },
            },


            homeGoods:{}
        }
    },
    computed:{
        //轮播使用
        swiper() {
            return this.$refs.mySwiper.swiper
        },
        ...mapGetters(['menu']),
    },
    methods:{
        //跳转到详情
        goodsDetail(item){
            // console.log(item);
            this.$router.push({ 
                'path':'/goods_detail', 
                'query':{ 
                    'gid': item.id ,
                    'gIndex': item.gIndex
                }
            });
        },

        //跳转到`我的`页面
        myPath(){
            // this.menu.currentNum = 3;
            this.$router.push({'path':'/my'});
        },

        //列表数据
        listData(type){
            var _self = this;
            this.http.post('/HomeGoods.class.php',{
                type: type
            },function(data){
                if ( data.code == 0 ) {
                    _self.homeGoods = data;
                }else{
                    _self.$dialog.toast({ mes: data.msg });
                }
            });
        }
    },
    mounted(){
        
        //默认获取为推荐
        this.listData('recommended');

    }
}
</script>


<style scoped lang="scss"> 
    @import '../../assets/sass/index.scss';
</style> 
