import $ from 'jquery'
import Session from '../Session/session'


function post(url, data, opt) {
  let def={
    url:url,
    data:data,
    method:'post',
    headers:{
      'BSESSIONTOKEN':Session.get_token()
    }
  }
  opt = Object.assign({}, def, opt);
  //合并具有相同属性的对象

  return $.ajax(opt)
    .then(function (data,status,res) {
      let token=res.getResponseHeader('BSESSIONTOKEN');
      console.log("token",token);
      if (token){
        Session.set_token(token);
      }
      return data;
    },res=>{

    })
}

export default {post}
