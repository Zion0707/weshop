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
		<div class="cp-body">
            

            


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