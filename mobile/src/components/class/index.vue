<template>
    <div class="page">
		<div class="cp-nav">
	    	<yd-navbar title="分类">
				<span slot="left" @click="back">
		            <yd-navbar-back-icon></yd-navbar-back-icon>
		        </span>
		        <router-link to="/search" slot="right">
		        	<yd-icon name="search" :class="'class-search'"></yd-icon>
		        </router-link>
		    </yd-navbar>
	    </div>
		<div class="cp3-body">

			<yd-scrolltab :callback="ydScrollTabBack">
	            <yd-scrolltab-panel label="手机">
	                <yd-list theme="3">
                        <yd-list-item v-for="item, key in list" :key="key" @click.native="goodsDetail(item)">
                            <img slot="img" :src="item.img">
                            <span slot="title">{{item.title}}</span>
                            <yd-list-other slot="other">
                                <div class="rdl-01">
                                    <span class="list-price"><em>¥</em>{{item.price}}</span>
                                </div>
                            </yd-list-other>
                        </yd-list-item>
                    </yd-list>
	            </yd-scrolltab-panel>
	    
	            <yd-scrolltab-panel label="电视">
	            	<yd-list theme="3">
                        <yd-list-item v-for="item, key in list2" :key="key" @click.native="goodsDetail(item)">
                            <img slot="img" :src="item.img">
                            <span slot="title">{{item.title}}</span>
                            <yd-list-other slot="other">
                                <div class="rdl-01">
                                    <span class="list-price"><em>¥</em>{{item.price}}</span>
                                </div>
                            </yd-list-other>
                        </yd-list-item>
                    </yd-list>
	            </yd-scrolltab-panel>
	    
	            <yd-scrolltab-panel label="电脑">
	            	<yd-list theme="3">
                        <yd-list-item v-for="item, key in list3" :key="key" @click.native="goodsDetail(item)">
                            <img slot="img" :src="item.img">
                            <span slot="title">{{item.title}}</span>
                            <yd-list-other slot="other">
                                <div class="rdl-01">
                                    <span class="list-price"><em>¥</em>{{item.price}}</span>
                                </div>
                            </yd-list-other>
                        </yd-list-item>
                    </yd-list>
	            </yd-scrolltab-panel>
	    
	            <!-- ... -->
	        </yd-scrolltab>

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
        	list: [
                {img: "//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/ee44583e8167f3d250186069a26c1384.jpg?thumb=1&w=360&h=360", title: "黑鲨手机", price: 156.23, content:"专业游戏手机",id:1},
                {img: "//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/ee44583e8167f3d250186069a26c1384.jpg?thumb=1&w=360&h=360", title: "黑鲨手机", price: 256.23, content:"专业游戏手机",id:2},
                {img: "//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/ee44583e8167f3d250186069a26c1384.jpg?thumb=1&w=360&h=360", title: "黑鲨手机", price: 356.23, content:"专业游戏手机",id:3},
                {img: "//cdn.cnbj0.fds.api.mi-img.com/b2c-mimall-media/ee44583e8167f3d250186069a26c1384.jpg?thumb=1&w=360&h=360", title: "黑鲨手机", price: 456.23, content:"专业游戏手机",id:4}
            ],

            list2: [
                {img: "//i8.mifile.cn/b2c-mimall-media/bf2dc71cbf6fa8413b7ade09719155a0!120x120.jpg", title: "黑鲨电视", price: 156.23, content:"专业游戏手机",id:1},
                {img: "//i8.mifile.cn/b2c-mimall-media/bf2dc71cbf6fa8413b7ade09719155a0!120x120.jpg", title: "黑鲨电视", price: 256.23, content:"专业游戏手机",id:2},
                {img: "//i8.mifile.cn/b2c-mimall-media/bf2dc71cbf6fa8413b7ade09719155a0!120x120.jpg", title: "黑鲨电视", price: 356.23, content:"专业游戏手机",id:3},
                {img: "//i8.mifile.cn/b2c-mimall-media/bf2dc71cbf6fa8413b7ade09719155a0!120x120.jpg", title: "黑鲨电视", price: 456.23, content:"专业游戏手机",id:4}
            ],

            list3: [
                {img: "//i8.mifile.cn/b2c-mimall-media/ccad3ac9a43a21a606a392cf6a14b091!120x120.jpg", title: "黑鲨电脑", price: 156.23, content:"专业游戏手机",id:1},
                {img: "//i8.mifile.cn/b2c-mimall-media/ccad3ac9a43a21a606a392cf6a14b091!120x120.jpg", title: "黑鲨电脑", price: 256.23, content:"专业游戏手机",id:2},
                {img: "//i8.mifile.cn/b2c-mimall-media/ccad3ac9a43a21a606a392cf6a14b091!120x120.jpg", title: "黑鲨电脑", price: 356.23, content:"专业游戏手机",id:3},
                {img: "//i8.mifile.cn/b2c-mimall-media/ccad3ac9a43a21a606a392cf6a14b091!120x120.jpg", title: "黑鲨电脑", price: 456.23, content:"专业游戏手机",id:4}
            ]
        }
    },
    methods:{
    	back(){
    		this.$router.back();
    	},

    	//跳转到详情
        goodsDetail(item){
            console.log(item);
            this.$router.push({ 'path':'/class/goods_detail', 'query':{id:item.id}});
        },

    	//返回的索引来进行按需加载
    	ydScrollTabBack($index){
    		console.log($index);
    	}
    },
    mounted(){
    	var _self = this;

    }
}
</script>

<style scoped lang="scss">
	@import '../../assets/sass/class.scss';
</style>