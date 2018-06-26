<template>
    <div class="child-page bg-f5f5f5">
		<div class="cp2-body">

            <div class="clearfix pr">
                <div class="od-back" @click="back()">
                    <i class="iconfont icon-fanhui"></i>
                </div>

                <swiper :options="swiperOption" ref="mySwiper" :class="'order-swiper'">
                    <!-- slides -->
                    <swiper-slide>
                        <img class="swiper-lazy" data-src="//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/be0f7095a8d06868c8ff4205301c5d2e.jpg?thumb=1&w=720&h=792">
                        <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                    </swiper-slide>
                    <swiper-slide>
                        <img class="swiper-lazy" data-src="//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/ec9b0f12d604fdc2a0d92d3fb5af3f50.jpg?thumb=1&w=720&h=792">
                        <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                    </swiper-slide>
                    <swiper-slide>
                        <img class="swiper-lazy" data-src="//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/3372902d84c593dc2ef1303592228aa0.jpg?thumb=1&w=720&h=792">
                        <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                    </swiper-slide>
                    <swiper-slide>
                        <img class="swiper-lazy" data-src="//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/32368af038111276c17719aede69b563.jpg?thumb=1&w=720&h=792">
                        <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                    </swiper-slide>
                    <swiper-slide>
                        <img class="swiper-lazy" data-src="//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/a16b59a3d47c53cf08f21025de9f0816.jpg?thumb=1&w=720&h=792">
                        <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                    </swiper-slide>
                    <!-- Optional controls -->
                    <div class="swiper-pagination" slot="pagination"></div>
                </swiper>
            </div>

            <div class="goods-desc">
                <div class="gd-01">黑鲨游戏手机 液冷更快</div>
                <div class="gd-02 mt10">液冷散热 / 独立图像处理芯片 / 一键游戏模式 / 骁龙845处理器 / 18:9全面屏 / 前后2000万摄像头</div>
                <div class="gd-03 mt10 price">
                    3499
                </div>
            </div>

            <div class="clearfix mt10">
                <yd-cell-group>
                    <yd-cell-item arrow @click.native="show1 = true">
                        <div class="goods-select" slot="left"><em>已选</em><span>黑鲨游戏手机 高配版 极夜黑 128GB x1</span></div>
                        <div slot="right"></div>
                    </yd-cell-item>
                    <yd-cell-item arrow @click.native="show2 = true">
                        <div class="goods-select" slot="left"><em>送至</em><span>广东省 深圳市 南山区</span></div>
                        <div slot="right"></div>
                    </yd-cell-item>
                </yd-cell-group>
            </div>

            <div class="gd-bottom">
                <div class="gdb-icon" @click="goIndex">
                    <i class="iconfont icon-shouye"></i>
                    <span>首页</span>
                </div>
                <div class="gdb-icon" @click="goCar">
                    <i class="iconfont icon-gouwuche"></i>
                    <span>购物车</span>
                </div>
                <a href="javascript:;" class="gdb-btn">
                    加入购物车
                </a>
            </div>




            <!-- 华丽的分割线 -->







            <!-- 规格参数弹框 -->
            <yd-popup v-model="show1" position="bottom" height="70%">
                <div class="parter-01 pf bd_b clearfix">
                    <i class="iconfont icon-guanbi par1-close" @click="show1=false"></i>
                    <div class="par1-left fl">
                        <img src="//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/0bef1311b94ccb05cf36e796fb3d1b30.jpg">
                    </div>
                    <div class="par1-right">
                        <div class="par1r-01 price"> 3200</div>
                        <div class="par1r-02">黑鲨游戏手机 高配版 极夜黑 128GB</div>
                    </div>
                </div>
                <div class="parter-02">
                    <div class="par2-in">

                        <div class="gd-arg">
                            <div class="gd-arg-tit">版本</div>
                            <ul class="gd-arg-con">
                               <li class="current">6GB+64GB 2999元</li>
                               <li>6GB+64GB 2999元</li>
                               <li>6GB+64GB 2999元</li>
                            </ul>
                        </div>

                        <div class="gd-arg inline-box mt30">
                            <div class="gd-arg-tit">颜色</div>
                            <ul class="gd-arg-con">
                               <li class="current">黑色</li>
                               <li>白色</li>
                               <li>红色</li>
                            </ul>
                        </div>

                        <div class="gd-arg mt30" style="border-bottom:none;">
                            <div class="gd-arg-tit">数量</div>
                            <div class="gd-num mt30 mb30">
                                <yd-spinner :style="{'margin-left':'12px'}" width="130px" height="35px" v-model="spinner"></yd-spinner>
                            </div>
                        </div>
                        


                    </div>
                </div>
                <div class="parter-03 pf" @click="addCar">
                    加入购物车
                </div>
            </yd-popup>


            <!-- 地区弹框 -->
            <yd-popup v-model="show2" position="bottom" height="60%">

            </yd-popup>

            


		</div>
    </div>
</template>

<script>

import { mapGetters } from 'vuex'; 

export default {
    data () {
        return {
            // 所有的参数同 swiper 官方 api 参数
            swiperOption: {
                lazy: true,
                pagination: {
                    el: '.swiper-pagination',
                },
            },

            spinner:1,
            show1:false,
            show2:false,
        }
    },
    computed:{
        ...mapGetters(['menu'])
    },
    methods:{
        //轮播使用
        swiper() {
            return this.$refs.mySwiper.swiper;
        },
        //返回上一级
    	back(){
    		this.$router.back();
            // this.$router.push({path:'/'});
    	},
        //添加到购物车
        addCar(){
            console.log('添加到购物车');
        },
        goIndex(){
            this.menu.currentNum = 0;
            this.$router.push({'path':'/'});
        },
        goCar(){
            this.menu.currentNum = 2;
            this.$router.push({'path':'/car'});
        },
    },
    mounted(){
    	var _self = this;

    }
}
</script>

<style scoped lang="scss">
	@import '../../assets/sass/goods_detail.scss';
</style>