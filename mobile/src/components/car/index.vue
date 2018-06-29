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
            

            <yd-checklist v-model="checklist" :label="false">
                <yd-checklist-item val="aaa">
                    <yd-flexbox>
                        <img src="//img12.360buyimg.com/n1/jfs/t2122/170/1006550413/171711/de099a6f/56399d01N67907749.jpg">
                        <yd-flexbox-item align="top">
                            [aaa] 类似购物车 / 类似购物车<br/>
                            <span style="color: blue;">点击这边的内容是禁止选中的</span><br/>
                            <p style="color:#F00;">选中值：{{checklist}}</p>
                        </yd-flexbox-item>
                    </yd-flexbox>
                </yd-checklist-item>
                <yd-checklist-item val="bbb">
                    <yd-flexbox>
                        <img src="//img10.360buyimg.com/n1/jfs/t6925/75/2382158459/437865/f3931d24/598be5b1N24d949fe.jpg">
                        <yd-flexbox-item align="top">
                            [bbb] 南非进口红西柚 6个 单果重约300-330g 新鲜水果
                        </yd-flexbox-item>
                    </yd-flexbox>
                </yd-checklist-item>
                <yd-checklist-item val="ccc">
                    <yd-flexbox>
                        <img src="//img14.360buyimg.com/n1/jfs/t3232/69/539717695/176729/cf1ff3d8/57baa5d1N901ffea5.jpg">
                        <yd-flexbox-item align="top">
                            [ccc] 展卉 越南进口红心火龙果 3个装中果 单果约300~350g 新鲜水果
                        </yd-flexbox-item>
                    </yd-flexbox>
                </yd-checklist-item>
            </yd-checklist>


		</div>
    </div>
</template>

<script>

export default {
    data () {
        return {
            checklist: []
        }
    },
    methods:{
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
	@import '../../assets/sass/car.scss';
</style>