<template>
    <div class="page">
	
		<div class="clearfix">
	        <yd-slider autoplay="0">
	        	<yd-slider-item>
		            <a href="javascript:;">
		                <img src="//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/1edb36d7033f83953b132b5a4fd11f05.jpg?thumb=1&w=720&h=360">
		            </a>
		        </yd-slider-item>
		        <yd-slider-item>
		            <a href="javascript:;">
		                <img src="//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/2ac0a79904813dbf63e1a50ba004f9bc.jpg?thumb=1&w=720&h=360">
		            </a>
		        </yd-slider-item>
		        <yd-slider-item>
		            <a href="javascript:;">
		                <img src="//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/4d8254479f085cde04386422acff2a19.jpg?thumb=1&w=720&h=360">
		            </a>
		        </yd-slider-item>
		    </yd-slider>
	    </div>
		
		<div class="clearfix">

			<div class="rd-item mt10">
				<h3 class="rd-item-head">
					<span>每日精选</span>
				</h3>

				<yd-list theme="3">
			        <yd-list-item v-for="item, key in list" :key="key">
			            <img slot="img" :src="item.img">
			            <span slot="title">{{item.title}}</span>
			            <yd-list-other slot="other">
			                <div class="rdl-01">
			                    <span class="list-price"><em>¥</em>{{item.price}}</span>
			                </div>
			                <div class="rdl-02">{{item.content}}</div>
			            </yd-list-other>
			        </yd-list-item>
			    </yd-list>
			</div>


			<div class="rd-item mt15">
				<h3 class="rd-item-head">
					<span>优惠精品</span>
				</h3>
				<yd-list theme="3">
			        <yd-list-item v-for="item, key in list" :key="key">
			            <img slot="img" :src="item.img">
			            <span slot="title">{{item.title}}</span>
			            <yd-list-other slot="other">
			                <div class="rdl-01">
			                    <span class="list-price"><em>¥</em>{{item.price}}</span>
			                </div>
			                <div class="rdl-02">{{item.content}}</div>
			            </yd-list-other>
			        </yd-list-item>
			    </yd-list>
			</div>


			<div class="rd-item mt15 mb10">
				<h3 class="rd-item-head">
					<span>新品上市</span>
				</h3>
				<yd-list theme="3">
			        <yd-list-item v-for="item, key in list" :key="key">
			            <img slot="img" :src="item.img">
			            <span slot="title">{{item.title}}</span>
			            <yd-list-other slot="other">
			                <div class="rdl-01">
			                    <span class="list-price"><em>¥</em>{{item.price}}</span>
			                </div>
			                <div class="rdl-02">{{item.content}}</div>
			            </yd-list-other>
			        </yd-list-item>
			    </yd-list>
			</div>
		
		</div>


    </div>
</template>



<script>
export default {
    data () {
        return {
        	list: [
                {img: "//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/ee44583e8167f3d250186069a26c1384.jpg?thumb=1&w=360&h=360", title: "黑鲨手机", price: 156.23, content:"专业游戏手机"},
                {img: "//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/ee44583e8167f3d250186069a26c1384.jpg?thumb=1&w=360&h=360", title: "黑鲨手机", price: 256.23, content:"专业游戏手机"},
                {img: "//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/ee44583e8167f3d250186069a26c1384.jpg?thumb=1&w=360&h=360", title: "黑鲨手机", price: 356.23, content:"专业游戏手机"},
                {img: "//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/ee44583e8167f3d250186069a26c1384.jpg?thumb=1&w=360&h=360", title: "黑鲨手机", price: 456.23, content:"专业游戏手机"},
                {img: "//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/ee44583e8167f3d250186069a26c1384.jpg?thumb=1&w=360&h=360", title: "黑鲨手机", price: 556.23, content:"专业游戏手机"},
                {img: "//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/ee44583e8167f3d250186069a26c1384.jpg?thumb=1&w=360&h=360", title: "黑鲨手机", price: 656.23, content:"专业游戏手机"}
            ]
        }
    }
}
</script>

<style scoped lang="scss"> 
	@import '../../assets/sass/recommend.scss';
</style> 
