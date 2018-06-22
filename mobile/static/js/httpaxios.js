// https://www.kancloud.cn/yunye/axios/234845
// axios使用说明
import axios from 'axios';
import Qs from 'qs';

let httpaxios = {}
let host = 'http://localhost:8885/weshop/api';

httpaxios.post = function(url,data,successCallbck,errorCallback){
    axios({
        method: 'post',
        baseURL: host,
        url: url,
        data: data,
        timeout: 2000,
        //请求参数转换，这样才能被后台拿到
        transformRequest: [function (data) {
            return Qs.stringify(data)
        }],
        //需要指定，后端session才能被保存
        withCredentials:true 
    }).then(function(response) {
        successCallbck && successCallbck(response.data);
    }).catch(function(error) {
        errorCallback && errorCallback(error);
    });
}
export default httpaxios;


