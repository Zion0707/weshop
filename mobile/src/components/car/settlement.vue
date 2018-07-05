<template>
    <div class="child-page">
		<div class="cp-nav">
	    	<yd-navbar title="结算">
				<span slot="left" @click="back">
		            <yd-navbar-back-icon></yd-navbar-back-icon>
		        </span>
		    </yd-navbar>
	    </div>
		<div class="cp3-body">
            
            222

		</div>
    

        <div class="bottom-order-tool has-order-tool">
            333
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

    }
}
</script>

<style scoped lang="scss">
	@import '../../assets/sass/car.scss';
</style>