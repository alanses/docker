<template>
    <div class="google-map">
        <h1>{{ msg }}</h1>

        <div id="myMap"></div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                msg: 'Перша міська клінічна лікарня ім.Князя Лева'
            }},
        mounted: function() {
            this.map = new google.maps.Map(document.getElementById('myMap'), {
                center: {lat: 49.8467557, lng: 24.031112099999973},
                scrollwheel: false,
                zoom: 15
            }),
             this.marker = new google.maps.Marker({
                    position: this.map.center,
                    map: this.map
                });
        }

    }
</script>

<style scoped>
    #myMap {
        height:400px;
        width: 100%;
    }
</style>