<template>
    <div id="app">
        <router-view/>

        <ul class="menu">
        	<li v-for="item in menuList" :class="{ 'current' : menu.currentNum == item.num }" @click="menuPath(item)">
        		<i class="iconfont" :class="item.iconName"></i>
        		<span>{{ item.name }}</span>
        	</li>
        </ul>
    </div>
</template>

<script>

import { mapGetters } from 'vuex';

export default {
    data(){
        return {
            currentNum:0,
            menuList:[
                {
                    num:0,
                    name:'首页',
                    iconName:'icon-shouye'
                },
                {
                    num:1,
                    name:'分类',
                    iconName:'icon-fenlei'
                },
                {
                    num:2,
                    name:'购物车',
                    iconName:'icon-gouwuche'
                },
                {
                    num:3,
                    name:'我的',
                    iconName:'icon-index-wode'
                }
            ]
        }
    },
    computed:{
        ...mapGetters(['menu'])
    },
    methods:{
        menuPath(item){
            switch(item.num){
                case 0:
                    this.$router.push({'path':'/'});
                    this.menu.currentNum = item.num;
                break;
                case 1:
                    this.$router.push({'path':'/class'});
                    this.menu.currentNum = item.num;
                break;
                case 2:
                    this.$router.push({'path':'/cart'});
                    this.menu.currentNum = item.num;
                break;
                case 3:
                    this.$router.push({'path':'/my'});
                    this.menu.currentNum = item.num;
                break;
            }
        }
    },
    mounted(){

    }
}
</script>
