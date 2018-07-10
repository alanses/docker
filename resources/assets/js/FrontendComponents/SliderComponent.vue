<template>
    <div v-swiper:mySwiper="swiperOption">
        <div class="swiper-wrapper">
            <div class="swiper-slide" v-for="banner in banners">
                <img :src="banner">
            </div>
        </div>
        <div class="swiper-pagination swiper-pagination-bullets"></div>
    </div>
</template>

<script>
    import { swiper, swiperSlide } from 'vue-awesome-swiper'

    export default {
        data() {
            return {
                banners: [
                    '/image/galery-1-small.jpg',
                    '/image/galery-2-small.jpg',
                ],
                swiperOption: {
                    loop: true,
                    slidesPerView: 'auto',
                    centeredSlides: true,
                    spaceBetween: 30,
                    pagination: {
                        el: '.swiper-pagination',
                        dynamicBullets: true
                    },
                }
            }
        },
    }
</script>

<style lang="scss" scoped>
    .my-swiper {
        height: 300px;
        width: 100%;
    .swiper-slide {
        text-align: center;
        font-size: 38px;
        font-weight: 700;
        background-color: #eee;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .swiper-pagination {
    > .swiper-pagination-bullet {
        background-color: red;
    }
    }
    }
</style>