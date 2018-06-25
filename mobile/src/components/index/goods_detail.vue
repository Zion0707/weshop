<template>
    <div class="child-page">
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
                <div class="gd-03 mt10">
                    <span>￥</span>3499
                </div>
            </div>

            


		</div>
    </div>
</template>

<script>

export default {
    data () {
        return {
            // some swiper options/callbacks
            // 所有的参数同 swiper 官方 api 参数
            swiperOption: {
                lazy: true,
                pagination: {
                    el: '.swiper-pagination',
                },
            },
        }
    },
    methods:{
        //轮播使用
        swiper() {
            return this.$refs.mySwiper.swiper
        },

        //返回上一级
    	back(){
    		this.$router.back();
            // this.$router.push({path:'/'});
    	}
    },
    mounted(){
    	var _self = this;

    }
}
</script>

<style scoped lang="scss">
	@import '../../assets/sass/index.scss';
</style>