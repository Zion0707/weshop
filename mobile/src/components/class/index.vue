<template>
    <div class="page">
		<div class="cp-nav">
	    	<yd-navbar title="分类">
		        <router-link to="/search" slot="right">
		        	<yd-icon name="search" :class="'class-search'"></yd-icon>
		        </router-link>
		    </yd-navbar>
	    </div>
		<div class="cp-body">

			<yd-scrolltab :callback="ydScrollTabBack">
	            <yd-scrolltab-panel label="空调">
	                <div style="height: 350px;background-color: gray;"></div>
	            </yd-scrolltab-panel>
	    
	            <yd-scrolltab-panel label="冰箱">
	                <div style="height: 350px;background-color: blue;"></div>
	            </yd-scrolltab-panel>
	    
	            <yd-scrolltab-panel label="洗衣机">
	                <div style="height: 350px;background-color: yellow;"></div>
	            </yd-scrolltab-panel>
	    
	            <!-- ... -->
	        </yd-scrolltab>

		</div>
    </div>
</template>

<script>

export default {
    data () {
        return {

        }
    },
    methods:{
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