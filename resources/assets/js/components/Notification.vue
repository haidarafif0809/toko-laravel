<template>
    <li class="dropdown">
        <a aria-expanded="false" aria-haspopup="true" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
            Notification <span class="badge">{{notifications.length}}</span>
        </a>
        <ul class="dropdown-menu">
            <li v-for="notification in notifications">
                <a href="" v-on:click="MarkAsRead(notification)">Pesanan Baru di Simpan pesanan <br>
                    <small>By {{notification.data.user.id}}</small>
                </a>
            </li>
            <li v-if="notifications.length == 0">
                Tidak ada notifikasi baru
            </li>
        </ul>
    </li>
</template>

<script>
export default {
    props: ['notifications'], 
    data: function(){
        return {
            url : window.location.origin+(window.location.pathname).replace("home", "/penjualan/view-buka-penjualan"),
        }
    },
    methods:{
        MarkAsRead: function(notification) {
            var data = {
                id: notification.id
            };
            axios.post(window.location.origin+(window.location.pathname).replace("home", "notification/read"), data)
            .then(resp => {
                // window.location.href = "penjualan/view-buka-penjualan";
            });
            // body...
        }
    }
}
</script>
