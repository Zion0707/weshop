<template>
    <div class="child-page">
		<div class="cp-nav">
	    	<yd-navbar title="注册">
		        <router-link to="/my" slot="left">
		            <yd-navbar-back-icon></yd-navbar-back-icon>
		        </router-link>
		    </yd-navbar>
	    </div>
		<div class="cp-body">
			
			<div class="register-logo">
				<strong>We</strong><span></span>
			</div>

			<yd-cell-group style="border-top:1px solid #f1f1f1;">
		        <yd-cell-item>
		            <span slot="left">用户名：</span>
		            <yd-input slot="right" v-model.trim="username" @keyup.enter.native="upFrom" placeholder="请输入用户名"></yd-input>
		        </yd-cell-item>
		        <yd-cell-item>
		            <span slot="left">密码：</span>
		            <yd-input slot="right" type="password" v-model.trim="password" @keyup.enter.native="upFrom" placeholder="请输入密码"></yd-input>
		        </yd-cell-item>
		        <yd-cell-item>
		            <span slot="left">确认密码：</span>
		            <yd-input slot="right" type="password" v-model.trim="password2" @keyup.enter.native="upFrom" placeholder="请确认密码"></yd-input>
		        </yd-cell-item>
		        <yd-cell-item>
		            <span slot="left" style="position: relative;">验证码：
                        <canvas width="100" height="40" class="vCode" id="code"></canvas>
		            </span>
		            <yd-input slot="right" v-model.trim="vCode" @keyup.enter.native="upFrom" placeholder="请输入验证码"></yd-input>
		        </yd-cell-item>
		    </yd-cell-group>
			
            
	        <div class="pd1050">
	        	<yd-button size="large" type="primary" @click.native="upFrom">注 册</yd-button>
	        </div>

			<div class="re-miss">
				<router-link to="/">遇到问题</router-link>
				<span>|</span>
				<router-link to="/login">已有账号</router-link>
			</div>

		</div>
    </div>
</template>

<script>

export default {
    data () {
        return {
        	code:'',
        	username:'',
        	password:'',
        	password2:'',
        	vCode:'',
        }
    },
    methods:{
    	upFrom(){
            var _self = this;

    		//表单校验
    		if (this.username == '') {
    			this.$dialog.notify({mes: '请输入用户名'});
    		}else if ( this.password == '' ) {
    			this.$dialog.notify({mes: '请输入密码'});
    		}else if ( this.password2 == '' ) {
    			this.$dialog.notify({mes: '请确认密码'});
    		}else if ( this.password != this.password2  ) {
    			this.$dialog.notify({mes: '确认密码不正确'});
    		}else if ( this.vCode == '' ) {
                this.$dialog.notify({mes: '请输入验证码'});
            }else if ( this.vCode != this.code ) {
                this.$dialog.notify({mes: '验证码不正确'});
            }else{

                //注册调用
                this.http.post('/Register.class.php',{
                    username: this.username,
                    password: this.password
                },function(data){
                    $('#code').click();
                    
                    if ( data.code == 0 ) {
                        _self.$dialog.toast({
                            mes: data.msg,
                            callback:()=>{
                                //调用父级组件中的方法并返回到父级
                                _self.$parent.getUserInfo();
                                _self.$router.push({path:'/my'});
                            }
                        });
                    }else{
                        _self.$dialog.toast({
                            mes: data.msg,
                            callback:()=>{
                            }
                        });
                    }
                });

    		}
    	}
    },
    mounted(){
    	var _self = this;

        //canvas 验证码生成
        var cvs = document.getElementById('code');
        var cxt = cvs.getContext('2d');

        function randomNumber(min, max) {
            return Math.floor(Math.random() * (max - min + 1) + min);
        }
        function randomString() {
            _self.code = '';
            var source = '012345789ascdefgqwrtyuioplkjghmnvczx';
            for (var i = 0; i < 4; i++) {
                var index = Math.floor(Math.random() * source.length);
                _self.code = _self.code + source.charAt(index);
            }
            return _self.code;
        }
        function drawString(code) {
            cxt.clearRect(0, 0, cvs.width, cvs.height);
            cxt.fillStyle = '#ccc';
            cxt.font = '30px 黑体';
            cxt.textBaseline = 'top';
            for (var i = 0; i < code.length; i++) {
                var r = randomNumber(0, 255);
                var g = randomNumber(0, 255);
                var b = randomNumber(0, 255);
                var h = randomNumber(0, cvs.height - 40);
                cxt.fillStyle = 'rgb(' + r + ',' + g + ',' + b + ')';
                cxt.fillText(code.charAt(i), 10 + i * 18, h);
            }
            //线条
            for (var i = 0; i < 10; i++) {
                var x1 = randomNumber(0, cvs.width);
                var y1 = randomNumber(0, cvs.height);
                var x2 = randomNumber(0, cvs.width);
                var y2 = randomNumber(0, cvs.height);
                cxt.strokeStyle = '#ddd';
                cxt.beginPath();
                cxt.moveTo(x1, y1);
                cxt.lineTo(x2, y2);
                cxt.closePath();
                cxt.stroke();
            }
        }

        drawString(randomString());
        cvs.onclick = function (e) {
            drawString(randomString());
        }
  
    }
}
</script>

<style scoped lang="scss">
	@import '../../assets/sass/my.scss';
</style>