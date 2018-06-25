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
                        <img src="//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/be0f7095a8d06868c8ff4205301c5d2e.jpg?thumb=1&w=720&h=792">
                    </swiper-slide>
                    <swiper-slide>
                        <img src="//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/ec9b0f12d604fdc2a0d92d3fb5af3f50.jpg?thumb=1&w=720&h=792">
                    </swiper-slide>
                    <swiper-slide>
                        <img src="//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/3372902d84c593dc2ef1303592228aa0.jpg?thumb=1&w=720&h=792">
                    </swiper-slide>
                    <swiper-slide>
                        <img src="//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/32368af038111276c17719aede69b563.jpg?thumb=1&w=720&h=792">
                    </swiper-slide>
                    <swiper-slide>
                        <img src="//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/a16b59a3d47c53cf08f21025de9f0816.jpg?thumb=1&w=720&h=792">
                    </swiper-slide>
                    <!-- Optional controls -->
                    <div class="swiper-pagination" slot="pagination"></div>
                </swiper>
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