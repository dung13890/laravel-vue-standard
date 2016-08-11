<template>
    <div class="modal fade" id="create-user">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name" class="control-label">Name</label>
                                <input type="text" :value="item.name" v-model="value['name']" class="form-control" placeholder="Không được trống" />
                            </div>
                            <div class="col-md-6">
                                <label for="username" class="control-label">Username</label>
                                <input type="text" v-model="value['username']" class="form-control" placeholder="Không được trống" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="control-label">Email</label>
                        <input type="email" v-model="value['email']" class="form-control" placeholder="Không được trống" />
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="password" class="control-label">Password</label>
                                <input type="password" v-model="value['password']" class="form-control" placeholder="Không được trống" />
                            </div>
                            <div class="col-md-6">
                                <label for="password_confirmation" class="control-label">Password confirmation</label>
                                <input type="password" v-model="value['password_confirmation']" class="form-control" placeholder="Không được trống" />
                            </div>
                        </div>
                    </div>
                    <hr>
                    <a href="javascript:window.history.back()" data-dismiss="modal" class="btn btn-default btn-sm" ><i class="fa fa-times"></i> Hủy</a>
                    <button type="submit" v-on:click="postForm" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    var token = $('meta[name="csrf-token"]').attr('content')
    export default {
        props: {
            item: {}
        },
        data: function () {
            return {
                value: {}
            }
        },
        methods: {
            postForm: function () {
                var self = this;
                $.extend(this.value, {_token: token});
                this.$parent.$parent.ProductService.store(this.value).then((response) => {
                    console.log(response);
                    return;
                });
                //$('#create-user').modal('hide');
                this.$parent.$broadcast('vuetable:refresh');
                //this.value = null
            },
            render: function () {
                this.$broadcast('vuetable:refresh')
            }
        }
    }
</script>