export default {
  setHttp (http) {
    this.http = http;
  },
  setRouter (router) {
    this.router = router;
  },

  index: function () {
    var self = this;
    return new Promise( function(resolve, reject) {
      self.http({url: self.router.route('api.v1.user.index'), method: 'GET'}).then(function (response) {
          resolve(response.data);
      }, function (response) {
          reject(response.data);
      });
    })
  },
  store: function (data) {
    var self = this;
    return new Promise( function(resolve, reject) {
      self.http({url: self.router.route('api.v1.user.store'), body: data, method: 'POST'}).then(function (response) {
          resolve(response.data);
      }, function (response) {
          reject(response.data);
      });
    })
  },
}
