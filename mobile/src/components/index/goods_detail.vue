<template>
    <div class="child-page bg-f5f5f5">
		<div class="cp2-body">

            <div class="clearfix pr">
                <div class="od-back" @click="back()">
                    <i class="iconfont icon-fanhui"></i>
                </div>

                <swiper :options="swiperOption" ref="mySwiper" :class="'order-swiper'">
                    <!-- slides -->
                    <swiper-slide v-for="item,key in goodsDetail.banner" :key="key">
                        <!-- 图片懒加载，但是第一张图片不用懒加载 -->
                        <img :src="item.url" v-if="key==0">
                        <img class="swiper-lazy" :data-src="item.url" v-else>
                        <div class="swiper-lazy-preloader swiper-lazy-preloader-white" v-if="key > 0"></div>
                    </swiper-slide>
                    <!-- Optional controls -->
                    <div class="swiper-pagination" slot="pagination"></div>
                </swiper>
            </div>

            <div class="goods-desc">
                <div class="gd-01">{{ goodsDetail.name }}</div>
                <div class="gd-02 mt10">{{ goodsDetail.description }}</div>
                <div class="gd-03 mt10 price">
                    {{ parameter.marketPrice }}
                </div>
            </div>

            <div class="clearfix mt10">
                <yd-cell-group>
                    <yd-cell-item arrow @click.native="show1 = true">
                        <div class="goods-select" slot="left"><em>已选</em><span>{{ parameter.specifications }} x{{ totalNum }}</span></div>
                        <div slot="right"></div>
                    </yd-cell-item>
                    <yd-cell-item arrow @click.native="show2 = true">
                        <div class="goods-select" slot="left"><em>送至</em><span>广东省 深圳市 南山区</span></div>
                        <div slot="right"></div>
                    </yd-cell-item>
                </yd-cell-group>
            </div>

            <div class="gd-bottom">
                <div class="gdb-icon" @click="goIndex">
                    <i class="iconfont icon-shouye"></i>
                    <span>首页</span>
                </div>
                <div class="gdb-icon" @click="goCar">
                    <i class="iconfont icon-gouwuche"></i>
                    <span>购物车</span>
                </div>
                <a href="javascript:;" class="gdb-btn" @click="show1=true">
                    加入购物车
                </a>
            </div>






            <!-- ///////////////////////////////////// 华丽的分割线 //////////////////////////////////// -->







            <!-- 规格参数弹框 -->
            <yd-popup v-model="show1" position="bottom" height="70%">
                <div class="parter-01 pf bd_b clearfix">
                    <i class="iconfont icon-guanbi par1-close" @click="show1=false"></i>
                    <div class="par1-left fl">
                        <img :src="goodsDetail.cover">
                    </div>
                    <div class="par1-right mt30">
                        <div class="par1r-01 price"> {{ parameter.marketPrice }}</div>
                        <div class="par1r-02">{{ parameter.specifications }}</div>
                    </div>
                </div>
                <div class="parter-02">
                    <div class="par2-in">

                        <div class="gd-arg">
                            <div class="gd-arg-tit">版本</div>
                            <ul class="gd-arg-con">
                                <li v-for="item in parameterList" 
                                    :class="{'current': item.gIndex === gIndex }" 
                                    @click="selectParameter(item)">
                                    {{ item.specifications }} {{ item.marketPrice }}元
                                </li>
                            </ul>
                        </div>

                        <div class="gd-arg inline-box mt30">
                            <div class="gd-arg-tit">颜色</div>
                            <ul class="gd-arg-con">
                               <li :class="{ 'current': $index === colorIndex , 'notCurrent': item.inventory < 1 }" 
                                    v-for="item,$index in colorList"
                                    @click="selectColor(item, $index)">
                                   {{ item.color }}
                               </li>
                            </ul>
                        </div>

                        <div class="gd-arg mt30 clearfix" style="border-bottom:none;">
                            <div class="gd-arg-tit fl">数量</div>
                            <div class="gd-num fr">
                                <yd-spinner 
                                    :style="{'margin-left':'12px'}" 
                                    width="110px" 
                                    height="35px" 
                                    :readonly="false" 
                                    v-model.trim="totalNum">        
                                </yd-spinner>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="parter-03 pf" @click="addCar">
                    加入购物车
                </div>
            </yd-popup>


            <!-- 地区弹框 -->
            <yd-popup v-model="show2" position="bottom" height="60%">

            </yd-popup>

            


		</div>
    </div>
</template>

<script>

import { mapGetters } from 'vuex'; 

export default {
    data () {
        return {
            // 所有的参数同 swiper 官方 api 参数
            swiperOption: {
                lazy: true,
                pagination: {
                    el: '.swiper-pagination',
                },
            },

            totalNum:1,
            show1:false,
            show2:false,
            gid: this.$route.query.gid,
            gIndex: this.$route.query.gIndex,
            goodsDetail:{},
            parameter:{},
            parameterList:[],
            colorList:[],
            colorIndex:'',
            gcid:''
        }
    },
    computed:{
        ...mapGetters(['menu'])
    },
    methods:{
        //轮播使用
        swiper() {
            return this.$refs.mySwiper.swiper;
        },
        //返回上一级
    	back(){
    		this.$router.back();
            // this.$router.push({path:'/'});
    	},
        goIndex(){
            // this.menu.currentNum = 0;
            this.$router.push({'path':'/'});
        },
        goCar(){
            // this.menu.currentNum = 2;
            this.$router.push({'path':'/car'});
        },
        //获取商品详情
        getGoodsDetail(){
            var _self = this;
            this.http.post('/GoodsDetail.class.php',{
                gid: this.gid,
                gIndex: this.gIndex
            },function(data){
                if ( data.code == 0 ) {
                    _self.goodsDetail = data;
                    _self.parameterList = data.parameterList;

                    //根据gIndex查询颜色及库存列表
                    for(var i in _self.parameterList){
                        //根据gIndex来定位是哪个规格
                        if ( _self.parameterList[i].gIndex == _self.gIndex ) {
                            _self.parameter = _self.parameterList[i];
                            _self.colorList = _self.parameterList[i].colorList;
                        }
                    }
                }else{
                    _self.$dialog.toast({ mes: data.msg });
                }
            });
        },
        //选择规格
        selectParameter(item){
            //相关数据赋值
            this.parameter = item;
            this.gIndex = item.gIndex;
            this.colorList = item.colorList;
            this.colorIndex = '';
            this.gcid = '';
        },
        //选择颜色
        selectColor(item, idx){
            //库存大于0才能被选择
            if ( item.inventory > 0 ) {
                this.colorIndex = idx;
                this.goodsDetail.cover = item.colorCover;
                this.gcid = item.id;
            }
        },
        
        //添加到购物车
        addCar(){
            var _self = this;

            if ( this.gcid ){

                this.http.post('/ShopCar.class.php',{
                    type: 'addOrder',
                    gIndex: this.parameter.gIndex,
                    gid: this.parameter.gid,
                    gpid: this.parameter.id,
                    name: this.goodsDetail.name +' '+ this.parameter.specifications,
                    description: this.parameter.versionDescription,
                    marketPrice: this.parameter.marketPrice,
                    totalNum: this.totalNum,
                    gcid: this.gcid
                },function(data){
                    if ( data.code == 0 ) {
                        
                        _self.show1 = false;

                        _self.$dialog.toast({
                            mes: data.msg,
                            icon: 'success',
                            callback(){

                                //添加成功之后恢复到默认值
                                _self.colorIndex = '';
                                _self.gcid = '';
                                _self.totalNum = 1;
                                
                            }
                        });
                    }else if( data.code == -1 ){
                        _self.$router.push({
                            path: '/login',
                            query: {
                                preUrl : window.location.href.split('/#')[1]
                            }
                        });
                    }else{
                        _self.$dialog.toast({ 
                            mes: data.msg,
                            icon: 'error'
                        });
                    }
                });

            }else{
                this.$dialog.notify({ 
                    mes: '请完善商品信息哦！',
                    timeout: 1500
                });
            }

        }
    },
    mounted(){
        this.getGoodsDetail();
    }
}
</script>

<style scoped lang="scss">
	@import '../../assets/sass/goods_detail.scss';
</style>