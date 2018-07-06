<template>
    <div class="child-page">
		<div class="cp-nav">
	    	<yd-navbar title="地址管理">
	    		<span slot="left" @click="back">
		            <yd-navbar-back-icon></yd-navbar-back-icon>
		        </span>
		    </yd-navbar>
	    </div>
		<div class="cp3-body">
			<div class="address-list">

                <div class="address-item bd_tlbr" v-for="item in addressList">
                    <div class="adi-header">
                        <span class="c-ff6700">{{ item.receiver }}</span>
                        {{ item.phoneNumber }}
                        <span class="c-ff6700" v-if="item.isDefaultAddress==1">
                            [默认地址]
                        </span>
                        <span class="fr c-999999">删除</span>
                    </div>
                    <div class="adi-con mt5">
                        {{ item.district }}
                        {{ item.address }}
                    </div>
                </div><!--address-item-->

            </div>
		</div>

        <div class="bottom-btn add-new">
            新建地址
        </div>
    </div>
</template>

<script>

export default {
    data () {
        return {
            addressList:[],
            pageNo:1,
            pageSize:10,
        }
    },
    methods:{
    	back(){
            this.$router.back();
        },
        //获取订单列表
        getAddress(pageNo, pageSize){
            var _self = this;
            this.http.post('/Address.class.php',{
                type: 'getAddress',
                pageNo: pageNo,
                pageSize: pageSize
            },function(data){
                if ( data.code == 0 ) {
                    _self.addressList = data.addressList;
                }else{
                    _self.$dialog.toast({ mes: data.msg });
                }
            });
        },
    },
    mounted(){
    	this.getAddress(this.pageNo, this.pageSize);
    }
}
</script>

<style scoped lang="scss">
	@import '../../assets/sass/my.scss';
</style>