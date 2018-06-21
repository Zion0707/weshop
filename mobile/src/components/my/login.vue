<template>
    <div class="child-page">
		<div class="cp-nav">
	    	<yd-navbar title="登录">
		        <router-link to="/my" slot="left">
		            <yd-navbar-back-icon></yd-navbar-back-icon>
		        </router-link>
		    </yd-navbar>
	    </div>
		<div class="cp-body">
			111
		</div>
    </div>
</template>

<script>
export default {
    data () {
        return {

        }
    }
}
</script>

<style scoped lang="scss">
	@import '../../assets/sass/my.scss';
</style>