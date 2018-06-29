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
            

            <yd-checklist v-model="checkList" :label="false" :color="'#f55624'">
                <yd-checklist-item v-for="item,key in orderList" :key="key" :val="item.id">
                    <yd-flexbox>
                        <img :src="item.colorCover">
                        <yd-flexbox-item align="top">
                            <div>{{ item.note }}</div>
                            <div>{{ item.marketPrice }}</div>
                            <div>
                                <yd-spinner 
                                    width="90px" 
                                    height="30px" 
                                    :readonly="false" 
                                    v-model.trim="item.totalNum">        
                                </yd-spinner>
                            </div>
                        </yd-flexbox-item>
                        <div>
                            <i class="iconfont icon-shanchu"></i>
                        </div>
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
            checkList: [],
            orderList: [],
        }
    },
    watch:{
        checkList(){
            console.log( this.checkList );
        }
    },

    methods:{
    	back(){
    		this.$router.back();
    	}
    },
    mounted(){
    	var _self = this;
        
        this.http.post('/ShopCar.class.php',{
            type: 'getOrder'
        },function(data){
            if ( data.code == 0 ) {
                _self.orderList = data.orderList;
            }else if( data.code == -1 ){

            }else{
                _self.$dialog.toast({ mes: data.msg });
            }
        });

    }
}
</script>

<style scoped lang="scss">
	@import '../../assets/sass/car.scss';
</style>