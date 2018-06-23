<template>
    <div class="child-page">
		<div class="cp-nav">
	    	<yd-navbar title="设置">
		        <router-link to="/my" slot="left">
		            <yd-navbar-back-icon></yd-navbar-back-icon>
		        </router-link>
		    </yd-navbar>
	    </div>
		<div class="cp-body">
			
			
			<div class="logout mt20" @click="logout">
				退出登录
			</div>

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
    	logout(){
    		var _self = this;
    		this.http.post('/Logout.class.php',null,function(data){
    			if (data.code == 0) {
    				_self.$dialog.toast({
                        mes: data.msg,
                        callback:()=>{
                            _self.$router.push({path:'/login'});
                        }
                    });
    			}
            });
    	}
    },
    mounted(){
    	
    }
}
</script>

<style scoped lang="scss">
	@import '../../assets/sass/my.scss';
</style>