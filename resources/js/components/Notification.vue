<template>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-light" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-bell" aria-hidden="true"></i>
            <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right mailbox scale-up">
            <ul>
                <li>
                    <div class="drop-title">Notifications <span class="badge badge-pill badge-primary mx-1"> {{notifications.length}}</span></div>
                </li>
                <li>
                    <div class="message-center">
                        <!-- Message -->
                        <a href="#" v-for="notification in notifications" v-on:click="MarkAsRead(notification)">
                            <div class="btn btn-danger btn-circle">
                                <i class="fa fa-link"></i>
                            </div>
                            <div class="mail-contnet">
                                <h5>{{notification.data.title}}</h5>
                                <span class="mail-desc">{{notification.data.message}}</span>
                                <span class="time">{{notification.data.time}}</span>
                            </div>
                        </a>
                        <a href="javascript:void(0);" v-if="notifications.length == 0">
                            <div class="btn btn-danger btn-circle">
                                <i class="far fa-bell-slash"></i>
                            </div>
                            <div class="mail-contnet">
                                <h5>Nothing New</h5>
                                <span class="mail-desc">You do not have new Notification</span>
                            </div>
                        </a>
                    </div>
                </li>
                <li>
                    <a class="nav-link text-center" v-on:click="MarkAllAsRead()" href="javascript:void(0);"> <strong>Mark All As Read</strong> <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i> </a>
                </li>
            </ul>
        </div>
    </li>
</template>

<script>
export default {
    props:['notifications'],
    methods: {
        MarkAsRead: function(notification){
            var data = {
                id:notification.id
            };
            axios.post('/notification/read', data).then(response => {
                window.location.href = notification.data.url
            });
        },
        MarkAllAsRead: function(){
            axios.post('/notification/readall');
        }
    }
}
</script>

<style scoped>

</style>
