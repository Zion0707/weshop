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
    
            <yd-cell-group :class="'address-item'">
                <yd-cell-item arrow>
                    <div slot="left">
                        <p><strong>小明 185****9977</strong></p>
                        <p>江苏 泰州市 兴化市 沈沦镇 钠弊06山段路28 (053888)</p>
                    </div>
                </yd-cell-item>
            </yd-cell-group>

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