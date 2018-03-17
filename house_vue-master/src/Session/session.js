let Session = {
  get_token:get_token,
  set_token:set_token
}

function set_token(token) {
  this.token = token;
  localStorage.setItem('bsession',token);
}

function get_token() {
  return localStorage.getItem('bsession');
//  返回取到的数据
}

export default Session;
//暴露对象




